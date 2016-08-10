<?php
    $tabela1='sinipend';
    $tabela2='Beneficiarios';
    @$inicio=$_GET['inicio'];
    
    if(@$_GET['certificado']!=null){
        $campo='endosso';
        $busca=$_GET['certificado'];
        $certificado=$busca;
    }elseif($_GET['cpf']){
        $campo='cpf';
        $busca=OdbcValidator::removePonto($_GET['cpf']);
        $cpf=$busca;
    }
    
    echo "<div class=informacoes>";
    echo "<h3>SINISTRADO</h3>";
    echo "<div class=sinistrado >";
    if($dao->listaCampo2($tabela1,$campo,$busca,$pagAtual)){
        foreach($dao->listaCampo2($tabela1,$campo,$busca,$pagAtual) as $item){
            echo "<label>Certificado: </label>";
            echo $item['ENDOSSO'];
            echo "<br>";
            echo "<label>Sinistro: </label>";
            echo $item['SINISTRO'];
            echo "<br>";
            echo "<label>Sinistrado: </label>";
            echo $item['TITULAR'];
            echo "<br>";
            echo "<label>Cpf: </label>";
                if(strlen($item['CPF'])!=11){
                    $cor="color=red";
                }else{
                    $cor="color=black";
                }
            echo "<font $cor>";
            echo OdbcValidator::mask($item['CPF'],'###.###.###-##');
            echo "</font>";
            echo "<br><br>";
            $certificado_[]= $item['ENDOSSO'];
        }
        $limite=count($dao->listaCampo3($tabela1,$campo,$busca,$pagAtual));
        if($limite < 4){
         $proximo='<button disabled>';
        }else{
         $proximo='<button>';
        }
        $pagAtual=$item['idtitular'];
        
        if($inicio=='sim'){
          $botao="<button disabled>";
        }else{
          $botao="<button onclick=history.go(-1)>";
        }
        echo $botao."ANTERIOR</button>";
        echo "<a href=\"teste3.php?certificado=".$certificado."&cpf=$cpf&act=informacoes&abrir=1&pagAtual=$pagAtual \">".$proximo." PR&Oacute;XIMO</button></a>";
        echo "</div>";
    }else{
        echo "N&atilde;o encontrado nenhum resultado.";
    }
    echo "<h3>BENEFICI&Aacute;RIO(S)</h3>";
    echo "<div class=beneficiario>";
    if($campo=='endosso'){
   for($x=0;$x<count(@$certificado_);$x++){
    if($dao->listaCampo($tabela2,$campo,$certificado_[$x],$pagAtual)){
        foreach($dao->listaCampo($tabela2,$campo,$certificado_[$x],$pagAtual) as $item){
            echo "<label>Certificado: </label>";
            echo $item['endosso'];
            echo "<br>";
            echo "<label>Sinistro: </label>";
            echo $item['sinistro'];
            echo "<br>";
            echo "<label>Cobertura: </label>";
            echo $item['tpcobertura'];
            echo "<br>";
            echo "<label>Valor a indenizar: </label>";
            echo number_format($item['vlindeniza'],'2',',','.');
            echo "<br>";
            echo "<label>Benefici&aacute;rio: </label>";
            echo $item['nome'];
            echo "<br>";
            echo "<label>Cpf: </label>";
                if(strlen($item['cpf'])!=11){
                    $cor="color=red";
                }else{
                    $cor="color=black";
                }
            echo "<font $cor>";
            echo OdbcValidator::mask($item['cpf'],'###.###.###-##');
            echo "</font>";
            echo "<br><br>";
        }
     }
   }
        echo "</div>";
    }else{
    if($dao->listaCampo4($tabela2,$campo,$busca,$pagAtual)){
        foreach($dao->listaCampo4($tabela2,$campo,$busca,$pagAtual) as $item){
            echo "<i>Certificado: </i>";
            echo $item['endosso'];
            echo "<br>";
            echo "<i>Sinistro: </i>";
            echo $item['sinistro'];
            echo "<br>";
            echo "<i>Cobertura: </i>";
            echo $item['tpcobertura'];
            echo "<br>";
            echo "<i>Valor a indenizar: </i>";
            echo number_format($item['vlindeniza'],'2',',','.');
            echo "<br>";
            echo "<i>Benefici&aacute;rio: </i>";
            echo $item['nome'];
            echo "<br>";
            echo "<i>Cpf: </i>";
            echo OdbcValidator::mask($item['cpf'],'###.###.###-##');
            echo "<br><br>";
        }
        echo "</div>";
    }
    }
    echo "</div>";
?>