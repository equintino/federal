<!DOCTYPE html>
<html>
    <head>
        <title>Divergente</title>
         <!--@section Scripts {
         @Scripts.Render("~/Content/css")
         @Scripts.Render("~/bundles/DataTables")-->
        <script>
         function cookie($ultimoSinistrado){
           //alert($ultimoSinistrado);
           document.cookie="ultimoSinistrado="+$ultimoSinistrado;
         }
/*
           $(document).ready(function () {
              $("#divCarregando").show();
              $(window).load(function () {
              // Quando a página estiver totalmente carregada, remove o id
              $('#divCarregando').fadeOut('slow');
              });
           });
 */
         /*
         function calculando(){
           //alert("aguarde...");
           document.getElementById("calculando").innerHTML = "pronto!";
         }
         */
        </script>
    </head>
    <body>
        <?php
        /*
        print_r($dao);
        echo "<br><br>";
        print_r($search);
        echo "<br><br>";
        print_r($odbc);
        echo "<br><br>";
          //$dao = new OdbcDao();
          //$search = new OdbcSearchCriteria();
          //$odbc = new Odbc();
        print_r($dao);
        echo "<br><br>";
        print_r($search);
        echo "<br><br>";
        print_r($odbc);
        echo "<br><br>";
         * 
         */
          
          $tabela1='sinipend';
          $tabela2='Beneficiarios';
          $ultimoSinistrado=$_COOKIE['ultimoSinistrado'];
          
          //print_r($_GET);
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
          //echo "<h1>".$idtitular__."</h1>";
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
               //echo "<div id=\"calculando\" class=lendo>";
                //echo "calculando...";
               //echo "</div>";
          /*
          echo "
           <div id=\"divCarregando\" class=\"progresso\"> 
            <img src=\"~/Img/carregando.gif\" />
            <br /> Carregando... 
           </div> ";
           * 
           */
          
          //echo $sucursal;die;
          /*
          switch($sucursal){
              case 15:
                  $filial='0115';
                  break;
              case 21:
                  $filial='0121';
                  break;
              case 22:
                  $filial='0122';
                  break;
              case 23:
                  $filial='0123';
                  break;
              case 24:
                  $filial='0124';
                  break;
              case 25:
                  $filial='0125';
                  break;
              case 26:
                  $filial='0126';
                  break;
              case 27:
                  $filial='0127';
                  break;
              case 28:
                  $filial='0128';
                  break;
              case 29:
                  $filial='0129';
                  break;
              case 31:
                  $filial='0131';
                  break;
              case 32:
                  $filial='0132';
                  break;
              case 33:
                  $filial='0133';
                  break;
              case 35:
                  $filial='0135';
                  break;
              case 41:
                  $filial='0141';
                  break;
              case 42:
                  $filial='0142';
                  break;
              case 43:
                  $filial='0143';
                  break;
              case 51:
                  $filial='0151';
                  break;
              case 52:
                  $filial='0152';
                  break;
              case 53:
                  $filial='0153';
                  break;
              case 54:
                  $filial='0154';
                  break;
              case 01:
                  $filial='0101';
                  break;
              default: 
                  $filial=null;
                  echo "Sucursal inexistente";
                  die;
                  //break;
          }
           * 
           */
          
          //echo $filial;die; 
          //echo $filial.'.'.$ramo;die;
          //echo $search->getsinistro();
          
          //$search->setsinistro($filial.'.'.$ramo);
          if(!isset($ultimoSinistrado)){
            foreach($dao->ultimoSinistrado() as $id){
             $ultimoSinistrado=$id->getidtitular();
             //setcookie("ultimoSinistrado" ,"$ultimoSinistrado", time() + (86400 * 30), "/");
            echo  "<script>cookie($ultimoSinistrado)</script>";
            }
          //echo "<h1>".$ultimoSinistrado."</h1>";
          }
          //print_r($_COOKIE);
          //echo $search->getsinistro();
          //print_r($search);
          //die;
        /*
          echo "<div id='geral'>";
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>BENEFICI&AacuteRIO</th><th>VL. A INDENIZAR</th></tr>";
         * 
         */
          echo "<table align=center border=1 cellspacing=0 >";
          echo "<tr><th>SINISTRO</th><th>VL. SEGURADO</th><th>VL. A INDENIZAR</th></tr>";
          $totalSegurada=0;
          $totalparaIndenizar=0;
          //while($divergente<28){
          while($divergente<14){
           //echo "<h1>$idtitular__</h1>";
           //echo "<br><br>";
          $search->setidtitular($idtitular__);
          $daos=$dao->buscaSinistrado($search);
          while($daos=='nulo'){
           $semsinistrado[]=$idtitular__;
           $idtitular__++;
           $search->setidtitular($idtitular__);
           $daos=$dao->buscaSinistrado($search);
           //echo "estou aqui dentro";
          }
          //print_r($search);
          //echo "<br><br>";
          //print_r($daos);
          //echo "<br><br>";
          //var_dump($dao->listaConteudo2($tabela1));die;
             //if($dao->listaConteudo2($tabela1)){
               //print_r($dao->busca($search));die;  
              //foreach($dao->listaConteudo2($tabela1) as $item1){
          //if($)
              foreach($daos as $item1){
                  //print_r($item1);
                  $search->setsinistro($item1->getsinistro());
                  //echo "<br><br>";
                  //print_r($search->getsinistro());
                  //echo "<br><br>";
                  //die;
               //if(!$item1['SINISTRO']){
               //if(!$item1->getsinistro()){
            set_time_limit(20);    
            //$search->setsinistro($item1['SINISTRO']);   
            $odbcs=$dao->busca($search);
            //echo "<br><br>";
            //print_r($odbcs);
            //die;
            $indenizaOld=0;
            foreach($odbcs as $item2){
             $indenizaOld=$item2->getvlindeniza()+$indenizaOld;
             //print_r($indenizaOld);
             //die;
             //echo "<br><br>";
            }
            /*
            print_r(number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.'));
            echo " != ";
            print_r(number_format($indenizaOld,2,',','.'));
            echo " && ";
            print_r(number_format($indenizaOld,2,',','.'));
            echo " != 0";
            echo "<br><br>";
            
             * 
             */
            //echo $indenizaOld;die;
            //echo "<br><br>";
            //print_r($item2);
            //echo "<br><br>";
            if(number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.')!=number_format($indenizaOld,2,',','.') && number_format($indenizaOld,2,',','.')!=0 && ($item1->getsinistro()!= null || $item1->getsinistro()!= 0 )){
             //echo "<tr><td>".$item1->getidtitular()."</td>";
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
               //echo "passei aqui";
               //$seguencia[]=$idtitular__;
              }
               }
               //echo $divergente;
               //if($divergente==14){               
                 //echo "<script>calculando()</script>";
               //}
             // }
            // }
             //echo "<tr><th>TOTAL</th><td>".number_format($totalSegurada,'2',',','.')."</td><td>".number_format($totalparaIndenizar,'2',',','.')."</td></tr>";
               /*
            if(number_format($item1->getIMPORTANCIA_SEGURADA(),2,',','.')!=number_format($indenizaOld,2,',','.') && number_format($indenizaOld,2,',','.')!=0){
                $divergente++;
                @$idtitular__++;
                $seguencia[]=$idtitular__;             
            }
               $idtitular__++;
                
          }
                */
          if($pagAtual==1){
            $botao="<button disabled>";
          }else{
            $botao="<button onclick='history.go(-1)' >";
          }
          if($idtitular__ > ($ultimoSinistrado)){
            $botao_="<button disabled>";
          }else{        
            //redirecionar('1','teste3.php?act=divergente&abrir=1','AGUARDE...');
            $botao_="<button onclick=\"window.location.href='carregando.php?act=divergente&abrir=1&idtitular__=".$idtitular__."&pagAtual=".($pagAtual+1)."'\">";
          }
               
               echo "<tr><th colspan=3>".$botao." < </button> &nbsp ".$pagAtual." &nbsp   ".$botao_." ></button></th></tr>";
               echo "</table>";
               
/* '\'".."\'&pagAnterior=\'".$seguencia[0]."\'\"  > 
 */
              //print_r(@$semsinistrado);
             die;
             
             
             
            $linha_vazia=0;
            if($dao->listaConteudo($tabela2)){
            foreach($dao->listaConteudo($tabela2) as $item2){ 
              if($item2['vlindeniza'] != 0){
                //echo "<tr><td align=center>".$item['sinistro']."</td><td>".$item['nome']."</td><td align=right>".number_format($item['vlindeniza'],'2',',','.')."</td></tr>";
                    if($sinistro_ant != $item2['sinistro']){
                        $y++;
                    }
                    $sin_cadastrado[]=$item2['sinistro'];
                    $sinistro_ant=$item2['sinistro'];
                    $total=$total+$item2['vlindeniza'];
                    $x++;
                }else{
                    $sin_vazio[]=$item2['sinistro'];
                    $nome_vazio[]=$item2['nome'];
                    $indenizado_vazio[]=$item2['vlindeniza'];
                    $linha_vazia++;
                }
            }
           }
           /*
          echo '</table>';
        echo "</div>";
        echo "<br><br><br><br><br><br>";
        echo "<div>";
            echo "<h3 align='center'><span>Cadastros Benefici&aacute;rios Incompletos</span></h3>";
            echo "<table border=1 align=center cellspacing=0 spanspacing=0><tr><th>SINISTRO</th><th>BENEFICI&Aacute;RIO</th><th>VL. A INDENIZAR</th></tr>";
            * 
            */
            if(@!$sin_vazio){
             $sin_vazio=null;
            }
            for($a=0;$a<count($sin_vazio);$a++){
                if($sin_vazio[$a]!=null){
                    //echo "<tr><td>".$sin_vazio[$a]."</td><td>".$nome_vazio[$a]."</td><td>".$indenizado_vazio[$a]."</td></tr>";
                }
            }
        //echo "</div>";
        $campo='sinistro';
        
          echo '<table align=center border=1 cellspacing=0 class="resumo">';
          echo '<th colspan=3>RESUMO</th>';
          echo '<tr><th>IMPORT&AcircNCIA SEGURADA</th><th>TOTAL A INDENIZAR</th></tr>';
          echo '<tr><td align=right>'.number_format($impSegurada,'2',',','.').'</td><td align=right>'.number_format($aIndenizar,'2',',','.').'</td></tr>';
          echo '<tr><th colspan=3><span>VALOR DIVEG&EcircNTE</span></th></tr>';
          echo '<tr><td colspan=3 align=center>';
          echo number_format($impSegurada-$aIndenizar,'2',',','.');
          echo '</td></tr>';
          die; 
        ?>
    </body>
</html>