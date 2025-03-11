<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/test',function(){
return view('frontend.layout.index');
});
Route::resource('expenses', ExpenseController::class);
Route::resource('category', CategoryController::class);
Route::resource('report', ReportController::class);
Route::resource('budget', BudgetController::class);
