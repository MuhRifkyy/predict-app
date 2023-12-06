<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\StocksController;
use App\Models\Stock;

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


use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\MetodeController;

// use Illuminate\Support\Facades

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
->name('logout');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
    Route::get('/sales', [SaleController::class,'index'])->name('sales');
    Route::get('/createsales', [SaleController::class,'create'])->name('createsales');
    Route::post('/postsales', [SaleController::class,'store'])->name('postsales');
    
  
});

Route::get('/', function () {
    return view('welcome');
});


//Khusus Dashboard dan Prediksi
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('/prediction', [DashboardController::class,'predict'])->name('prediction');

//Khusus untuk Sales


//Khusus untuk Stok
Route::get('/stock', [StocksController::class,'index'])->name('stock');
Route::get('/createstock', [StocksController::class,'create'])->name('createstock');
Route::post('/poststock', [StocksController::class,'store'])->name('poststock');
Route::get('/editstock/{id}', [StocksController::class,'edit'])->name('editstock');
Route::post('/updatestock', [StocksController::class,'update'])->name('updatestock');
Route::get('/deletestock/{id}', [StocksController::class,'destroy'])->name('deletestock');


//Khusus untuk Customer
Route::get('/customer', [CustomerController::class,'index'])->name('customer');
Route::get('/customercreate', [CustomerController::class,'create'])->name('customercreate');
Route::post('/customerpost', [CustomerController::class,'store'])->name('customerpost');
Route::get('/editcustomer/{id}', [CustomerController::class,'edit'])->name('customeredit');
Route::post('/customerupdate', [CustomerController::class,'update'])->name('customerupdate');
Route::get('/customerdelete/{id}', [CustomerController::class,'destroy'])->name('customerdelete');

//Khusus untuk Produk
Route::get('/product', [ProdukController::class,'index'])->name('product');
Route::get('/createproduct', [ProdukController::class,'create'])->name('createproduct');
Route::post('/postproduct', [ProdukController::class,'store'])->name('postproduct');
Route::get('/editproduct/{id}', [ProdukController::class,'edit'])->name('editproduct');
Route::post('/updateproduct', [ProdukController::class,'update'])->name('updateproduct');
Route::get('/deleteproduct/{id}', [ProdukController::class,'destroy'])->name('deleteproduct');


// route viwe ke metode
Route::get("/methode",[MetodeController::class,'index'])->name('methode.index');
Route::post("/methode",[MetodeController::class,'store'])->name('methode.store');
