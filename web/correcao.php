<?php
   include '../dao/TodoDao.php';
   include '../dao/TodoSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Todo.php';
   include '../validation/TodoValidator.php';
   include '../mapping/TodoMapper.php';
   
   $Tododao=new TodoDao(); 
   $Todosearch=new TodoSearchCriteria();
   
   print_r($Tododao->find7());
?>

