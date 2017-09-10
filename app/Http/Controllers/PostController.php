<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //list
	public function index()
	{
		return view('post/index');
	}

	//show
	public function show()
	{
		$title = 'this is a big title';
		return view('post/show',['title'=>$title]);
	}

	//create
	public function create()
	{
		return view('post/create');
	}

	//store
	public function store()
	{
//		return view('post/create');
	}

	//edit
	public function edit()
	{
		return view('post/edit');
	}

	//update
	public function update()
	{
//		return view('post/update');
	}

	//delete
	public function delete()
	{
//		return view('post/create');
	}

}
