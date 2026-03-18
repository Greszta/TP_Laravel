<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SetLocaleController;
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


    Route::get('/', [EtudiantController::class, 'index'])->name('etudiant.index');
    Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index');
    Route::get('/etudiant/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show');

    Route::middleware('auth')->group(function() {
        Route::get('/create/etudiant', [EtudiantController::class, 'create'])->name('etudiant.create');
        Route::post('/create/etudiant', [EtudiantController::class, 'store'])->name('etudiant.store');
        Route::get('/edit/etudiant/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit');
        Route::put('/edit/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update');
        Route::delete('/etudiant/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');

        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/edit/user/{user}', [UserController::class, 'edit'])->name('user.edit');

        Route::resource('/articles', ArticleController::class);
        Route::resource('/documents', DocumentController::class);
    });
    
    //users
    Route::get('/registration', [UserController::class, 'create'])->name('user.create');
    Route::post('/registration', [UserController::class, 'store'])->name('user.store');
    
    
    //auth
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('auth.store');
    Route::get('/logout', [AuthController::class, 'destroy'])->name('logout');
    
    //lang
    Route::get('/lang/{locale}', [SetLocaleController::class, 'index'])->name('lang');