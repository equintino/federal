<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<?php
          include '../dao/OdbcDao.php';
          include '../dao/OdbcSearchCriteria.php';
          include '../config/Config.php';
          include '../model/Odbc.php';
          include '../mapping/OdbcMapper.php';
   @$act=$_GET['act'];
   @$busca=$_GET['busca'];
   @$sinistro=$_POST['sinistro'];
   @$num_sinistro=$_POST['num_sinistro'];
   //print_r($_POST);die;
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
   echo "<div class='busca'>";
   //echo "<img height=300px src='img/em_construcao.png' />";
   include_once 'busca.php';
   echo "</div>";
   //print_r($_POST);die;
    if($busca=='sinistro'){
     $dsn='federal';
     $user='';
     $password='';
     $tabela='Beneficiarios';
     $conn=  odbc_connect($dsn, $user, $password);
     $dao=new OdbcDao();
     $odbc=new Odbc();
     $search=new OdbcSearchCriteria();
     //echo $sinistro;
     //var_dump(preg_match('/^[a-z,A-Z]/', $sinistro));die;
     if(preg_match('/^[a-z,A-Z]/', $sinistro)){
         $search->setnome($sinistro);
         //print_r($search);die;
        $dao->busca($search);
      //$sql="select * from $tabela where nome like '%$sinistro%' and exclui like 0";
     }else{
         //echo "<h1>$num_sinistro</h1>";
         $search->setsinistro($num_sinistro);
         //print_r($search);die;
        $dao->busca($search);
      //$sql="select * from $tabela where sinistro like '%".$num_sinistro."%' and exclui like 0";
     }
     
     
     print_r($dao->busca($search));die;
     $result_id=odbc_exec($conn,$sql);
     odbc_result_all($result_id, 'border=1');
    }
  }
  if($act=='relatorio'){
   include_once 'teste2.php';
  }
?>
