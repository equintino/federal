<?php
    $dao = new OdbcDao();
    $search = new OdbcSearchCriteria();
    $odbc = new Odbc();
    
    /*
    print_r($dao);
    echo "<br><br>";
    print_r($search);
    echo "<br><br>";
    print_r($odbc);
    echo "<br><br>";
     * 
     */
    //print_r($_POST);
    //echo "<br><br>";
    
    $tabela1='sinipend';
    $tabela2='Beneficiarios';
    
    //print_r($_GET);die;
    if(@$_GET['certificado']!=null){
        $campo='endosso';
        $busca=$_GET['certificado'];
        $certificado=$busca;
    }elseif($_GET['cpf']){
        $campo='cpf';
        $busca=OdbcValidator::removePonto($_GET['cpf']);
        $cpf=$busca;
    }
        //echo "$campo - $busca";die;
    
    //$campo='ENDOSSO';
    //$busca='0131.93.22.00000814';
    
    function mask($val, $mask){
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++){
	 if($mask[$i] == '#'){
            if(isset($val[$k]))
                $maskared .= $val[$k++];
         }else{
            if(isset($mask[$i]))
            $maskared .= $mask[$i];
         }
        }
	 return $maskared;
    }
    
    echo "<div class=informacoes>";
    echo "<h3>SINISTRADO</h3>";
    echo "<div class=sinistrado >";
    if($dao->listaCampo2($tabela1,$campo,$busca,$pagAtual)){
     //print_r($dao->listaCampo2($tabela1,$campo,$busca));die;
     //echo "<h1>$pagAtual</h1>";
     //$odbc->setidtitular($pagAtual);
        foreach($dao->listaCampo2($tabela1,$campo,$busca,$pagAtual) as $item){
            echo "<i>Certificado: </i>";
            echo $item['ENDOSSO'];
            echo "<br>";
            echo "<i>Sinistro: </i>";
            echo $item['SINISTRO'];
            echo "<br>";
            echo "<i>Sinistrado: </i>";
            echo $item['TITULAR'];
            echo "<br>";
            echo "<i>Cpf: </i>";
            echo mask($item['CPF'],'###.###.###-##');
            echo "<br><br>";
            $certificado_[]= $item['ENDOSSO'];
        //print_r ($idtilular);
        }
        //print_r ($idtitular);
        $limite=count($dao->listaCampo3($tabela1,$campo,$busca,$pagAtual));
        //echo ($idtitular[0]-1);
        if($limite < 4){
         $proximo='<button disabled>';
        }else{
         $proximo='<button>';
        }
        $pagAtual=$item['idtitular'];
        //echo "<h1>$pagAtual</h1>";
        //$pagAtual=$odbc->getidtitular();
        //echo "<h1>$pagAtual</h1>";
        //echo ($pagAtual-3);
        echo "<a href=\"teste3.php?certificado=".$certificado."&cpf=$cpf&act=informacoes&abrir=1&pagAtual=0 \"><button>IN&Iacute;CIO</button>";
        echo "<a href=\"teste3.php?certificado=".$certificado."&cpf=$cpf&act=informacoes&abrir=1&pagAtual=$pagAtual \">".$proximo." PR&Oacute;XIMO</button></a>";
        echo "</div>";
    }else{
        echo "N&atilde;o encontrado nenhum resultado.";
    }
    echo "<h3>BENEFICI&Aacute;RIO(S)</h3>";
    echo "<div class=beneficiario>";
   //print_r($certificado_);die;
    if($campo=='endosso'){
   for($x=0;$x<count(@$certificado_);$x++){
    //print_r($certificado_[$x]);
    //echo count($certificado_);
    //echo "<br>";
   //}die;
    if($dao->listaCampo($tabela2,$campo,$certificado_[$x],$pagAtual)){
        foreach($dao->listaCampo($tabela2,$campo,$certificado_[$x],$pagAtual) as $item){
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
            echo mask($item['cpf'],'###.###.###-##');
            echo "<br><br>";
        }
    //}
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
            echo mask($item['cpf'],'###.###.###-##');
            echo "<br><br>";
        }
        echo "</div>";
    }
    }
    echo "</div>";
?>

