<?php

namespace App;

use App\Model;

use Laravel\Scout\Searchable;

class Post extends Model
{
	use Searchable;


	//define type in the index
	public function searchableAs()
	{
		return "post";
	}

	//define which words to be search
	public function toSearchableArray()
	{
		return [
			'title' => $this->title,
			'content' => $this->content,
		];
	}

	protected $guarded=[];// not fillable feilds
//	protected $fillable = ['title', 'content'];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	//link comment
	public function comments()
	{
		return $this->hasMany('App\Comment')->orderBy('created_at','desc');
	}

	/*
	* 点赞
	*/
	public function zans()
	{
		return $this->hasMany(\App\Zan::class)->orderBy('created_at', 'desc');
	}

	/*
	 * 判断一个用户是否已经给这篇文章点赞了
	 */
	public function zan($user_id)
	{
		return $this->hasOne(\App\Zan::class)->where('user_id', $user_id);
	}
}
