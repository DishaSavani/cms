<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Http\Requests\Tags\CreateTagRequest;





class TagsController extends Controller
{
    //
    public function index()
    {
        return view('tags.index')->with('tags',Tag::all());
    }
    public function create()
    {
        return view('tags.create');
    }
    public function store(CreateTagRequest $request)
    {
        Tag::create([
            'name'=>$request->name
        ]);
        session()->flash('success','Tags Create Successfully');
        return redirect(route(' tags.index '));
    }
    public function show()
    {

    }
    public function edit(Tag $tag)
    {
        return view('tags.create')->with('tag',$tag);
    }
    public function  update(UpdateTagRequest $request,Tag $tag)
    {
        $tag->update([
            'name' => $request->name
        ]);

      //  $tag->save();
        session()->flash('success','Tags Updated Successfully');
        return redirect(route('tags.index'));
    }
    public function destroy(Tag $tag)
    {
        if($tag->posts->count() > 0)
        {
            session()->flash('error','Tags cannot be Deleted because it is associated to some posts  ');
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success','Tags Deleted Successfully');
        return redirect(route('tags.index'));
    }

}
