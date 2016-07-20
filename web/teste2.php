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
          //$tabela='sinipend';
          
          //print_r($dao->listaTabela());
          echo '<br><br>';
          //print_r($dao->listaConteudo($tabela));
          
          $quant=0;
          $total=0;
          $x=0;
          $y=0;
          $sinistro_ant=null;
          echo '<table border=1 align=center cellspacing=0 spanspacing=0>';      
          echo "<tr><th>SINISTRO</th><th>BENEFICIARIO</th><th>VL. INDENIZADO</th></tr>";
            foreach($dao->listaConteudo($tabela) as $item){ 
              if($item['vlindeniza'] != 0){
                echo "<tr><td align=center>".$item['sinistro']."</td><td>".$item['nome']."</td><td align=right>".number_format($item['vlindeniza'],'2',',','.')."</td></tr>";
                if($sinistro_ant != $item['sinistro']){
                    $y++;
                }
                $sinistro_ant=$item['sinistro'];
                $total=$total+$item['vlindeniza'];
                $x++;
              }
            }
           // echo "$quant - $x - $total - $y";die;
          echo '</table>';
          echo '<table align=center border=1 cellspacing=0>';
          echo '<h3 align=center>RESUMO</h3>';
          echo '<tr><th>SINISTROS</th><th>BENEFICIARIOS</th><th>TOTAL A INDENIZAR</th></tr>';
          echo '<tr><td align=right>'.number_format($y,'0','','.').'</td><td align=right>'.number_format($x,'0','','.').'</td><td align=right>R$ '.number_format($total,'2',',','.').'</td></tr>';
          echo '</table>';
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
