<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório</title>
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
          
          $dao->listaConteudo($tabela);die;
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
