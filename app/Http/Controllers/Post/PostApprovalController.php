<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Repositories\Admin\Post\PostApprovalRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Http\Responses\ViewResponse;
use Illuminate\Support\Facades\View;
use App\Models\Post;
use App\Models\Comment;
class PostApprovalController extends Controller
{

        protected $repository;

    public function __construct(PostApprovalRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('permission:post-apporoval-list|post-apporoval-approved', ['only' => ['index','show']]);
        $this->middleware('permission:post-apporoval-approved', ['only' => ['edit','update']]);
        View::share('js', ['approvals']);
    }

    public function index()
    {
        return new ViewResponse('admin.approval.index');
    }
    public function show(Post $post)
    {
        $status = '';
        if($post->status == 1)
        {
            $status = 'Open';
        }
        if($post->status == 2)
        {
            $status = 'Approved';
        }
        if($post->status == 3)
        {
            $status = 'Rejected';
        }
        $post->setAttribute('flag', $status);
        return view('admin.approval.show')->withPost($post);
    }

    public function update(PostRequest $request, Post $post)
    {
        if($request->status == 2)
        {
            $post->reason = $request->reason;
            $post->status = $request->status;
            $post->save();

            return redirect()->route('auth.post.approval.index')
            ->with('success','Post has been approved');
        }

        if($request->status == 3)
        {
            $post->reason = $request->reason;
            $post->status = $request->status;
            $post->save();
            
            return redirect()->route('auth.post.approval.index')
            ->with('success','Post has been rejected');
        }
    
        
    }

    public function filter(PostRequest $request)
    {
      
      $postArray = Post::where('status', 2);
      if($request->name && $request->name != '')
      {
          $userId = DB::table('users')->where('name', 'LIKE', '%'.$request->name.'%')->pluck('id')->toArray();
          if(empty($userId))
          {
            $postArray->where('content', 'LIKE', '%'.$request->name.'%');
          }
          else
          {
            $postArray->whereIn('author_id', $userId);
          }
         

      }
      $posts = $postArray->paginate(5);
      return view('includes.partials._dashboard-part', compact('posts'))->render();
    }
    public function askQua(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->where('parent_id', null)->get();

        return view('qa', compact('post', 'comments'));
    }

    public function reply(CommentUpdateRequest $request)
    {
        $comment = (new Comment())->create([
            'content' => $request->content,
            'author_id' => auth()->user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id
        ]);
        
        return redirect()->back();
    }

    public function comment(CommentUpdateRequest $request)
    {
        $comment = (new Comment())->create([
            'content' => $request->content,
            'author_id' => auth()->user()->id,
            'post_id' => $request->post_id
        ]);
        
        return redirect()->back();
    }

    public function view()
    {
        $now = carbon()->now();
        return Comment::where('parent_id', request()->input('parent'))->get()
            ->each(function ($obj) use ($now) {
                $obj->child = Comment::where('parent_id', $obj->id)->count();
                $obj->ago = $obj->created_at->diffForHumans($now);
                $obj->user = $obj->user->name;
            });
    }

    public function updateComment(CommentUpdateRequest $request)
    {
        $commentId = $request->input('commentId');
        $commentValue = $request->input('commentValue');
        $comment = Comment::where('id', $commentId)->first();
        $comment->content = $commentValue;
        $comment->save();
        
        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function destroy(PostRequest $request)
    {
        $commentId = $request->input('commentId');
        Comment::where('parent_id', $commentId)->delete();
        Comment::where('id', $commentId)->delete();

        
        return response()->json([
            'success' => true
        ]);
    }

}
