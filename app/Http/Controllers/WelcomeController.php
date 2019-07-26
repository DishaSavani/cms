<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    //
    public function index()
    {

        //$tags = Post::with('post1')->get();
        return view('welcome')
        ->with('categories',Category::all())

        ->with('tags',Tag::all())
        ->with('posts',Post::searched()->simplePaginate(3));
    }
}
