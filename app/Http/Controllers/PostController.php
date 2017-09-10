<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
//use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
	//list
	public function index()
	{
		$posts = Post::orderBy('created_at','desc')->paginate(6);
		return view('post/index',compact('posts'));
	}

	//show
	public function show(Post $post)
	{
//		dd($post);
		return view('post/show',compact('post'));
	}

	//create
	public function create()
	{
//		print_r('dsds');
		return view('post/create');
	}

	//store
	public function store(Request $request)
	{
		$this->validate($request,[
			'title'=>'required|string|max:100|min:5',
			'content'=>'required|string|min:10',
		],[
			'title.min' => 'the length of article is too short',
		]);
		$post = Post::create(request(['title','content']));
		return redirect("/posts");
//		return view('post/create');
	}

	//edit
	public function edit(Post $post)
	{
		return view('post/edit',compact('post'));
	}

	//update
	public function update(Post $post,Request $request)
	{
		$this->validate(request(),[
			'title'=>'required|string|max:100|min:5',
			'content'=>'required|string|min:10',
		],[
			'title.min' => 'the length of article is too short',
		]);
//		$post->title = \request('title');
		$post->content = \request('content');
		$post->title = $request->title;
//		$post->content = $request->content;
		$post->save();
//		$post = Post::create(request(['title','content']));
		return redirect("/posts/{$post->id}");
	}

	//delete
	public function delete(Post $post)
	{
//		dd($post);
//		return view('post/create');
		$post->delete();
		return redirect("/posts");
	}
	public function imageUpload(Request $request)
	{
//		dd(\request()->all());
		$path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
		return asset('storage/'.$path);
//
//		return view('post/create');
	}

}
