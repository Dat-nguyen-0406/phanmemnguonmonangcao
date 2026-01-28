<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware; 
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Middleware\CheckTimeAccess;


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
        $title = "product list";
       
        return view('product.index',['title' => $title, 
        'products' => [
            ['id'=>1,'name'=>'san pham 1','price'=>1000],
            ['id'=>2,'name'=>'san pham 2','price'=>2000],
            ['id'=>3,'name'=>'san pham 3','price'=>3000],
        ]]); 
    }
    public function GetDetail(string $id = null)
    {
        return view('product.detail', ['id' => $id]);
    }
    public function Add()
    {
        return view('product.add');
    }

    public function store(Request $request)
    {
        $request->all();
    }

    public function login(){
        return view('product.login');
    }
     public function checkLogin(Request $request)
    {
        if($request->input('username') === 'datnguyen' && $request->input('password') === '1') {
            return "Login successful!";
        } else {
            return "Login failed!";
        }
    }
}