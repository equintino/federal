<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<script src="js/script.js"></script> 
<form action="testeprocesso.php?act=sinistrado&busca=sinistrado" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="n&uacute;mero de sinistro" autofocus="">
    ou
    <input type="text" name="sinistrado" placeholder="nome do sinistrado" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
<?php
   include '../dao/TodoDao.php';
   include '../dao/TodoSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Todo.php';
   include '../mapping/TodoMapper.php';
   include '../validation/TodoValidator.php';
    
    $Tododao=new TodoDao();
    $search=new TodoSearchCriteria;
    $Todo=new Todo();
    
    
    @$sinistro= $_POST['num_sinistro'];
    @$sinistrado=$_POST['sinistrado'];
    
    /*
    echo "<script>
            //window.localStorage.setItem('sinitro','123');
           var sinistro = prompt('Insere aqui o numero de sinistro','Sinistro');
         </script>";
     * 
     */
    //print_r($sinistro);
    //echo "<br>";
    //print_r($Todosearch);
    //echo "<br>";
    //print_r($Todo);
    //echo "<br>";
    //$sinistro="<script>document.write(sinistro)</script>";
        //$search->setSINISTRO('0135.93.03.00003');
    //echo "$sinistro";die;
    
    $search->setSINISTRO($sinistro);
    $search->setSEGURADOS($sinistrado);
    //echo strval($search);die;
    //echo "<br><br>";
    //echo "<pre>";
    $todos=$Tododao->find($search);
    
    echo "<div class=judiciais>";
    if(!$todos){
        echo "<b>Nenhum resultado foi obtido</b>";
    }else{
        echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
        echo "<tr><th>SINISTRO</th><th>PROCESSO</th><th>PROC. ANTIGO</th><th>SEGURADO</th><th>OBS.</th></tr>";
        foreach($todos as $item){
            echo "<tr><td>";
            echo $item->getSINISTRO();
            echo "</td><td>";
            echo $item->getN_PROC();
            echo "</td><td align=right>";
            echo $item->getN_NATIGO();
            echo "</td><td>";
            echo $item->getSEGURADOS();
            echo "</td><td>";
            echo $item->getOBS();
            echo "</td></tr>";
        }
        echo "</table>";
    }
    echo "</div>";
?>

