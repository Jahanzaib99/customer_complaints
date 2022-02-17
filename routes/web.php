<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Auth;
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
// Auth::routes();
// Route::post('login', [LoginController::class, 'loginPost'])->name('login.post');
// Route::get('login', [LoginController::class, 'login']);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' => 'complaints', 'middleware' => ['auth']], function() {
    Route::get('', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::post('', [ComplaintController::class, 'update'])->name('complaints.update');
});
require __DIR__.'/auth.php';
