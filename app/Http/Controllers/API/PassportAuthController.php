<?php
 
namespace App\Http\Controllers\API;
 
use App\Http\Controllers\Controller;
 
use Illuminate\Http\Request;
 
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
  
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
  
        $token = $user->createToken('Laravel9PassportAuth')->accessToken;
  
        return response()->json(['token' => $token], 200);
    }
  
    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
  
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;
            return response()->json([
                'success' => true,
                'message' => "Successfully Login",
                'token' => $token,
            ], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
 

    public function logout(Request $request)
    {
        try {
            auth()->user()->token()->revoke();
        } catch (\Exception $e) {
            return $this->respondInternalError($e->getMessage());
        }

        return $this->respond([
            'success' => true,
            'message' => trans('Successfully logout'),
        ]);
    }
}