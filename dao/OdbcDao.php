<?php
include '../config/config.php';

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
    public function listaConteudo($tabela){
        $sql = "SELECT * FROM $tabela WHERE 1";
        print_r($tabela);
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        odbc_result_all($result,'Border=1 cellspacing=0 cellpadding=5'); 
    }
    public function listaCampo($tabela,$campo,$busca){
        $sql = "SELECT * FROM $tabela WHERE $campo like '%$busca%'";
        //print_r($sql);
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        echo '<table>';
        while (odbc_fetch_row($result)) {
            echo '<tr>';
            //for($x=0;$x<count($data);$x++){
                //$col[$x] = $data[$x];
                echo '<td>';
                //echo odbc_result($result);
        print_r(odbc_result($result, $campo));
        echo ' - ';
        print_r(odbc_result($result, 'nome'));
                echo '</td>';
            //}
            echo "</tr>";
        }
        echo '</table>';
    }
    public function listaColunas($sql){
     $conn = new OdbcDao();
     $result=$conn->query($sql);
     $colunas_num=odbc_num_fields($result);
     for($x=1;$x<$colunas_num+1;$x++){
       $colunas[]=odbc_field_name($result,$x);
     }
     return $colunas;
    }
    public function find(OdbcSearchCriteria $search = null) {
        $result = array();
        foreach ($this->query($this->getFindSql($search)) as $row) {
            $odbc = new Odbc();
            OdbcMapper::map($todo, $row);
            $result[$odbc->getidbenefi()] = $odbc;
        }
        return $result;
    }
    private function getFindSql(OdbcSearchCriteria $search = null) {
        $sql = 'SELECT * FROM todo WHERE 1';
                //deleted = 0 ';
        $orderBy = null;
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
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    private function getFindSql2(OdbcSearchCriteria $search = null) {
        $sql = 'SELECT * FROM todo WHERE 1';
        $orderBy = 'id';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
            }
        }
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
}