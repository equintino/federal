<?php 
//phpinfo();die;
      @$num_sinistro=$_GET['num_sinistro'];
      if(@!$num_sinistro){
       @$num_sinistro=$_POST['num_sinistro'];
      }
      @$beneficiario=$_GET['beneficiario'];
      if(@!$beneficiario){
       @$beneficiario=$_POST['beneficiario'];
      }
      //echo $beneficiario;
      @$importanciasegurada=$_GET['importanciasegurada'];
      if(@!$importanciasegurada){
       @$importanciasegurada=$_POST['importanciasegurada'];
      }
      @$vlindeniza=$_GET['vlindeniza'];
      if(@!$vlindeniza){
       @$vlindeniza=$_POST['vlindeniza'];
      }
      @$pagAtual=$_GET['pagAtual'];
      @$pag_=$_GET['pag_'];
               if(@!$pag_){
                   $pag_=1;
               }
      @$continua=$_GET['continua'];
      //print_r($_GET);die;
      if(isset($pagAtual)){
         $search->setidbenefi($pagAtual); 
      }
      //print_r($pagAtual);die;
      
      if($num_sinistro==null && $beneficiario==null && $importanciasegurada==0){
          $valoresembranco=1;          
      }
      if(strlen($num_sinistro)==16){
          $sin=OdbcValidator::mask($num_sinistro,"####.##.##.########");
      }else{
          $sin=$num_sinistro;
      }
      
    if($busca=='beneficiario'){     
     if(preg_match('/^[a-z,A-Z]/', $beneficiario)){
      $search->setnome($beneficiario);
      $odbcs=$dao->busca4($search);
     }else{
      if(substr($sin,9,1)==2){
       $search->setendosso($sin);
      }else{      
       $search->setsinistro($sin);
      }
     }
      $search->setvlindeniza($vlindeniza);
      
      $odbcs=$dao->busca4($search);
      
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
    if(@!$idbenefi){
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>AP&Oacute;LICE</th><th>CERTIFICADO</th><th>BENEFICI&Aacute;RIO</th><th>A INDENIZAR</th></tr>";
      }
      $totalBeneficiarios=0;
     foreach($odbcs as $item){
      //print_r($item);
       if($item->getnome()){
        echo "<tr><td>";
           //echo $item->getidbenefi();
        //echo "<td>";
        echo "<a href='teste3.php?act=titular&sinistro=".$item->getsinistro()."'>";
        echo $item->getsinistro();
        echo "</a>";
        echo "</td><td>";
        echo $item->getapolice();
        echo "</td><td>";
        echo $item->getendosso();
        echo "</td><td>";
        echo "<a href='teste3.php?act=beneficiario&busca=beneficiario&abrir=1&idbenefi=".$item->getidbenefi()."'>";
        echo $item->getnome();
        echo "</a>";
        echo "</td><td align=right>";
        echo number_format($item->getvlindeniza(),2,',','.');
        echo "</td></tr>";
        $totalBeneficiarios++;
       }
     }
       //$ultimaLinha_=@$item->getidbenefi()/14;       
      //echo "<tr><th colspan=4 align=center> <a href=teste3.php?act=beneficiario&busca=beneficiario&pagAtual=".($item->getidbenefi()-28)."> < &nbsp</a>".number_format($ultimaLinha_,'0','','.')." de ".number_format($totalPag,'0','','.')." <a href=teste3.php?act=beneficiario&busca=beneficiario&pagAtual=".$item->getidbenefi().">&nbsp > </a></th></tr>";
      
      //die;
        /// paginação ///
       $totalPag=number_format(($dao->totalLinhas($search,'Beneficiarios')/14),'0','','.');
       //print_r($totalPag);die;
       //print_r($search);
       $pagAtual=  number_format(@$item->getidbenefi()/14,'0','','.');
       //print_r($pagAtual);die;
       //echo "<br><br>";
       //var_dump(number_format($pagAtual,'0','','.') == $totalPag || $pag_ == $totalPag);
       //echo "<br>";
       //print_r($pag_);
       //echo "<br>";
       //print_r($totalPag);die;
       
        
       if($pagAtual==1 || $pag_==1){
           $botao="<button disabled>";
       }else{
           $botao="<button onclick=history.go(-1); >";
       }
       if(number_format($pagAtual,'0','','.') == $totalPag || $pag_ == $totalPag){
           $botao_="<button disabled>";
       }else{
           $botao_="<a href=carregando.php?act=beneficiario&busca=beneficiario&beneficiario=$beneficiario&vlindeniza=$vlindeniza&num_sinistro=$num_sinistro&pagAtual=".$item->getidbenefi()."&pag_=".($pag_+1)." > <button>";
       }
       
       if(@$valoresembranco==1){
            echo "<tr><th colspan=5 align=center>".$botao." < </button> $pag_ de ".$totalPag." ".$botao_." > </button></a></th></tr>";
       }else{
        $ultimaLinha=$item->getidbenefi();
           if(number_format($totalPag,'0','','.') > 0 ){
               echo "<script>
                        document.cookie=\"pag_\=$pag_\";
                        document.cookie=\"totalPag=$totalPag\";
                        document.cookie=\"ultimoBeneficiario=$ultimaLinha\";
                    </script>";
               echo "<tr><th colspan=5 align=center>".$botao." < </button> $pag_ de $totalPag ".$botao_." > </button></a></th></tr>";
           }else{
               echo "<tr><th colspan=5 align=center><button disabled> < </button> 1 de 1 <button disabled> > </button></a></th></tr>";
           }
       }
        /// fim paginação ///  
      }else{
       $search->setidbenefi($idbenefi);
       $odbcs=$dao->busca5($search);
       echo "<div class=endereco>";
       echo "<br><br>";
       foreach($odbcs as $item){
        $cpf1=OdbcValidator::removePonto($item->getcpf());
         echo "<label>Nome: </label>";
         echo $item->getnome();
         echo "<br>";
         echo "<label>Cpf: </label>";
            if(strlen($cpf1) != 11){
                $cor='color=red';
            }else{
                $cor='color=black';
            }
         echo "<font $cor>";
         echo OdbcValidator::mask($cpf1,'###.###.###-##');
         echo "</font>";
         echo "<br>";
         echo "<label>Tel: </label>";
         echo $item->gettel_fixo();
         echo " / ";
         echo $item->gettel_cel();
         echo "<label>E-mail: </label>";
         echo $item->getemail();
         echo "<br>";
         echo "<label>Endere&ccedil;o: </label>";
         echo $item->gettipo();
         echo " ";
         echo $item->getendereco();
         echo ", ";
         echo $item->getnumero();
         echo " - <label>Complemento: </label>";
         echo $item->getcomplemento();
         echo "<br>";
         echo "<label>Bairro: </label>";
         echo $item->getbairro();
         echo " - ";
         echo $item->getmunicipio();
         echo " - ";
         echo $item->getestado();
         echo "<br>";
         echo "<label>Cep: </label>";
         echo OdbcValidator::mask($item->getcep(),"#####-###");
         echo "<br>";
         echo "<label>Cobertura: </label>";
         echo $item->gettpcobertura();
         echo "<br>";
         echo "<label>A Indenizar: </label>R$ ";
         echo number_format($item->getvlindeniza(),2,',','.');
       }
       echo "<br>";
       echo "<button onclick=history.go(-1)>";
       echo "Voltar";
       echo "</button>";
       echo "</div>";
      }
      echo "</table>";
      echo "</div>";
      die;
    }
?>