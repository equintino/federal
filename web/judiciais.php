<?php
header('Content-type: text/html; charset=UTF-8');
 /*
    @$filename=$_GET['arquivo'];
    $mode='r';
    @$handle=fopen($filename, $mode);
    
    @$dados=file($filename);
    @$conteudo = fread ($handle, filesize ($filename));
    
    @fclose($handle);
 
 */   
    $Tododao=new TodoDao();
    $Todosearch=new TodoSearchCriteria;
    $Todo=new Todo();
    $odbc=new Odbc();
    
    @$sinistro= $_POST['num_sinistro'];
    if(@!$sinistro){
       @$sinistro= $_GET['num_sinistro']; 
    }
    @$sinistrado=$_POST['sinistrado'];
    if(@!$sinistrado){
       @$sinistrado=$_GET['sinistrado']; 
    }
        
    $Todosearch->setSINISTRO($sinistro);
    $Todosearch->setSEGURADOS($sinistrado);
    
    $todos=$Tododao->find($Todosearch);
    
    //print_r($todos);die;
    
    echo "<div class=judiciais>";
    /*
    if(!$todos){
        echo "<b>Nenhum resultado foi obtido</b>";
    }else{
        echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
        echo "<tr><th>SINISTRO</th><th>PROCESSO</th><th>PROC. ANTIGO</th><th>SEGURADO</th><th>OBS.</th></tr>";
        foreach($todos as $item){
            echo "<tr><td>";
            echo $item->getSINISTRO();
            echo "</td><td>";
            echo $item->getN_PROC();
            echo "</td><td align=right>";
            echo $item->getN_NATIGO();
            echo "</td><td>";
            echo $item->getSEGURADOS();
            echo "</td><td>";
            echo $item->getOBS();
            echo "</td></tr>";
        }
        echo "</table>";
    }
    
     * 
     */
    //$dao=new OdbcDao();
    
    //print_r($todos);
    //echo "<br><br>";
    //print_r($odbcs);die;
    
    if($todos){
        echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
        echo "<tr><th>SINISTRO</th><th>PROCESSO</th><th>PROC. ANTIGO</th><th>SEGURADO</th><th>SINISTRADO</th><th>OBS.</th></tr>";
        foreach($todos as $item){
                $search->setsinistro($item->getsinistro());
                //echo "<tr><td>";
                //echo($item->getsinistro());
                //echo "</td>";
                @$odbcs=$dao->busca6($search);
            if($odbcs){
                foreach($odbcs as $item3){
                    echo "<tr><td>";
                    echo $item3->getsinistro();
                    echo "</td><td>";
                    echo $item->getN_PROC();
                    echo "</td><td align=right>";
                    echo $item->getN_NATIGO();
                    echo "</td><td>";
                    echo $item->getSEGURADOS();
                    echo "</td><td>";
                    echo $item3->getTITULAR();
                    echo "</td><td>";
                    echo $item->getOBS();
                    echo "</td></tr>";
                }
            }
        }
        echo "</table>";
    }
    //print_r($odbcs);
    //echo "<br><br>";
    //print_r($search);
    echo "</div>";
?>