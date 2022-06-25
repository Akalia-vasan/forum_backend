<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\Admin\User\UserRepository;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UserTableController.
 */
class UserTableController extends Controller
{
    /**
     * @var \App\Repositories\UserRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\\UserRequest $request
     *
     * @return mixed
     */
    public function invoke(UserRequest $request)
    {
        return Datatables::make($this->repository->getForDataTable($request->get('status'), $request->get('trashed')))
            ->escapeColumns(['name', 'email'])
            ->addColumn('roles', function ($user) {
                return $user->getRoleNames()->first();
            })
            ->addColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->toDateString();
            })
            ->addColumn('updated_at', function ($user) {
                return Carbon::parse($user->updated_at)->toDateString();
            })
            ->addColumn('actions', function ($user) {
                
                if($user->getRoleNames()->first() == 'Admin')
                {
                    return '<a href="'.route('admin.auth.user.edit', $user).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a><a class="btn btn-secondary btn-sm" href="'.route('admin.auth.user.show', $user).'">
                    <i class="fa fa-eye" data-toggle="tooltip">
                    </i>
                    </a>';
                }
                else
                {
                    return '<a href="'.route('admin.auth.user.edit', $user).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a><a class="btn btn-secondary btn-sm" href="'.route('admin.auth.user.show', $user).'">
                    <i class="fa fa-eye" data-toggle="tooltip">
                    </i>
                    </a><a data-method="delete" href="'.route('admin.auth.user.destroy', $user).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                }
                
            })
            ->make(true);
    }
}
