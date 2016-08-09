<?php 
      //die;
      @$num_sinistro=$_GET['num_sinistro'];
      if(@!$num_sinistro){
       @$num_sinistro=$_POST['num_sinistro'];
      }
      @$sinistrado=$_GET['sinistrado'];
      if(@!$sinistrado){
       @$sinistrado=$_POST['sinistrado'];
      }
      @$importanciasegurada=$_GET['importanciasegurada'];
      if(@!$importanciasegurada){
       @$importanciasegurada=$_POST['importanciasegurada'];
      }
      @$pagAtual=$_GET['pagAtual'];
      @$pag_=$_GET['pag_'];
               if(@!$pag_){
                   $pag_=1;
               }
      @$continua=$_GET['continua'];
      
      //print_r($_COOKIE);
      
      if(isset($pagAtual)){
         $search->setidtitular($pagAtual); 
      }
      
      if($num_sinistro==null && $sinistrado==null && $importanciasegurada==0){
          $valoresembranco=1;
          
      }
      
      //echo "estou aqui";
      //print_r($_GET);
      //die;
      
      $search->setTITULAR($sinistrado);
      $search->setIMPORTANCIA_SEGURADA($importanciasegurada);
      if(substr($num_sinistro,9,1)==2){
       $search->setENDOSSO($num_sinistro);
      }else{      
       $search->setsinistro($num_sinistro);
      }
       
      $odbcs=$dao->busca3($search);
           //print_r($search);
           //echo "<br><br>";
           //print_r($odbcs);
      
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>CERTIFICADO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th></tr>";
      }
      $y=0;
     foreach($odbcs as $item){
       if($item->getTITULAR()){
        echo "<tr><td>";
            //echo $item->getidtitular();
        //echo "</td><td>";
            echo $item->getsinistro();
        echo "</td><td>";
            echo $item->getENDOSSO();
        echo "</td><td>";
            echo $item->getTITULAR();
        echo "</td><td align=right>";
            echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
        echo "</td></tr>";
       $y++;
       }
     }
        /// paginação ///
       $totalPag=number_format(($dao->totalLinhas($search,'sinipend')/14),'0','','.');
       //print_r($totalPag);
       $pagAtual=  number_format(@$item->getidtitular()/14,'0','','.');
       
       //echo number_format($totalPag,'0','','.');
        
       if($pagAtual==1 || $pag_==1){
           $botao="<button disabled>";
       }else{
           $botao="<button onclick=history.go(-1); >";
       }
       if(number_format($pagAtual,'0','','.') == number_format($totalPag,'0','','.') || $pag_ == $totalPag){
           $botao_="<button disabled>";
       }else{
           $botao_="<a href=carregando.php?act=sinistrado&busca=sinistrado&sinistrado=$sinistrado&importanciasegurada=$importanciasegurada&num_sinistro=$num_sinistro&pagAtual=".$item->getidtitular()."&pag_=".($pag_+1)." > <button>";
       }
       
       if(@$valoresembranco==1){
            echo "<tr><th colspan=4 align=center>".$botao." < </button> $pagAtual de ".number_format($totalPag,'0','','.')." ".$botao_." > </button></a></th></tr>";
       }else{
        //echo "<br><br>";
        //print_r(number_format($totalPag,'0','','.'));
        $ultimoSinistrado=$item->getidtitular();
           if(number_format($totalPag,'0','','.') > 0 ){
               echo "<script>
                        document.cookie=\"pag_\=$pag_\";
                        document.cookie=\"totalPag=$totalPag\";
                        document.cookie=\"ultimoSinistrado=$ultimoSinistrado\";
                    </script>";
               //echo number_format(($totalPag/14),'0','','.');
               echo "<tr><th colspan=4 align=center>".$botao." < </button> $pag_ de $totalPag ".$botao_." > </button></a></th></tr>";
           }else{
               echo "<tr><th colspan=4 align=center><button disabled> < </button> 1 de 1 <button disabled> > </button></a></th></tr>";
           }
       }
        /// fim paginação ///   
      echo "</table>";
?>
