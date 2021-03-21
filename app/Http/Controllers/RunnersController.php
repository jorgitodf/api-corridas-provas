<?php

namespace App\Http\Controllers;

use App\Runners;
use App\Validations\Validations;
use Illuminate\Http\Request;

class RunnersController extends Controller
{
    protected $runners;
    private $validations;

    /**
     * injeção de dependência dos objetos Runners e Validations
     *
     * @param Runners $runners
     * @param Validations $validations
     */
    public function __construct(Runners $runners, Validations $validations)
    {
        $this->runners = $runners;
        $this->validations = $validations;
    }

    /**
     * Lista todos os corredores cadastrados
     *
     * @return void
     */
    public function index()
    {
        return $this->runners::all();
    }

    /**
     * Armazena na base de dados os dados do corredor ao ser cadastrado
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $dados = $request->all();

        $res = $this->runners::where('cpf', '=', "" . $dados['cpf'] . "")->get();
        if (count($res) > 0) {
            return response()->json(['error' => "Este corredor já está cadastrado!!!"], 403);
        }

        /**
         * Realiza a validação dos dados vindo do formulário
         */
        $error = $this->validations->validateRunner($dados);

        if (!$error) {
            try {
                $this->runners::create($dados);
                return response()->json(['success' => 'Corredor(a) Cadastrado(a) com Sucesso!'], 201);
            } catch (\Illuminate\Database\QueryException $ex) {
                $error['error_create'] = $ex->getMessage();
            }
        }

        return response()->json(['error' => $error], 403);
    }
}
