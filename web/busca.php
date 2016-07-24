  <script type="text/javascript">
    $(document).ready(function() {
      $("#sin").inputmask({
        mask: ["####.99.99.99999999", "9999.99.99.99999999", ],
        keepStatic: true
      });
    });
  </script>
<?php        
          $dao = new OdbcDao();
          //$search = new OdbcSearchCriteria();
          //$search->setsinistro(93);
          //$search->setnome('joao');
          $tabela='Beneficiarios';
          $tabela2='sinipend';
?>
<form action="teste3.php?act=sinistro&busca=sinistro" method="POST">
    <input type="text" id="sin" name="sinistro" placeholder="número de sinistro">
    <button onclick="submit" title="No. de Sinistro" ><img src="img/lupa.png" height="12px" />
    </button>
</form>