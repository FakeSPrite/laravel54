<?php

namespace App;

use App\Model;

class Comment extends Model
{
	//link post
	public function post()
	{
		return $this->belongsTo('App\Post');
	}

//	//comment model
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
