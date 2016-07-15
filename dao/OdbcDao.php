<?php
final class OdbcDao {  
  private $db = null;
  
    public function __destruct(){  
        $this->db = null;
    }
    public function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("odbc");
        try {
            $this->db = odbc_connect($config['banco'],$config['username'],$config['password'])or die(odbc_errormsg());
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }
    public function query($sql) {
        $result = odbc_exec($this->getDb(),$sql);
        return $result;
    }
    public function listaTabela(){	
        $result = odbc_tables($this->getDb());
        $tables = array();
        while (odbc_fetch_row($result)){
            if(odbc_result($result,"TABLE_TYPE")=="TABLE")
            $tabelas[] = odbc_result($result,"TABLE_NAME");
        }
        return $tabelas;
    }
    public function listaConteudo($sql){
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        odbc_result_all($result,'Border=1 cellspacing=0 cellpadding=5'); 
    }
    public function listaCampo($sql,$data){
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        echo '<table>';
        while (odbc_fetch_row($result)) {
            echo '<tr>';
            for($x=0;$x<count($data);$x++){
                $col[$x] = $data[$x];
                echo '<td>';
                echo odbc_result($result, $col[$x]);
                echo '</td>';
            }
            echo "</tr>";
        }
        echo '</table>';
    }
    public function listaColunas($tabela){
     $conn = new OdbcDao();
     $sql = "SELECT * FROM $tabela WHERE 1";
     $result=$conn->query($sql);
     $colunas_num=odbc_num_fields($result);
     for($x=1;$x<$colunas_num+1;$x++){
       $colunas[]=odbc_field_name($result,$x);
     }
     return $colunas;
    }
    public function find(OdbcSearchCriteria $search = null) {
        $result = array();
        //echo '<br>teste<br>';
         //echo($this->query($this->getFindSql($search)));
         //echo '<br>';
         //print_r($this->query($this->getFindSql($search)));
         //print_r($this->getFindSql($search));
         //echo '<br>teste<br>';
         //print_r($search);
        foreach ($this->query($this->getFindSql($search)) as $row) {
            $odbc = new OdbcDao();
            odbcMapper::map($odbc, $row);
            $result[$odbc->getidbenefi()] = $odbc;
        }
        return $result;
    }
    private function getFindSql(OdbcSearchCriteria $search = null) {
        $sql = 'SELECT * FROM Beneficiarios WHERE 1';
                //deleted = 0 ';
        //$orderBy = null;
                //' priority, due_on';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
                /*
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
                 */
            }
        }
        //$sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    public function find2() {
      $busca = $this->query($this->getFindSql2());
      $row = odbc_fetch_array($busca);
      var_dump($row);
        //foreach ($this->query($this->getFindSql2()) as $row) {
            $odbc = new Odbc();
            OdbcMapper::map($odbc, $row);
            $idbenefi = $odbc->getidbenefi();
        //}
        return @$idbenefi;
    }
    private function getFindSql2(OdbcSearchCriteria $search = null) {
        $sql = 'SELECT * FROM Beneficiarios WHERE 1';
        $orderBy = 'idbenefi';
        if ($search !== null) {
            //if ($search->getStatus() !== null) {
                //$sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
            //}
        }
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
}