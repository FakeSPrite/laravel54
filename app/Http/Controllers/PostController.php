<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Post;
//use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
	//list
	public function index()
	{

		$user = \Auth::user();
		//依赖注入
		$app = app();
		$log= $app->make('log');
		$log->info("post_index",['data' => 'this is post index']);
		$posts = Post::orderBy('created_at','desc')->withCount(['zans','comments'])->paginate(6);
		return view('post/index',compact('posts','user'));
	}

	//show
	public function show(Post $post)
	{
//		dd($post);
		$post->load('comments');
		return view('post/show',compact('post'));
	}

	//create
	public function create()
	{
//		print_r('dsds');.
		$user = \Auth::user();
		return view('post/create',compact('user'));
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

		$user_id = \Auth::id();
		$params = array_merge(request(['title','content']),compact('user_id'));

		$post = Post::create($params);
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

		$this->authorize('update', $post);
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
		$this->authorize('delete',$post);
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

	public function comment(Post $post)
	{
		$this->validate(request(),[
			'content' => 'required|min:3',
		]);

		$comment = new Comment();
		$comment->user_id = \Auth::id();
		$comment->content = request('content');
		$post->comments()->save($comment);

		//back to original page
		return back();

	}

	public function zan(Post $post)
	{
		$zan = new \App\Zan;
		$zan->user_id = \Auth::id();
		$post->zans()->save($zan);
		return back();
	}

	/*
	 * 取消点赞
	 */
	public function unzan(Post $post)
	{
//		dd($post->zan(\Auth::id()));
		$post->zan(\Auth::id())->delete();
		return back();
	}

	public function search()
	{
		$this->validate(request(),[
			'query' => 'required'
		]);

		$query = request('query');
		$posts = Post::search(request('query'))->paginate(2);
//		dd($posts);
		return view('post/search', compact('posts', 'query'));
	}

}
