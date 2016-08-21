<?php
//@$texto=$_GET['texto'];
// Abre ou cria o arquivo exemplo1.txt
// "a" representa que o arquivo é aberto para ser escrito
$arq="exemplo1.txt";
$fp = fopen($arq, "a+");

// Escreve "primeiro exemplo" no exemplo1.txt
$escreve = fwrite($fp, $texto);
print_r(fread($fp, filesize($arq)));

// Fecha o arquivo
fclose($fp);
?>

