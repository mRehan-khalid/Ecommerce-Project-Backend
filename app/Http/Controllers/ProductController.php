<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    function addProduct(Request $req){
        $product = new Product;
        $product->product_name = $req->input('product_name');
        $product->product_price = $req->input('product_price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('file_path')->store('products');
        $product->save();
        return $product;    

    }

    function productsList()
    {
        return Product::all();
    }

    function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json(['message' => 'Product deleted successfully']);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    function getProductById($id)
    {
        $product = Product::find($id);
        if ($product) {
            return $product;
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    function updateProduct(Request $req, $id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->product_name = $req->input('product_name', $product->product_name);
            $product->product_price = $req->input('product_price', $product->product_price);
            $product->description = $req->input('description', $product->description);
            if ($req->hasFile('file_path')) {
                $product->file_path = $req->file('file_path')->store('products');
            }
            $product->save();
            return $product;
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    function searchProduct($key)
    {
        return Product::where('product_name', 'LIKE', "%$key%")->get();
    }
}
