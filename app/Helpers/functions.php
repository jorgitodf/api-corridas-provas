<?php

/**
 * Calcula a idade do corredor
 *
 * @param [type] $data_nascimento
 * @return void
 */
function idade($data_nascimento)
{
    $date = new DateTime($data_nascimento);
    $interval = $date->diff(new DateTime(date('Y-m-d')));
    return $interval->format('%Y');
}

/**
 * Calcula o tempo da prova do corredor
 *
 * @param [type] $hora_inicio
 * @param [type] $hora_final
 * @return string
 */
function tempo_prova($hora_inicio, $hora_final): string
{
    $output = (strtotime($hora_final) - strtotime($hora_inicio));
    return date('H:i:s', $output);
}
