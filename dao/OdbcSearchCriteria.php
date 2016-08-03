<?php

final class OdbcSearchCriteria {
 
    private $sinistro = null;
    private $certificado = null;
    private $nome;
    private $vlindeniza = 0;
    private $TITULAR;
    private $IMPORTANCIA_SEGURADA = 0;
    private $ENDOSSO = null;
    private $idtitular = 0;
    private $idbenefi = 0;
    
    public function getsinistro() {
        return $this->sinistro;
    }
    public function setsinistro($sinistro) {
        $this->sinistro = $sinistro;
        return $this;
    }
    public function getcertificado() {
        return $this->certificado;
    }
    public function setcertificado($certificado) {
        $this->certificado = $certificado;
        return $this;
    }
    public function getnome(){
        return $this->nome;
    }
    public function setnome($nome){
        $this->nome = $nome;
        return $this;
    }
    public function getvlindeniza(){
        return OdbcValidator::validaCentavos($this->vlindeniza);
    }
    public function setvlindeniza($vlindeniza){
        $this->vlindeniza = $vlindeniza;
        return $this;
    }
    public function getidtitular(){
        return $this->idtitular;
    }
    public function setidtitular($idtitular){
        $this->idtitular = $idtitular;
        return $this;
    }
    public function getidbenefi(){
        return $this->idbenefi;
    }
    public function setidbenefi($idbenefi){
        $this->idbenefi = $idbenefi;
        return $this;
    }
    public function getTITULAR(){
        return $this->TITULAR;
    }
    public function setTITULAR($TITULAR){
        $this->TITULAR = $TITULAR;
        return $this;
    }
    public function getENDOSSO(){
        return $this->ENDOSSO;
    }
    public function setENDOSSO($ENDOSSO){
        $this->ENDOSSO = $ENDOSSO;
        return $this;
    }
    public function getIMPORTANCIA_SEGURADA(){
        return $this->IMPORTANCIA_SEGURADA;
    }
    public function setIMPORTANCIA_SEGURADA($IMPORTANCIA_SEGURADA){
        $this->IMPORTANCIA_SEGURADA = $IMPORTANCIA_SEGURADA;
        return $this;
    }
}
?>