<?php

final class OdbcSearchCriteria {
 
    private $sinistro = null;
    
    public function getsinistro() {
        return $this->sinistro;
    }
    public function setsinistro($sinistro) {
        $this->sinistro = $sinistro;
        return $this;
    }
}
?>