<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('pelanggan', [pelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('pelanggan/trash', [pelangganController::class, 'trash'])->name('pelanggan.trash');
    Route::get('pelanggan/add', [pelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('pelanggan/store', [pelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('pelanggan/{id}/edit', [pelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::post('pelanggan/{id}/update', [pelangganController::class, 'update'])->name('pelanggan.update');
    Route::post('pelanggan/{id}/delete', [pelangganController::class, 'delete'])->name('pelanggan.delete');
    Route::post('pelanggan/{id}/remove', [pelangganController::class, 'remove'])->name('pelanggan.remove');
    Route::post('pelanggan/{id}/restore', [pelangganController::class, 'restore'])->name('pelanggan.restore');

    Route::get('menu', [menuController::class, 'index'])->name('menu.index');
    Route::get('menu/trash', [menuController::class, 'trash'])->name('menu.trash');
    Route::get('menu/add', [menuController::class, 'create'])->name('menu.create');
    Route::post('menu/store', [menuController::class, 'store'])->name('menu.store');
    Route::get('menu/{id}/edit', [menuController::class, 'edit'])->name('menu.edit');
    Route::post('menu/{id}/update', [menuController::class, 'update'])->name('menu.update');
    Route::post('menu/{id}/delete', [menuController::class, 'delete'])->name('menu.delete');
    Route::post('menu/{id}/remove', [menuController::class, 'remove'])->name('menu.remove');
    Route::post('menu/{id}/restore', [menuController::class, 'restore'])->name('menu.restore');

    Route::get('dashboard', [pesananController::class, 'index'])->name('pesanan.index');
    Route::get('pesanan/trash', [pesananController::class, 'trash'])->name('pesanan.trash');
    Route::get('pesanan/add', [pesananController::class, 'create'])->name('pesanan.create');
    Route::post('pesanan/store', [pesananController::class, 'store'])->name('pesanan.store');
    Route::get('pesanan/{id}/edit', [pesananController::class, 'edit'])->name('pesanan.edit');
    Route::post('pesanan/{id}/update', [pesananController::class, 'update'])->name('pesanan.update');
    Route::post('pesanan/{id}/delete', [pesananController::class, 'delete'])->name('pesanan.delete');
    Route::post('pesanan/{id}/remove', [pesananController::class, 'remove'])->name('pesanan.remove');
    Route::post('pesanan/{id}/restore', [pesananController::class, 'restore'])->name('pesanan.restore');
});

require __DIR__.'/auth.php';
