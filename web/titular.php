<?php

   @$act=$_GET['act'];
   @$sinistro=$_GET['sinistro'];
   //$sinistro='0126.93.03.0000103';
     
     if($act=='titular'){
        $dao=new OdbcDao();
        $odbc=new Odbc();
        $search=new OdbcSearchCriteria();
        $search->setsinistro($sinistro);
        $odbcs=$dao->busca2($search);
        
        //echo $sinistro;
        //echo "<br>";
        //print_r($odbcs);
        
        /// somando os valores indenizados ///
        $indenizacao=0;
        $beneficiarios=$dao->busca($search);
        foreach($beneficiarios as $valores){
            $indenizacao=$indenizacao+($valores->getvlindeniza());
        }
        $totalaindenizar=$indenizacao;
     
        echo "<br>";
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th><th>TOTAL A INDENIZAR</th></tr>";
      }
     foreach($odbcs as $item){  
       echo "<tr><td>";
       echo $sinistro;
       echo "</td><td>";
       echo $item->getTITULAR();
       echo "</td><td align=right>";
       echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
       echo "</td><td align=right>";
       echo number_format($totalaindenizar,2,',','.');
       echo "</td></tr>";
     }
      echo "</table>";
      echo "<button class='voltar' onclick=history.go(-1); >VOLTAR</button>";
      echo "</div>";
      die;
     }
     if($act=='sinistrado'){
         
      $dao = new OdbcDao();
      $odbc = new Odbc();
      $search = new OdbcSearchCriteria();
        
        @$num_sinistro=$_POST['num_sinistro'];
        @$sinistrado=$_POST['sinistrado'];
        @$importanciasegurada=$_POST['importanciasegurada'];
        
        $search->setTITULAR($sinistrado);
        $search->setsinistro($num_sinistro);
        $search->setIMPORTANCIA_SEGURADA($importanciasegurada);
        
        $odbcs=$dao->busca2($search);
        
        echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th><th>VL. A INDENIZAR</th></tr>";
      }
     foreach($odbcs as $item){    
       echo "<tr><td>";
       echo $item->getsinistro();
       echo "</td><td>";
       echo $item->getTITULAR();
       echo "</td><td align=right>";
       echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
       echo "</td><td align=right>";
       echo number_format($item->getvlindeniza(),2,',','.');
       echo "</td></tr>";
     }
      echo "</table>";
         die;
     }
?>