<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::orderBy('name')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::orderBy('name')->get();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product =  new Products();

        $product->name = $request->name;
        $product->category = $request->category;

        try {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $imageName = 'products/'.time() . "." . $image->extension();
                $product->image = $imageName;
                Storage::put('public/'.$imageName, file_get_contents($image));
            }
            $product->save();
            return redirect()->route('products.index')->with(['success'=>'Product added successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with(['error'=>'Product adding failed']);
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
        $product = Products::findorFail($id);
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::orderBy('name')->get();
        $product = Products::findorFail($id);
        return view('admin.product.edit', compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Products::findorFail($id);

        $product->name = $request->name;
        $product->category = $request->category;

        try {
            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                if($product->image != NULL){
                    Storage::delete('public/'.$product->image);
                }
                $imageName = 'products/'.time() . "." . $image->extension();
                $product->image = $imageName;
                Storage::put('public/'.$imageName, file_get_contents($image));
            }
            $product->save();
            return redirect()->route('products.index')->with(['success'=>'Product edited successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with(['error'=>'Product editing failed']);
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
        $product = Products::findorFail($id);
        try {
            $product->delete();
            return redirect()->route('products.index')->with(['success'=>'Product deleted successfully']);
        } catch (\Throwable $th) {
            return redirect()->route('products.index')->with(['error'=>'Product deleting failed']);
        }
    }
}
