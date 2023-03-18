<?php

require_once('class_afn.php');

$aEstados = [
    0 => AFN::getObjetoEstado([
        AFN::getObjetoCondicao(AFN::IS_LETRA, 1),
        AFN::getObjetoCondicao('i', 2, true),
        AFN::getObjetoCondicao('f', 4, true),
        AFN::getObjetoCondicao('w', 7, true),
        AFN::getObjetoCondicao(AFN::IS_NUMERO, 12)
    ]),
    1 => AFN::getObjetoEstado([
        AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
        AFN::getObjetoCondicao(AFN::IS_NUMERO, 1),
    ], 'ID', true),
    2 => AFN::getObjetoEstado([
        AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
        AFN::getObjetoCondicao('f', 3, true),
    ]),
    3 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao(AFN::IS_NUMERO, 1),
        ], 'RESERVADA', true),
    4 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao('o', 5, true),
        ]),
    5 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao('r', 6, true),
        ]),
    6 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao(AFN::IS_NUMERO, 1),
        ], 'RESERVADA', true),
    7 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao('h', 8, true),
        ]),
    8 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao('i', 9, true),
        ]),
    9 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao('l', 10, true),
        ]),
    10 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao('e', 11, true),
        ]),
    11 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_LETRA,  1),
            AFN::getObjetoCondicao(AFN::IS_NUMERO, 1),
        ], 'RESERVADA', true),
    12 => AFN::getObjetoEstado([
            AFN::getObjetoCondicao(AFN::IS_NUMERO, 12)
        ], 'NUMERICO', true),
];

$oAutomato = new AFN($aEstados);

echo $oAutomato->testar("if");