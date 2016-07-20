<?php

final class OdbcSearchCriteria {
 
    private $sinistro = null;
    private $nome;
    
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
}
?>