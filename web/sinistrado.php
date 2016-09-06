<?php 
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
      
      if(isset($pagAtual)){
         $search->setidtitular($pagAtual); 
      }
      
      if($num_sinistro==null && $sinistrado==null && $importanciasegurada==0){
          $valoresembranco=1;       
      }
      if(strlen($num_sinistro)==16){
          $sin=OdbcValidator::mask($num_sinistro,"####.##.##.########");
      }else{
          $sin=$num_sinistro;
      }
      
      $search->setTITULAR($sinistrado);
      $search->setIMPORTANCIA_SEGURADA($importanciasegurada);
      if(substr($sin,9,1)==2){
       $search->setENDOSSO($sin);
      }else{      
       $search->setsinistro($sin);
      }
       
      $odbcs=$dao->busca3($search);
      //print_r($odbcs);die;
      
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>AP&Oacute;LICE</th><th>CERTIFICADO</th><th>SINISTRADO</th><th>IMP.<br>SEGURADA</th><th>DT<br>&OacuteBTO</th><th>DT<br>AVISO</th><th>INFO</th></tr>";
      }
      $y=0;
     // print_r($odbcs);die;
     foreach($odbcs as $item){
       if($item->getTITULAR()){
        echo "<tr><td>";
            echo $item->getsinistro();
        echo "</td><td>";
            echo $item->getapolice();
        echo "</td><td>";
            echo $item->getENDOSSO();
        echo "</td><td>";
            echo $item->getTITULAR();
        echo "</td><td align=right>";
            echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
        echo "</td><td>";
            echo $item->getDT_SINISTRO();
        echo "</td><td>";
            $data=$item->getDT_AVISO();
            echo OdbcValidator::data($data);
        echo "</td><td align=center>";
            echo "<a href='teste3.php?act=status&sinistro=".$item->getsinistro()."&beneficiario=".$item->getnome()."'><img src='img/detalhe.png' height=15 /></a>";
        echo "</td></tr>";
       $y++;
       }
     }
        /// paginação ///
       $totalPag=number_format(($dao->totalLinhas($search,'sinipend')/14),'0','','.');
       //$pagAtual=  number_format(@$item->getidtitular()/14,'0','','.');
       //echo $totalPag;
       //echo $item->getidtitular();
       
        
       if($pagAtual==1 || $pag_==1){
           $botao="<button disabled>";
       }else{
           $botao="<button onclick=history.go(-1); >";
       }
      // echo number_format($pagAtual,'0','','.');
       //echo "==";
       //echo number_format($totalPag,'0','','.');
       //print_r(number_format($pagAtual,'0','','.') == number_format($totalPag,'0','','.') || $pag_ == $totalPag);
       if($pagAtual == number_format($totalPag,'0','','.') || $pag_ == $totalPag){
           $botao_="<button disabled>";
       }else{
           $botao_="<a href=carregando.php?act=sinistrado&busca=sinistrado&sinistrado=$sinistrado&importanciasegurada=$importanciasegurada&num_sinistro=$num_sinistro&pagAtual=".@$item->getidtitular()."&pag_=".($pag_+1)." > <button>";
       }
       
       if(@$valoresembranco==1){
            echo "<tr><th colspan=8 align=center>".$botao." < </button> $pag_ de ".number_format($totalPag,'0','','.')." ".$botao_." > </button></a></th></tr>";
       }else{
        $ultimoSinistrado=$item->getidtitular();
        //echo $totalPag;
           if(number_format($totalPag,'0','','.') > 0 ){
               echo "<script>
                        document.cookie=\"pag_=$pag_\";
                        document.cookie=\"pagAtual=$pag_\";
                        document.cookie=\"totalPag=$totalPag\";
                        document.cookie=\"ultimoSinistrado=$ultimoSinistrado\";
                    </script>";
               echo "<tr><th colspan=8 align=center>".$botao." < </button> $pag_ de $totalPag ".$botao_." > </button></a></th></tr>";
               //$pagAtual=$pag_;
           }else{
               echo "<tr><th colspan=8 align=center><button disabled> < </button> 1 de 1 <button disabled> > </button></a></th></tr>";
           }
       }
        /// fim paginação ///   
      echo "</table>";
?>
