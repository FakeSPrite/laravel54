<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
	//public setting page
	public function setting()
	{
		return view('user.setting');
	}
	//setting action
	public function settingStore(Request $request)
	{
	}

	//profile page
	public function show(User $user)
	{
		//personal information,follow,fans,articles
		$user = User::withCount(['stars','fans','posts'])->find($user->id);
//dd($user);
		//article list,first 10
		$posts = $user->posts()->orderBy('created_at','desc')->take(10)->get();

		//user that followed
		$stars  = $user->stars;
		$susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();


		//fans
		$fans = $user->fans;
		$fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();


		return view('user/show',compact('user','posts','susers','fusers'));
	}

	public function fan(User $user)
	{
		$me = \Auth::user();//get current user
		$me->doFan($user->id);
		return;
	}

	public function unfan(User $user)
	{
		return;
	}
}
