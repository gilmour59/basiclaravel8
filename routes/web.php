<?php

use App\Http\Controllers\BrandController;
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
Route::get('/category/trash/{id}', [CategoryController::class, 'trashCategory'])->name('trash.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCategory'])->name('restore.category');
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');

Route::get('/brand/all', [BrandController::class, 'allBrands'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'addBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand'])->name('edit.brand');
Route::put('/brand/update/{id}', [BrandController::class, 'updateBrand'])->name('update.brand');
Route::get('/brand/trash/{id}', [BrandController::class, 'trashBrand'])->name('trash.brand');
Route::get('/brand/restore/{id}', [BrandController::class, 'restoreBrand'])->name('restore.brand');
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand'])->name('delete.brand');

Route::get('/multipic/all', [BrandController::class, 'allMultipics'])->name('all.multipic');
Route::post('/multipic/add', [BrandController::class, 'addMultipic'])->name('store.multipic');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    //$users = User::all();
    //$users = DB::table('users')->get();

    //return view('dashboard')->with("users", $users);
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout/', [BrandController::class, 'logout'])->name('user.logout');