<?PHP
//// Descrição da conexao ////
/*
$banco='federal';
$conn=odbc_connect($banco,'','')or die(odbc_errormsg());
$result = @odbc_data_source( $conn, SQL_FETCH_FIRST );
while($result){
    echo "DSN: " . $result['server'] . " - " . $result['description'] . "<br>\n";
    $result = @odbc_data_source( $link, SQL_FETCH_NEXT );
}
 * 
 */
//// Fim da Descrição ////

/*
	
//// Lista Conteudo da tabela ////
$tabela='Beneficiarios';
$sql="SELECT * FROM $tabela WHERE 1";
$result=odbc_exec($conn,$sql);
//odbc_result_all($result,'Border=1 cellspacing=0 cellpadding=5');
//// Fim Lista Conteudo ////

*/
//// Lista Conteudo da tabela formatado ////
/*
odbc_result_all_ex($result, 'Border=1 cellspacing=0 cellpadding=5', "style='FONT-FAMILY:Tahoma; FONT-SIZE:8pt; BORDER-BOTTOM:solid 1pt gree'");
function odbc_result_all_ex($res, $sTable, $sRow){
    $cFields = odbc_num_fields($res);
   
    $strTable = "<table $sTable>";
    $strTable .= "<tr>";
    for ($n=1; $n<=$cFields; $n++){
       $strTable .= "<td $sRow><b>". str_replace("_", " ", odbc_field_name($res, $n)) . "</b></td>";
    }
    $strTable .= "</tr>";
   
    while(odbc_fetch_row($res)){
	$strTable .= "<tr>";
        for ($n=1; $n<=$cFields; $n++){
           if (odbc_result($res, $n)==''){
              $strTable .= "<td $sRow>&nbsp;</td>";
           }else{
              $strTable .= "<td $sRow>". odbc_result($res, $n) . "</td>";
           }

        }
	$strTable .= "</tr>";
    }	
       
    $strTable .= "</table>";
   
    Print $strTable;
   
}
//// Fim lista de conteudo ////
*/
include '../dao/odbc.class.php';


// chama a classe //
$teste = new odbc();
print_r($teste -> listaTabela());// Listar tabelas // ok

$tabela = 'sinipend';
$campo = 'TITULAR';
$busca = 'MARIA julia';
//$sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$busca%'";// busca //
//$sql = "SELECT * FROM $tabela WHERE 1";// lista todo o conteudo //
//$teste -> listaConteudo($sql);// metodo de busca //
//$tabela = 'Beneficiarios';
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
print_r($teste->listaColunas($sql));// lista colunas // ok
die;

//// area de teste ////
$tabela='Beneficiarios';
$sql="UPDATE `$tabela` SET `idtitular`='1' WHERE `idbenefi`=1";
$sql2="SELECT * FROM `$tabela` WHERE `idbenefi`=1";


$result=  odbc_exec($conn,$sql);
$result2=  odbc_exec($conn,$sql2);
odbc_commit($conn);
var_dump($result);
ECHO '<BR>';
$i=2;
$campo=odbc_num_fields($result2);
$campo2=odbc_field_name($result2,$i);
print_r($campo2);
echo ' -> ';
echo(odbc_result($result2,$campo2));

//// fim area de teste ////


//// fecha conexao ////	
odbc_close($conn);
die;
	
$table="Beneficiarios";
$sql = "SELECT * FROM $table"; 
$result=odbc_exec($conn,$sql);
//odbc_result_all($result, 'id="users" class="listing"');
//odbc_result_all($result, 'border=1');
odbc_result_all($result, 'Border=0 cellspacing=0 cellpadding=5', "style='FONT-FAMILY:Tahoma; FONT-SIZE:8pt; BORDER-BOTTOM:solid 1pt gree'");
while ($rows = odbc_fetch_object($result)) {
    //print $rows->COLUMNNAME;
}
?>