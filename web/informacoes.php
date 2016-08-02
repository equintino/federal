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
    }elseif($_GET['cpf']){
        $campo='cpf';
        $busca=OdbcValidator::removePonto($_GET['cpf']);
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
    echo "<h4>SINISTRADO</h4>";
    if($dao->listaCampo($tabela1,$campo,$busca)){
        foreach($dao->listaCampo($tabela1,$campo,$busca) as $item){
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
        }
    }else{
        echo "N&atilde;o encontrado nenhum resultado.";
    }
    echo "<h4>BENEFICI&Aacute;RIO(S)</h4>";
    if($dao->listaCampo($tabela2,$campo,$busca)){
        foreach($dao->listaCampo($tabela2,$campo,$busca) as $item){
            echo "<i>Certificado: </i>";
            echo $item['endosso'];
            echo "<br>";
            echo "<i>Sinistro: </i>";
            echo $item['sinistro'];
            echo "<br>";
            echo "<i>Sinistrado: </i>";
            echo $item['nome'];
            echo "<br>";
            echo "<i>Cpf: </i>";
            echo mask($item['cpf'],'###.###.###-##');
            echo "<br><br>";
        }
    }else{
        echo "N&atilde;o encontrado nenhum resultado.";
    }
    echo "</div>";
?>

