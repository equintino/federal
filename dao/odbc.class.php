<?php
include '../config/config.php';

final class odbc {  
  private $db = null;
  //private $banco='federal';
  
  function __construct(){
    //$conn = new odbc();
    //self::odbc -> odbc_connect($this->banco,'','')or die(odbc_errormsg());
    
    //return self::odbc;
    //// Descrição da conexao ////
    //$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
    /*
    while($result){
        echo "DSN: " . $result['server'] . " - " . $result['description'] . "<br>\n";
        $result = @odbc_data_source( $link, SQL_FETCH_NEXT );
    }
     * 
     */
        //// Fim da Descrição ////
  }
 // function __destruct{  
   // public function __destruct() {
        //$this->db = null;
    //}
 // }
    public function getDb() {
        //// conexao com banco ////
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
        odbc_result_all($result,'Border=1 cellspacing=0 cellpadding=5');
        //$statement = $this->getDb()->query($sql, odbc_result_all($result));
        //if ($statement === false) {
            //self::throwDbError($this->getDb()->errorInfo());
        //}
        return $result;
    }
  public function listaTabela(){	
    //// Lista Tabelas ////
    $result = odbc_tables($this->getDb());
    $tables = array();
    while (odbc_fetch_row($result)){
        if(odbc_result($result,"TABLE_TYPE")=="TABLE")
        echo"<br>".odbc_result($result,"TABLE_NAME");
    }
    //// Fim Lista Tabelas ////
  }
}
$teste = new odbc();
$teste -> getDb();
print_r($teste -> listaTabela());// Listar tabelas //
echo "<br>";
print_r($teste -> query("SELECT * FROM Beneficiarios WHERE 1"));
echo "<br>aqui";