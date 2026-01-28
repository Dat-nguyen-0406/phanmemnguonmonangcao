<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Middleware\CheckTimeAccess;

Route::get('/', function () {
    return view('home');
})->name('home')   ;

Route::get('/login', [ProductsController::class, 'login'])
    ->middleware(CheckTimeAccess::class);

Route::post('/checklogin', [ProductsController::class, 'checklogin'])->name('checklogin');

Route::get('/SingIn', [AuthController::class, 'SingIn']);
Route::post('/CheckSingIn', [AuthController::class, 'CheckSingIn'])->name('CheckSingIn');


Route::prefix('products')->middleware(CheckTimeAccess::class)->group(function () {

 Route::controller(ProductsController::class)->group(function () {
    Route::get('/', 'index') ->name('products.index');

    Route::get('/add', 'Add')->name('products.add');

    Route::get('/detail/{id?}', 'GetDetail')->name('products.detail');

    });
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