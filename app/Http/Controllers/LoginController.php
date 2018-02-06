<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
		return null;
	}
	//logout page
	public function logout()
	{
		return null;
	}
}
