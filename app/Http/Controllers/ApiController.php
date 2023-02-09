<?php

namespace App\Http\Controllers;

use App\Exports\MetricasExport;
use App\Models\Doacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Publicacao;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ApiController extends Controller
{
    public function getEnderecoProjetos()
    {
        $usuarios = User::where('id_tipo', '=', '2')->where('ativo', '=', '1')->get();

        if ($usuarios->count() > 0) {
            return response($usuarios->toJson(), 200);
        } else {
            $erro_message  = ['message' => 'Não existe projetos disponíveis no momento'];
            return response($erro_message, 404);
        }
    }

    public function getPublicacoes($id_usuario)
    {
        $publicacaoes = Publicacao::where('id_usuario', '=', $id_usuario)
            ->where('ativo', '=', 1)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($publicacaoes->count() > 0) {
            return response($publicacaoes->toJson(), 200);
        } else {
            $erro_message  = ['message' => 'Não existe publicações ativas para este usuário'];
            return response($erro_message, 404);
        }
    }

    public function getFormaRecebimento($id_usuario)
    {
        $user = User::where('id', '=', $id_usuario)->get();

        if ($user->count() > 0) {
            $pix = PaymentMethod::where('id_usuario', '=', $id_usuario)->where('ativo', '=', 1)->get();
            return response()->json(["usuario" => $user, "pix" => $pix], 200);
        } else {
            $erro_message  = ['message' => 'Não foi encontrado nenhum usuário ativo para o id recebido'];
            return response($erro_message, 404);
        }
    }

    public function salvarDoacao(Request $request)
    {
        $doacaoData = $request->input();
        $doacao = new Doacao();
        $doacao->id_usuario = $doacaoData['id_usuario'];
        $doacao->id_publicacao = $doacaoData['id_publicacao'];
        $doacao->id_status = $doacaoData['id_status'];
        $salvar = $doacao->save();

        if ($salvar) {
            $info_message  = ['message' => 'Doação salva com sucesso'];
            return response()->json($info_message, 200);
        } else {
            $erro_message  = ['message' => 'Houve um erro ao salvar a doação'];
            return response()->json($erro_message, 404);
        }
    }

    public function getMetricasTotais(Request $request)
    {
        if (count($request->all())) {
            $metricas = DB::table('publicacoes')
                ->leftJoin('doacoes', 'publicacoes.id', '=', 'doacoes.id_publicacao')
                ->select(
                    'publicacoes.id',
                    'publicacoes.titulo',
                    'publicacoes.dt_inicio',
                    'publicacoes.dt_fim',
                    'publicacoes.ativo',
                    'publicacoes.created_at',
                    DB::raw('count(doacoes.id) as nr_doacoes')
                )
                ->whereDate('publicacoes.created_at', '>=', $request->startDate)
                ->whereDate('publicacoes.created_at', '<=', $request->endDate)
                ->where("publicacoes.id_usuario", "=", $request->userId)
                ->where("doacoes.id_status", "=", 2)
                ->groupBy(
                    'publicacoes.id',
                    'publicacoes.titulo',
                    'publicacoes.dt_inicio',
                    'publicacoes.dt_fim',
                    'publicacoes.ativo',
                    'publicacoes.created_at'
                )
                ->get();

            if (count($metricas->all()) > 0) {
                return response()->json($metricas, 200);
            } else {
                $erro_message  = ['message' => 'Nenhuma publicação encontrada para o período solicitado'];
                return response()->json($erro_message, 404);
            }
        } else {
            $erro_message  = ['message' => 'Filtro não recebido'];
            return response()->json($erro_message, 400);
        }
    }

    public function atualizarIcone(Request $request)
    {
        $user = User::find($request->user_id);

        $user->profile_icon = $request->profile_icon;
        $atualizar = $user->save();

        if ($atualizar) {
            $erro_message  = ['message' => 'Ícone do perfil atualizado com sucesso'];
            return response()->json($erro_message, 200);
        } else {
            $erro_message  = ['message' => 'Erro ao atualizar ícone do perfil'];
            return response()->json($erro_message, 404);
        }
    }

    public function alterarSenha(Request $request)
    {
        $user = User::find($request->user_id);

        $hashedPassword = $user->first()->password;

        if (Hash::check($request->password, $hashedPassword)) {
            $user->password = bcrypt($request->new_password);
            $atualizar = $user->save();

            if ($atualizar) {
                $erro_message  = ['message' => 'Senha atualizada com sucesso', 'status'=> 200];
                return response()->json($erro_message, 200);
            } else {
                $erro_message  = ['message' => 'Ops! Houve um erro ao atualizar a senha', 'status'=> 404];
                return response()->json($erro_message, 404);
            }
        } else {
            $erro_message  = ['message' => 'A senha informada não está correta', 'status'=> 406];
            return response()->json($erro_message, 406);
        }
    }

    public function gerarExcel(Request $request)
    {
        return Excel::download(new MetricasExport($request), 'Relatório.' . $request->tipo);
    }

    public function getPixQrCode($chave_pix, $beneficiario_pix, $cidade_pix = null, $descricao = null, $valor_pix = null)
    {
        $identificador = "***";  //Utilizar *** para identificador gerado automaticamente.
        $px[00] = "01"; //Payload Format Indicator, Obrigatório, valor fixo: 01
        // Se o QR Code for para pagamento único (só puder ser utilizado uma vez), descomente a linha a seguir.
        //$px[01]="12"; //Se o valor 12 estiver presente, significa que o BR Code só pode ser utilizado uma vez. 
        $px[26][00] = "br.gov.bcb.pix"; //Indica arranjo específico; “00” (GUI) obrigatório e valor fixo: br.gov.bcb.pix
        $px[26][01] = $chave_pix;
        if (!empty($descricao)) {
            /* 
            Não é possível que a chave pix e infoAdicionais cheguem simultaneamente a seus tamanhos máximos potenciais.
            Conforme página 15 do Anexo I - Padrões para Iniciação do PIX  versão 1.2.006.
        */
            $tam_max_descr = 99 - (4 + 4 + 4 + 14 + strlen($chave_pix));
            if (strlen($descricao) > $tam_max_descr) {
                $descricao = substr($descricao, 0, $tam_max_descr);
            }
            $px[26][02] = $descricao;
        }
        $px[52] = "0000"; //Merchant Category Code “0000” ou MCC ISO18245
        $px[53] = "986"; //Moeda, “986” = BRL: real brasileiro - ISO4217
        if ($valor_pix > 0) {
            // Na versão 1.2.006 do Anexo I - Padrões para Iniciação do PIX estabelece o campo valor (54) como um campo opcional.
            $px[54] = $valor_pix;
        }
        $px[58] = "BR"; //“BR” – Código de país ISO3166-1 alpha 2
        $px[59] = $beneficiario_pix; //Nome do beneficiário/recebedor. Máximo: 25 caracteres.
        $px[60] = $cidade_pix; //Nome cidade onde é efetuada a transação. Máximo 15 caracteres.
        $px[62][05] = $identificador;
        //   $px[62][50][00]="BR.GOV.BCB.BRCODE"; //Payment system specific template - GUI
        //   $px[62][50][01]="1.2.006"; //Payment system specific template - versão
        $pix = montaPix($px);
        $pix .= "6304"; //Adiciona o campo do CRC no fim da linha do pix.
        $pix .= crcChecksum($pix); //Calcula o checksum CRC16 e acrescenta ao final.
        $linhas = round(strlen($pix) / 120) + 1;

        return response()->json(["brcodepix" => $linhas, "pix" => $pix], 200);
    }
}
