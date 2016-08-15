<form action="testeprocesso.php?act=sinistrado&busca=sinistrado" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="sinistro ou certificado" autofocus="">
    ou
    <input type="text" name="nome" placeholder="nome do sinistrado" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
        <label>acima de R$ </label>
        <input type="text" name="importanciasegurada" placeholder="import&acirc;cia segurada"/>
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
    
    @$sinistro=$_POST['num_sinistro'];
    
    /*
    echo "<script>
            //window.localStorage.setItem('sinitro','123');
           var sinistro = prompt('Insere aqui o numero de sinistro','Sinistro');
         </script>";
     * 
     */
    print_r($sinistro);
    //echo "<br>";
    //print_r($Todosearch);
    //echo "<br>";
    //print_r($Todo);
    //echo "<br>";
    //$sinistro="<script>document.write(sinistro)</script>";
        //$search->setSINISTRO('0135.93.03.00003');
    //echo "$sinistro";die;
    
    $search->setSINISTRO($sinistro);
    //echo strval($search);die;
    //echo "<br><br>";
    echo "<pre>";
    print_r($Tododao->find($search));
    echo "</pre>";
?>

