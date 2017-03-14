<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    { 
      $this->middleware('guest:admin');
    }    
    //
    public function showLoginForm() {
    	return view('admin.login');
    }

    public function login(Request $request) {
    	//Validate login request
    	$this->validate($request, [
    		'email'		=>	'required|email',
    		'password'	=>	'required|min:6'
    	]);

    	//Attempt to login credentials
    	if(Auth::guard('admin')->attempt( ['email' => $request->email, 'password' => $request->password], $request->remember )){
    		// Redirect admin to intended dashboard if successful
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	// Redirect if login failed
    	return redirect()->back()->withInput($request->only('email'));
    }
}
