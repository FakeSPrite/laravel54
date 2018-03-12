<?php

/**
 * Date: 12/03/2018
 * Time: 7:11 AM
 */
namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	/*
	 * 用户列表
	 */
	public function index() {
		$users = \App\AdminUser::paginate( 10 );

		return view( '/admin/user/index', compact( 'users' ) );
	}
}