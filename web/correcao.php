<meta charset="utf8">
<?php
   include '../dao/TodoDao.php';
   include '../dao/TodoSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Todo.php';
   include '../validation/TodoValidator.php';
   include '../validation/OdbcValidator.php';
   include '../mapping/TodoMapper.php';
   
   
   $Tododao=new TodoDao(); 
   $Todosearch=new TodoSearchCriteria();
   
   $Todosearch->setANO(2016);
   
   $provaveis=$Tododao->listaProvavel();
   //$provavel=$Tododao->findByProvavel();
   //print_r($provaveis);die;
   /*
   for($x=1;$x<13;$x++){
     print_r(TodoValidator::nomeMes($x));
     echo "<br>";
   }
    */
   $igpms=$Tododao->findByIgpm($Todosearch);
   //print_r($igpms);die;
   //print_r($provaveis);die;
   foreach($provaveis as $provavel){
    $mes=substr($provavel['DT_AVISO'],3,2);
    $ano=substr($provavel['DT_AVISO'],6,4);
    $nomeMes=TodoValidator::nomeMes($mes);
    $valorCorrigido=$provavel['VALOR_ADMINISTRATIVO'];
    $sinistro=$provavel['SINISTRO'];
    //$mes=5;
    //$ano=2012;
    if($ano<2014 && $mes<'8'){
     echo "$nomeMes/$ano";
       echo " (";
      for($x=$ano;$x<2015;$x++){
        if($x<2014){
         for($y=$mes;$y<13;$y++){
           //echo TodoValidator::nomeMes($y)."/$x";
           $Todosearch->setAno($x);
           $igpm=$Tododao->findByIgpm($Todosearch);
           //foreach($igpm as )
           //print_r(taxaigpm($y,$igpm));die;
             switch($y){
               case 1:
                $mes_=$igpm->getJANEIRO();
                break;
               case 2:
                $mes_=$igpm->getFEVEREIRO();
                break;
               case 3:
                $mes_=$igpm->getMARCO();
                break;
               case 4:
                $mes_=$igpm->getABRIL();
                break;
               case 5:
                $mes_=$igpm->getMAIO();
                break;
               case 6:
                $mes_=$igpm->getJUNHO();
                break;
               case 7:
                $mes_=$igpm->getJULHO();
                break;
               case 8:
                $mes_=$igpm->getAGOSTO();
                break;
               case 9:
                $mes_=$igpm->getSETEMBRO();
                break;
               case 10:
                $mes_=$igpm->getOUTUBRO();
                break;
               case 11:
                $mes_=$igpm->getNOVEMBRO();
                break;
               case 12:
                $mes_=$igpm->getDEZEMBRO();
                break;
               return $mes_;
             }
              //echo $mes_;
            //if(TodoValidator::nomeMes($y)=='JUNHO')
           //$jan='JANEIRO';
           //$mes_='getJUNHO()';
           //echo $ig;
             $igpm_mes=(OdbcValidator::removePonto($mes_))/10000;
             PRINT_R($sinistro);
             echo " - ";
             print_r($valorCorrigido);
             echo " ) $nomeMes -> $mes_ ";
             print_r($igpm_mes);
             echo "<br>";
             $correcao=((OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO'])/100)*$igpm_mes);
             echo $correcao;die;
             $valorCorrigido=$valorCorrigido+(((OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO'])/100)*$igpm_mes)+(OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO'])/100));
             echo " ($valorCorrigido) ";die;
           //foreach ($igpm as $item){
           // print_r($item);die;
             //echo $item->getJUNHO();//TodoValidator::nomeMes($y);
            // die;
             //$taxa=$item[];
             //print_r(TodoValidator::nomeMes($y));
           //}die;
           //echo "$taxa";
           echo " - ";
         }die;
         $mes=1;
        }else{
         for($y=$mes;$y<8;$y++){
             switch($y){
               case 1:
                $mes_=$igpm->getJANEIRO();
                break;
               case 2:
                $mes_=$igpm->getFEVEREIRO();
                break;
               case 3:
                $mes_=$igpm->getMARCO();
                break;
               case 4:
                $mes_=$igpm->getABRIL();
                break;
               case 5:
                $mes_=$igpm->getMAIO();
                break;
               case 6:
                $mes_=$igpm->getJUNHO();
                break;
               case 7:
                $mes_=$igpm->getJULHO();
                break;
               case 8:
                $mes_=$igpm->getAGOSTO();
                break;
               case 9:
                $mes_=$igpm->getSETEMBRO();
                break;
               case 10:
                $mes_=$igpm->getOUTUBRO();
                break;
               case 11:
                $mes_=$igpm->getNOVEMBRO();
                break;
               case 12:
                $mes_=$igpm->getDEZEMBRO();
                break;
               return $mes_;
             }
           //echo TodoValidator::nomeMes($y)."/$x";
             $igpm_mes=(OdbcValidator::removePonto($mes_))/10000;
             print_r($valorCorrigido);
             echo " * ";
             print_r($igpm_mes);
             $valorCorrigido=$valorCorrigido+(((OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO'])/100)*$igpm_mes)+(OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO'])/100));
             echo " ($valorCorrigido) ";
         }
        }
        /*
        for($y=$mes;$y<13;$y++){
         if($y<8){
          echo "$y - ";
         }else{
          echo "$y ";
         }
        }
         * 
         */
      }
    }
      echo ") ";
      echo "<br>";
   }die;
   
     echo "<table border=1 align=center cellspacing=0 spanspacing=0 class=\"tabela\">";
     echo "<tr><th>SINISTRO</th><th>SEGURADO</th><th>PARTE CONTR&Aacute;RIA</th><th>VALOR PEDIDO</th><th>VALOR ADMINISTRATIVO</th><th>MENOR VALOR</th></tr>";
   
   foreach($provaveis as $provavel){
       echo "<tr><td>";
       echo $provavel['SINISTRO'];
       echo "</td><td>";
       echo $provavel['SEGURADO'];
       echo "</td><td>";
       echo $provavel['PARTE_CONTRARIA'];
       echo "</td><td>";
       echo $provavel['VALOR_PEDIDO'];
       echo "</td><td>";
       echo $provavel['CORRECAO_TR'];
       echo "</td><td>";
       $pedido=OdbcValidator::removePonto($provavel['VALOR_PEDIDO']);
       $administrativo=  OdbcValidator::removePonto($provavel['VALOR_ADMINISTRATIVO']);
       if($pedido > $administrativo || $pedido == null){
           echo $provavel['CORRECAO_TR'];
       }else{
           echo $provavel['VALOR_PEDIDO'];
       }
       echo "</td></tr>";
   }
    echo "</table>";
?>