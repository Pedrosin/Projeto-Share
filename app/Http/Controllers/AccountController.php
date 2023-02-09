<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    function index()
    {
        $data = PaymentMethod::where("id_usuario", "=", Auth::user()->id)->get();
        return view('conta', compact('data'));
    }

    function minhasDoacoes()
    {
        if (Auth::check()) {
            $data = DB::table('doacoes')
                ->leftJoin('publicacoes', 'doacoes.id_publicacao', '=', 'publicacoes.id')
                ->leftJoin('situacoes', 'doacoes.id_status', '=', 'situacoes.id')
                ->leftJoin('tipos_publicacao', 'publicacoes.id_tipo', '=', 'tipos_publicacao.id')
                ->select(
                    DB::raw('DATE_FORMAT(doacoes.created_at, "%d/%m/%Y %H:%i:%s") as created_at'),
                    'publicacoes.titulo',
                    'situacoes.nm_situacao',
                    'tipos_publicacao.nm_tipo'
                )
                ->where('doacoes.id_usuario', '=', Auth::user()->id)
                ->orderBy('publicacoes.id', 'desc')
                ->get();
            return view('minhas-doacoes', compact('data'));
        } else {
            return redirect()->back();
        }
    }

    function editarDadosProjeto(Request $request)
    {
        $conta = User::find(auth()->user()->id);

        $messages = [
            'required' => 'O campo :attribute é obrigatório',
        ];

        $request->validate([
            'cep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
        ], $messages);

        $conta->cep = $request->cep;
        $conta->rua = $request->rua;
        $conta->bairro = $request->bairro;
        $conta->cidade = $request->cidade;
        $conta->complemento = $request->complemento;
        $conta->uf = $request->uf;
        $conta->save();

        return redirect('conta')->with('success', 'Endereço atualizado com successo');
    }

    function criarPix(Request $request)
    {
        $pix = new PaymentMethod();

        $request->validate([
            'tipo_chave' => 'required',
            'chave_pix'  => 'required'
        ]);

        $pix->id_usuario = auth()->user()->id;
        $pix->tp_chave = $request->tipo_chave;
        $pix->valor = $request->chave_pix;

        $chaves_ativas = PaymentMethod::where('ativo', '=', '1')->where('id_usuario', '=', auth()->user()->id)->count();

        if ($chaves_ativas > 0) {
            $pix->ativo = 0;
        } else {
            $pix->ativo = 1;
        }
        $pix->save();

        return redirect('conta')->with('success', 'Chave Pix cadastrada com sucesso');
    }

    function ativarChave(Request $request)
    {
        PaymentMethod::where('ativo', '=', '1')->update(['ativo' => 0]);

        $curr_chave = PaymentMethod::find($request->id);
        $curr_chave->ativo = 1;
        $curr_chave->save();

        return redirect('conta')->with('success', 'Chave Pix ativada');
    }

    function desativarChave(Request $request)
    {
        $curr_chave = PaymentMethod::find($request->id);
        $curr_chave->ativo = 0;
        $curr_chave->save();

        return redirect('conta')->with('success', 'Chave Pix desativada');
    }
}
