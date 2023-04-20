<?php

use App\Http\Controllers\HomeController;
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

Auth::routes();
Route::view('/', 'lanling-page')->name('home');
Route::get('/check-email', function () {
    return view('welcome');
})->middleware(['auth', 'checkUser'])->name('checkemail');
Route::get('/oauth/gmail', function (){
    return LaravelGmail::redirect();
});

Route::get('/oauth/gmail/callback', function (){
    LaravelGmail::makeToken();
    return redirect()->to('/');
});

Route::get('/oauth/gmail/logout', function (){
    LaravelGmail::logout(); //It returns exception if fails
    return redirect()->to('/');
});
Route::get('admin/users', [HomeController::class, 'adminUser'])->name('admin.users.index');
Route::put('admin/users/{id}', [HomeController::class, 'adminUserActive'])->name('admin.users.active');
Route::delete('admin/users/{id}', [HomeController::class, 'adminDelete'])->name('admin.users.delete');

Route::view('/login-qb', 'login-qb');
