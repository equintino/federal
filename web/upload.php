<?php

/* Insira aqui a pasta que deseja salvar o arquivo*/
$uploaddir = 'arquivos/';

$uploadfile = $uploaddir . $_FILES['arquivo']['name'];

//print_r($_FILES);die;
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile)){
    echo "Arquivo Enviado";
    header('Location:teste3.php?act=judiciais&abrir=1&arquivo='.$uploadfile.'');
}else{
    echo "Arquivo não enviado";   
}
?>

