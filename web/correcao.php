<<<<<<< 0bcb9db44cdaa5ded769cf1b647ab0bb1e6a25c5
<meta charset="utf8">
=======
>>>>>>> casa3
<?php
   include '../dao/TodoDao.php';
   include '../dao/TodoSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Todo.php';
   include '../validation/TodoValidator.php';
<<<<<<< 0bcb9db44cdaa5ded769cf1b647ab0bb1e6a25c5
   include '../validation/OdbcValidator.php';
=======
>>>>>>> casa3
   include '../mapping/TodoMapper.php';
   
   $Tododao=new TodoDao(); 
   $Todosearch=new TodoSearchCriteria();
   
<<<<<<< 0bcb9db44cdaa5ded769cf1b647ab0bb1e6a25c5
   $Todosearch->setANO(2015);
   
   $provaveis=$Tododao->listaProvavel();
   //$provavel=$Todosdao->findByProvavel();
   //print_r($provavel);
   
     echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
     echo "<tr><th>SINISTRO</th><th>SEGURADO</th><th>PARTE CONTR&Aacute;RIA</th><th>VALOR PEDIDO</th><th>VALOR ADMINISTRATIVO</th><th>MENOR VALOR</th></tr>";
   
   foreach($provaveis as $provavel){
       echo "<tr><td>";
       echo $provavel['SINISTRO'];
       echo "</td><td>";
       echo $provavel['SEGURADO'];
       echo "</td><td>";
       echo $provavel['PARTE_CONTRARIA'];
       echo "</td><td>";
       echo $provavel['VALOR_PEDIDO'];
       echo "</td><td>";
       echo $provavel['CORRECAO_TR'];
       echo "</td><td>";
       $pedido=OdbcValidator::removePonto($provavel['VALOR_PEDIDO']);
       $administrativo=  OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO']);
       if($pedido > $administrativo || $pedido == null){
           echo $provavel['CORRECAO_TR'];
       }else{
           echo $provavel['VALOR_PEDIDO'];
       }
       echo "</td></tr>";
   }
    echo "</table>";
=======
   print_r($Tododao->find7());
>>>>>>> casa3
?>

