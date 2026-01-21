<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home');
})->name ('home');



Route::prefix('products')->group(function () {

    Route::get(
        '/', function () {
           return view('product.index');
        }
    )
    ->name('products.index');

    Route::get(
        '/add', function () {
            return view('product.add');
        }
    )
    -> name('products.add');

    Route::get(
        '/{id?}', function ($id) {
            return "chi tiết sản phẩm" . $id;
        }
    );  
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