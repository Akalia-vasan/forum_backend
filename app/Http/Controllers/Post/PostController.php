<?php

namespace App\Http\Controllers\Post;

use App\Http\Responses\ViewResponse;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\Post\PostRepository;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
class PostController extends Controller
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
        $this->middleware('permission:post-create', ['only' => ['create','store']]);
        $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:post-delete', ['only' => ['destroy']]);
        View::share('js', ['posts']);
    }

    public function index()
    {
        return new ViewResponse('admin.post.index');
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(PostStoreRequest $request)
    {
        $status = 1;
        if(auth()->user()->getRoleNames()->first() == 'Admin')
        {
            $status = 2;
        }
        $post = Post::create([
            'content' => $request->input('content'),
            'author_id' => auth()->user()->id,
            'status' => $status
            ]);
    
        return redirect()->route('auth.post.index')
                        ->with('success','Post created successfully');
    }

    public function edit(Post $post)
    {
        return view('admin.post.edit')
        ->withPost($post);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->content = $request->input('content');
        $post->save();
    
        return redirect()->route('auth.post.index')
                        ->with('success','Post updated successfully');
    }

    public function show(Post $post)
    {
    }

    public function destory(Post $post)
    {
        $post->delete();
        return redirect()->route('auth.post.index')->with('success','Post deleted successfully');
    }
}
