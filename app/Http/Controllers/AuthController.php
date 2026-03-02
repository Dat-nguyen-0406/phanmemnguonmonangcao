<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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

    public function ShowLogIn()
    {
        return view('admin.product.login');
    }


    public function CheckLogIn(Request $request)
{
    // 1. Lấy dữ liệu từ Form
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ];

    
    if (Auth::attempt($credentials)) {
        // Đăng nhập đúng -> Làm mới Session
        $request->session()->regenerate();
        
        // Chuyển hướng về trang Admin (Route đã đặt tên là layout.admin trong web.php)
        return redirect()->route('layout.admin');
    }

    // 3. Đăng nhập sai -> Quay lại trang login kèm thông báo lỗi
    return back()->with('error', 'Email hoặc mật khẩu không chính xác!');
}
}

