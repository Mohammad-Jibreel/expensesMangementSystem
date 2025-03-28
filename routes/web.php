<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\GroupExpenseController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SavingGoalController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;



Route::get('/', [FAQController::class, 'index']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ForgotPasswordController::class, 'reset']);

Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');




Route::get('/test',function(){
return view('layouts.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');



Route::resource('expenses', ExpenseController::class);
Route::resource('category', CategoryController::class);
Route::resource('report', ReportController::class);
Route::resource('budgets', BudgetController::class);
Route::get('/reports/export/{id}/{format}', [ReportController::class, 'export'])->name('reports.export');
Route::get('/reports/export/all/{format}', [ReportController::class, 'exportAll'])->name('reports.export.all');
Route::resource('groups', GroupController::class);
Route::resource('group-members', GroupMemberController::class);
Route::resource('group-expenses', GroupExpenseController::class);
Route::resource('rewards', RewardController::class);
Route::resource('challenges', ChallengeController::class);
Route::resource('savings', SavingGoalController::class);
Route::middleware(['auth'])->group(function () {
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/contact', function () {
        return view('dashboard.contact.create'); // Make sure you have a `contact.blade.php` file
    })->name('contact.create');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [UserController::class, 'show'])->name('profile.show'); // Show profile
    Route::get('profile/edit', [UserController::class, 'edit'])->name('profile.edit'); // Edit profile
    Route::put('profile', [UserController::class, 'update'])->name('profile.update'); // Update profile
});
