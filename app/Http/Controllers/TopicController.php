<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
    	//topic with article
	    $topic = Topic::withCount('postTopics')->find($topic->id);

        //list first 10
	    $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();

	    //belongs to me but not submit yet
	    $myposts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

		return view('topic/show',compact('topic','posts','myposts'));
    }

	public function submit(Topic $topic)
	{
		$this->validate(request(),[
			'post_ids' => 'required|array'
		]);

	/*	// 确认这些post都是属于当前用户的
		$posts = \App\Post::find(request(['post_ids']));
		foreach ($posts as $post) {
			if ($post->user_id != \Auth::id()) {
				return back()->withErrors(array('message' => '没有权限'));
			}
		}*/


		$post_ids = request('post_ids');
		$topic_id = $topic->id;
		foreach ($post_ids as $post_id){
			\App\PostTopic::firstOrCreate(compact('topic_id', 'post_id'));
		}
		return back();

	}
}
