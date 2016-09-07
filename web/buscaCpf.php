<?php   
    $tabela1='sinipend';
    $tabela2='Beneficiarios';
    @$inicio=$_GET['inicio'];
    @$sinistrado=$_GET['sinistrado'];
    @$cpf=$_GET['cpf'];
    @$sinistro=$_GET['sinistro'];
    
    $dao = new OdbcDao();
    $Tododao = new TodoDao();
    $search = new TodoSearchCriteria();
    
    //print_r($_GET);die;
    if(!$sinistrado && !$cpf && !$sinistro){
     echo '<table border=1 align=center cellspacing=0 spanspacing=0 class="tabela">';      
     echo "<tr><th>SINISTRO</th><th>SINISTRADO</th><th>CPF(CORRETO)</th><th>CPF(ERRADO)</th></tr>";
     foreach($dao->listaConteudo($tabela1) as $item){
      $search->setSINISTRO(@$item['SINISTRO']);
    
      @$cpf =  OdbcValidator::removePonto($item['CPF']);
       if(strlen($cpf) != 11){
        if(@$item['SINISTRO']){
         if($Tododao->find4($search)){
           foreach($Tododao->find4($search) as $item2);
         }
         echo "<tr><td>".($item['SINISTRO'])."</td>";
         //echo "<td>".$item2->getSEGURADOS()."</td>";
         echo "<td>".$item['TITULAR']."</td>";
         echo "<td align=center>";
         if(strlen($item2->getCPF())==11){
          echo "'".($item2->getCPF());
         }
         echo "</td><td align=center>";
         echo "'".($item['CPF']);
         echo "</ts></tr>";
        }
       }
     }
     die;
    }
    
    if(@$_GET['sinistrado']!=null){
        $campo='TITULAR';
        $busca=$_GET['sinistrado'];
        //$certificado=$busca;
        //$busca=OdbcValidator::removePonto($busca);
        //$busca=OdbcValidator::mask($busca,"####.##.##.########");
    }elseif(@$_GET['cpf']){
        $campo='cpf';
        $busca=OdbcValidator::removePonto($_GET['cpf']);
        $cpf=$busca;
    }else{
      $campo='nome';
      $busca=$_GET['sinistrado'];
    }
    
    //echo "campo -> $campo -- busca -> $busca";
    
    if(@$dao->listaCampo2($tabela1,$campo,$busca,$pagAtual) || $dao->listaCampo($tabela2,$campo,$busca,$pagAtual)){
     $pesquisa=$dao->listaCampo2($tabela1,$campo,$busca,$pagAtual);
    }else{
     $busca=OdbcValidator::mask($cpf,"###.###.###-##");
     $pesquisa=$dao->listaCampo2($tabela1,$campo,$busca,$pagAtual);
    }
    //print_r($pesquisa);die;
    echo "<div class=informacoes>";
    echo "<h3>SINISTRADO</h3>";
    echo "<div class=sinistrado >";
    if($pesquisa){
        foreach($pesquisa as $item){
            $cpf1=OdbcValidator::removePonto($item['CPF']);
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
                if(strlen($cpf1) != 11){
                    $cor="color=red";
                }else{
                    $cor="color=black";
                }
            echo "<font $cor>";
            echo OdbcValidator::mask($cpf1,'###.###.###-##');
            echo "</font>";
            echo "<br><br>";
            $sinistro_[]= $item['SINISTRO'];
        }
        //print_r($sinistro_);die;
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
        echo "<a href=\"teste3.php?sinistro=".$sinistro."&cpf=$cpf&act=pesquisa&abrir=1&pagAtual=$pagAtual \">".$proximo." PR&Oacute;XIMO</button></a>";
        echo "</div>";
    }else{
        echo "N&atilde;o encontrado nenhum resultado.";
    }
    echo "<h3>BENEFICI&Aacute;RIO(S)</h3>";
    echo "<div class=beneficiario>";
    //echo $pesquisa;
    if($pesquisa){
     $campo='sinistro';
   for($x=0;$x<count(@$sinistro_);$x++){
    if($dao->listaCampo($tabela2,$campo,$sinistro_[$x],$pagAtual)){
        foreach($dao->listaCampo($tabela2,$campo,$sinistro_[$x],$pagAtual) as $item){
            $cpf2=  OdbcValidator::removePonto($item['cpf']);
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
                if(strlen($cpf2)!=11){
            //print_r(strlen($item['cpf']));
                    $cor="color=red";
                }else{
                    $cor="color=black";
                }
            echo "<font $cor>";
            echo OdbcValidator::mask($cpf2,'###.###.###-##');
            echo "</font>";
            echo "<br><br>";
        }
        //print_r($item);die;
     }
   }
        echo "</div>";die;
    }else{
     //echo $campo;
     if($campo == 'TITULAR'){
      $campo='nome';
     }
    if($dao->listaCampo4($tabela2,$campo,$busca,$pagAtual)){
        foreach($dao->listaCampo4($tabela2,$campo,$busca,$pagAtual) as $item){
         $cpf3=OdbcValidator::removePonto($item['cpf']);
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
            echo OdbcValidator::mask($cpf3,'###.###.###-##');
            echo "<br><br>";
        }
        echo "</div>";
     }
    }
    echo "</div>"; 
?> 