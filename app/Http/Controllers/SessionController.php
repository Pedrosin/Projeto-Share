<?php

namespace App\Http\Controllers;

use App\Models\ProfileIcon;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function perfil()
    {
        $data = ProfileIcon::all();
        $profile_icon =  ProfileIcon::where('id', '=', Auth()->user()->profile_icon)->first();
        return view('perfil', compact('data', 'profile_icon'));
    }

    public function entrar(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'ativo' => '1'
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password, 'ativo' => 1])) {
            $id_tipo = auth()->user()->id_tipo;

            switch ($id_tipo) {
                case 1:
                    $url = '/explorar';
                    break;
                case 2:
                    $url = '/dashboard';
                    break;
                case 3:
                    $url = '/dashboard';
                    break;
            }
            return redirect($url);
        } else {
            return back()->withInput()->withErrors(['credenciais' => 'Credenciais inválidas, ou usuário inativo.']);
        }

        return back()->withErrors(['email' => 'Seu e-mail não pode ser verificado.']);
    }

    public function sair()
    {
        auth()->logout();

        return redirect('/login')->with('success', 'Desconectado, até logo!');
    }
}
