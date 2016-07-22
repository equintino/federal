<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<?php
   @$act=$_GET['act'];
?>
<div id='menu'>
    <ul>
        <a href="teste3.php"><li>HOME</li></a>
        <a href="teste3.php?act=sinistro"><li>CONSULTA BENEFICI&Aacute;RIOS</li></a>
        <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
    </ul>
</div>
<?php
  if($act=='sinistro'){
   echo "<div class='construcao'>";
   echo "<img height=400px src='img/em_construcao.jpg' />";
   echo "</div>";
  }
  if($act=='relatorio'){
   include_once 'teste2.php';
  }
?>
