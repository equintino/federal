<?php

   @$act=$_GET['act'];
   //@$vlindeniza=$_POST['vlindeniza'];
   @$sinistro=$_GET['sinistro'];
      
     //print_r($_GET);
     //echo "<br><br>";
     //print_r($_POST);die;
      
     //print_r($search);die;
     //echo $sinistro;die;
     //var_dump(preg_match('/^[a-z,A-Z]/', $sinistro));die;
     //if(preg_match('/^[a-z,A-Z]/', $sinistro)){
         //echo "nome";die;
     if($act=='titular'){
        $dao=new OdbcDao();
        //print_r($dao);die;
        $odbc=new Odbc();
        //print_r($odbc);die;
        $search=new OdbcSearchCriteria();
        $search->setsinistro($sinistro);
         //$search->setvlindeniza($vlindeniza);
         //print_r($search);die;
        $odbcs=$dao->busca2($search);
        //print_r($odbcs);
        //echo "<br><br>";
        
        /// somando os valores indenizados ///
        $indenizacao=0;
        $beneficiarios=$dao->busca($search);
        //print_r($beneficiarios);
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
        
        /*
        print_r($_GET);
        echo "<br><br>";
        print_r($_POST);
        echo "<br><br>";die;
        print_r($dao);
        echo "<br><br>";
        print_r($odbc);
        echo "<br><br>";
        print_r($search);
        echo "<br><br>";
        
         * 
         */
        
        
        @$num_sinistro=$_POST['num_sinistro'];
        @$sinistrado=$_POST['sinistrado'];
        @$importanciasegurada=$_POST['importanciasegurada'];
        
        $search->setTITULAR($sinistrado);
        $search->setsinistro($num_sinistro);
        $search->setIMPORTANCIA_SEGURADA($importanciasegurada);
        
        $odbcs=$dao->busca2($search);
        
        //print_r($odbcs);die;
        //foreach($odbcs as $item);
        //print_r($dao->busca2($search));
        //echo "<br><br>";
        //print_r($item);die;
        echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th><th>VL. A INDENIZAR</th></tr>";
      }
     foreach($odbcs as $item){
      //print_r($item->getsinistro());    
       echo "<tr><td>";
       //echo "<a href='teste3.php?act=titular&sinistro=".$item->getsinistro()."'>";
       echo $item->getsinistro();
       //echo "</a>";
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

