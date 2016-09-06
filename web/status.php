<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<script src="js/script.js"></script> 
<?php
   include '../dao/OdbcDao.php';
   include '../dao/OdbcSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Odbc.php';
   include '../mapping/OdbcMapper.php';
   include '../validation/OdbcValidator.php';
   include '../dao/TodoDao.php';
   include '../dao/TodoSearchCriteria.php';
   include '../model/Todo.php';
   include '../mapping/TodoMapper.php';
   include '../validation/TodoValidator.php';
   include '../exception/NotFoundException.php';
   
   $todoDao = new TodoDao();
   $search = new TodoSearchCriteria();
   //$todos = new Todo();
   
   $SINISTRO='0126.93.03.00000046';
   $search->setSINISTRO($SINISTRO); 
   
   $todos=$todoDao->find3($search);
   
   foreach($todos as $todos){
   echo "SINISTRO - ";
   echo $todos->getCOD_SIN();
   echo "<br>";
   echo "STATUS DO SINISTRO - ";
   echo $todos->getCOD_FASE_SIN();
   echo "<br>";
   echo "OBSERVA&Ccedil;&Atilde;O - ";
   echo $todos->getOBS_FASE_SIN();
   echo "<br>";
   echo "ALTERA&Ccedil;&Atilde;O FEITA POR - ";
   echo $todos->getUSR_ATU();
   //print_r($todos);
   echo "<br>";
   }
   //print_r($search);
?>

