<?php

namespace App\Http\Controllers;


use App\Http\Requests\Posts\UpdatePostRequest;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\Posts\CreatePostRequest;
use Illuminate\Support\Facades\Storage;


//use App\Http\Requests\Categories\CreateCategoryRequest;


class PostController extends Controller
{
    public function  _construct(){
        $this->middleware('VerifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index  ')->with('posts',Post::all());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Posts.create')->with('category',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created r  esource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        //upload the images
       $image= $request->image->store('posts');
      $post =  Post::create([
         'title'=>$request->title,
         'decription'=>$request->decription,
         'content' =>$request-> content,
         'image'=>$image,
         'publishes_at' => $request->publish_at,
          'category_id' => $request->category,
          'user_id' =>auth()->user()->id
        ]);

      if($request->tags)
      {
          $post->tags()->attach($request->tags);
      }
        session()->flash('success','Post Created Successfully ');
        return redirect(route('post.index '));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('category',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        //
        $data = $request->only(['title','decription','content','publish_at']);
        if($request->hasFile('image')){

            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);
        session()->flash('success','Post Updated Successfully');
        return redirect(route('posts.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        if($post->trashed())
        {
            $post->deleteImage();
            $post->forceDelete();

        }else
        {
            $post->delete();

        }
        session()->flash('success','Post Deleted Successfully ');
        return redirect(route('posts.index'));

    }
    /**
     * Remove the specified resource from storage.
     *

     * @return \Illuminate\Http\Response
     */
    public function  trashed()
    {
        // only Trashed Data display
        $trashed = Post::onlyTrashed()->get();
        //all data dispap(trash + non-trashed)
        //$trashed = Post::withTrashed()->get();
        return view( 'posts.index')->with('posts',$trashed);

    }
    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        session()->flash('success','Post Restore Successfully ');
        return redirect()->back();
    }

}
