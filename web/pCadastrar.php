<?php
    $filename='arquivos/pCadastrar.txt';
    $handle=fopen($filename, 'r');
    $texto=fread($handle, filesize($filename));
    $array=unserialize($texto);
    fclose($handle);
    echo "<button onclick=history.go(-1) class=busca>VOLTAR</button>";
    echo "<div id=avisado>";
    //echo "<table align=center>";
    //echo "<tr><td>";
    echo "<div>ANTES <img src='img/seta_esq.png' height=20px> ";
    echo "<span> AVISADO 2011 </span>";
    echo " <img src='img/seta_dir.png' height=20px>";
    echo " DEPOIS</div>";
    //echo "</table>";
    echo "<div class=tabelaEsq>";
    echo "<table border=1 align=center cellspacing=0 spanspacing=0 ><tr><th>SINISTRO</th>";
    foreach($array as $item){
        echo "<tr><td>$item</td></tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "<div class=tabelaDir>";
    echo "<table border=1 align=center cellspacing=0 spanspacing=0 ><tr><th>SINISTRO</th>";
    foreach($array as $item){
        echo "<tr><td>$item</td></tr>";
    }
    echo "</table>";
    echo "</div>";
    echo "</div>";
?>

