<?php

use App\Http\Controllers\AdmissionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('admission', [AdmissionController::class, 'admission'])->name('admission');
    Route::post('stripe-payment', [StripeController::class, 'stripe_payment'])->name('stripe');
    Route::post('cash-payment', [StripeController::class, 'cash_payment'])->name('cash');
    Route::resource('invoice', InvoiceController::class);
    Route::resource('lead', LeadController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('course', CourseController::class);
    Route::resource('class', CurriculumController::class);
    Route::resource('quiz', QuizController::class);
    Route::resource('question', QuestionController::class);
});

require __DIR__.'/auth.php';
