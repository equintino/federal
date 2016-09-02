<script>
  function total($x,$local){
   var x='Total de ('+$x+')';
   var local=$local;
   document.getElementById(local).innerHTML=x;
  }
</script>
<?php
    $filename='arquivos/pCadastrar.txt';
    $handle=fopen($filename, 'r');
    $texto=fread($handle, filesize($filename));
    $array=explode(',',$texto);
    fclose($handle);
    //print_r($array);die;
    //print_r(array_keys($array));
    //echo $array[0];
    //die;
    echo "<button onclick=history.go(-1) class=busca>VOLTAR</button>";
    echo "<div id=avisado>";
    //echo "<table align=center>";
    //echo "<tr><td>";
    echo "<div><span id=antes></span> ANTES <img src='img/seta_esq.png' height=20px> ";
    echo "<span class=tituloAvisado> AVISADOS 2011 </span>";
    echo " <img src='img/seta_dir.png' height=20px>";
    echo " DEPOIS <span id=depois></span></div>";
    //echo "</table>";
    echo "<div class=tabelaEsq>";
    echo "<table border=1 align=center cellspacing=0 spanspacing=0 ><tr><th>SINISTRO</th>";
    $y=0;
    $z=0;
    for($x=0;$x<count($array);$x++){
     @$dt_aviso=$array[$x+1];
     $ano = substr(strrchr($dt_aviso,"/"),-2,2);
     if($ano < 11){
       if($array[$x]){
        echo "<tr><td>$array[$x]</td></tr>";
        $y++;
       }
     }
     $x++;
    }
    echo "<script>total($y,'antes')</script>";
    echo "</table>";
    echo "</div>";
    echo "<div class=tabelaDir>";
    echo "<table border=1 align=center cellspacing=0 spanspacing=0 ><tr><th>SINISTRO</th>";
    for($x=0;$x<count($array);$x++){
     @$dt_aviso=$array[$x+1];
     $ano = substr(strrchr($dt_aviso,"/"),-2,2);
     if($ano > 10){
      if($array[$x]){
        echo "<tr><td>$array[$x]</td></tr>";
        $z++;
      }
     }
     $x++;
    }
    echo "<script>total($z,'depois')</script>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
?>

