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
        //// executa a query ////
        $result = odbc_exec($this->getDb(),$sql);
        return $result;
    }
    public function listaTabela(){	
        //// Lista Tabelas ////
        $result = odbc_tables($this->getDb());
        $tables = array();
        while (odbc_fetch_row($result)){
            if(odbc_result($result,"TABLE_TYPE")=="TABLE")
            $tabelas[] = odbc_result($result,"TABLE_NAME");
        }
        return $tabelas;
    }
    public function listaConteudo($sql){
        // lista conteudo //
        $conn = new odbc();
        $result=$conn -> query($sql);
        odbc_result_all($result,'Border=1 cellspacing=0 cellpadding=5'); 
    }
    public function listaCampo($sql,$data){
        $conn = new odbc();
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
}
// chama a classe //
$teste = new odbc();
//print_r($teste -> listaTabela());// Listar tabelas // ok

$tabela = 'sinipend';
$campo = 'TITULAR';
$busca = 'MARIA julia';
//$sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$busca%'";// busca //
//$sql = "SELECT * FROM $tabela WHERE 1";// lista todo o conteudo //
//$teste -> listaConteudo($sql);// metodo de busca //
$tabela = 'Beneficiarios';
echo "<br>";
$col1 = "ENDOSSO";
$col2 = "TITULAR";
//print_r(odbc_result($result,$col1));
//echo ' - ';
//print_r(odbc_result($result,$col2));
//echo '<br>';
$data = array('TITULAR','ENDOSSO');
$sql = "SELECT * FROM $tabela WHERE 1";
//$teste->listaCampo($sql,$data);// executa uma query // ok
$result=$teste->query($sql);
echo '<br>';
$colunas=odbc_num_fields($result);
for($x=1;$x<$colunas+1;$x++){
    print_r(odbc_field_name($result,$x));
    if ($x!=$colunas){
        echo ' - ';
    }
}


