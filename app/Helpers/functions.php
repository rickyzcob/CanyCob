<?php

use Carbon\Carbon;

function formatDateAndTime($value, $format = 'd/m/Y - H:i')
{
    return Carbon::parse($value)->format($format);
}

function formatDate($value, $format = 'd/m/Y')
{
    return Carbon::parse($value)->format($format);
}

function formatdiffForHumans($value, $format = 'd/m/Y')
{
    return Carbon::parse($value)->diffForHumans();
}


function formatMoney($value)
{
    return 'R$ '.number_format($value, 2, ',', '.');
}
function firstName($value)
{

    $name = explode(" ", $value);
    return $name[0] . " ". $name[1];
}



function formatMoneyInput($value)
{
    return number_format($value, 2, ',', '.');
}

function formatDecimal($value)
{
    return strtr($value, ['.' => '',  ',' => '.', ]);
}

function formatCoin($value)
{
    $coin = explode('.', $value);
    return $coin[0];
}

function formatCPFCNPJ($value) {

    $value = preg_replace("/[^0-9]/", "", $value);
    $qtd = strlen($value);

    if($qtd >= 11) {

        if($qtd === 11 ) {
            $docFormatado = substr($value, 0, 3) . '.' .
                substr($value, 3, 3) . '.' .
                substr($value, 6, 3) . '-' .
                substr($value, 9, 2);
        } else {
            $docFormatado = substr($value, 0, 2) . '.' .
                substr($value, 2, 3) . '.' .
                substr($value, 5, 3) . '/' .
                substr($value, 8, 4) . '-' .
                substr($value, -2);
        }

        return $docFormatado;

    } else {
        return 'Documento invalido';
    }
}
