<?php
header('Content-type: text/html; charset=UTF-8');
    //echo "Processos Judiciais";
    include_once 'upload.phtml';
//print_r($_GET);die;
    @$filename=$_GET['arquivo'];
    $mode='r';
    @$handle=fopen($filename, $mode);
    
    @$dados=file($filename);
    echo "O conteudo e: ";
    echo "<br>";
    print_r($dados);
    @$conteudo = fread ($handle, filesize ($filename));
    //echo "<br><br>";
    //echo utf8_encode($conteudo);
    //explode($, $string)
    print_r(explode(";",$dados[1]));
    
    @fclose($handle);
?>

