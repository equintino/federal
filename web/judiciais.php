<?php
    //echo "Processos Judiciais";
    include_once 'upload.phtml';
//print_r($_GET);die;
    $filename=$_GET['arquivo'];
    $mode='r';
    $handle=fopen($filename, $mode);
    
    $dados=file($filename);
    echo "O conteudo e: ";
    echo "<br>";
    print_r($dados);
    $conteudo = fread ($handle, filesize ($filename));
    echo "<br><br>";
    echo $conteudo;
    
    fclose($handle);
?>

