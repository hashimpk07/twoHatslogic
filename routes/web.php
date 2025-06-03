<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
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
// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [ProductController::class, 'index'])->name('products.index');


Route::get('/carts', [CartController::class, 'show'])->name('carts.show');
Route::post('/carts/add', [CartController::class, 'add'])->name('carts.add');
Route::post('/carts/update/{item}', [CartController::class, 'update'])->name('carts.update');
Route::post('/carts/remove/{item}', [CartController::class, 'remove'])->name('carts.remove');