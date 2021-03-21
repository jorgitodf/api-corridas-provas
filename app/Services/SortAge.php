<?php

namespace App\Services;

class SortAge
{
    protected $dados = [];
    protected static $faixaIdade1 = 'grupo 18-35';
    protected static $faixaIdade2 = 'grupo 26-35';
    protected static $faixaIdade3 = 'grupo 36-45';
    protected static $faixaIdade4 = 'grupo 46-55';
    protected static $faixaIdade5 = 'grupo > 55';

    public static function racesListingByAge(array $idsRacer, array $res): array
    {
        foreach ($res as $key => $value) {
            if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [18,19,20,21,22,23,24,25])) {
                $dados[self::$faixaIdade1][$key]['id_prova'] = $value['id_prova'];
                $dados[self::$faixaIdade1][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[self::$faixaIdade1][$key]['id_corredor'] = $value['id_corredor'];
                $dados[self::$faixaIdade1][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[self::$faixaIdade1][$key]['idade'] = $value['idade'];
                $dados[self::$faixaIdade1][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [26,27,28,29,30,31,32,33,34,35])) {
                $dados[self::$faixaIdade2][$key]['id_prova'] = $value['id_prova'];
                $dados[self::$faixaIdade2][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[self::$faixaIdade2][$key]['id_corredor'] = $value['id_corredor'];
                $dados[self::$faixaIdade2][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[self::$faixaIdade2][$key]['idade'] = $value['idade'];
                $dados[self::$faixaIdade2][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [36,37,38,39,40,41,42,43,44,45])) {
                $dados[self::$faixaIdade3][$key]['id_prova'] = $value['id_prova'];
                $dados[self::$faixaIdade3][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[self::$faixaIdade3][$key]['id_corredor'] = $value['id_corredor'];
                $dados[self::$faixaIdade3][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[self::$faixaIdade3][$key]['idade'] = $value['idade'];
                $dados[self::$faixaIdade3][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [46,47,48,49,50,51,52,53,54,55])) {
                $dados[self::$faixaIdade4][$key]['id_prova'] = $value['id_prova'];
                $dados[self::$faixaIdade4][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[self::$faixaIdade4][$key]['id_corredor'] = $value['id_corredor'];
                $dados[self::$faixaIdade4][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[self::$faixaIdade4][$key]['idade'] = $value['idade'];
                $dados[self::$faixaIdade4][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && $value['idade'] > 55) {
                $dados[self::$faixaIdade5][$key]['id_prova'] = $value['id_prova'];
                $dados[self::$faixaIdade5][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[self::$faixaIdade5][$key]['id_corredor'] = $value['id_corredor'];
                $dados[self::$faixaIdade5][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[self::$faixaIdade5][$key]['idade'] = $value['idade'];
                $dados[self::$faixaIdade5][$key]['tempo'] = $value['tempo'];
            } else {
                return null;
            }
        }
        return $dados;
    }

    public static function racesListingGeneral(array $idsRacer, array $res): array
    {
        foreach ($res as $key => $value) {
            if (in_array($value['id_prova'], $idsRacer)) {
                $dados[$value['tipo_prova']][$key]['id_prova'] = $value['id_prova'];
                $dados[$value['tipo_prova']][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[$value['tipo_prova']][$key]['id_corredor'] = $value['id_corredor'];
                $dados[$value['tipo_prova']][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[$value['tipo_prova']][$key]['idade'] = $value['idade'];
                $dados[$value['tipo_prova']][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [26,27,28,29,30,31,32,33,34,35])) {
                $dados[$value['tipo_prova']][$key]['id_prova'] = $value['id_prova'];
                $dados[$value['tipo_prova']][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[$value['tipo_prova']][$key]['id_corredor'] = $value['id_corredor'];
                $dados[$value['tipo_prova']][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[$value['tipo_prova']][$key]['idade'] = $value['idade'];
                $dados[$value['tipo_prova']][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [36,37,38,39,40,41,42,43,44,45])) {
                $dados[$value['tipo_prova']][$key]['id_prova'] = $value['id_prova'];
                $dados[$value['tipo_prova']][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[$value['tipo_prova']][$key]['id_corredor'] = $value['id_corredor'];
                $dados[$value['tipo_prova']][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[$value['tipo_prova']][$key]['idade'] = $value['idade'];
                $dados[$value['tipo_prova']][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && in_array($value['idade'], [46,47,48,49,50,51,52,53,54,55])) {
                $dados[$value['tipo_prova']][$key]['id_prova'] = $value['id_prova'];
                $dados[$value['tipo_prova']][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[$value['tipo_prova']][$key]['id_corredor'] = $value['id_corredor'];
                $dados[$value['tipo_prova']][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[$value['tipo_prova']][$key]['idade'] = $value['idade'];
                $dados[$value['tipo_prova']][$key]['tempo'] = $value['tempo'];
            } else if (in_array($value['id_prova'], $idsRacer) && $value['idade'] > 55) {
                $dados[$value['tipo_prova']][$key]['id_prova'] = $value['id_prova'];
                $dados[$value['tipo_prova']][$key]['tipo_prova'] = $value['tipo_prova'];
                $dados[$value['tipo_prova']][$key]['id_corredor'] = $value['id_corredor'];
                $dados[$value['tipo_prova']][$key]['nome_corredor'] = $value['nome_corredor'];
                $dados[$value['tipo_prova']][$key]['idade'] = $value['idade'];
                $dados[$value['tipo_prova']][$key]['tempo'] = $value['tempo'];
            } else {
                return null;
            }
        }
        return $dados;
    }

}
