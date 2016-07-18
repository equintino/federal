<?php
$sinistro = Utils::getUrlParam('sinistro');

$dao = new OdbcDao();
$search = new OdbcSearchCriteria();
$search->setsinistro($sinistro);
$tabela = 'Beneficiarios';
//$dados = $dao->listaColunas($tabela);
$listaTabelas=$dao->listaTabela();

$odbcs = $dao->find2($search);

$title = Utils::capitalize('Sistema de Sinistro');
/*
TodoValidator::validateStatus($status);
*/
//// area de teste ////
/*
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
	
$table="Beneficiarios";
$sql = "SELECT * FROM $table"; 
$result=odbc_exec($conn,$sql);
//odbc_result_all($result, 'id="users" class="listing"');
//odbc_result_all($result, 'border=1');
odbc_result_all($result, 'Border=0 cellspacing=0 cellpadding=5', "style='FONT-FAMILY:Tahoma; FONT-SIZE:8pt; BORDER-BOTTOM:solid 1pt gree'");
while ($rows = odbc_fetch_object($result)) {
    //print $rows->COLUMNNAME;
}
 * 
 */
?>
