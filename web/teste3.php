<link rel="stylesheet" type="text/css" href="css/consulta.css" />
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
   @$vlindeniza=$_POST['vlindeniza'];
   @$titular=$_GET['titular'];
   @$abrir=$_GET['abrir'];
   @$pagAtual=$_GET['pagAtual'];
   
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
        <a href="teste3.php?act=sinistro"><li>CONSULTA BENEFICI&Aacute;RIOS</li></a>
        <a href="teste3.php?act=informacoes"><li>IMFORMA&Ccedil;&Otilde;ES</li></a>
        <a href="teste3.php?act=divergente&busca=divergente"><li>VALORES DIVERGENTES</li></a>
        <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
    </ul>
</div>
<?php
  if($act=='sinistro'){
      if(isset($pagAtual)){
         $search->setidbenefi($pagAtual); 
      }
   echo "<div class='busca'>";
   include_once 'busca.php';
   echo "</div>";
    if($busca=='sinistro'){     
     if(preg_match('/^[a-z,A-Z]/', $sinistro)){
      $search->setnome($sinistro);
      $search->setvlindeniza($vlindeniza);
      $odbcs=$dao->busca4($search);
     }else{
      if(substr($num_sinistro,9,1)==2){
       $search->setendosso($num_sinistro);
      }else{      
       $search->setsinistro($num_sinistro);
      }
      $search->setvlindeniza($vlindeniza);
      $odbcs=$dao->busca4($search);
     }
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>CERTIFICADO</th><th>BENEFICI&Aacute;RIO</th><th>VL. A INDENIZAR</th></tr>";
      }
      $totalBeneficiarios=0;
     foreach($odbcs as $item){
       if($item->getnome()){
        echo "<tr><td>";
        echo "<a href='teste3.php?act=titular&sinistro=".$item->getsinistro()."'>";
        echo $item->getsinistro();
        echo "</a>";
        echo "</td><td>";
        echo $item->getendosso();
        echo "</td><td>";
        echo $item->getnome();
        echo "</td><td align=right>";
        echo number_format($item->getvlindeniza(),2,',','.');
        echo "</td></tr>";
        $totalBeneficiarios++;
       }
     }
       $totalPag=($dao->totalLinhas($search,'Beneficiarios'))/14;
       $ultimaLinha_=@$item->getidbenefi()/14;       
      echo "<tr><th colspan=4 align=center> <a href=teste3.php?act=sinistro&busca=sinistro&pagAtual=".($item->getidbenefi()-28)."> < &nbsp</a>".number_format($ultimaLinha_,'0','','.')." de ".number_format($totalPag,'0','','.')." <a href=teste3.php?act=sinistro&busca=sinistro&pagAtual=".$item->getidbenefi().">&nbsp > </a></th></tr>";
      
      echo "</table>";
      echo "</div>";
      die;
    }
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
      
      if(isset($pagAtual)){
         $search->setidtitular($pagAtual); 
      }
      
      @$num_sinistro=$_POST['num_sinistro'];
      @$sinistrado=$_POST['sinistrado'];
      
      @$importanciasegurada=OdbcValidator::validaCentavos($_POST['importanciasegurada']);
      
      $search->setTITULAR($sinistrado);
      $search->setIMPORTANCIA_SEGURADA($importanciasegurada);
      if(substr($num_sinistro,9,1)==2){
       $search->setENDOSSO($num_sinistro);
      }else{      
       $search->setsinistro($num_sinistro);
      }
       
      $odbcs=$dao->busca3($search);
            
      
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>CERTIFICADO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th></tr>";
      }
      $y=0;
     foreach($odbcs as $item){
       if($item->getTITULAR()){
        echo "<tr><td>";
            echo $item->getsinistro();
        echo "</td><td>";
            echo $item->getENDOSSO();
        echo "</td><td>";
            echo $item->getTITULAR();
        echo "</td><td align=right>";
            echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
        echo "</td></tr>";
       $y++;
       }
     }
        /// paginação ///
       $totalPag=($dao->totalLinhas($search,'sinipend'))/14;
       $ultimaLinha=@$item->getidtitular()/14;       
      echo "<tr><th colspan=4 align=center><a href=teste3.php?act=sinistrado&busca=sinistrado&pagAtual=".($item->getidtitular()-28)."> < &nbsp</a>".number_format($ultimaLinha,'0','','.')." de ".number_format($totalPag,'0','','.')." <a href=teste3.php?act=sinistrado&busca=sinistrado&pagAtual=".$item->getidtitular()." >&nbsp > </a></th></tr>";
        /// fim paginação ///
      
      echo "</table>";
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
  if($act=='restrito'){
   echo "<div class='construcao'>";
    echo "<img height=300px src='img/em_construcao.png' />";
   echo "</div>";
  }
?>