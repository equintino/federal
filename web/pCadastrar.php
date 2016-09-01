<?php
    $filename='arquivos/pCadastrar.txt';
    $handle=fopen($filename, 'r');
    $texto=fread($handle, filesize($filename));
    $array=unserialize($texto);
    fclose($handle);
    echo "<button onclick=history.go(-1) class=busca>VOLTAR</button>";
    echo "<div class=avisado>";
    echo "<table align=center>";
    echo "<tr><td>ANTES<img src='img/seta_esq.png' height=50px></td>";
    echo "<td>";
    echo "AVISADO 2011";
    echo "</td>";
    echo "<td><img src='img/seta_dir.png' height=50px>DEPOIS</td></tr>";
    echo "</table>";
    echo "</div>";
    echo "<div id=avisado>";
    echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=tabela><tr><th>SINISTRO</th>";
    foreach($array as $item){
        echo "<tr><td>$item</td></tr>";
    }
    echo "</table>";
    echo "</div>";
?>

