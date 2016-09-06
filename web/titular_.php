<?php
   @$act=$_GET['act'];
   @$sinistro=$_GET['sinistro'];
   @$impSegurada=$_GET['impSegurada'];
   @$vlindeniza=$_GET['vlindeniza'];
   @$id=$_GET['id'];
     
     if($act=='titular'){
        $search->setsinistro($sinistro);
        $odbcs=$dao->busca2($search);
                
        /// somando os valores indenizados ///
        $indenizacao=0;
        $beneficiarios=$dao->busca($search);
        foreach($beneficiarios as $valores){
            $indenizacao=$indenizacao+($valores->getvlindeniza());
        }
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
       if(number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.') != number_format($indenizacao,2,',','.')){        
          echo "</td><td class=valordiferente align=right>";
       }else{
          echo "</td><td align=right>";      
       }
       echo number_format($indenizacao,2,',','.');
       echo "</td></tr>";
     }
      echo "</table>";
      /*
          echo "impSegurada -> ".number_format($impSegurada,'2',',','.')." != ";
          echo number_format($item->getIMPORTANCIA_SEGURADA(),'2',',','.')." OU ";
          echo "vlindeniza -> ". number_format($vlindeniza,'2',',','.')." != ".number_format($indenizacao,'2',',','.')."";
          
       * 
       */
          //echo "passei aqui";
            
      //// Atualizando a tabela divergencia ////
      if(number_format($impSegurada,'2',',','.') != number_format($item->getIMPORTANCIA_SEGURADA(),'2',',','.') || number_format($vlindeniza,'2',',','.') != number_format($indenizacao,'2',',','.')){
          //echo "estou aqui";die;
       //echo "<br>";
       //echo "Valores antigos = $impSegurada e $vlindeniza";
       //echo "<br>";
       //echo "Novos valores = ".$item->getIMPORTANCIA_SEGURADA()." e $indenizacao";
      
       $Tododao=new TodoDao();
       $todo=new Todo();
       
       $todo->setId($id);
       $todo->setIMPORTANCIA_SEGURADA($item->getIMPORTANCIA_SEGURADA());
       $todo->setvlindeniza($indenizacao);
       
       if(number_format($item->getIMPORTANCIA_SEGURADA(),'2',',','.') == number_format($indenizacao,'2',',','.')){
        $Tododao->delete($id);
       }else{
        $Tododao->save($todo);
       }
       
       //print_r(get_class_methods($Tododao));
       //echo "<br>";
       //print_r($Tododao);
      }
      //// Fim atualizacao ////
      //echo $id;die;
      //print_r($_GET);die;
      if($id){
       //echo "estou aqui";
       echo "<button class='voltar' onclick=location.assign('teste3.php?act=divergente&busca=voltar&&abrir=1&x=total')>VOLTAR</button>";
      }else{
      echo "<button class='voltar' onclick=history.go(-1); >VOLTAR</button>";
      }
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