<!DOCTYPE html>
<html>
    <head>
        <title>Relatorio</title>
     <script>
         function total($x){
          var x='Total de diverg&ecirc;ncias encontradas ('+$x+')';
          document.getElementById('total').innerHTML=x;
         }
     </script>
    </head>
    <body>
        <?php 
          $tabela='Beneficiarios';
          $tabela2='sinipend';
          echo '<br>';          
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $contador=0;
          $sinistro_ant=null;
        echo "<div id='geral'>";
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>AP&Oacute;LICE</th><th>CERTIFICADO</th><th>BENEFICI&AacuteRIO</th><th>VL. A INDENIZAR</th></tr>";
          
          //// Lista de SINISTRADO ////
             $sin_num=0;
             if($dao->listaConteudo($tabela2)){
              foreach($dao->listaConteudo($tabela2) as $item2){
               @$sinistro_[]=$item2['SINISTRO'];
               @$titular[]=$item2['TITULAR'];
               @$certificado2[]=$item2['ENDOSSO'];
               if($item2['SINISTRO']){
                @$sin_num ++;
               }               
              }
             }
          //// lista de BENEFICIARIOS ////   
            $linha_vazia=0;

            if($dao->listaConteudo($tabela)){
            foreach($dao->listaConteudo($tabela) as $item){ 
                if($item['sinistro']){
                echo "<tr><td align=center>".$item['sinistro']."</td><td>".$item['apolice']."</td><td>".$item['endosso']."</td><td>".$item['nome']."</td><td align=right>".number_format($item['vlindeniza'],'2',',','.')."</td></tr>";
                    if($sinistro_ant != $item['sinistro']){
                        $y++;
                        $Tododao=new TodoDao();
                        $Todosearch=new TodoSearchCriteria();
                        $Todosearch->setSINISTRO($item['sinistro']);
                        
                        //$Todosearch->setSINISTRO('0152.93.03.00000276');
                        
                        //print_r($Todosearch->getSINISTRO());
                        if($Todosearch->getSINISTRO()){
                            $todos=$Tododao->find($Todosearch);
                        }
                        //echo "<pre>";
                        //print_r(@$y);
                        //echo "</pre>";
                        //print $y;
                        //echo "<br>";
                        if(@$todos){
                         foreach ($todos as $sin){
                           $sinJud[]=$sin->getSINISTRO();
                           //echo " - ";
                           //echo $sin->getN_PROC();
                           //echo "<br>";
                         }
                           //echo count($sinJud);
                        }
                        //print_r($todos);
                    }
                    $sin_cadastrado[]=$item['sinistro'];
                    $sinistro_ant=$item['sinistro'];
                    $total=$total+$item['vlindeniza'];
                    //$apolices[]=$item['apolice'];
                    $x++;
                }
            $key=array_search($item['sinistro'],$sinistro_); 
            //print_r(substr($item['apolice'],8,2));
            //echo "<br>";
            if($item['vlindeniza'] == 0 || $item['endosso'] != $certificado2[$key] || $item['sinistro'] == '' || (substr($item['apolice'],8,2) != 00 && $item['endosso'] != $certificado2[$key])){
                    $sin_vazio[]=$item['sinistro'];
                    $nome_vazio[]=$item['nome'];
                    $certificado[]=$item['endosso'];
                    $indenizado_vazio[]=$item['vlindeniza'];
                    $certificado2[]=$certificado2[$key];
                    $apolices[]=$item['apolice'];
                    $linha_vazia++;
                }
            }
           }
          echo '</table>';
        echo "</div>";
        echo "<br><br><br><br><br><br>";
        echo "<div>";
            echo "<h3 align='center'><span>Cadastros Benefici&aacute;rios Incompletos ou Certificado diverg&ecirc;nte</span></h3>";
            echo "<div id=total class=busca></div>";
            echo "<table border=1 align=center cellspacing=0 spanspacing=0><tr><th>SINISTRO</th><th>AP&Oacute;LICE</th><th>CERTIFICADO</th><th>BENEFICI&Aacute;RIO</th><th>VL. A INDENIZAR</th></tr>";
            if(@!$sin_vazio){
             $sin_vazio=null;
            }
            for($a=0;$a<count($sin_vazio);$a++){
                if($sin_vazio[$a]!=null){
                    echo "<tr><td>".$sin_vazio[$a]."</td><td>".$apolices[$a]."</td><td>".$certificado[$a]."</td><td>".$nome_vazio[$a]."</td><td align=right>".number_format($indenizado_vazio[$a],'2',',','.')."</td></tr>";
                }
            }
        echo "</div>";
        echo "<script>total($linha_vazia)</script>";
        $campo='sinistro';
        $processos=count(@$sinJud);
          echo '<table align=center border=1 cellspacing=0 class="resumo">';
          echo '<th colspan=3>RESUMO</th>';
          echo '<tr><th>SINISTROS</th><th>BENEFICI&Aacute;RIOS</th><th>TOTAL A INDENIZAR</th></tr>';
          echo '<tr><td align=right>'.number_format($y,'0','','.').'</td><td align=right>'.number_format($x,'0','','.').'</td><td align=right>R$ '.number_format($total,'2',',','.').'</td></tr>';
          echo '<tr><th colspan=3>IMPORTADOS (c/ proc. jud.) - CADASTRADOS = <span>p/ cadastrar</span></th></tr>';
          echo '<tr><td colspan=3 align=center>';
          echo number_format($sin_num,'0','','.');
          echo " (".($processos).")";
          echo ' - ';
          echo number_format($y,'0','','.');
          echo ' = ';
          echo number_format(($sin_num-$processos)-$y,'0','','.');
          echo '</td></tr>';
          die; 
        ?>
    </body>
</html>