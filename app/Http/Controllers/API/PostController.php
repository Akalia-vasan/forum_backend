<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\Admin\Post\PostRepository;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Response;
class PostController extends Controller
{
    protected $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
        // $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => ['index','show']]);
        // $this->middleware('permission:post-create', ['only' => ['create','store']]);
        // $this->middleware('permission:post-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:post-delete', ['only' => ['destroy']]);
    }

    public function index(PostRequest  $request)
    {
        $collection = $this->repository->retrieveData($request->all());

        return PostResource::collection($collection);
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
        if($post->status == '1')
        {
            $data = [
                'content' => $post->content
            ];
            Mail::send('emails.post-notify', $data, function ($message) use ($data) {
                $message->from(config('mail.from.address'), 'Forum');
                $message->subject("Approval Requested");
                $message->to(['admin@gmail.net']);
            });
        }    
        
        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

   

    public function update(PostUpdateRequest $request, Post $post)
    {
        $post->content = $request->input('content');
        $post->save();
    
        return new PostResource($post);
    }


    public function destory(Post $post)
    {
        $post->delete();
        return response()->noContent();
    }
}