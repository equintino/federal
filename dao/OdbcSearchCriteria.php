<?php

final class OdbcSearchCriteria {
 
    private $sinistro = null;
    private $nome;
    private $vlindeniza = 0;
    
    public function getsinistro() {
        return $this->sinistro;
    }
    public function setsinistro($sinistro) {
        $this->sinistro = $sinistro;
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
    public function getTITULAR(){
        return $this->TITULAR;
    }
    public function setTITULAR($TITULAR){
        $this->TITULAR = $TITULAR;
        return $this;
    }
}
?>