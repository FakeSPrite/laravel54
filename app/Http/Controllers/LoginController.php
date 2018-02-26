<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Auth;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Support\Facades\Response ;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class LoginController extends Controller
{
	//login page
	public function index()
	{
		return view('login.index');
	}

	//login page
	public function login()
	{
		$this->validate(request(),[
			'is_remember' =>'',
			'email' => 'required|email',
			'password' => 'required|min:4|max:10',
		]);

		$user = request(['email','password']);

		$is_remember = boolval(request('is_remember'));
//		dd([$user,$is_remember]);
		if(true ==Auth::attempt($user,$is_remember)){
			return redirect('/posts');
		}
			return Redirect::back()->withErrors('password is not correct');

	}
	//logout page
	public function logout()
	{
		Auth::logout();
		return redirect('/login');
	}
}
