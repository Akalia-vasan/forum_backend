<?php

namespace App\Http\Controllers\Role;

use App\Http\Requests\RoleRequest;
use App\Repositories\Admin\Role\RoleRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use DB;
class RoleTableController extends Controller
{
    /**
     * @var \App\Repositories\RoleRepository
     */
    protected $repository;

    /**
     * @param \App\Repositories\RoleRepository $roles
     */
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \App\Http\Requests\RoleRequest $request
     *
     * @return mixed
     */
    public function invoke(RoleRequest $request)
    {
        return Datatables::of($this->repository->getForDataTable())
            ->escapeColumns(['name'])
            ->addColumn('permissions', function ($role) {
                return implode("', '",$role->permissions->pluck('name')->toArray());
            })
            ->addColumn('users', function ($role) {
                return DB::table('model_has_roles')
                ->selectRaw('count(role_id) as count')
                ->groupBy('role_id')
                ->where('role_id', $role->id)->pluck('count')->first() ?? 0;
            })
            ->addColumn('actions', function ($role) {
                if($role->name == 'Admin')
                {
                    return '</a><a class="btn btn-secondary btn-sm" href="'.route('admin.auth.role.show', $role).'">
                    <i class="fa fa-eye" data-toggle="tooltip">
                    </i>
                    </a>';
                }
                else
                {
                    return '<a href="'.route('admin.auth.role.edit', $role).'" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a><a class="btn btn-secondary btn-sm" href="'.route('admin.auth.user.show', $role).'">
                    <i class="fa fa-eye" data-toggle="tooltip">
                    </i>
                    </a><a data-method="delete" href="'.route('admin.auth.role.destroy', $role).'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
                }
            })
            ->make(true);
    }
}

