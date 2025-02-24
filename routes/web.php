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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/develop', function(){
    return 'Welcome to Developments';
})->name('develop.index');

Route::get('/develop/{develops}', function($develops)
{
    if ($develops === '5')
    {
        return redirect()->route('develop.index');
    }
    return 'Detalles del desarrollador ' . $develops;
});

Route::view('/welcome', 'welcome') -> name('welcome');
// Route::get('/dashboard', function () {
//     //EJECUCIÓN DEL MIDDLEWARE, ANTES DE DEVOLVER O MOSTRAR UNA VISTA
//     return view('dashboard');
//     //SE PUEDE EJECUTAR DESPUÉS DE DEVOLVERLO PARA MOSTRAR UNA VISTA
// })->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/posts', function () {
    return view('posts');
}) -> name('posts.index');
require __DIR__.'/auth.php';
