<?php

namespace App\Http\Controllers;

use App\Models\Doacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Models\Publicacao;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->id_tipo == 2) {
                $data = DB::table('publicacoes')
                    ->leftJoin('doacoes', 'publicacoes.id', '=', 'doacoes.id_publicacao')
                    ->select(
                        'publicacoes.id',
                        'publicacoes.titulo',
                        'publicacoes.dt_inicio',
                        'publicacoes.dt_fim',
                        'publicacoes.ativo',
                        DB::raw('count(doacoes.id) as nr_doacoes')
                    )
                    ->where("publicacoes.id_usuario", "=", Auth::user()->id)
                    ->groupBy(
                        'publicacoes.id',
                        'publicacoes.titulo',
                        'publicacoes.dt_inicio',
                        'publicacoes.dt_fim',
                        'publicacoes.ativo'
                    )
                    ->orderBy('publicacoes.created_at', 'desc')
                    ->get();
                return view('dashboard', compact('data'));
            } else if (Auth::user()->id_tipo == 3) {
                return $this->ativarProjetos();
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function ordens(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->id_tipo == 2) {
                $data = DB::table('doacoes')
                    ->leftJoin('publicacoes', 'doacoes.id_publicacao', '=', 'publicacoes.id')
                    ->leftJoin('users', 'doacoes.id_usuario', '=', 'users.id')
                    ->leftJoin('situacoes', 'doacoes.id_status', '=', 'situacoes.id')
                    ->leftJoin('tipos_publicacao', 'publicacoes.id_tipo', '=', 'tipos_publicacao.id')
                    ->where('publicacoes.id', '=', $request->id)
                    ->select(
                        'doacoes.id',
                        'publicacoes.titulo',
                        DB::raw('DATE_FORMAT(doacoes.created_at, "%d/%m/%Y %H:%i:%s") as created_at'),
                        'users.name',
                        'tipos_publicacao.nm_tipo',
                        'situacoes.nm_situacao',
                        'situacoes.id as id_situacao'
                    )
                    ->orderBy('doacoes.id', 'desc')
                    ->get();

                return view('ordens', compact('data'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function gerarMetricas()
    {
        return view('metricas');
    }

    public function atualizarDoacao(Request $request)
    {
        $doacao = Doacao::find($request->id_doacao);

        $doacao->id_status = $request->id_status;
        $atualizar = $doacao->save();

        if ($atualizar) {
            echo json_encode(["message" => "Status da doação atualizada com sucesso"]);
        } else {
            echo json_encode(["message" => "Erro ao atualizar status da doação"]);
        }
    }

    public function publicar()
    {
        return view('publicar');
    }

    public function ativarProjetos()
    {
        $data = User::where('id_tipo', '=', '2')->orderBy('id', 'desc')->get();
        return view('projetos', compact('data'));
    }

    public function reativarProjetos(Request $request)
    {
        $projeto = User::find($request->id);
        $projeto->ativo = 1;
        $projeto->save();

        return redirect('projetos')->with('success', 'Projeto reativado com successo');
    }

    public function inativarProjetos(Request $request)
    {
        $projeto = User::find($request->id);
        $projeto->ativo = 0;
        $projeto->save();
        return redirect('projetos')->with('success', 'Projeto inativado com successo');
    }

    public function editarProjetos(Request $request)
    {
        $id = $request->id;
        $data = User::where('id', '=', $id)->get()->first();
        return view('editar-projeto', compact('data'));
    }

    public function atualizarProjetos(Request $request)
    {
        $projeto = User::find($request->id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'cep' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'celular' => 'required|max:15',
        ]);

        $projeto->name = $request->name;
        $projeto->email = $request->email;
        $projeto->celular = $request->celular;
        $projeto->cep = $request->cep;
        $projeto->rua = $request->rua;
        $projeto->bairro = $request->bairro;
        $projeto->complemento = $request->complemento;
        $projeto->cidade = $request->cidade;
        $projeto->uf = $request->uf;
        $projeto->save();

        return redirect('projetos')->with('success', 'Projeto atualizado com successo');
    }

    public function criarPublicacao(Request $request)
    {
        $publicacao = new Publicacao();

        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
            'imagem' => 'required',
            'dt_inicio' => [
                'required',
                'date_format:d/m/Y',
            ],
            'dt_fim' => [
                'required',
                'date_format:d/m/Y',
                'after_or_equal:dt_inicio'
            ]
        ]);

        $file = $request->file('imagem');
        $resize_image = Image::make($file->getRealPath());
        $resize_image->fit(444, 250);
        $name = $file->hashName();
        Storage::disk('ftp')->put('publicacoes/' . $name,  (string) $resize_image->encode());

        $publicacao->nm_imagem = $name;
        $publicacao->path_imagem = 'https://projetoscti.com.br/projetoscti01/tcc/publicacoes/' . $name;

        $publicacao->titulo = $request->titulo;
        $publicacao->descricao = $request->descricao;
        $publicacao->id_tipo = $request->tipo;
        $publicacao->id_usuario = auth()->user()->id;
        $publicacao->dt_inicio = $request->dt_inicio;
        $publicacao->dt_fim = $request->dt_fim;
        $publicacao->save();
        return redirect('dashboard')->with('success', 'Publicação criada com successo');
    }

    public function editarPublicacao(Request $request)
    {
        $id = $request->id;
        $data = Publicacao::where('id', '=', $id)->first();
        return view('editar-publicacao', compact('data', 'id'));
    }

    public function editar(Request $request)
    {
        $publicacao = Publicacao::find($request->id);

        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'tipo' => 'required',
            'dt_inicio' => [
                'required',
                'date_format:d/m/Y',
            ],
            'dt_fim' => [
                'required',
                'date_format:d/m/Y',
                'after_or_equal:dt_inicio'
            ],
        ]);

        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $resize_image = Image::make($file->getRealPath());
            $resize_image->fit(444, 250);
            $name = $file->hashName();
            Storage::disk('ftp')->put('publicacoes/' . $name,  (string) $resize_image->encode());

            $publicacao->nm_imagem = $name;
            $publicacao->path_imagem = 'http://projetoscti.com.br/projetoscti01/tcc/publicacoes/' . $name;
        }

        $publicacao->titulo = $request->titulo;
        $publicacao->descricao = $request->descricao;
        $publicacao->id_tipo = $request->tipo;
        $publicacao->id_usuario = auth()->user()->id;
        $publicacao->dt_inicio = $request->dt_inicio;
        $publicacao->dt_fim = $request->dt_fim;
        $publicacao->save();
        return redirect('dashboard')->with('success', 'Publicação atualizada com successo');
    }

    public function inativarPublicacao(Request $request)
    {
        $publicacao = Publicacao::find($request->id);
        $publicacao->ativo = 0;
        $publicacao->save();
        return redirect('dashboard')->with('success', 'Publicação inativada com successo');
    }

    public function reativarPublicacao(Request $request)
    {
        $publicacao = Publicacao::find($request->id);
        $publicacao->ativo = 1;
        $publicacao->save();
        return redirect('dashboard')->with('success', 'Publicação reativada com successo');
    }
}
