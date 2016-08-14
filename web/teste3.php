<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<script src="js/script.js"></script> 
<?php
   include '../dao/OdbcDao.php';
   include '../dao/OdbcSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Odbc.php';
   include '../mapping/OdbcMapper.php';
   include '../validation/OdbcValidator.php';
   
   @$act=$_GET['act'];
   @$busca=$_GET['busca'];
   @$sinistro=$_POST['sinistro'];
   @$num_sinistro=$_POST['num_sinistro'];
   @$vlindeniza=OdbcValidator::validaCentavos($_POST['vlindeniza']);
   @$titular=$_GET['titular'];
   @$abrir=$_GET['abrir'];
   @$pagAtual=$_GET['pagAtual'];
   @$beneficiario=$_GET['beneficiario'];
   if(@!$beneficiario){
      @$beneficiario=$_POST['beneficiario']; 
   }
   @$menu=$_GET['menu'];
   
   if(@$menu=1){
       /*
       echo "passei aqui";
            echo "<script>
                document.cookie=\"ultimoSinistrado=\";
                </script>";
        * 
        */
   }
      
   //@$num_sinistro=$_POST['num_sinistro'];
   @$sinistrado=$_POST['sinistrado'];      
   @$importanciasegurada=OdbcValidator::validaCentavos($_POST['importanciasegurada']);
   @$endereco=$_GET['endereco'];
   @$idbenefi=$_GET['idbenefi'];
   
      //print_r($_GET);
     $dao=new OdbcDao();
     $search=new OdbcSearchCriteria();
   
   if(array_key_exists('sucursal',$_POST)){
    $sucursal=$_POST['sucursal'];
   }
   if(array_key_exists('ramo',$_POST)){
    $ramo=$_POST['ramo'];
   }
   if(array_key_exists('sucursal',$_GET)){
    $sucursal=$_GET['sucursal'];
   }
   if(array_key_exists('ramo',$_GET)){
    $ramo=$_GET['ramo'];
   }
?>
<div id='menu'>
    <ul>
        <a href="teste3.php?act=sinistrado"><li>SINISTRADO</li></a>
        <a href="teste3.php?act=beneficiario"><li>BENEFICI&Aacute;RIOS</li></a>
        <a href="teste3.php?act=informacoes"><li>IMFORMA&Ccedil;&Otilde;ES</li></a>
        <a href="teste3.php?act=divergente&busca=divergente&menu=1"><li>VALORES DIVERGENTES</li></a>
        <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
        <a href="teste3.php?act=judiciais"><li>PROCESSOS JUDICIAIS</li></a>
    </ul>
</div>
<?php
  if($act=='beneficiario'){
      if(isset($pagAtual)){
         $search->setidbenefi($pagAtual); 
      }
   echo "<div class='busca'>";
   include_once 'busca.php';  
     if($busca=='beneficiario'){     
        if (!$abrir){
            header('Location:carregando.php?act=beneficiario&num_sinistro='.$num_sinistro.'&sinistrado='.$sinistrado.'&importanciasegurada='.$importanciasegurada.'&beneficiario='.$beneficiario.'&vlindeniza='.$vlindeniza.'');
        }else{
            include_once 'beneficiario.php';
        }
      }
   echo "</div>";
  }
  if($act=='titular'){
   echo "<div>";
    include_once "titular.php";
   echo "</div>";
   die;
  }
  if($act=='sinistrado'){
   echo "<div class=busca>";
    include_once "busca.php";    
     if($busca=='sinistrado'){     
        if (!$abrir){
            header('Location:carregando.php?act=sinistrado&num_sinistro='.$num_sinistro.'&sinistrado='.$sinistrado.'&importanciasegurada='.$importanciasegurada.'');
        }else{
            include_once 'sinistrado.php';
        }
    }
      echo "</div>";
        die;
  }
  if($act=='relatorio'){      
   if (!$abrir){
    header('Location:carregando.php?act=relatorio');
   }else{
    include_once 'relatorios.php';
   }
  }
  if($act=='divergente'){
      echo "<div class=busca>";
      include_once 'busca.php';
   if(array_key_exists('sucursal',$_POST)){
    $sucursal=$_POST['sucursal'];
   }
   if(array_key_exists('ramo',$_POST)){
    $ramo=$_POST['ramo'];
   }
   if ($busca=='divergente'){
    header('Location:carregando.php?act=divergente&sucursal='.$sucursal.'&ramo='.$ramo.' ');
   }
   if($abrir==1){
       include_once 'divergente.php';
   }
       echo "</div>";
      die;
  }
  if($act=='informacoes'){
   echo "<div class='busca'>";
    include_once 'busca.php';
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
    if ($busca=='informacoes'){
        header('Location:carregando.php?act=informacoes');
    }
    if($abrir==1){
       include_once 'informacoes.php';
    }
       echo "</div>";
       die;
  }
  if($act=='judiciais'){
      //echo "estou aqui";
      echo "<div class=busca>";
    include_once 'busca.php';
   //if($abrir==1){
       include_once 'judiciais.php';
   //}
       echo "</div>";
      die;
  }
  if($act=='restrito'){
   echo "<div class='construcao'>";
    echo "<img height=300px src='img/em_construcao.png' />";
   echo "</div>";
  }
?>