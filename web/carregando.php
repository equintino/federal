<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<?php 
 @$act=$_GET['act'];
   if(array_key_exists('sucursal',$_POST)){
    //print_r($_POST);
    $sucursal=$_POST['sucursal'];
   }
   if(array_key_exists('ramo',$_POST)){
    $ramo=$_POST['ramo'];
   }
   if(array_key_exists('sucursal',$_GET)){
    //print_r($_GET);
    $sucursal=$_GET['sucursal'];
   }
   if(array_key_exists('ramo',$_GET)){
    $ramo=$_GET['ramo'];
   }
 //echo 'post';
 //print_r($_POST);
 //echo 'get';
 //print_r($_GET);die;
?>
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
  //echo $sucursal.$ramo;
  redirecionar('1','teste3.php?act=divergente&abrir=1&sucursal='.$sucursal.'&ramo='.$ramo.' ','PROCURANDO POR DIVERG&EcircNCIA...'); 
 }
?>