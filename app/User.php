<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	protected $fillable = [
		'name', 'email', 'password',
	];

	//user posts list
	 public function posts()
	 {
		 return $this->hasMany(\App\Post::class,'user_id','id');
	 }

	 //fan who followed me
	public function fans()
	{
		return $this->hasMany(\App\Fan::class,'star_id','id');
	}

	//user that I follow
	public function stars()
	{
		return $this->hasMany(\App\Fan::class,'fan_id','id');
	}

	//I follow user
	public function dofan($uid)
	{
		$fan = new \App\Fan();
		$fan->star_id = $uid;
		return $this->stars()->save($fan);
	}

	//I unfollow user
	public function doUnfan($uid)
	{
		$fan = new \App\Fan();
		$fan->star_id = $uid;
		return $this->stars()->delete($fan);
	}

	//check whether uid followed
	public function hasFan($uid)
	{
		return $this->fans()->where('fan_id',$uid)->count();
	}

	//check whether follow uid
	public function hasStar($uid)
	{
		return $this->stars()->where('star_id',$uid)->count();
	}
}
