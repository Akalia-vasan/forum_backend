<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Repositories\Admin\User\UserRepository;
use App\Http\Resources\UserResource;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ManageUserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Response;
use App\Models\User;
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
    }

    public function index(UserRequest $request)
    {
        $collection = $this->userRepository->retrieveData($request->all());

        return UserResource::collection($collection);
    }

    public function store(ManageUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
    
        $user = User::create($input);
        $user->assignRole($request->input('assignees_role'));

        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(userUpdateRequest $request, User $user)
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
        return new UserResource($user);
    }

    public function destory(User $user)
    {
        $user->delete();
        return response()->noContent();

    }
    public function show(User $user)
    {
        return new UserResource($user);
    }
}