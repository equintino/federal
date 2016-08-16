<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<meta charset="utf-8">
<?php 
 @$act=$_GET['act'];
 @$idtitular__=$_GET['idtitular__'];
 @$pagAtual=$_GET['pagAtual'];
 @$pag_=$_GET['pag_'];
 
 
 @$num_sinistro=$_GET['num_sinistro'];
 @$sinistrado=$_GET['sinistrado'];  
 @$importanciasegurada=$_GET['importanciasegurada'];
 @$beneficiario=$_GET['beneficiario'];
 @$vlindeniza=$_GET['vlindeniza'];
 
 //print_r($_GET);die;
 
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
   
?>
<div id='menu'>
 <ul>
        <a href="teste3.php?act=sinistrado"><li>SINISTRADO</li></a>
        <a href="teste3.php?act=sinistro"><li>BENEFICI&Aacute;RIOS</li></a>
        <a href="teste3.php?act=informacoes"><li>IMFORMA&Ccedil;&Otilde;ES</li></a>
        <a href="teste3.php?act=divergente"><li>VALORES DIVERGENTES</li></a>
        <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
        <a href="teste3.php?act=judiciais"><li>PROCESSOS JUDICIAIS</li></a>
 </ul>
</div>
<?php
 function redirecionar($tempo,$url, $mensagem){
  header("Refresh: $tempo; url=$url");
  echo "<div class=carregando>";
  echo '<center>'.$mensagem.  '</center><br/>';
  echo '<center><img src="img/carregando.gif" alt="" /><br/><br/><tt><i>lendo...</i></tt></center>';
  echo "</div>";
 }
 if($act=='relatorio'){
  redirecionar('0.01','teste3.php?act=relatorio&abrir=1','AGUARDE'); 
 }
 if($act=='divergente'){ 
  redirecionar('1','teste3.php?act=divergente&abrir=1&idtitular__='.$idtitular__.'&pagAtual='.$pagAtual.'','AGUARDE'); 
 }
 if($act=='beneficiario'){
     //print_r($_GET);die;
  redirecionar('1','teste3.php?act=beneficiario&abrir=1&busca=beneficiario&num_sinistro='.$num_sinistro.'&beneficiario='.$beneficiario.'&vlindeniza='.$vlindeniza.'&pagAtual='.$pagAtual.'&pag_='.$pag_.'','AGUARDE'); 
 }
 if($act=='sinistrado'){
  redirecionar('1','teste3.php?act=sinistrado&abrir=1&busca=sinistrado&num_sinistro='.$num_sinistro.'&sinistrado='.$sinistrado.'&importanciasegurada='.$importanciasegurada.'&pagAtual='.$pagAtual.'&pag_='.$pag_.'','AGUARDE'); 
 }
 if($act=='informacoes'){
  if(@!$certificado && @!$cpf){
    echo "<script>
        alert(\"Os campos estão em branco\");
        history.go(-1);
      </script>";  
  }else{
    redirecionar('1','teste3.php?inicio=sim&act=informacoes&abrir=1&certificado='.@$certificado.'&cpf='.@$cpf.' ','AGUARDE'); 
  }
 }
 if($act=='judiciais'){
  redirecionar('1','teste3.php?act=judiciais&abrir=1&num_sinistro='.$num_sinistro.'&sinistrado='.$sinistrado.'&pagAtual='.$pagAtual.'&pag_='.$pag_.'','AGUARDE'); 
 }
?>