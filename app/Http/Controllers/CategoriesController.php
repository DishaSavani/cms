<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

use App\Http\Requests\Categories\UpadeteCategoryRequest;
use App\Http\Requests\Categories\CreateCategoryRequest;


class CategoriesController extends Controller
{
    //
    public function index()
    {
        return view('categories.index')->with('categories',Category::all());
    }
    public function create()
    {
        return view('categories.create');
    }
    public function store(CreateCategoryRequest $request)
    {
       Category::create([
          'name'=>$request->name
       ]);
       session()->flash('success','Categories Create Successfully');
       return redirect(route(' categories.index '));
    }
    public function show()
    {

    }
    public function edit(Category $category)
    {
        return view('categories.create ')->with('category',$category);
    }
    public function  update(UpadeteCategoryRequest $request,Category $category)
    {
        $category->name = $request->name;
        $category->save();
        session()->flash('success','Categories Updated Successfully');
        return redirect(route('categories.index'));
    }
    public function destroy(Category $category)
    {
        if ($category->posts->count() > 0){
            session()->flash('error','Categories cannot be Deleted because it has some post. ');
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success','Categories Deleted Successfully');
        return redirect(route('categories.index'));
    }

}
