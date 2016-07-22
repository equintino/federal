<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <!--<meta charset="UTF-8">-->
        <title>Relatorio</title>
    </head>
    <body>
        <?php
          include '../dao/OdbcDao.php';
          include '../dao/OdbcSearchCriteria.php';
          include '../config/Config.php';
          include '../model/Odbc.php';
          include '../mapping/OdbcMapper.php';
        
          $dao = new OdbcDao();
          //$search = new OdbcSearchCriteria();
          //$search->setsinistro(93);
          //$search->setnome('joao');
          $tabela='Beneficiarios';
          $tabela2='sinipend';
          
          //print_r($dao->listaTabela());
          echo '<br><br>';
          //print_r($dao->listaConteudo($tabela));
          
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $sinistro_ant=null;
        echo "<div id='geral'>";
          echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
          echo "<tr><th>SINISTRO</th><th>BENEFICIARIO</th><th>VL. INDENIZADO</th></tr>";
             $sin_numero=0;
            foreach($dao->listaConteudo($tabela2) as $item2){
             //print_r($dao->listaConteudo($tabela2));die;
              $sinistro_[]=$item2['SINISTRO'];
              $titular[]=$item2['TITULAR'];
              $sin_numero ++;
            }
            foreach($dao->listaConteudo($tabela) as $item){ 
              if($item['vlindeniza'] != 0){
                echo "<tr><td align=center>".$item['sinistro']."</td><td>".$item['nome']."</td><td align=right>".number_format($item['vlindeniza'],'2',',','.')."</td></tr>";
                if($sinistro_ant != $item['sinistro']){
                    $y++;
                }
                $sin_cadastrado[]=$item['sinistro'];
                $sinistro_ant=$item['sinistro'];
                $total=$total+$item['vlindeniza'];
                $x++;
              }
            }
            $campo='sinistro';
            //print_r($dao->listaCampo($tabela,$campo,93));
           /* echo '<tr><th>SINISTRO</th><th colspan=2>TITULAR</th></tr>';
            foreach ($sinistro_ as $key => $z){
            $consulta=$dao->listaCampo($tabela,$campo,$z);
            var_dump($consulta);
               if(@$consulta){
                echo '<tr><td>'.$z.'</td><td colspan=2>'.$titular[$key].'</td></tr>';
               }
            }*/
          echo '</table>';
        echo "</div>";
          echo '<table align=center border=1 cellspacing=0 class="resumo">';
          echo '<th colspan=3>RESUMO</th>';
          echo '<tr><th>SINISTROS</th><th>BENEFICIARIOS</th><th>TOTAL A INDENIZAR</th></tr>';
          echo '<tr><td align=right>'.number_format($y,'0','','.').'</td><td align=right>'.number_format($x,'0','','.').'</td><td align=right>R$ '.number_format($total,'2',',','.').'</td></tr>';
          echo '<tr><th colspan=3>SINISTROS IMPORTADOS <br>SEM BENEFICIÁRIOS CADASTRADOS</th></tr>';
          echo '<tr><td colspan=3 align=center>';
          echo number_format($sin_numero-$y,'0','','.');
          echo '</td></tr>';
          die;
          //$odbcs = $dao->find2($search);
          //print_r($odbcs);die;
          
          
          //odbc_close($conn);
	
//$table="Beneficiarios";
//$sql = "SELECT * FROM $table"; 
//$result=odbc_exec($conn,$sql);
//odbc_result_all($result, 'id="users" class="listing"');
//odbc_result_all($result, 'border=1');
//odbc_result_all($result, 'Border=0 cellspacing=0 cellpadding=5', "style='FONT-FAMILY:Tahoma; FONT-SIZE:8pt; BORDER-BOTTOM:solid 1pt gree'");
//while ($rows = odbc_fetch_object($result)) {
    //print $rows->COLUMNNAME;
//}
          
        ?>
    </body>
</html>
