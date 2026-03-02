<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware; 
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Middleware\CheckTimeAccess;
use App\Models\Product;

class ProductsController implements HasMiddleware 
{
    public static function middleware(): array
    {
        return [
           
            new Middleware(CheckTimeAccess::class),
        ];
    }

   

    public function index()
    {
    $products = Product::all(); // Lấy tất cả sản phẩm từ DB
    return view('admin.product.index', compact('products'));
    }

    public function GetDetail(string $id = null)
    {
        return view('admin.product.detail', ['id' => $id]);
    }
    public function Add()
    {
        return view('admin.product.add');
    }


    public function login(){
        return view('admin.product.login');
    }
     public function checkLogin(Request $request)
    {
        if($request->input('username') === 'datnguyen' && $request->input('password') === '1') {
            return "Login successful!";
        } else {
            return "Login failed!";
        }
    }
    public function store(Request $request)
    {
        //
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();
        return redirect('/product');
    }
    public function show(string $id)
    {
        //
        $product = Product::find($id);
        return view('admin.product.detail', ['product' => $product]);
    }
     public function edit(string $id)
    {
        //
        $product = Product::find($id);
        return view('admin.product.edit', ['product' => $product]);
    }
    public function update(Request $request, string $id)
    {
        //
        $product = Product::find($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        
        $product->save();
        return redirect('/product');
    }

    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect('/product');
    }

}