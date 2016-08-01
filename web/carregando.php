<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<?php @$act=$_GET['act']; ?>
<div id='menu'>
 <ul>
  <a href="teste3.php?act=sinistrado"><li>SINISTRADO</li></a>
  <a href="teste3.php?act=sinistro"><li>CONSULTA BENEFICI&Aacute;RIOS</li></a>
  <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
  <a href="teste3.php?act=divergente"><li>VALORES DIVERGENTES</li></a>
  <a href="teste3.php?act=restrito"><li>&Aacute;REA RESTRITA</li></a>
 </ul>
</div>
<?php
 function redirecionar($tempo,$url, $mensagem){
  header("Refresh: $tempo; url=$url");
  echo "<div class=carregando>";
  echo '<center>'.$mensagem.  '</center><br/>';
  echo '<center><img src="img/carregando.gif" alt="" /><br/><br/><tt>CARREGANDO</tt></center>';
  echo "</div>";
 }
 if($act=='relatorio'){
  redirecionar('0.01','teste3.php?act=relatorio&abrir=1','AGUARDE...'); 
 }
 if($act=='divergente'){
  redirecionar('1','teste3.php?act=divergente&abrir=1','AGUARDE...'); 
 }
?>