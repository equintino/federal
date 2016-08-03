<?php
final class TodoSearchCriteria {

    private $status = null;


    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

}
?>