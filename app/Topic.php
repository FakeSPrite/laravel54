<?php

namespace App;

use App\Model;

class Topic extends Model
{
    public function posts()
    {
    	return $this->belongsToMany(\App\Post::class,'post_topics','topic_id','post_id');
    }

    //topic article amount,for withCount
    public function postTopics()
    {
    	return $this->hasMany(\App\PostTopic::class,'post_id');
    }
}
