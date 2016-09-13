<link rel="stylesheet" type="text/css" href="css/consulta.css" />
<script src="js/script.js"></script> 
<?php
//putenv("ORACLE_HOME=C:\ARQUIV~1\EASYPH~1.1VC\binaries\php\php_runningversion\\ext");
//foreach(PDO::getAvailableDrivers() as $driver)
  //  echo $driver, '<br>';die;
/*
putenv("OraHome92=C:\oracle\ora92");
putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN");
putenv("ORACLE_HOME=C:\ARQUIV~1\EASYPH~1.1VC\binaries\php\php_runningversion\\ext");
putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN\tnsnames.ora");
putenv("Oracle=C:\ARQUIV~1\EASYPH~1.1VC\binaries\php\php_runningversion\ext");
 * 
 */
//$test = getenv('LD_LIBRARY_PATH')."  ".getenv('ORACLE_HOME');

//echo $test;die;

//phpinfo();die;
//echo getenv("OraHome92");

//print_r(getenv("ORACLE_HOME"));
   include '../dao/OdbcDao.php';
   include '../dao/OdbcSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Odbc.php';
   include '../mapping/OdbcMapper.php';
   include '../validation/OdbcValidator.php';
   include '../dao/TodoDao.php';
   include '../dao/Oracle.php';
   include '../dao/TodoSearchCriteria.php';
   include '../model/Todo.php';
   include '../mapping/TodoMapper.php';
   include '../validation/TodoValidator.php';
   include '../exception/NotFoundException.php';
   
   
   
   //echo getenv("ORACLE_HOME");
   //$db_test = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=localhost)(PORT=1521)) (CONNECT_DATA=(SID=xe)))';
   //$conn = oci_connect('sys as sysdba', '12345', '//localhost/orcl');
   //echo $conn;
   //die;
   
   //$db_test = '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(HOST=192.168.10.110)(PORT=1521)) (CONNECT_DATA=(SID=prd1)))';
   //echo $db_test;die;
   //$conn = new PDO("oci:dbname=xe",'sngsprod', 'SFS#01PROD');
   
   //var_dump($conn);die;
   
   
   $oracle = new Oracle();
   //print_r($oracle);
   print_r($oracle->find());
   //die;
$conn = oci_connect('system', 'monica924', 'host:localhost/sinistro');
$query = 'select table_name from user_tables';
$stid = oci_parse($conn, $query);
oci_execute($stid, OCI_DEFAULT);
while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
foreach ($row as $item) {
echo $item." | ";
}
echo "
\n";
}
oci_free_statement($stid);
oci_close($conn);
die;



putenv("ORACLE_SID=xe");
putenv("OraHome92=C:\oracle\ora92");
putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN");
putenv("ORACLE_HOME=C:\oracle\ora92");
putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN\tnsnames.ora");

//### INICIO - CONECTA AO ORACLE ####################################################
if (!$db = ora_logon("system@sinistro","monica924"))
{
echo "<font color='#0000FF'>ERRO NA CONEXAO COM ORACLE: </font>";
echo "<font color='#FF0000'>".ora_error()."</font>";
die();
}
else
{
echo "<font color='#0000FF'>ORACLE CONECTADO!</font>";
}
//### FIM - CONECTA AO ORACLE ####################################################
die;


    $conn = oci_pconnect('system', 'monica924', 'localhost:1521/XE');
    $stid = oci_parse($conn, 'select * from teste');
    oci_execute($stid);
    while (($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) != false) {
        foreach ($row as $item)
        {
            var_dump($row);
        }
    }

die;

// Connects to the XE service (i.e. database) on the "localhost" machine
/*
$conn = oci_pconnect('system', 'monica924', 'localhost/XE');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM employees');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";die;
*/



$oea_user = "system";
$ora_senha = "monica924";
$db="sinistro";
//$conn = oci_connect('hr', 'welcome', 'localhost/XE');
//$conn = oci_connect($username,$passwd,$db);die;

//Nome de usuário do banco de dados, nesse exemplo usei um usuário padrão do oracle, 
//caso não dê certo é por que ele deve ter sido deletado ou a senha alterada após 
//a instalação do oracle.
//$ora_user = "sngsprod"; 
//Senha do usuário no banco de dados.
//$ora_senha = "SFS#01PROD"; 
//Nesse bloco do código, especificamos as definições do banco de dados, como o protocolo 
//de comunicação o protocolo utilizado  foi o TCP, o ip do servidor onde se encontra o banco de dados 
//e a porta de conexão , geralmente por padrão a porta utilizada pelo Oracle  é a porta 1521, 
//caso não dê certo com a porta 1521, alguém pode ter alterado-a no durante a instalação,
//e por último a instância do banco que aqui utilizamos a instância ORCL. 
//Caso não dê certo nessa instância é por que no momento da instalação ela foi criada com um nome diferente.
$ora_bd = "(DESCRIPTION=
          (ADDRESS_LIST=
            (ADDRESS=(PROTOCOL=TCP) 
              (HOST=localhost)(PORT=1521)
            )
          )
          (CONNECT_DATA=(SERVICE_NAME=ORCL))
     )"; 
$ora_bd_ = "
sinistro =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";
$conn = oci_connect($ora_user,$ora_senha, $ora_bd=null);die;
//Nesta linha fazemos a conexão com o banco usando os variáveis preenchidas	
//anterior mente, logo em seguida fazemos uma verificação, se a conexão ocorreu 
//com sucesso, será impresso na tela uma mensagem avisando nos de tal,
//caso não, ele imprimirá na tela uma mensagem avisando que houve um erro
if ($ora_conexao == oci_connect($ora_user, $ora_senha, $ora_bd))   
    echo "Conexão bem sucedida. Usuário conectado: $ora_user"; 
else	
    echo "Erro na conexão com o Oracle.";					   

print_r($ora_conexao);

/// para testar ////
/*
 $conn = oci_connect('user' , 'password','
    (DESCRIPTION =
        (ADDRESS_LIST =
            (ADDRESS = (PROTOCOL=TCP)(HOST=serveurdeBDD)(PORT=1664))
        )
        (CONNECT_DATA =
            (SERVICE_NAME=monservicedulistener)
        )
    )');
         
                 
        if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
 
$stid = oci_parse($conn, 'SELECT SYSDATE FROM dual');
oci_execute($stid);
 
echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "") . "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n";
 */
?>