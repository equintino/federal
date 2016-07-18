<?php
//include 'teste.phtml';

$errors = array();
$odbc = null;
$edit = array_key_exists('id', $_GET);

if ($edit) {
    $odbc = Utils::getOdbcByGetId();
} else {
    // set defaults
    $odbc = new Odbc();
    //$odbc->setPriority(Todo::PRIORITY_MEDIUM);
    $dueOn = new DateTime("+5 day", new DateTimeZone('America/Sao_Paulo'));
    $eliminacaoPrazo = new DateTime("+30 day", new DateTimeZone('America/Sao_Paulo'));
    $dueOn->setTime(0, 0, 0);
    $odbc->setDueOn($dueOn);
    //$odbc->setEliminacao($todo->getCreatedOn());
    //$todo->setEliminacao_novo($todo->getCreatedOn());
    //$odbc->setEficazData($odbc->getCreatedOn());
}


if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('detail', array('id' => $odbc->getId()));
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['odbc']
    $data = array(
        'title' => $_POST['odbc']['title'],
        'due_on' => $_POST['odbc']['due_on_date'] . ' ' . @$_POST['odbc']['due_on_hour'] . ':' . @$_POST['odbc']['due_on_minute'] . ':00',
        'priority' => $_POST['odbc']['priority'],
        'description' => @$_POST['odbc']['description'],
        'comment' => @$_POST['odbc']['comment'],
        'descricao' => $_POST['odbc']['descricao'],
        'numero' => $_POST['odbc']['numero'],
        'origem' => $_POST['odbc']['origem'],
        'tipoacao' => $_POST['odbc']['tipoacao'],
        'processo' => $_POST['odbc']['processo'],
        'identificador' => $_POST['odbc']['identificador'],
        'causa' => $_POST['odbc']['causa'],
        'imediata' => $_POST['odbc']['imediata'],
        'corretiva' => $_POST['odbc']['corretiva'],
        'implementador' => $_POST['odbc']['implementador'],
        'eliminacao' => $_POST['odbc']['eliminacao']. ' ' . date("H").":".$_POST['odbc']['eliminacao_min'] . ':00',
        'eliminacao_novo' => $_POST['odbc']['eliminacao_novo']. ' ' . date("H").":".$_POST['odbc']['eliminacao_novo_min'] . ':00',
		'reg_eficacia' => $_POST['odbc']['reg_eficacia'],
		'resp_verificacao' => $_POST['odbc']['resp_verificacao'],
		'eficaz_data' => $_POST['odbc']['eficaz_data']. ' ' . date("H").":".$_POST['odbc']['eficaz_data_min'] . ':00',
		'novo_rnc' => $_POST['odbc']['novo_rnc'],
		'eficaz' => @$_POST['odbc']['eficaz']
    );
    // mapear
    OdbcMapper::map($odbc, $data);
    // validar
    $errors = OdbcValidator::validate($todo);
  
    if (empty($errors)) {
        // gravar
        $dao = new OdbcDao();
        $odbc = $dao->save($odbc);
        Flash::addFlash('RNC salvo com sucesso.');
        // redirecionar
        Utils::redirect('detail', array('id' => $odbc->getId()));
    }
}
?>