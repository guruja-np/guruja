<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Shared\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false,
]);
Route::get('/admin/login', function () {
    if (Auth::check() && Auth::user()->hasRole('admin')) {
        return Redirect::to('/admin/dashboard');
    }
    return view('auth/admin_login');
})->name('admin.login');
Route::post('/admin/login',[LoginController::class, 'login']);
Route::post('/admin/logout',[LoginController::class, 'logout']);
Route::get('/teacher/login', function () {
    if (Auth::check() && Auth::user()->role->name  == 'teacher') {
        return Redirect::to('/teacher/dashboard');
    }else if (Auth::check() && Auth::user()->hasRole('admin')) {
        return Redirect::to('/admin/dashboard');
    }
    return view('auth/teacher_login');
})->name('teacher.login');
Route::post('/teacher/login',[LoginController::class, 'login']);
Route::post('/teacher/register',[LoginController::class, 'registerTeacher']);
Route::post('/teacher/logout',[LoginController::class, 'logout']);

Route::prefix('admin')->name('admin.')->middleware(['auth', 'user-access:admin'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);

    Route::resource('/category', CategoryController::class);
});

Route::prefix('teacher')->name('teacher.')->middleware(['auth', 'user-access:teacher'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
});