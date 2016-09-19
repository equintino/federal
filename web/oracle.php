<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<script src="js/script.js"></script> 
<?php
//phpinfo();die;
   include '../dao/OdbcDao.php';
   include '../dao/OdbcSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Odbc.php';
   include '../mapping/OdbcMapper.php';
   include '../validation/OdbcValidator.php';
   include '../dao/TodoDao.php';
   include '../dao/Oracle.php';
   include '../dao/TodoSearchCriteria.php';
   include '../model/Todo.php';
   include '../mapping/TodoMapper.php';
   include '../validation/TodoValidator.php';
   include '../exception/NotFoundException.php';
   
   $oracle = new Oracle();
   //print_r($oracle);
   print_r($oracle->find());
?>