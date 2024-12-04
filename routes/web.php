<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                              |
|--------------------------------------------------------------------------|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('profile.dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
  
    Route::get('/produtos/listar', [ProdutoController::class, 'index'])->name('produtos.index'); 
    Route::get('/produtos/cadastrar', [ProdutoController::class, 'create'])->name('produtos.create'); 
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store'); 

    Route::get('/produtos/{produto}/edit', [ProdutoController::class, 'edit'])->middleware('can:product-edit')->name('produtos.edit'); 
    Route::put('/produtos/{produto}', [ProdutoController::class, 'update'])->middleware('can:product-edit')->name('produtos.update'); 
    Route::delete('/produtos/{produto}', [ProdutoController::class, 'destroy'])->middleware('can:product-delete')->name('produtos.destroy'); 
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
