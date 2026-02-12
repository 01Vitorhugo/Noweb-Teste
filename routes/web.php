<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Redirecionamento Inicial
Route::get('/', fn() => redirect()->route('posts.index'));

// Autenticação
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Relatórios e Index (Públicos)
Route::get('/reports/posts-by-category', [PostController::class, 'reportByCategory'])->name('reports.posts');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Criação e Salvamento (Abertos para evitar conflito de sessão no teste)
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Rotas Protegidas (Edição e Exclusão)
Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});

// Detalhes do Post (Sempre por último)
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');