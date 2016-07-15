<?php
$dao = new OdbcDao();
$search = new OdbcSearchCriteria();
$tabela = 'Beneficiarios';
$dados = $dao->listaColunas($tabela);
//print_r($dao->listaTabela());
//$Odbc = new Odbc();
//$dados = array('coluna1','coluna2','coluna3');
$odbc = $dao->find2($search);
//print_r(Odbc::getidtitular());
//Odbc::variaveis($dados);
//print_r($Odbc);

//$empresa = 'Federal de Seguros S/A em Liquidação Extrajudicial Ltda';
//$title = 'Sistema de Sinistro '.Utils::capitalize($empresa);

//print_r($dao);
//print_r($search);
/*
$status = Utils::getUrlParam('status');+
TodoValidator::validateStatus($status);

$dao = new TodoDao();
$search = new TodoSearchCriteria();
$search->setStatus($status);

$eliminacao_nome = 'Prazo para Eliminação:';
$resp_verificacao_nome = 'Responsável pela Verificação:';
$acao_eficaz_nome = 'A Ação foi Eficaz?';
$conclusao_nome = 'Conclusão:';
// data for template
if(Utils::capitalize($status)=='Vencido'){
    $title = 'Prazos '.Utils::capitalize($status); 
}elseif(Utils::capitalize($status)=='Cancelado'){
    $title = 'Registros '.Utils::capitalize($status);
}else{
    $title = 'Não Conformidades '.Utils::capitalize($status);
}
$todos = $dao->find($search);
*/
/// teste ////
// chama a classe //
$teste = new OdbcDao();
$tabela = 'Beneficiarios';
$campo = 'sinistro';
$busca = '00003289';
print_r($teste -> listaTabela());// Listar tabelas // ok
//die;
//print_r($teste -> listaConteudo($tabela));
print_r($teste -> listaCampo($tabela,$campo,$busca));
$odbc = new Odbc();
//$odbc -> setnome('MARIA jose');
print_r(Utils::escape($odbc->getnome()));die;
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
