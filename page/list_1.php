<?php
$status = Utils::getUrlParam('status');
TodoValidator::validateStatus($status);

$dao = new TodoDao();
$search = new TodoSearchCriteria();
$search->setStatus($status);

$eliminacao_nome = 'Prazo para Eliminação:';
$resp_verificacao_nome = 'Responsável pela Verificação:';
$acao_eficaz_nome = 'A Ação foi Eficaz?';
$conclusao_nome = 'Conclusão:';
// data for template
$title = 'Não Conformidades '.Utils::capitalize($status);
if(Utils::capitalize($status)=='Vencido'){
    $title = 'Prazos '.Utils::capitalize($status); 
}elseif(Utils::capitalize($status)=='Cancelado'){
    $title = 'Registros '.Utils::capitalize($status);
}else{
    $title = 'Não Conformidades '.Utils::capitalize($status);
}
$todos = $dao->find($search);

?>
