<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiController::class)->group(function () {
    Route::get('endereco', 'getEnderecoProjetos');
    Route::get('publicacoes/{id}', 'getPublicacoes');
    Route::get('recebimento/{id_usuario}', 'getFormaRecebimento');
    Route::get('gerarchavepix/{chave_pix}/{beneficiario_pix}/{cidade_pix}/{descricao?}/{valor_pix?}', 'getPixQrCode');
    Route::post('concluirdoacao', 'salvarDoacao');
    Route::put('atualizaricone', 'atualizarIcone');
    Route::put('alterarsenha', 'alterarSenha');

    Route::prefix('metricas')->group(function () {
        Route::post('totais', 'getMetricasTotais');
        Route::post('publicacao', 'getMetricasPublicacao');
        Route::get('gerarExcel/{startDate}/{endDate}/{userId}/{tipo}', 'gerarExcel');
    });
});
