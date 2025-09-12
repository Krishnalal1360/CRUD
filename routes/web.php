<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*Route::get('/', function () {
    return view('customer.index');
});*/
//
Route::resource('customers', CustomerController::class);