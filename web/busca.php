<?php        
    $dao = new OdbcDao();
    $tabela='Beneficiarios';
    $tabela2='sinipend';
          
    //print_r($_GET);
    //echo "<br><br>";
    //print_r($_POST);
         
    if($act=='sinistro'):
?>
<div class="titulo">BENEFICI&Aacute;RIO</div>
<form action="teste3.php?act=sinistro&busca=sinistro" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="n&uacute;mero de sinistro" autofocus="">
    ou
    <input type="text" name="sinistro" placeholder="nome do benefici&aacute;rio" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
        <label>acima de R$ </label>
    <input type="text" name="vlindeniza" placeholder="Valor a indenizar"/>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php elseif($act=='sinistrado'): ?>
<div class="titulo">SINISTRADO</div>
<form action="teste3.php?act=sinistrado&busca=sinistrado" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="n&uacute;mero de sinistro" autofocus="">
    ou
    <input type="text" name="sinistrado" placeholder="nome do sinistrado" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
        <label>acima de R$ </label>
        <input type="text" name="importanciasegurada" placeholder="import&acirc;cia segurada"/>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php endif; ?>

