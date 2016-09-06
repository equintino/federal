<?php
   
   $todoDao = new TodoDao();
   $search = new TodoSearchCriteria();
   //$todos = new Todo();
    //print_r($_GET);die;
   
   $sinistro=$_GET['sinistro'];
   $beneficiario=$_GET['beneficiario'];
   echo "<br><br><br>";
   echo "<h3 align=center>HIST&Oacute;RICO DE ($sinistro)</h3>";
   //echo "beneficiario -> $beneficiario";
   $search->setSINISTRO($sinistro); 
   
   $todos=$todoDao->find3($search);
   //print_r($todos);
   //echo "<br>";
   echo "<div class=detalhe>";
   foreach($todos as $todos){
   //echo "STATUS DO SINISTRO - ";
   //echo $todos->getCOD_FASE_SIN();
   //echo "<br>";
       if($todos->getOBS_FASE_SIN()){
          echo "<label><b>".  TodoValidator::data($todos->getDTH_FASE_SIN())."</label>";
          echo " ( ".$todos->getUSR_ATU()." )</b>";
          echo "<br>";
          echo "&nbsp&nbsp&nbsp".$todos->getOBS_FASE_SIN();
          echo "<br><br>";
       }
   //print_r($todos);
   }
   echo "</div>";
   echo "<button onclick=history.go(-1) class=bt_detalhe> VOLTAR </button>";
   //print_r($search);
?>

