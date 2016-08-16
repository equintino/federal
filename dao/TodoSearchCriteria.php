<?php
final class TodoSearchCriteria {

    private $status = null;
    private $SINISTRO;
    private $SEGURADOS;


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
    

}
?>