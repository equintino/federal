<!DOCTYPE html>
<html>
    <head>
        <title>Relatorio</title>
    </head>
    <body>
        <?php 
          $dao = new OdbcDao();
          $tabela='Beneficiarios';
          $tabela2='sinipend';
          echo '<br>';          
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $sinistro_ant=null;
        echo "<div id='geral'>";
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>BENEFICI&AacuteRIO</th><th>VL. A INDENIZAR</th></tr>";
             $sin_num=0;
             if($dao->listaConteudo($tabela2)){
              foreach($dao->listaConteudo($tabela2) as $item2){
               @$sinistro_[]=$item2['SINISTRO'];
               @$titular[]=$item2['TITULAR'];
               if($item2['TITULAR']){
                @$sin_num ++;
               }
               //echo $item2['SINISTRO']." - ".$item2['TITULAR']."<br>";
              }
             }
             //echo $sin_num;die;
            $linha_vazia=0;
            if($dao->listaConteudo($tabela)){
            foreach($dao->listaConteudo($tabela) as $item){ 
              //if($item['vlindeniza'] != 0){
                if($item['nome']){
                echo "<tr><td align=center>".$item['sinistro']."</td><td>".$item['nome']."</td><td align=right>".number_format($item['vlindeniza'],'2',',','.')."</td></tr>";
                //echo $sinistro_ant.' != '.$item['sinistro'];
                    if($sinistro_ant != $item['sinistro']){
                        //echo ' diferente<br>';
                        $y++;
                    }
                    
                    $sin_cadastrado[]=$item['sinistro'];
                    $sinistro_ant=$item['sinistro'];
                    $total=$total+$item['vlindeniza'];
                    $x++;
                }
                if($item['vlindeniza'] == 0){
                    $sin_vazio[]=$item['sinistro'];
                    $nome_vazio[]=$item['nome'];
                    $indenizado_vazio[]=$item['vlindeniza'];
                    $linha_vazia++;
                }
            }
           }
          echo '</table>';
        echo "</div>";
        echo "<br><br><br><br><br><br>";
        echo "<div>";
            echo "<h3 align='center'><span>Cadastros Benefici&aacute;rios Incompletos</span></h3>";
            echo "<table border=1 align=center cellspacing=0 spanspacing=0><tr><th>SINISTRO</th><th>BENEFICI&Aacute;RIO</th><th>VL. A INDENIZAR</th></tr>";
            if(@!$sin_vazio){
             $sin_vazio=null;
            }
            for($a=0;$a<count($sin_vazio);$a++){
                if($sin_vazio[$a]!=null){
                    echo "<tr><td>".$sin_vazio[$a]."</td><td>".$nome_vazio[$a]."</td><td>".$indenizado_vazio[$a]."</td></tr>";
                }
            }
        echo "</div>";
        $campo='sinistro';
          echo '<table align=center border=1 cellspacing=0 class="resumo">';
          echo '<th colspan=3>RESUMO</th>';
          echo '<tr><th>SINISTROS</th><th>BENEFICI&Aacute;RIOS</th><th>TOTAL A INDENIZAR</th></tr>';
          echo '<tr><td align=right>'.number_format($y,'0','','.').'</td><td align=right>'.number_format($x,'0','','.').'</td><td align=right>R$ '.number_format($total,'2',',','.').'</td></tr>';
          echo '<tr><th colspan=3>IMPORTADOS - CADASTRADOS = <span>p/ cadastrar</span></th></tr>';
          echo '<tr><td colspan=3 align=center>';
          echo number_format($sin_num,'0','','.');
          echo ' - ';
          echo number_format($y,'0','','.');
          echo ' = ';
          echo number_format($sin_num-$y,'0','','.');
          echo '</td></tr>';
          die; 
        ?>
    </body>
</html>