<?php

namespace App\Validations;

use DateTime;

/**
 * Classe responsável pela validação dos dados
 */
class Validations
{
    private $erros = [];

    /**
     * Método responsával em validar os dados do cadastro de cada corredor
     *
     * @param [type] $data
     * @param [type] $model
     * @return void
     */
    public function validateRunner($data, $model = null)
    {
        $dataNascimento = $data['data_nascimento'];
        $date = new DateTime($dataNascimento);
        $interval = $date->diff(new DateTime(date('Y-m-d')));
        $idade = $interval->format('%Y');

        if (empty($data['nome']) || $data['nome'] == null) {
            $this->erros['error-nome'] = "Preencha o Nome do Corredor!";
        } elseif (empty($data['cpf'])) {
            $this->erros['error-cpf'] = "Preencha o Cpf do Corredor!";
        } elseif (empty($data['data_nascimento'])) {
            $this->erros['error-data-nascimento'] = "Preencha a Data de Nascimento do Corredor!";
        } elseif ($idade < 18) {
            $this->erros['error-data-nascimento'] = "Não é permitida a inscrição de menores de idade!";
        }
        return $this->erros;
    }

    /**
     * Método responsával em validar os dados do cadastro dp tipo de prova
     *
     * @param [type] $data
     * @param [type] $model
     * @return void
     */
    public function validateRaces($data, $model = null)
    {
        if (empty($data['tipo_prova']) || $data['tipo_prova'] == null) {
            $this->erros['error-tipo-prova'] = "Preencha o Tipo de Prova!";
        } elseif (empty($data['data_prova'])) {
            $this->erros['error-data-prova'] = "Preencha a Data da Prova!";
        }
        return $this->erros;
    }

    /**
     * Método responsával em validar os dados do cadastro da prova para cada corredor
     *
     * @param [type] $resRunner
     * @param [type] $dados
     * @param [type] $resRacer
     * @param [type] $resRacerData
     * @return void
     */
    public function validateRunnersRaces($resRunner, $dados, $resRacer, $resRacerData)
    {
        if (empty($dados['runner_id'])) {
            $this->erros['error-runner'] = "Informe o nome do corredor!";
        } elseif (empty($resRunner)) {
            $this->erros['error-runner'] = "O Corredor informado não está cadastrado!";
        } elseif (empty($dados['racer_id'])) {
            $this->erros['error-racer'] = "Informe o tipo da Prova!";
        } elseif (empty($resRacer)) {
            $this->erros['error-racer'] = "O Tipo de Prova informada não está cadastrada!";
        } elseif (empty($dados['data_prova'])) {
            $this->erros['error-data-prova'] = "Informe a data da Prova!";
        } elseif ($resRacer['data_prova'] != $dados['data_prova']) {
            $this->erros['error-data-prova'] = "Prova com esta data não localizada!";
        } elseif (count($resRacerData) > 0) {
            foreach ($resRacerData as $key => $value) {
                if ($value['data_prova'] == $dados['data_prova']) {
                    $this->erros['error-data-prova'] = "Não é permitido cadastrar o mesmo corredor em duas
                    provas diferentes na mesma data!";
                }
            }
        }
        return $this->erros;
    }

    /**
     * Método responsával em validar os dados do cadastro do resultado da prova para cada corredor
     *
     * @param [type] $dados
     * @param [type] $resRunner
     * @param [type] $resRacer
     * @return void
     */
    public function validateRunnersResult($dados, $resRunner, $resRacer)
    {
        if (empty($dados['runner_id'])) {
            $this->erros['error-runner'] = "Informe o nome do corredor!";
        } elseif (empty($resRunner)) {
            $this->erros['error-runner'] = "O Corredor informado não está cadastrado!";
        } elseif (empty($dados['racer_id'])) {
            $this->erros['error-racer'] = "Informe o tipo da Prova!";
        } elseif (empty($resRacer)) {
            $this->erros['error-racer'] = "O Tipo de Prova informada não está cadastrada!";
        } elseif (empty($dados['hora_inicio_prova'])) {
            $this->erros['error-hora-inicio-prova'] = "Informe a hora do início da Prova!";
        } elseif (!$this->validateHour($dados['hora_inicio_prova'])) {
            $this->erros['error-hora-inicio-prova'] = "Hora do início da Prova inválida! Ex: 10:00:00";
        } elseif (empty($dados['hora_final_prova'])) {
            $this->erros['error-hora-final-prova'] = "Informe a hora do final da Prova!";
        } elseif (!$this->validateHour($dados['hora_final_prova'])) {
            $this->erros['error-hora-final-prova'] = "Hora do final da Prova inválida! Ex: 10:00:00";
        }
        return $this->erros;
    }

    /**
     * Valida o formato da hora hh:mm:ss
     *
     * @param [type] $input
     * @return void
     */
    private function validateHour($input)
    {
        $format = 'H:i:s';
        $date = DateTime::createFromFormat('!' . $format, $input);
        return $date && $date->format($format) === $input;
    }

    /**
     * Converte o formato da data dd/mm/yyyy para yyyy/mm/dd
     *
     * @param [type] $data
     * @return void
     */
    private function formataData($data)
    {
        if (!empty($data)) {
            $d = explode("/", $data);
            $data_format = (trim($d[2] . "-" . $d[1] . "-" . $d[0]));
            return $data_format;
        }
    }
}
