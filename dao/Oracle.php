<?php
final class Oracle {
    //extends PDOStatement
    /** @var PDO */
    private $db = null;
    public function __destruct() {
        // close db connection
        $this->db = null;
    }
    public function find(TodoSearchCriteria $search = null) {
        $result = array();
        
        //print_r($search);
        //print_r($this->query($this->getFindSql($search)));die;
        foreach ($this->query($this->getFindSql($search)) as $row) {
         //die;
         print_r($row);
         echo "<br>";
            $todo = new Todo();
            //print_r($todo);die;
            TodoMapper::map($todo, $row);
            $result[$todo->getId()] = $todo;
        }
        die;
        //print_r($result);
        return $result;
    }
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
         //print_r($todo);die;
            TodoMapper::map($todo, $row);
            //echo "<br><br>";
          //print_r($todo);  
            $result[$todo->getId()] = $todo;
        }
        //print_r($result);die;
        return @$result;
    }
    public function find4(TodoSearchCriteria $search = null) {
        foreach ($this->query($this->getFindSql4($search)) as $row) {
            $todo = new Todo();
         //print_r($todo);die;
            TodoMapper::map($todo, $row);
            //echo "<br><br>";
          //print_r($todo);  
            $result[$todo->getId()] = $todo;
        }
        //print_r($result);die;
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
     //print_r($todo);die;
        if ($todo->getId() === null) {
            return $this->insert($todo);
        }
        return $this->update($todo);
    }
    public function save2($todo) {
     //die;
            //var_dump(TodoMapper::map($todo, $todo));die;
     //print_r($todo->getId());die;
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
        //echo $sql;die;
            /*UPDATE todo SET
                last_modified_on = :last_modified_on,
                deleted = :deleted*/
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, array(
            ':id' => $id
        ));
        //':last_modified_on' => self::formatDateTime(new DateTime(), new DateTimeZone('America/Sao_Paulo')),':deleted' => true,
        return $statement->rowCount() == 1;
    }
    private function getDb() {
     //ECHO "PASSEI POR AQUI";
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("oracle");
        try {
            //$db_test = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)) (CONNECT_DATA=(SID=xe)))';
            //$this->db = new PDO("oci:dbname=//192.168.10.110:1521/prd1",'sngsprod', 'SFS#01PROD');
            $this->db = new PDO("oci:dbname=".$config['dsn'],$config['username'],$config['password']);
            //DIE;
            //var_dump($this->db);die;
            //$c = oci_connect("user", "passwd", $db_test);
            //$s = oci_parse($c, 'select * from some_table order by some_column');
            //oci_execute($s);
            /*
            putenv("ORACLE_SID=xe");
            putenv("OraHome92=C:\oracle\ora92");
            putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN");
            putenv("ORACLE_HOME=C:\oracle\ora92");
            putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN\tnsnames.ora");
            
             * 
             */
            //$this->db = oci_connect('sngsprod', 'SFS#01PROD');
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }

    private function getFindSql(TodoSearchCriteria $search = null) {

       $sql = "select * from v\$version where banner like '%Oracle%'";
       $sql = "select * from teste "; 
       //$sql = "select * from SINISTROS_FUP";
       /*
       $sql = "
        CREATE TABLE EDMILSON.TABLE1(
        COLUMN1 VARCHAR2(20) 
        )
       ";
        * 
        */
       //print_r($sql);
        //$sql = 'SELECT * FROM processojudicial WHERE 1';
                // 'deleted = 0 ';
       /*
        if($search->getSINISTRO()){
            $orderBy = ' SINISTRO';
        }elseif($search->getN_PROC()){
            $orderBy = ' N_PROC';
        }
        * 
        */
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
                switch ($search->getStatus()) {
                    case Todo::STATUS_PENDING:
                        $orderBy = 'due_on, priority';
                        break;
                    case Todo::STATUS_DONE:
                    case Todo::STATUS_VOIDED:
                    case Todo::STATUS_CANCELADO:
                        $orderBy = 'due_on DESC, priority';
                        break;
                    default:
                        throw new Exception('No order for status: ' . $search->getStatus());
                }
            }
            if($search->getSEGURADOS()){
                $sql .= " and SEGURADOS like '%".$search->getSEGURADOS()."%'";
            }elseif($search->getN_PROC()){
                $sql .= " and N_PROC like '%".$search->getN_PROC()."%'";
            }
           //$sql .= " and SINISTRO like '%".$sinistro."%'";
        }
        if(@$orderBy){
            $sql .= ' ORDER BY ' . $orderBy;
        }
        return $sql;
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
     //print_r($search);die;
        $sql = 'SELECT * FROM sinistros_fup WHERE ';//COD_SIN=\'0126.93.03.00000046\'';
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
     //print_r($search);die;
        $sql = 'SELECT * FROM sinistros_pendentes WHERE ';//COD_SIN=\'0126.93.03.00000046\'';
        $orderBy = ' PROCESSO_SINISTRO';
        $sql .= ' PROCESSO_SINISTRO=\''.$search->getSINISTRO().'\'';
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
        //print_r($sql);die;
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
        //echo "<br>";
        //print_r($statement);
        //echo "<br>";
        //print_r($this->getParams($todo));die;
        //print_r($statement, $this->getParams($todo));die;
        $this->executeStatement($statement, $this->getParams($todo));
        //var_dump($this->executeStatement($statement, $this->getParams($todo)));die;
        if (!$todo->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            //throw new NotFoundException('Processo com ID "' . $todo->getId() . '" nao existe.');
        }
        //print_r($todo);die;
        return $todo;
    }

    private function getParams($todo) {
        $params = array(
            /*
            ':ESI'=> $todo->getESI(),
            ':ARQUIVO'=> $todo->getARQUIVO(),
            ':AVISO'=> $todo->getAVISO(),
             */
            //':SINISTRO'=> $todo->getSINISTRO(),
            /*
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
             * 
             */
            ':id'=> $todo->getId(),
            //':idtitular'=> $todo->getidtitular(),
            //':priority'=> $todo->getPriority(),
            //':status'=> $todo->getStatus(),
            ':vlindeniza'=>$todo->getvlindeniza(),
            ':IMPORTANCIA_SEGURADA'=>$todo->getIMPORTANCIA_SEGURADA()
            //':created_on' => self::formatDateTime($todo->getCreatedOn()),
            //':last_modified_on' => self::formatDateTime($todo->getLastModifiedOn())
        );
        if ($todo->getId()) {
            // unset created date, this one is never updated
            unset($params[':created_on']);
        }
        //print_r($params);die;
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
    public function query($sql) {
     //echo $sql;
     //echo "<br>";
            //set_time_limit(3600);
        $statement = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        //print_r($statement);die;
        //print_r(get_class_methods($this->db));
        //echo "<br>";
        //print_r($this->getDb()->errorInfo());
        if ($statement === false) {
            self::throwDbError($this->getDb()->errorInfo());
        }
        return $statement;
    }

    private static function throwDbError(array $errorInfo) {
        // TODO log error, send email, etc.
        throw new Exception('DB error [' . $errorInfo[0] . ', ' . $errorInfo[1] . ']: ' . $errorInfo[2]);
    }

    private static function formatDateTime(DateTime $date) {
        return $date->format(DateTime::ISO8601);
    }
}
?>