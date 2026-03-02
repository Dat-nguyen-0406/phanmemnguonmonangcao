<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Middleware\CheckTimeAccess;
use App\Http\Middleware\CheckAge;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home')   ;

Route::get('/login', [AuthController::class, 'ShowLogIn'])
    ->middleware(CheckTimeAccess::class);
Route::post('/login', [AuthController::class, 'CheckLogIn'])->name('CheckLogIn');


// đăng ký
Route::get('/SingIn', [AuthController::class, 'SingIn']);
Route::post('/CheckSingIn', [AuthController::class, 'CheckSingIn'])->name('CheckSingIn');

//tuổi
Route::get('/age', function () {
    return view('age');
});
Route::post('/save-age', function (Request $request) {
    $age = $request->input('age');
    session(['age' => $age]);
    return 'Tuổi đã được lưu là: ' . $age . ' <br> <a href="'.route('products.index').'">Nhấn vào đây vào trang Products</a>';
})->name('save.age');;

Route::prefix('product')->middleware([CheckTimeAccess::class , CheckAge::class])->group(function () {

 Route::controller(ProductsController::class)->group(function () {
    Route::get('/', 'index') ->name('products.index');

    Route::get('/add', 'Add')->name('products.add');

    Route::get('/detail/{id?}', 'GetDetail')->name('products.detail');

    });
}); 



Route::get('/admin', function () {
    return view('layout.admin');
})->name('layout.admin');

Route::prefix('admin/category')->group(function () {
    Route::get('/', function () {
        return "Trang danh sách Category";
    })->name('category.index');

    Route::get('/add', function () {
        return "Trang thêm Category";
    })->name('category.add');
});


Route::prefix('sinhvien')->group(function(){

     Route::get('/{name?}/{mssv?}',function($name ='Luong Xuan Hieu',$mssv='123456'){
        return "Họ và tên : Nguyễn Thành Đạt <br> MSSV : 0004267<br>Lớp : 67PM1";
    }); 
});



Route::get('/banco/{n}', function ($n) {
    return view('banco.viewsbanco', ['n' => $n]);
})
->where('n', '[0-9]+')
->name('banco.viewsbanco');



Route::fallback(function () {
    return view('error.404');
});