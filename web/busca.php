<?php        
          $dao = new OdbcDao();
          //$search = new OdbcSearchCriteria();
          //$search->setsinistro(93);
          //$search->setnome('joao');
          $tabela='Beneficiarios';
          $tabela2='sinipend';
?>
<form action="teste3.php?act=sinistro&busca=sinistro" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="n&uacute;mero de sinistro" autofocus="">
    ou
    <input type="text" name="sinistro" placeholder="nome do benefici&aacute;rio" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="No. de Sinistro" ><img src="img/lupa.png" height="12px" />
    </button>
</form>