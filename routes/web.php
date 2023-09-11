<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::get('/Principal', function () {
    return view('welcome');
});

Route::get ('/', 'App\Http\Controllers\PrincipalController@principal')->name('site.index');
Route::get ('/SobreNos', 'App\Http\Controllers\SobreNosController@principal')->name('site.sobrenos');
Route::get ('/Contato', 'App\Http\Controllers\ContatoController@principal')->name('site.contato');

route::prefix("/admin")->group (function(){
    Route::get('/Clientes', function(){return 'Clientes';});
    Route::get('/Fornecedores', 'App\Http\Controllers\FornecedorController@index')->name('admin.fornecedores');
    route::get('/Produtos', function(){return 'Produtos';});
});

Route::get('/admin', function(){
    return redirect()->route('site.index');
}
);

Route::fallback(function() { 
    echo 'a rota não existe <a href= "'.route('site.index').'"> Clique aqui </a> ';
}
);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
