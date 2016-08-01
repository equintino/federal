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
     foreach($odbcs as $item){   
       echo "<tr><td>";
       echo "<a href='teste3.php?act=titular&sinistro=".$item->getsinistro()."'>";
       echo $item->getsinistro();
       echo "</a>";
       echo "</td><td>";
       echo $item->getnome();
       echo "</td><td align=right>";
       echo number_format($item->getvlindeniza(),2,',','.');
       echo "</td></tr>";
     }
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
     foreach($odbcs as $item){
      echo "<tr><td>";
       echo $item->getsinistro();
       echo "</td><td>";
       echo $item->getTITULAR();
       echo "</td><td align=right>";
       echo number_format($item->getIMPORTANCIA_SEGURADA(),2,',','.');
       echo "</td></tr>";
     }
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
   if (!$abrir){
    header('Location:carregando.php?act=divergente');
   }else{
      echo "<div>";
      include_once "divergente.php";
      echo "</div>";
      die;
   }
  }
  if($act=='restrito'){
   echo "<div class='construcao'>";
    echo "<img height=300px src='img/em_construcao.png' />";
   echo "</div>";
  }
?>