<!DOCTYPE html>
<html>
    <head>
        <title>Divergente</title>
    </head>
    <body>
        <?php 
          $dao = new OdbcDao();
          $search = new OdbcSearchCriteria();
          $odbc = new Odbc();
          
          $tabela1='sinipend';
          $tabela2='Beneficiarios';
          
          echo '<br>';          
          $impSegurada=0;
          $aIndenizar=0;
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $sinistro_ant=null;
        /*
          echo "<div id='geral'>";
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>BENEFICI&AacuteRIO</th><th>VL. A INDENIZAR</th></tr>";
         * 
         */
          echo "<table align=center border=1 cellspacing=0 >";
          echo "<tr><th>SINISTRO</th><th>IMPORT&AcircNCIA SEGURADA</th><th>A INDENIZAR</th></tr>";
             if($dao->listaConteudo($tabela1)){
              foreach($dao->listaConteudo($tabela1) as $item1){
               if($item1['SINISTRO'] != '0'){
            set_time_limit(20);    
            $search->setsinistro($item1['SINISTRO']);   
            $odbcs=$dao->busca($search);
            //print_r($odbcs);die;
            $indenizaOld=0;
            foreach($odbcs as $item2){
             //print_r($item2);die;
             $indenizaOld=$item2->getvlindeniza()+$indenizaOld;
            }
            if(number_format($item1['IMPORTANCIA_SEGURADA'],2,',','.')!=number_format($indenizaOld,2,',','.') && number_format($indenizaOld,2,',','.')!=0){
                echo "<tr><td>".$item1['SINISTRO']."</td>";
                echo "<td>".number_format($item1['IMPORTANCIA_SEGURADA'],2,',','.')."</td>";
             echo "<td>".number_format($indenizaOld,2,',','.')."</td></tr>";
               }
               }
              }
             }die;
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