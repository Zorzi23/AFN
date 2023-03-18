<?php

class AFN {

    const IS_LETRA  = 'isLetra';

    CONST IS_NUMERO = 'isNumero';

    CONST ESTADO_INICIAL = 0;

    private $aEstados;

    public function __construct($aEstados, $aEstadosFinais = []) {
        $this->setEstados($aEstados);
    }

    public function getQuantidadeEstados():int {
        return count($this->aEstados);
    }

    public function getEstados():array {
        return $this->aEstados;
    }

    public function getEstadosFinais():array {

        $aEstadosFinais = [];

        foreach($this->aEstados as $oEstado) {
            if($oEstado->bFinal) {
                $aEstadosFinais[] = $oEstado;
            }
        }

        return $aEstadosFinais;
    }

    public function setEstado($oEstado):void {
        
        if(!count($this->aEstados)) {
            $this->aEstados = [$oEstado];
            return;
        }

        $this->aEstados[] = $oEstado;
    }

    public function setEstados($aEstados = []):void {
        $this->aEstados = $aEstados;
    }

    public static function getObjetoEstado($aCondicoes = [], $sDescricao = '', $bFinal = false):object {
        return (object) [
            "aCondicoes" => $aCondicoes,
            "sDescricao" => $sDescricao,
            "bFinal"     => $bFinal
        ];
    }

    public static function getObjetoCondicao($xCondicao, $iProximoEstado = 0, $bReservada = false) {
        return (object) [
            "xCondicao"      => $xCondicao,
            "bReservada"     => $bReservada,
            "iProximoEstado" => $iProximoEstado
        ];
    }

    public static function isReservada($sCaractere, $oEstado) {
        return in_array($sCaractere, self::getPalavrasReservadas($oEstado));
    }

    public static function isLetra($sTeste) {
        return ctype_alpha($sTeste);
    }

    public static function isNumero($sTeste) {
        return is_numeric($sTeste);
    }

    public function testar($sTeste) {

        $aCaracteres = str_split(trim(strtolower($sTeste)));

        $oEstadoAtual = $this->aEstados[self::ESTADO_INICIAL];

        $iProximoEstado = self::ESTADO_INICIAL;

        foreach($aCaracteres as $sCaractere) {

            foreach($oEstadoAtual->aCondicoes as $oCondicao) {

                $xCondicao = $oCondicao->xCondicao;

                $bReservada = self::isReservada($sCaractere, $oEstadoAtual);

                if($bReservada && $oCondicao->bReservada && $xCondicao == $sCaractere) {
                    $iProximoEstado = $oCondicao->iProximoEstado;
                    break;
                }
                
                if(self::isLetra($sCaractere) && $xCondicao === self::IS_LETRA && !$bReservada) {
                    $iProximoEstado = $oCondicao->iProximoEstado;
                    break;
                }
                
                if(self::isNumero($sCaractere) && $xCondicao === self::IS_NUMERO && !$bReservada) {
                    $iProximoEstado = $oCondicao->iProximoEstado;
                    break;
                }
            }

            $oEstadoAtual = $this->aEstados[$iProximoEstado];
        }

        if($oEstadoAtual->bFinal) {
            return $oEstadoAtual->sDescricao;
        }

        return "Palavra não reconhecida pelo automato";
    }

    private static function getPalavrasReservadas($oEstado) {

        $aCondicoes = [];

        foreach($oEstado->aCondicoes as $oCondicao) {

            if($oCondicao->bReservada) {
                $aCondicoes[] = $oCondicao->xCondicao;
            }
        }

        return $aCondicoes;

    }
}