<?php if($act=='beneficiario'): ?>
<div class="titulo">BENEFICI&Aacute;RIO</div>
<form action="teste3.php?act=beneficiario&busca=beneficiario" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="sinistro ou certificado" autofocus="">
    ou
    <input type="text" name="beneficiario" placeholder="nome do benefici&aacute;rio" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
        <label>acima de R$ </label>
    <input type="text" name="vlindeniza" placeholder="Valor a indenizar"/>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php elseif($act=='sinistrado'): ?>
<form action="teste3.php?act=beneficiario&busca=beneficiario" method="POST">
    <input type="hidden" name="num_sinistro" value="<?php echo @$_GET['num_sinistro'] ?>" >
    <div class="titulo">
    <?php 
     @$digitos=strlen($_GET['num_sinistro']);
      if(@$digitos == 16 || @$digitos == 19){
       echo '<button onlick="submit">';
       echo '<i>ver Benefici&aacute;rios</i></button></div>';
      }else{
       echo 'SINISTRADO</div>';
      }
     ?>
</form>
<form action="teste3.php?act=sinistrado&busca=sinistrado" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="sinistro ou certificado" autofocus="">
    ou
    <input type="text" name="sinistrado" placeholder="nome do sinistrado" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
        <label>acima de R$ </label>
        <input type="text" name="importanciasegurada" placeholder="import&acirc;cia segurada"/>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php elseif($act=='divergente'): ?>
<form action="teste3.php?act=divergente&busca=divergente" method="POST">
   <span>Qual a op&ccedil;&acirc;o de pesquisa?</span>
   <input name="x" type="radio" value="total" required> Total
   <input name="x" type="radio" value="parcial"> Parcial
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
<?php die; ?>
    <?php elseif($act=='judiciais'): ?>
<div class="titulo">PROCESSOS JUDICIAIS</div>
<form action="teste3.php?act=judiciais&busca=judiciais" method="POST">
    <input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="n&uacute;mero de sinistro" autofocus="">
    ou
    <input type="text" name="sinistrado" placeholder="nome do sinistrado" >
    ou
    <input type="text" name="processo" placeholder="processo judicial" >
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php //include_once 'upload.phtml'; ?>
    <?php elseif($act=='informacoes'): ?>
<div class="titulo">INFORMA&Ccedil;&Otilde;ES</div>
<form action="carregando.php?act=informacoes&busca=informacoes&abrir=1" method="POST">
    <label for="certificado"><i>Certificado</i></label>
    <input type="text" attrname="telephone1" name="certificado" maxlength="19" placeholder="n&uacute;mero de certificado" autofocus="">
    <label for="doc"><i>Cpf</i></label>
    <input id="doc" name="cpf" type="text" maxlength="14">
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php elseif($act=='pesquisa'): ?>
<div class="titulo">BUSCA</div>
<form action="carregando.php?act=pesquisa&busca=pesquisa" method="POST">
    <label for="certificado"><i>Digite o nome do titular: </i></label>
    <input type="text" size="50" name="sinistrado" >
    <label for="doc"><i> ou Cpf: </i></label>
    <input id="doc" name="cpf" type="text" maxlength="14">
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
    <?php elseif($act=='status'): ?>
<div class="titulo">DETALHES</div>
    <?php endif; ?>