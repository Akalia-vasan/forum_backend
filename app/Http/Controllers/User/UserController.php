<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use App\Http\Responses\ViewResponse;
use App\Models\User;
use App\Repositories\Admin\User\UserRepository;
use Illuminate\Support\Facades\View;
use App\Http\Requests\ManageUserRequest;
use App\Http\Requests\UserUpdateRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    
    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','show']]);
        $this->middleware('permission:user-create', ['only' => ['create','store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
        View::share('js', ['users']);
    }


    
    public function index()
    {
        return new ViewResponse('admin.user.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(ManageUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('assignees_role'));
    
        return redirect()->route('admin.auth.user.index')
                        ->with('success','User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.user.edit')
        ->withUser($user)
        ->withRoles($roles);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = bcrypt($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
    
        $user->assignRole($request->input('assignees_role'));
    
        return redirect()->route('admin.auth.user.index')
                        ->with('success','User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.auth.user.index')
                        ->with('success','User deleted successfully');
    }

    public function show(User $user)
    {
        return view('admin.user.show')
        ->withUser($user);
    }
}