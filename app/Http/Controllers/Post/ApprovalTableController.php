<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Repositories\Admin\Post\PostApprovalRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Http\Responses\ViewResponse;
class ApprovalTableController extends Controller
{
   /**
     * @var \App\Repositories\PostApprovalRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\PostApprovalRepository $posts
     */
    public function __construct(PostApprovalRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\PostRequest $request
     *
     * @return mixed
     */
    public function invoke(PostRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['content'])
            ->addColumn('status', function ($post) {
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
                    $status = 'Reject';
                }
                return $status; 
            }) 
            ->addColumn('created_at', function ($post) {
                return Carbon::parse($post->created_at)->toDateString();
            })  
            ->addColumn('actions', function ($post) {
                return '<a href="'.route('auth.post.edit', $post).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
            })
            ->make(true);
    }
}