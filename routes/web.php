<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/home', function () {
    echo "Home";
});

Route::get('/contact', [ContactController::class, 'index'])->middleware('check_age');

Route::get('/category/all', [CategoryController::class, 'allCategories'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'addCategory'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');

Route::put('/category/update/{id}', [CategoryController::class, 'updateCategory'])->name('update.category');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    //$users = User::all();
    $users = DB::table('users')->get();

    return view('dashboard')->with("users", $users);

})->name('dashboard');
