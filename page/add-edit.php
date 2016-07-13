<?php
$errors = array();
$todo = null;
$edit = array_key_exists('id', $_GET);

if ($edit) {
    $todo = Utils::getTodoByGetId();
} else {
    // set defaults
    $todo = new Todo();
    $todo->setPriority(Todo::PRIORITY_MEDIUM);
    $dueOn = new DateTime("+5 day", new DateTimeZone('America/Sao_Paulo'));
    $eliminacaoPrazo = new DateTime("+30 day", new DateTimeZone('America/Sao_Paulo'));
    $dueOn->setTime(0, 0, 0);
    $todo->setDueOn($dueOn);
    $todo->setEliminacao($todo->getCreatedOn());
    $todo->setEliminacao_novo($todo->getCreatedOn());
    $todo->setEficazData($todo->getCreatedOn());
}


if (array_key_exists('cancel', $_POST)) {
    // redirect
    Utils::redirect('detail', array('id' => $todo->getId()));
} elseif (array_key_exists('save', $_POST)) {
    // for security reasons, do not map the whole $_POST['todo']
    $data = array(
        'title' => $_POST['todo']['title'],
        'due_on' => $_POST['todo']['due_on_date'] . ' ' . @$_POST['todo']['due_on_hour'] . ':' . @$_POST['todo']['due_on_minute'] . ':00',
        'priority' => $_POST['todo']['priority'],
        'description' => @$_POST['todo']['description'],
        'comment' => @$_POST['todo']['comment'],
        'descricao' => $_POST['todo']['descricao'],
        'numero' => $_POST['todo']['numero'],
        'origem' => $_POST['todo']['origem'],
        'tipoacao' => $_POST['todo']['tipoacao'],
        'processo' => $_POST['todo']['processo'],
        'identificador' => $_POST['todo']['identificador'],
        'causa' => $_POST['todo']['causa'],
        'imediata' => $_POST['todo']['imediata'],
        'corretiva' => $_POST['todo']['corretiva'],
        'implementador' => $_POST['todo']['implementador'],
        'eliminacao' => $_POST['todo']['eliminacao']. ' ' . date("H").":".$_POST['todo']['eliminacao_min'] . ':00',
        'eliminacao_novo' => $_POST['todo']['eliminacao_novo']. ' ' . date("H").":".$_POST['todo']['eliminacao_novo_min'] . ':00',
		'reg_eficacia' => $_POST['todo']['reg_eficacia'],
		'resp_verificacao' => $_POST['todo']['resp_verificacao'],
		'eficaz_data' => $_POST['todo']['eficaz_data']. ' ' . date("H").":".$_POST['todo']['eficaz_data_min'] . ':00',
		'novo_rnc' => $_POST['todo']['novo_rnc'],
		'eficaz' => @$_POST['todo']['eficaz']
    );
    // mapear
    TodoMapper::map($todo, $data);
    // validar
    $errors = TodoValidator::validate($todo);
  
    if (empty($errors)) {
        // gravar
        $dao = new TodoDao();
        $todo = $dao->save($todo);
        Flash::addFlash('RNC salvo com sucesso.');
        // redirecionar
        Utils::redirect('detail', array('id' => $todo->getId()));
    }
}
?>