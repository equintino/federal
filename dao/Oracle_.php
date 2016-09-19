<?php
final class Oracle extends PDOStatement{
    private $db = null;
    public function __destruct() {
        $this->db = null;
    }
    public function find(TodoSearchCriteria $search = null) {
        $result = array();
        foreach ($this->query($this->getFindSql($search)) as $row) {
         //
         print_r($row);echo "<br>";//executa a query
         //
            $todo = new Todo();
            TodoMapper::map($todo, $row);
            $result[$todo->getId()] = $todo;
        }
        return $result;
    }
    private function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("oracle");
        $config2 = Config::getConfig("oracle_local");
        try {
            $this->db = new PDO($config2['dsn'],$config2['username'],$config2['password']);
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

    private function getFindSql(TodoSearchCriteria $search = null) {
       $sql = "select * from v\$version where banner like '%Oracle%'";
       $sql = "SELECT * FROM DOCUMENTOS_FUP";
       $sql = "SELECT * FROM EXTRATOS_BANCARIOS";
       $sql = "SELECT * FROM MOTIVOS_ENCERRAMENTO_SIN";
       $sql = "SELECT * FROM TMP_PROCS_JURID_201309";
       $sql = "SELECT * FROM TMP_PROCS_JURID_201309_FINAL";
       $sql = "SELECT * FROM TMP_PROCESSOS_SIN";
       $sql = "SELECT * FROM LISTA_SINISTROS";
       $sql = "SELECT * FROM SINISTROS_DG";
       $sql = "SELECT * FROM DOCUMENTOS_DG";
       $sql = "select * from teste "; 
       $sql = "SELECT owner, table_name FROM dba_tables";
       $sql = "select * from SINISTROS_FUP";
       
        if ($search !== null) {
            if($search->getSEGURADOS()){
                $sql .= " and SEGURADOS like '%".$search->getSEGURADOS()."%'";
            }elseif($search->getN_PROC()){
                $sql .= " and N_PROC like '%".$search->getN_PROC()."%'";
            }
        }
        if(@$orderBy){
            $sql .= ' ORDER BY ' . $orderBy;
        }
        return $sql;
    }
    public function query($sql) {
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }
    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    } 
    //// até aqui testado ok ////
    /*
    public function find2() {
        foreach ($this->query($this->getFindSql2()) as $row) {
            $todo = new Todo();
            TodoMapper::map($todo, $row);
            $result[$todo->getId()] = $todo;
        }
        return @$result;
    }
    public function find3(TodoSearchCriteria $search = null) {
        foreach ($this->query($this->getFindSql3($search)) as $row) {
            $todo = new Todo();
            TodoMapper::map($todo, $row); 
            $result[$todo->getId()] = $todo;
        }
        return @$result;
    }
    public function find4(TodoSearchCriteria $search = null) {
        foreach ($this->query($this->getFindSql4($search)) as $row) {
            $todo = new Todo();
            TodoMapper::map($todo, $row); 
            $result[$todo->getId()] = $todo;
        }
        return @$result;
    }
    public function findById($id) {
        $row = $this->query('SELECT * FROM processojudicial WHERE deleted = 0 and id = ' . (int) $id)->fetch();
        if (!$row) {
            return null;
        }
        $todo = new Todo();
        TodoMapper::map($todo, $row);
        return $todo;
    }
    public function save(ToDo $todo) {
        if ($todo->getId() === null) {
            return $this->insert($todo);
        }
        return $this->update($todo);
    }
    public function save2($todo) {
        if ($todo->getId() === null) {
            return $this->insert2($todo);
        }
        return $this->update2($todo);
    }
    public function delete($id) {
        $sql = '
          delete from divergencia
            WHERE
                id = :id';
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        return $statement->rowCount() == 1;
    }
    private function getFindSql2(TodoSearchCriteria $search = null) {
        $sql = 'SELECT * FROM divergencia WHERE 1';
        $orderBy = 'SINISTRO';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    private function getFindSql3(TodoSearchCriteria $search = null) {
        $sql = 'SELECT * FROM sinistros_fup WHERE ';
        $orderBy = 'COD_SIN';
        $sql .= ' COD_SIN=\''.$search->getSINISTRO().'\'';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= ' AND status = ' . $this->getDb()->quote($search->getStatus());
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        $sql .= ' limit 0,15';
        //print_r($sql);die;
        return $sql;
    }
    private function getFindSql4(TodoSearchCriteria $search = null) {
        $sql = 'SELECT * FROM sinistros_pendentes WHERE ';
        $orderBy = ' PROCESSO_SINISTRO';
        $sql .= ' PROCESSO_SINISTRO=\''.$search->getSINISTRO().'\'';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= ' AND status = ' . $this->getDb()->quote($search->getStatus());
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        $sql .= ' limit 0,15';
        return $sql;
    }
    private function insert(Todo $todo) {
        $now = new DateTime();
        $todo->setId(null);
        $todo->setCreatedOn($now);
        $todo->setLastModifiedOn($now);
        $todo->setStatus(Todo::STATUS_PENDING);
        
///// Configurar a $sql nos campos para inclusão no banco //////
        
        $sql = '
            INSERT INTO `processojudicial` (`ESI`, `ARQUIVO`, `AVISO`, `SINISTRO`, `PESSOA`, `CERTIFICADO`, `CPF`, `OBS`, `SEGURADOS`, `N_PROC`, `N_NATIGO`, `NATUREZA`, `PROCED`, `UF`, `CIDADE`, `FORO`, `N_VARA`, `VARA`, `CLIENTE`, `RECLAMANTE`, `FASE`, `TP_PROBA`, `PROVAVIL`, `VLPEDIDO`, `DTPEDIDO`, `TPACAO`, `NULL`, `deleted`, `id`, `priority`, `status`, `created_on`, `last_modified_on`) VALUES (:ESI, :ARQUIVO, :AVISO, :SINISTRO, :PESSOA, :CERTIFICADO, :CPF, :OBS, :SEGURADOS, :N_PROC, :N_NATIGO, :NATUREZA, :PROCED, :UF, :CIDADE, :FORO, :N_VARA, :VARA, :CLIENTE, :RECLAMANTE, :FASE, :TP_PROBA, :PROVAVIL, :VLPEDIDO, :DTPEDIDO, :TPACAO, :NULL, :deleted, :id, :priority, :status, :created_on, :last_modified_on)';
        return $this->execute($sql, $todo);
    }
    private function insert2($todo) {
        $sql = "INSERT INTO 'divergencia' (`id`,`SINISTRO`, `IMPORTANCIA_SEGURADA`, `vlindeniza`, `idtitular`) VALUES ('', :SINISTRO, :IMPORTANCIA_SEGURADA, :vlindeniza, :idtitular)";
        return $this->execute($sql, $todo);
    }
    private function update(Todo $todo) {
        $todo->setLastModifiedOn(new DateTime(), new DateTimeZone('America/Sao_Paulo'));
        $sql = '
            UPDATE divergencia SET
                IMPORTANCIA_SEGURADA = :IMPORTANCIA_SEGURADA, vlindeniza = :vlindeniza
            WHERE
                id = :id';
        return $this->execute($sql, $todo);
    }
    public function execute($sql,$todo) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($todo));
        if (!$todo->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
        }
        return $todo;
    }

    private function getParams($todo) {
        $params = array(
            ':id'=> $todo->getId(),
            ':vlindeniza'=>$todo->getvlindeniza(),
            ':IMPORTANCIA_SEGURADA'=>$todo->getIMPORTANCIA_SEGURADA()
        );
        if ($todo->getId()) {
            unset($params[':created_on']);
        }
        return $params;
    }
    private function getParams2(Todo $todo) {
        $params = array(
            ':ESI'=> $todo->getESI(),
            ':ARQUIVO'=> $todo->getARQUIVO(),
            ':AVISO'=> $todo->getAVISO(),
            ':SINISTRO'=> $todo->getSINISTRO(),
            ':PESSOA'=> $todo->getPESSOA(),
            ':CERTIFICADO'=> $todo->getCERTIFICADO(),
            ':CPF'=> $todo->getCPF(),
            ':OBS'=> $todo->getOBS(),
            ':SEGURADOS'=> $todo->getSEGURADOS(),
            ':N_PROC'=> $todo->getN_PROC(),
            ':N_NATIGO'=> $todo->getN_NATIGO(),
            ':NATUREZA'=> $todo->getNATUREZA(),
            ':PROCED'=> $todo->getPROCED(),
            ':UF'=> $todo->getUF(),
            ':CIDADE'=> $todo->getCIDADE(),
            ':FORO'=> $todo->getFORO(),
            ':N_VARA'=> $todo->getN_VARA(),
            ':VARA'=> $todo->getVARA(),
            ':CLIENTE'=> $todo->getCLIENTE(),
            ':RECLAMANTE'=> $todo->getRECLAMANTE(),
            ':FASE'=> $todo->getFASE(),
            ':TP_PROBA'=> $todo->getTP_PROBA(),
            ':PROVAVIL'=> $todo->getPROVAVIL(),
            ':VLPEDIDO'=> $todo->getVLPEDIDO(),
            ':DTPEDIDO'=> $todo->getDTPEDIDO(),
            ':TPACAO'=> $todo->getTPACAO(),
            ':deleted'=> $todo->getdeleted(),
            ':id'=> $todo->getId(),
            ':priority'=> $todo->getPriority(),
            ':status'=> $todo->getStatus(),
            ':vlindeniza'=>$todo->getvlindeniza(),
            ':IMPORTANCIA_SEGURADA'=>$todo->getIMPORTANCIA_SEGURADA(),
            ':created_on' => self::formatDateTime($todo->getCreatedOn()),
            ':last_modified_on' => self::formatDateTime($todo->getLastModifiedOn())
        );
        if ($todo->getId()) {
            // unset created date, this one is never updated
            unset($params[':created_on']);
        }
        return $params;
    }
    private function executeStatement(PDOStatement $statement, array $params) {
        if (!$statement->execute($params)) {
            self::throwDbError($this->getDb()->errorInfo());
        }
    }
    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }
     * 
     */
}
?>