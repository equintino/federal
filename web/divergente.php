<!DOCTYPE html>
<html>
    <head>
        <title>Divergente</title>
        <script>
         function cookie($ultimoSinistrado){
           document.cookie="ultimoSinistrado="+$ultimoSinistrado;
         }
        </script>
    </head>
    <body>
        <?php
          $tabela1='sinipend';
          $tabela2='Beneficiarios';
          @$ultimoSinistrado=$_COOKIE['ultimoSinistrado'];
          
          @$idtitular__=$_GET['idtitular__'];
          @$pagAnterior=$_GET['pagAnterior'];
          if(@$voltar){
           @$idtitular__=$pagAnterior;
          }
          @$pagAtual=$_GET['pagAtual'];
          if(@!$idtitular__){
            $idtitular__=1;
            $seguencia[]=$idtitular__;
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
          if(!isset($ultimoSinistrado)){
            foreach($dao->ultimoSinistrado() as $id){
             $ultimoSinistrado=$id->getidtitular();
            echo  "<script>createCookie('ultimoSinistrado',$ultimoSinistrado)</script>";
            }
          }
          echo "<table align=center border=1 cellspacing=0 >";
          echo "<tr><th>SINISTRO</th><th>VL. SEGURADO</th><th>VL. A INDENIZAR</th></tr>";
          $totalSegurada=0;
          $totalparaIndenizar=0;
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
        ?>
    </body>
</html>