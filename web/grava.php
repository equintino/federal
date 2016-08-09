<?php
          include '../dao/OdbcDao.php';
          include '../dao/OdbcSearchCriteria.php';
          include '../config/Config.php';
          include '../model/Odbc.php';
          include '../mapping/OdbcMapper.php';
          //var_dump(odbc_close_all());
        
          //$dao = new OdbcDao();
          //$odbc= new Odbc();
          $tabela='Beneficiarios';
          $tabela2='sinipend';
          $file_x='exclui';
          
          $conn=odbc_connect('federal','','');
          /// limpar tabela ///
          //$sql = "ALTER TABLE `".$tabela."` ADD `".$file_x."` varchar(1)";// CRIA COLUNA EXCLUI
          //$sql = "ALTER TABLE `".$tabela."` ADD `exclui` varchar(1) ";


          //$sql="UPDATE `$tabela2` SET `".$file_x."`=0 WHERE 1";//zera o conteudo exclui
          //$sql="update $tabela2 set exclui=1 where SINISTRO=' '";
          //$sql = "update $tabela set exclui=1 where sinistro like '0153.93.03.0000'" ;
          //$sql = "SELECT * FROM $tabela WHERE sinistro like '0153.93.03.0000'" ;
          //$sql = "update $tabela set exclui=0 where idbenefi=10978";
          //odbc_exec($conn,$sql);
          //$sql="SELECT * FROM Beneficiarios WHERE nome like '%edmilson%' AND exclui like '0'";
          //$sql = "SELECT * FROM $tabela WHERE sinistro like '0153.93.03.0000'" ;
          //$sql="select * from $tabela where sinistro='0135.93.03.00003491'";
         //$sql="select * from $tabela where sinistro='88888888888888888'";
         //$sql="select * from $tabela2 where vlindeniza like '%44592308%'";
         //$sql="select * from $tabela2 where idtitular like '5586'";
         //$sql="delete * from $tabela2 where idtitular like '5586'";
         //$sql="select * from $tabela2 where IMPORTANCIA_SEGURADA=0.00";
          //$sql="DELETE * from $tabela where sinistro='88888888888888888'";
          //$sql="DELETE * FROM $tabela WHERE sinistro like '0153.93.03.0000'" ;
          //$sql="select * from $tabela where idbenefi=3845";
          //$sql="delete * from $tabela where idbenefi=3845";
          //$sql="select * from $tabela2 where idtitular=5586";
          //$sql="delete * from $tabela2 where idtitular=5586";
          /// limpar tabela ///
          
          //$sql="select * from $tabela2 where idtitular=5788";
          $sql="select * from $tabela where idbenefi=9067";
          //$sql="select * from $tabela2 where SINISTRO='0126.93.03.00001032'";
          //$sql="select * from $tabela2 where 1";
          $result=odbc_exec($conn,$sql);
          odbc_result_all($result,'border=1');
          die;
          
          //$sql = "alter table Beneficiarios add exclui int(1)";
         // print_r($dao->query2($sql));die;
          
          /*
          $dados=array(
              'exclui' => true,
              'idbenefi' => '123456789'
              );
          */
          print_r($odbc);
          echo '<br><br>';
          OdbcMapper::map($odbc, $dados);
          print_r($odbc);
          print_r($odbc->getexclui());
          
          //print_r($odbc);

          
          //print_r($dao);
 
?>

