<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<meta charset="utf-8">
<?php 
 @$act=$_GET['act'];
   if(array_key_exists('sucursal',$_POST)){
    $sucursal=$_POST['sucursal'];
   }elseif(array_key_exists('sucursal',$_GET)){
    $sucursal=$_GET['sucursal'];
   }
   if(array_key_exists('ramo',$_POST)){
    $ramo=$_POST['ramo'];
   }elseif(array_key_exists('ramo',$_GET)){
    $ramo=$_GET['ramo'];
   }
   if(array_key_exists('certificado',$_POST)){
    $certificado=$_POST['certificado'];
   }elseif(array_key_exists('certificado',$_GET)){
    $certificado=$_GET['certificado'];
   }
   if(array_key_exists('cpf',$_POST)){
    $cpf=$_POST['cpf'];
   }elseif(array_key_exists('cpf',$_GET)){
    $cpf=$_GET['cpf'];
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
        <a href="teste3.php?act=informacoes"><li>IMFORMA&Ccedil;&Otilde;ES</li></a>
        <a href="teste3.php?act=divergente"><li>VALORES DIVERGENTES</li></a>
        <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
        <!--<a href="teste3.php?act=restrito"><li>&Aacute;REA RESTRITA</li></a>-->
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
  redirecionar('1','teste3.php?act=divergente&abrir=1','PROCURANDO POR DIVERG&EcircNCIA...'); 
 }
 if($act=='informacoes'){
  if(@!$certificado && @!$cpf){
    echo "<script>
        alert(\"Os campos estão em branco\");
        history.go(-1);
      </script>";  
  }else{
    redirecionar('1','teste3.php?act=informacoes&abrir=1&certificado='.@$certificado.'&cpf='.@$cpf.' ','PROCURANDO POR INFORMA&Ccedil;&Otilde;ES...'); 
  }
 }
?>