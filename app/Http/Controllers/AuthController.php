<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function SingIn()
    {
        return view('product.SingIn');
    }
    public function CheckSingIn(Request $request)
    {
        if(
        $request->input('username') === 'datnguyen' && 
        $request->input('password') === $request->input('repass') &&
        $request->input('mssv') === '0004267' && 
        $request->input('lopmonhoc') === '67PM1'
        ) 
        {
            return "Đăng ký thành công!";
        } else {
            return "Đăng ký thất bại!";
        }
    }
}
