<?php

namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Repositories\Admin\Post\PostApprovalRepository;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostRequest;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Response;

class ApprovalController extends Controller
{
    protected $repository;

    public function __construct(PostApprovalRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(PostRequest  $request)
    {
        $collection = $this->repository->retrieveData($request->all());

        return PostResource::collection($collection);
    }
    public function update(PostRequest $request, Post $post)
    {
        $post->reason = $request->reason;
        $post->status = $request->status;
        $post->save();
        
        return (new PostResource($post))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
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
      $posts = $postArray->get();
      return PostResource::collection($posts);
    }
}
