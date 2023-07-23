<?php

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

Route::get('/', function () {
    return view('welcome');
});

//Khusus Login
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::get('/signup', [LoginController::class,'signups'])->name('signup');

//Khusus Dashboard dan Prediksi
Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
Route::get('/prediction', [DashboardController::class,'predict'])->name('prediction');

//Khusus untuk Sales
Route::get('/sales', [SaleController::class,'index'])->name('sales');
Route::get('/createsales', [SaleController::class,'create'])->name('createsales');


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


