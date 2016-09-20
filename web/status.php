<?php
   
   $oracleDao = new OracleDao();
   $search = new OracleSearchCriteria();
   //$todos = new Todo();
    //print_r($_GET);die;
   //print_r($search);die;
   
   $sinistro=$_GET['sinistro'];
   $beneficiario=$_GET['beneficiario'];
   echo "<br><br><br>";
   echo "<h3 align=center>HIST&Oacute;RICO DE ($sinistro)</h3>";
   //echo "beneficiario -> $beneficiario";
   $search->setSINISTRO($sinistro); 
   
   $oracles=$oracleDao->find3($search);
   //print_r($oracles);die;
   //print_r(foreach($oracles as $x));die;
   //echo "<br>";
   echo "<div class=detalhe>";
   if($oracles){
    foreach($oracles as $todos){
   //echo "STATUS DO SINISTRO - ";
   //echo $todos->getCOD_FASE_SIN();
   //echo "<br>";
       if($todos->getOBS_FASE_SIN()){
          echo "<label><b>".$todos->getDTH_FASE_SIN()."</label>";
          echo " ( ".$todos->getUSR_ATU()." )</b>";
          echo "<br>";
          echo "&nbsp&nbsp&nbsp".$todos->getOBS_FASE_SIN();
          echo "<br><br>";
       }else{
          //echo "<b>N&Atilde;O EXISTE NENHUM ACOMPANHAMENTO REGISTRADO</b>";
       }
   //print_r($todos);
    }
   }else{
     echo "<b>N&Atilde;O EXISTE NENHUM ACOMPANHAMENTO REGISTRADO</b>";
   }
   echo "</div>";
   echo "<button onclick=history.go(-1) class=bt_detalhe> VOLTAR </button>";
   //print_r($search);
?>

