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


Route::get('/', function () {
    return view('welcome');
});

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
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');


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
Route::post('/add-expense', function (Request $request) {
    $text = $request->input('text');

    // تحليل الجملة واستخراج البيانات (المبلغ، الفئة)
    preg_match('/(\d+)\s*ريال.*(المطعم|السوق|البقالة|المقهى)/u', $text, $matches);

    if (count($matches) >= 3) {
        $amount = $matches[1];  // المبلغ
        $category = $matches[2]; // الفئة

        // إضافة المصروف لقاعدة البيانات
        Expense::create([
            'amount' => $amount,
            'category' => $category,
            'user_id' => auth()->id() ?? 1 // تأكد من استخدام نظام تسجيل الدخول
        ]);

        return response()->json(['message' => "تمت إضافة مصروف $amount ريال في فئة $category"]);
    }

    return response()->json(['message' => "تعذر فهم الجملة"], 400);
});
Route::resource('savings', SavingGoalController::class);
Route::get('/update-savings', [SavingGoalController::class, 'updateSavings'])->name('savings.update');
