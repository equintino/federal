<?php

   @$act=$_GET['act'];
   //@$vlindeniza=$_POST['vlindeniza'];
   @$sinistro=$_GET['sinistro'];
      
      //echo "$titular";
      
     $dao=new OdbcDao();
     //print_r($dao);die;
     $odbc=new Odbc();
     //print_r($odbc);die;
     $search=new OdbcSearchCriteria();
     //print_r($search);die;
     //echo $sinistro;die;
     //var_dump(preg_match('/^[a-z,A-Z]/', $sinistro));die;
     //if(preg_match('/^[a-z,A-Z]/', $sinistro)){
         //echo "nome";die;
         $search->setsinistro($sinistro);
         //$search->setvlindeniza($vlindeniza);
         //print_r($search);die;
        $odbcs=$dao->busca2($search);
     
     //die;
     //print_r($search);die;
     echo "<br><br>";
      //print_r($dao->busca($search));
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th></tr>";
      }
     foreach($odbcs as $item){
      //print_r($item->getsinistro());    
       echo "<tr><td>";
       echo $sinistro;
       echo "</td><td>";
       echo $item->getTITULAR();
       echo "</td><td align=right>";
       echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
       echo "</td></tr>";
     }
      echo "</table>";
      echo "<button class='voltar' onclick=history.go(-1); >VOLTAR</button>";
      echo "</div>";
      die;
?>

