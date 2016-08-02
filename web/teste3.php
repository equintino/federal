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
        <a href="teste3.php?act=relatorio"><li>RELAT&Oacute;RIOS</li></a>
        <a href="teste3.php?act=divergente"><li>VALORES DIVERGENTES</li></a>
        <a href="teste3.php?act=restrito"><li>&Aacute;REA RESTRITA</li></a>
    </ul>
</div>
<?php
  if($act=='sinistro'){
   echo "<div class='busca'>";
   include_once 'busca.php';
   echo "</div>";
    if($busca=='sinistro'){     
     $dao=new OdbcDao();
     $odbc=new Odbc();
     $search=new OdbcSearchCriteria();
     if(preg_match('/^[a-z,A-Z]/', $sinistro)){
      $search->setnome($sinistro);
      $search->setvlindeniza($vlindeniza);
      $odbcs=$dao->busca($search);
     }else{
      $search->setsinistro($num_sinistro);
      $search->setvlindeniza($vlindeniza);
      $odbcs=$dao->busca($search);
     }
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>BENEFICI&Aacute;RIO</th><th>VL. A INDENIZAR</th></tr>";
      }
      $totalBeneficiarios=0;
     foreach($odbcs as $item){
       if($item->getnome()){
        echo "<tr><td>";
        echo "<a href='teste3.php?act=titular&sinistro=".$item->getsinistro()."'>";
        echo $item->getsinistro();
        echo "</a>";
        echo "</td><td>";
        echo $item->getnome();
        echo "</td><td align=right>";
        echo number_format($item->getvlindeniza(),2,',','.');
        echo "</td></tr>";
        $totalBeneficiarios++;
       }
     }
      echo "<tr><td colspan=3 align=right>Total de benefici&aacute;rios: ".number_format($totalBeneficiarios,'0','','.')."</td></tr>";
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
      $dao = new OdbcDao();
      $odbc = new Odbc();
      $search = new OdbcSearchCriteria();
      
      @$num_sinistro=$_POST['num_sinistro'];
      @$sinistrado=$_POST['sinistrado'];
      @$importanciasegurada=OdbcValidator::validaCentavos($_POST['importanciasegurada']);
      
      $search->setTITULAR($sinistrado);
      $search->setsinistro($num_sinistro);
      $search->setIMPORTANCIA_SEGURADA($importanciasegurada);
        
      $odbcs=$dao->busca2($search);
      
      echo "<div class='busca_tabela'>";
      echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
      if($odbcs){
       echo "<tr><th>SINISTRO</th><th>SINISTRADO</th><th>IMPORT&Acirc;NCIA SEGURADA</th></tr>";
      }
      $y=0;
     foreach($odbcs as $item){
       if($item->getTITULAR()){
        echo "<tr><td>";
            echo $item->getsinistro();
        echo "</td><td>";
            echo $item->getTITULAR();
        echo "</td><td align=right>";
            echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
        echo "</td></tr>";
       $y++;
       }
     }
      echo "<tr><td colspan=3 align=right>Total de sinistrado: ".number_format($y,'0','','.')."</td></tr>";
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
        include_once 'busca.php';
   if(array_key_exists('sucursal',$_POST)){
    $sucursal=$_POST['sucursal'];
   }
   if(array_key_exists('ramo',$_POST)){
    $ramo=$_POST['ramo'];
   }
   if ($busca=='divergente'){
    header('Location:carregando.php?act=divergente&sucursal='.$sucursal.'&ramo='.$ramo.' ');
   /*
       echo "<script>
                var confirma=confirm('Este processo pode levar aproximadamente 10 minutos');
                if(!confirma){
                    history.go(-1);
                }else{
                    window.location.assign('carregando.php?act=divergente');
                }
           </script>";
    * 
    */
   //die;
   }
   if($abrir==1){
       //echo $sucursal;
    //print_r($_GET);die;
       include_once 'divergente.php';
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