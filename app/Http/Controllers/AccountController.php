<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AccountUpdateRequest;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function Update(AccountUpdateRequest $request)
    {
        $user = auth()->user();
        $input = $request->all();
    
        $user->update($input);
        
    
        return redirect()->back()
                        ->with('success','updated successfully');
    }

    public function password()
    {
        $user = auth()->user();
        $user->update(['password' => $input['password']]);
        
    
        return redirect()->back()
                        ->with('success','updated successfully');
    }
}
