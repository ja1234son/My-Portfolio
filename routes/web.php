<?php

use App\Http\Controllers\Api\AzamPayController;
use App\Http\Controllers\MailSendController;
use Illuminate\Support\Facades\Route;



Route::get('/',[MailSendController::class,'homePage'])->name('home.page');
Route::post('/',[MailSendController::class,'SendTestMail'])->name('email.post');


Route::get('/products', function(){
    return view('products');
});

Route::get('/view-cart-products', function(){
    return view('view_cart');
});

