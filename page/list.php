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
?>
