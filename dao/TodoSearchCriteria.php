<?php
final class TodoSearchCriteria {

    private $status = null;
    private $SINISTRO;
    private $SEGURADOS;
    private $N_PROC;


    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }
    public function getSINISTRO() {
        return $this->SINISTRO;
    }

    public function setSINISTRO($SINISTRO) {
        $this->SINISTRO = $SINISTRO;
        return $this;
    }
    public function getSEGURADOS() {
        return $this->SEGURADOS;
    }

    public function setSEGURADOS($SEGURADOS) {
        $this->SEGURADOS = $SEGURADOS;
        return $this;
    }
    public function getN_PROC() {
        return $this->N_PROC;
    }

    public function setN_PROC($N_PROC) {
        $this->N_PROC = $N_PROC;
        return $this;
    }
    

}
?>