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
<div class="titulo">SINISTRADO</div>
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
<div class="titulo">PESQUISANDO DIVERG&Ecirc;NCIAS</div>
<form action="teste3.php?act=divergente&busca=divergente" method="POST">
    <!--<input type="text" attrname="telephone1" name="num_sinistro" maxlength="19" placeholder="n&uacute;mero de sinistro" autofocus="">-->
    Qual a sucursal a pesquisar? 
    <input type="text" name="sucursal" size=2 maxlength="2" required />
    Qual o ramo? 
    <input type="text" name="ramo" size=2 maxlength="2" required />
    <script src='js/vanilla-masker.min.js'></script>
    <script src="js/index.js"></script>
    <button onclick="submit" title="Buscar" ><img src="img/lupa.png" height="12px" /></button>
</form>
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
    <?php endif; ?>