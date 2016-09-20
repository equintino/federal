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
          $Tododao=new TodoDao();
          $Todosearch=new TodoSearchCriteria();
          echo '<br>';          
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $contador=0;
          $sinistro_ant=null;
        echo "<div id='geral'>";
          
          //// Lista de SINISTRADO ////
          //echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          //echo "<tr><th>SINISTRO</th><th>SEGURADO</th></tr>";  
           
        /// Criando arquivo com segurados administratativo ///
            $filename_='arquivos/administrativo.csv';
            $handle_=fopen($filename_, 'w+');
            $texto_="SINISTRO;SINISTRADO;VALOR_INDENIZAR\r\n";
            fwrite($handle_, $texto_);
        /// continua ///
            
             $sin_num=0;
             if($dao->listaConteudo($tabela2)){
              foreach($dao->listaConteudo($tabela2) as $item2){
               @$sinistro_[]=$item2['SINISTRO'];
               @$titular[]=$item2['TITULAR'];
               @$certificado2[]=$item2['ENDOSSO'];
               @$dt_aviso[]=$item2['DT_AVISO'];
               @$imp_segurada[]=$item2['IMPORTANCIA_SEGURADA']; 
               
               if($item2['SINISTRO']){
                   $Todosearch->setSINISTRO($item2['SINISTRO']);
                   //print_r($Todosearch->getSINISTRO());die;
                  $sinSemJd=$Tododao->findBySinistro($Todosearch);
                  //print_r($sinSemJd);
                  //echo "<br><br>";
                  //if($sinSemJd){
                    //foreach($sinSemJd as $lista){
                        //print_r($lista->getSINISTRO());DIE;
                    //}
                  //}
                  if(!$sinSemJd){
               
                    /// continuacao ///
                        $texto_=$item2['SINISTRO'].";".$item2['TITULAR'].";".number_format($item2['IMPORTANCIA_SEGURADA'],'2',',','.')."\r\n";
                        fwrite($handle_, $texto_);
                    /// continua ///
                        
                
                  }
                }
               
               if($item2['SINISTRO']){
                $Todosearch->setSINISTRO($item2['SINISTRO']);
                /*
                if($Todosearch->getSINISTRO()){
                 $todos=$Tododao->find($Todosearch);
                 foreach ($todos as $sin){
                  $sinJud[]=$sin->getSINISTRO();
                 }
                }
                 * 
                 */
                @$sin_num ++;
                }               
                 //$todos=count($Tododao->find($Todosearch));
                 //print_r($sinJud);
               //echo "<tr><td>";
               //echo $item2['SINISTRO'];
               //echo "</td><td>";
               //echo $item2['TITULAR'];
               //echo "</td></tr>";
              }
             }        
                    /// continuacao ///
                        fclose($handle_);
                        unset($texto_);
                    /// fim administrativo ///

           //echo "</table>";
             
            ///// Lista BENEFICIARIOS ///// 
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>AP&Oacute;LICE</th><th>CERTIFICADO</th><th>BENEFICI&AacuteRIO</th><th>A INDENIZAR</th></tr>";
          //// lista de BENEFICIARIOS ////   
            $linha_vazia=0;     

            if($dao->listaConteudo($tabela)){
            foreach($dao->listaConteudo($tabela) as $item){ 
                if($item['sinistro']){
                echo "<tr><td align=center>".$item['sinistro']."</td><td>".$item['apolice']."</td><td>".$item['endosso']."</td><td>".$item['nome']."</td><td align=right>".number_format($item['vlindeniza'],'2',',','.')."</td></tr>";
                    if($sinistro_ant != $item['sinistro']){
                        $y++;
                    }
                    $sin_cadastrado[]=$item['sinistro'];
                    $sinistro_ant=$item['sinistro'];
                    $total=$total+$item['vlindeniza'];
                    $x++;
                }
            $key=array_search($item['sinistro'],$sinistro_); 
            
                if($item['vlindeniza'] == 0 || $item['endosso'] != $certificado2[$key] || $item['sinistro'] == '' || (substr($item['apolice'],8,2) != 00)){
                    $sin_vazio[]=$item['sinistro'];
                    $nome_vazio[]=$item['nome'];
                    $certificado[]=$item['endosso'];
                    $indenizado_vazio[]=$item['vlindeniza'];
                    $certificado2[]=$certificado2[$key];
                    $apolices[]=$item['apolice'];
                    $linha_vazia++;
                }
                ///////// Levantamento ////////
                        /*
                    if(@$key != @$key_old){
                        $titular_cad[]=$titular[$key];
                        $sinistro_cad[]=$sinistro_[$key];
                        $imp_segurada_cad[]=$imp_segurada[$key];
                        //echo $titular[$key];
                        //echo " - $key";
                        //echo "<br>"; 
                    }
                    $key_old=$key;
                         */
                //////// continua ////////
            }
         }
          echo '</table>';
        echo "</div>";               
        echo "<br><br><br><br><br><br>";
        echo "<div>";
            echo "<h3 align='center'><span>Cadastros Benefici&aacute;rios Incompletos ou Certificado diverg&ecirc;nte</span></h3>";
            echo "<div id=total class=busca></div>";
            echo "<table border=1 align=center cellspacing=0 spanspacing=0><tr><th>SINISTRO</th><th>AP&Oacute;LICE</th><th>CERTIFICADO</th><th>BENEFICI&Aacute;RIO</th><th>A INDENIZAR</th></tr>";
            
            
            if(@!$sin_vazio){
             $sin_vazio=null;
            }
            for($a=0;$a<count($sin_vazio);$a++){
                if($sin_vazio[$a]!=null){
                    echo "<tr><td><a href=teste3.php?act=beneficiario&busca=beneficiario&abrir=1&num_sinistro=".$sin_vazio[$a].">".$sin_vazio[$a]."</a></td><td>".$apolices[$a]."</td><td>".$certificado[$a]."</td><td>".$nome_vazio[$a]."</td><td align=right>".number_format($indenizado_vazio[$a],'2',',','.')."</td></tr>";
                }
            }
        echo "</div>";
        echo "<script>total($linha_vazia)</script>";
        $campo='sinistro';
        $processos=count($Tododao->find($Todosearch));//count(@$sinJud);
        //ECHO $processos;die;
        
        /// sinistros p/ cadastrar ///
            $dados='';
            $pCadastrar=array_diff($sinistro_,$sin_cadastrado);
            //foreach($pCadastrar as $key => $valores){
             //$keys[]=$key;
             //$dados=$pCadastrar[$key]=>$dt_aviso[$key]);
            //}
            
            
            //foreach($sinistro_ as $individual){
                //$sin_cadastrado_unico[]=  in_array($individual, $sin_cadastrado);
                //echo $individual."<br>";
            //}
            //die;
            
            
            $keys=array_keys($pCadastrar);
            unset($sinistro_,$sin_cadastrado);
            $contador=0;
            foreach($keys as $item){
             if($pCadastrar[$item]){
              $dados .= $pCadastrar[$item].",".OdbcValidator::data($dt_aviso[$item]);
              if($contador<count($keys)){
               $dados .= ",";
              }
             }
             $contador++;
            }
            $texto=($dados);
            $filename='arquivos/pCadastrar.txt';
            $handle=fopen($filename, 'w+');
            fwrite($handle, $texto);
            fclose($handle);
            unset($texto);
        /// fim ///
            
            
          ////////////////////Levantamento/////////////////////////////
            /*
             echo "SOMA DO VALOR INDENIZADO POR SEGURADO - <b>R$ ";
             print_r(number_format(array_sum($imp_segurada),'2',',','.'));
             echo "</b> (importado do Sistema Federal)<br><br>";
             echo "SOMA DO VALOR INDENIZADO POR SEGURADO - <b>R$ ";
             print_r(number_format(array_sum($imp_segurada_cad),'2',',','.'));
             echo "</b> (Cadastrado no quadro)<br><br>"; 
             
           
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>SEGURADO</th><th>A INDENIZAR</th></tr>";
          for($x=0;$x<count($titular_cad);$x++){
            echo "<tr><td>";
            echo $sinistro_cad[$x];
            echo "</td><td>";
            echo $titular_cad[$x];
            echo "</td><td align=right>";
            echo number_format($imp_segurada_cad[$x],'2',',','.');
            echo "</td></tr>";
          }
            echo "</table>";
             die;
             * 
             */
            
          //////////////////////////fim Levantamento////////////////////////////////
            
          echo '<table align=center border=1 cellspacing=0 class="resumo">';
          echo '<th colspan=3>RESUMO</th>';
          echo '<tr><th colspan=2>IMPORTADOS (proc. jud.)</th><th><span>p/ cadastrar</span></th></tr>';
          echo '<tr><td colspan=2 align=center>';
          echo number_format($sin_num,'0','','.');
          echo " (<a href=\"teste3.php?act=judiciais&busca=judiciais\">".($processos)."</a>)";
          echo '</td><td align=center>';
          echo "<a href=teste3.php?act=relatorio&abrir=2>";
          echo number_format(($sin_num)-$y,'0','','.');
          echo "</a>";
          echo '</td></tr>';
          echo '<tr><th>SINISTROS CADASTRADOS</th><th>BENEFICI&Aacute;RIOS</th><th>TOTAL A INDENIZAR</th></tr>';
          echo '<tr><td align=center>'.number_format($y,'0','','.').'</td><td align=center>'.number_format($x,'0','','.').'</td><td align=center>R$ '.number_format($total,'2',',','.').'</td></tr>';
          die; 
        ?>
    </body>
</html>