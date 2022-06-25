<?php

namespace App\Http\Controllers\Post;

use App\Http\Requests\PostRequest;
use App\Repositories\Admin\Post\PostRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
class PostTableController extends Controller
{
   /**
     * @var \App\Repositories\PostRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\PostRepository $posts
     */
    public function __construct(PostRepository $repository)
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
        return Datatables::of($this->repository->getForDataTable(auth()->user()->id))
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
                return '<a href="'.route('auth.post.edit', $post).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                    </a><a data-method="delete" href="'.route('auth.post.destroy', $post).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
            })
            ->make(true);
    }
}
