<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	//public setting page
	public function setting()
	{
		return view('user.setting');
	}
	//setting action
	public function settingStore()
	{
	}
}
