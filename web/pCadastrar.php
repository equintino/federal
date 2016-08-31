<?php
    $filename='arquivos/pCadastrar.txt';
    $handle=fopen($filename, 'r');
    $texto=fread($handle, filesize($filename));
    $array=unserialize($texto);
    fclose($handle);
    echo "<button onclick=history.go(-1) class=busca>VOLTAR</button>";
    echo "<div class=avisado>";
    echo "SINISTRO AVISADO";
    echo "</div>";
    echo "<div id=geral>";
    echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=tabela><tr><th>SINISTRO</th>";
    foreach($array as $item){
        echo "<tr><td>$item</td></tr>";
    }
    echo "</table>";
    echo "</div>";
?>

