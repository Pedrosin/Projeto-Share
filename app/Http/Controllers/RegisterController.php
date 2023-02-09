<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmarProjeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Exception;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $user = new User();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'cep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'celular' => 'required|max:15',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cep = $request->cep;
        $user->rua = $request->rua;
        $user->bairro = $request->bairro;
        $user->complemento = $request->complemento;
        $user->cidade = $request->cidade;
        $user->uf = $request->uf;
        $user->celular = $request->celular;

        if ($request->has('tipo')) {
            $user->ativo = 0;
            $user->id_tipo = $request->tipo;
        }

        $user->save();

        if ($request->tipo == 2) {
            try {
                Mail::to([
                    'lucas.hayashi@unesp.br',
                    'victor.b.pereira@unesp.br'
                ])->send(new ConfirmarProjeto($request->name));

                return redirect('/login')->with('success', 'Sua conta foi criada, agora é só aguardar 
                pela análise do nosso time!');
            } catch (Exception $ex) {
                return redirect('/login')->with('error', 'Erro ao criar a conta ' . $ex->getMessage());
            }
        } else {
            auth()->login($user);
            return redirect('/explorar');
        }
    }
}
