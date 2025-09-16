<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

/*Route::get('/', function () {
    return view('customer.index');
});*/
//
Route::get('customers/trash', [CustomerController::class, 'trashStore'])->name('customers.trash');
Route::get('customers/restore/{customer}', [CustomerController::class, 'restoreStore'])->name('customers.restore');
Route::delete('customers/force-destroy/{customer}', [CustomerController::class, 'forceDestroy'])->name('customers.forceDestroy');
Route::resource('customers', CustomerController::class);