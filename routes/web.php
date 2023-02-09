<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

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
    return view('index');
});

Route::get('explorar', function () {
    return view('explorar');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('forgot-password', function () {
        if (Auth::check()) {
            auth()->logout();
        }
        return view('forgot-password');
    });

    Route::post('forgot-password', 'forgotPassword')->name('password.request');

    Route::get('/reset-password/{token}', function ($token) {
        return view('reset-password', ['token' => $token]);
    })->middleware('guest')->name('password.reset');

    Route::post('reset-password', 'resetPassword')->name('password.update');

    Route::prefix('auth/github')->group(function () {
        Route::get('redirect', 'githubRedirect')->name('auth.github');
        Route::get('callback', 'githubCallback');
    });
    Route::prefix('auth/google')->group(function () {
        Route::get('redirect', 'googleRedirect')->name('auth.google');
        Route::get('callback', 'googleCallback');
    });
});

Route::controller(SessionController::class)->group(function () {
    Route::get('login', 'index')->middleware('guest');
    Route::get('logout', 'sair')->middleware('auth');
    Route::post('login', 'entrar')->middleware('guest');
    Route::get('perfil', 'perfil');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('register', 'index')->middleware('guest');
    Route::post('register', 'store')->middleware('guest');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('dashboard', 'index');
    Route::get('publicar', 'publicar');
    Route::get('ordens/{id}', 'ordens');
    Route::get('editar-publicacao/{id}', 'editarPublicacao');
    Route::get('inativar-publicacao/{id}', 'inativarPublicacao');
    Route::get('reativar-publicacao/{id}', 'reativarPublicacao');
    Route::get('projetos', 'ativarProjetos')->name("projetos");
    Route::get('editar-projeto/{id}', 'editarProjetos');
    Route::get('inativar-projeto/{id}', 'inativarProjetos');
    Route::get('reativar-projeto/{id}', 'reativarProjetos');
    Route::get('metricas', 'gerarMetricas');
    Route::post('editar-projeto', 'atualizarProjetos');
    Route::post('atualizar_doacao', 'atualizarDoacao');
    Route::post('publicar', 'criarPublicacao');
    Route::post('editar-publicacao', 'editar');
});

Route::controller(AccountController::class)->group(function () {
    Route::get('conta', 'index');
    Route::get('minhas-doacoes', 'minhasDoacoes');
    Route::get('ativar-chave/{id}', 'ativarChave');
    Route::get('desativar-chave/{id}', 'desativarChave');
    Route::post('atualizar-dados-projeto', 'editarDadosProjeto');
    Route::post('criar-pix', 'criarPix');
});
