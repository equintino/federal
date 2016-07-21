<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<?php
   @$act=$_GET['act'];
?>
<div id='menu'>
    <ul>
        <a href="teste3.php"><li>HOME</li></a>
        <a href="teste3.php?act=sinistro"><li>CONSULTA BENEFICIÁRIOS</li></a>
        <a href="teste3.php?act=relatorio"><li>RELATÓRIOS</li></a>
    </ul>
</div>
<?php
  if($act=='sinistro'){
   
  }
  if($act=='relatorio'){
   include_once 'teste2.php';
  }
?>
