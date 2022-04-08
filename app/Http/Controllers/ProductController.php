<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'image|required|mimes:png,jpg,svg,jpeg|max:2048'
        ]);

        // $validatedData = $request->validate(
        //     // rule0
        //     [
        //         'name' => ['required', 'max:255'],
        //         'price' => 'required|integer',
        //         'image' => 'image|required|mimes:png,jpg,svg,jpeg|max:2048'
        //     ],
        //     // message
        //     [
        //         'name.required' => 'Nama harus disi',
        //         'name.required' => 'Password is harus disi',
        //         'price.integer' => 'Harus angka',
        //     ]
        // );


        $input = $request->all();
        if ($image = $request->file('image')) {
            $targetPath = 'image/';
            $product_img = date('YmHis') . "." . $image->getClientOriginalExtension();
            $image->move($targetPath, $product_img);
            $input['image'] = "$product_img";
        }

        Product::create($input);

        return redirect()->route('products.index')->with(
            'Success',
            'Product Created Successfully'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            // 'image' => 'image|required|mimes:png,jpg,svg,jpeg|max:2048'
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $targetPath = 'image/';
            $product_img = date('YmHis') . "." . $image->getClientOriginalExtension();
            $image->move($targetPath, $product_img);
            $input['image'] = "$product_img";
        } else {
            unset($input['image']);
        }

        $product->update($input);
        return redirect()->route('products.index')->with(
            'success',
            'Products berhasil diupdate'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        // $product->forceDelete();
        return redirect()->route('products.index')->with(
            'success',
            'Product berhasil didelete'
        );
    }
}
