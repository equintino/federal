<title>Divergente</title>
<script>
 function cookie($ultimoSinistrado){
  document.cookie="ultimoSinistrado="+$ultimoSinistrado;
 }
 function total($x){
  var x='Total de diverg&ecirc;ncias encontradas ('+$x+')';
  document.getElementById('total').innerHTML=x;
}
</script>
<?php
          $todo=new Todo();
          $tododao=new TodoDao();
          
          $tabela1='sinipend';
          $tabela2='Beneficiarios';
          @$ultimoSinistrado=$_COOKIE['ultimoSinistrado'];
          @$semPaginacao=$_GET['semPaginacao'];
          @$tipoPesquisa=$_GET['x'];
          
          @$idtitular__=$_GET['idtitular__'];
          @$pagAnterior=$_GET['pagAnterior'];
          if(@$voltar){
           @$idtitular__=$pagAnterior;
          }
          @$pagAtual=$_GET['pagAtual'];
          
          if(@!$idtitular__){
            $idtitular__=1;
            $seguencia[]=$idtitular__;
            foreach($dao->ultimoSinistrado() as $id);
             $ultimoSinistrado=$id->getidtitular();
             setcookie('ultimoSinistrado',$ultimoSinistrado);
          }
          if(@!$pagAtual){
            @$pagAtual=1;
          }
          $divergente=1;
          
          echo '<br>';          
          $impSegurada=0;
          $aIndenizar=0;
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $sinistro_ant=null;
          echo "<div class=divergente>";
          echo "<table align=center border=1 cellspacing=0 >";
          echo "<tr><th>SINISTRO</th><th>VL. SEGURADO</th><th>VL. A INDENIZAR</th></tr>";
          $totalSegurada=0;
          $totalparaIndenizar=0;
          if(@$tipoPesquisa != 'total'){
          while($divergente<14){
           $search->setidtitular($idtitular__);
           $daos=$dao->buscaSinistrado($search);
           while($daos=='nulo'){
            $semsinistrado[]=$idtitular__;
            $idtitular__++;
            $search->setidtitular($idtitular__);
            $daos=$dao->buscaSinistrado($search);
           }
            foreach($daos as $item1){
             $search->setsinistro($item1->getsinistro());
             set_time_limit(20);       
             $odbcs=$dao->busca($search);
             $indenizaOld=0;
             foreach($odbcs as $item2){
              $indenizaOld=$item2->getvlindeniza()+$indenizaOld;
             }
             if(number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.')!=number_format($indenizaOld,2,',','.') && number_format($indenizaOld,2,',','.')!=0 && ($item1->getsinistro()!= null || $item1->getsinistro()!= 0 )){
                echo "<tr><td>".$item1->getsinistro()."</td>";
                echo "<td align=right>".number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.')."</td>";
                echo "<td align=right>".number_format($indenizaOld,2,',','.')."</td></tr>";
                $totalSegurada=$item1->getIMPORTANCIA_SEGURADA()+$totalSegurada;
                $totalparaIndenizar=$indenizaOld+$totalparaIndenizar;
                $divergente++;
                @$idtitular__++;
                $seguencia[]=$idtitular__;
             }
               $idtitular__++;
               if ($idtitular__ > ($ultimoSinistrado)){
                 $divergente=14;
               }
            }
           }
          }else{
           //print_r($_GET);die;
           ////////// lista banco mysql //////////
           $todos=$tododao->find2($search);
             $z=0;
             echo "<div id=total></div>";
          foreach($todos as $item1){
           echo "<div id=total></div>";
                echo "<tr><td><a href='teste3.php?act=titular&sinistro=".$item1->getsinistro()."&impSegurada=".$item1->getIMPORTANCIA_SEGURADA()."&vlindeniza=".$item1->getvlindeniza()."&id=".$item1->getid()."'>".$item1->getsinistro()."</a></td>";
                echo "<td align=right>".@number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.')."</td>";
                echo "<td align=right>".number_format($item1->getvlindeniza(),2,',','.')."</td></tr>";
                $z++;
             }
             echo "<script>total($z);</script>";
           die;
           ////////// fim lista banco mysql ///////
           
           
                $arq="arquivos/divergencia.csv";
                $texto="SINISTRO;IMPORTANCIA_SEGURADA;vlindeniza;idtitular;id";
                $fp = fopen($arq, "w+");
                fwrite($fp, $texto);
             
           $divergente=0;
           while($idtitular__ < ($ultimoSinistrado+1)){
           $search->setidtitular($idtitular__);
           $daos=$dao->buscaSinistrado($search);
           while($daos=='nulo'){
            $semsinistrado[]=$idtitular__;
            $idtitular__++;
            $search->setidtitular($idtitular__);
            $daos=$dao->buscaSinistrado($search);
           }
            foreach($daos as $item1){
             $search->setsinistro($item1->getsinistro());
             set_time_limit(20);       
             $odbcs=$dao->busca($search);
             $indenizaOld=0;
             foreach($odbcs as $item2){
              $indenizaOld=$item2->getvlindeniza()+$indenizaOld;
             }
             echo "<div id=total></div>";
             $z=0;
             if(number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.') != number_format($indenizaOld,2,',','.') && number_format($indenizaOld,2,',','.') != 0 && ($item1->getsinistro() != null || $item1-> getsinistro() != 0 )){
                echo "<tr><td>".$item1->getsinistro()."</td>";
                echo "<td align=right>".number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.')."</td>";
                echo "<td align=right>".number_format($indenizaOld,2,',','.')."</td></tr>";
                $totalSegurada=$item1->getIMPORTANCIA_SEGURADA()+$totalSegurada;
                $totalparaIndenizar=$indenizaOld+$totalparaIndenizar;
                $divergente++;
                @$idtitular__++;
                $seguencia[]=$idtitular__;
                TodoMapper::map($todo, array('vlindeniza'=>$indenizaOld,'IMPORTANCIA_SEGURADA'=>$item1->getIMPORTANCIA_SEGURADA(),'SINISTRO'=>$item1->getsinistro(),'idtitular'=>$item1->getidtitular()));
                
                $texto="\r\n".$item1->getsinistro().";".$item1->getIMPORTANCIA_SEGURADA().";".$indenizaOld.";".$item1->getidtitular().";$divergente";
                $escreve = fwrite($fp, $texto);
             }             
               $idtitular__++;
           }
          }
                fclose($fp);
          echo "<script>total($divergente);</script>";
          die;
          }
          if($pagAtual==1){
            $botao="<button disabled>";
          }else{
            $botao="<button onclick='history.go(-1)' >";
          }
          if($idtitular__ > ($ultimoSinistrado)){
            $botao_="<button disabled>";
          }else{  
            $botao_="<button onclick=\"window.location.href='carregando.php?act=divergente&abrir=1&idtitular__=".$idtitular__."&pagAtual=".($pagAtual+1)."'\">";
          }               
           echo "<tr><th colspan=3>".$botao." < </button> &nbsp ".$pagAtual." &nbsp   ".$botao_." ></button></th></tr>";
           echo "</table>";
           echo "</div>";
?>