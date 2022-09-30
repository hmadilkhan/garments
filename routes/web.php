<?php

use App\Http\Controllers\DesignController;
use App\Http\Controllers\DimensionController;
use App\Http\Controllers\FabricTypeController;
use App\Http\Controllers\Finance\LedgerController;
use App\Http\Controllers\Finance\MainAccountController;
use App\Http\Controllers\Finance\SubAccountController;
use App\Http\Controllers\Finance\VoucherController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\UnitController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return redirect()->route("login");
    // return Inertia::render('Welcome', [
    //     'canLogin' => Route::has('login'),
    //     'canRegister' => Route::has('register'),
    //     'laravelVersion' => Application::VERSION,
    //     'phpVersion' => PHP_VERSION,
    // ]);
});

Route::get('/dashboard', function () {
    bcrypt("1234");
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource("design",DesignController::class);
Route::resource("fabric-type",FabricTypeController::class);
Route::resource("unit",UnitController::class);
Route::resource("dimension",DimensionController::class);
Route::resource("seller",SellerController::class);
Route::resource("main-account",MainAccountController::class);
Route::resource("sub-account",SubAccountController::class);
Route::resource("voucher",VoucherController::class);

Route::get("ledger/{id}",[LedgerController::class,'index'])->name("ledger.index");
Route::post("ledger/store",[LedgerController::class,'store'])->name("ledger.store");

require __DIR__.'/auth.php';
