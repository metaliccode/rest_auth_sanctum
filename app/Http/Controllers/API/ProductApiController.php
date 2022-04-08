<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(['message' => 'Success', 'data' => $products, 200]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'image' => 'image|required|mimes:png,jpg,svg,jpeg|max:2048'
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $targetPath = 'image/';
            $product_img = date('YmHis') . "." . $image->getClientOriginalExtension();
            $image->move($targetPath, $product_img);
            $input['image'] = "$product_img";
        }

        Product::create($input);

        return response()->json(['message' => 'Success', 'data' => $input, 200]);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json(['message' => 'Success', 'data' => $product, 200]);
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'string|max:255',
            'price' => 'integer',
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

        $product = Product::find($id);
        $product->update($input);
        return response()->json(['message' => 'Success', 'data' => $product, 200]);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'Success', 'data' => $product, 200]);
    }
}
