<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::orderBy('name')->paginate(10);
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = new Categories();

        $category->name = $request->name;
        $category->description = $request->description;

        try {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $imageName = 'categories/'.time() . "." . $image->extension();
                $category->image = $imageName;
                Storage::put('public/'.$imageName, file_get_contents($image));
            }
            $category->save();
            return redirect()->route('categories.index')->with(['success'=>'Category added successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('categories.index')->with(['error'=>'Category adding failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Categories::findorFail($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::findorFail($id);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Categories::findorFail($id);
        $category->name = $request->name;
        $category->description = $request->description;

        try {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                if($category->image != NULL){
                    Storage::delete('public/'.$category->image);
                }
                $imageName = 'categories/'.time() . "." . $image->extension();
                $category->image = $imageName;
                Storage::put('public/'.$imageName, file_get_contents($image));
            }
            $category->save();
            return redirect()->route('categories.index')->with(['success'=>'Category edited successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('categories.index')->with(['error'=>'Category editing failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Categories::findorFail($id);
        try {
            $category->delete();
            return redirect()->route('categories.index')->with(['success'=>'Category deleted successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('categories.index')->with(['error'=>'Category deleting failed']);
        }
    }
}
