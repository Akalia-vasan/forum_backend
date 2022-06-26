<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Repositories\Admin\Post\PostApprovalRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Http\Responses\ViewResponse;
use Illuminate\Support\Facades\View;
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

}
