<?php 
//print phpinfo();die;

// Connects to the XE service (i.e. database) on the "localhost" machine
/*
$conn = oci_connect('hr', 'welcome', 'localhost/XE');
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

putenv("ORACLE_SID=prd1");
putenv("OraHome92=C:\oracle\ora92");
putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN");
putenv("ORACLE_HOME=C:\oracle\ora92");
putenv("TNS_ADMIN=C:\oracle\ora92\network\ADMIN\tnsnames.ora");

$username = "scott";
$passwd = "tiger";
$db="SNGS_ACCESS";
$conn = oci_connect('hr', 'welcome', 'localhost/XE');
//$conn = OCILogon($username,$passwd,$db);die;

//Nome de usuário do banco de dados, nesse exemplo usei um usuário padrão do oracle, 
//caso não dê certo é por que ele deve ter sido deletado ou a senha alterada após 
//a instalação do oracle.
$ora_user = "sngsprod"; 
//Senha do usuário no banco de dados.
$ora_senha = "SFS#01PROD"; 
//Nesse bloco do código, especificamos as definições do banco de dados, como o protocolo 
//de comunicação o protocolo utilizado  foi o TCP, o ip do servidor onde se encontra o banco de dados 
//e a porta de conexão , geralmente por padrão a porta utilizada pelo Oracle  é a porta 1521, 
//caso não dê certo com a porta 1521, alguém pode ter alterado-a no durante a instalação,
//e por último a instância do banco que aqui utilizamos a instância ORCL. 
//Caso não dê certo nessa instância é por que no momento da instalação ela foi criada com um nome diferente.
$ora_bd_old = "(DESCRIPTION=
          (ADDRESS_LIST=
            (ADDRESS=(PROTOCOL=TCP) 
              (HOST=192.168.0.2)(PORT=1521)
            )
          )
          (CONNECT_DATA=(SERVICE_NAME=ORCL))
     )"; 
$ora_bd = "
SNGSPROD.FEDERAL-PDC =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.10.110)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = PRD1)
    )
  )
BANCO.FEDERAL.LOCAL =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.10.110)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SERVICE_NAME = prd1)
    )
  )

SNGS.FEDERAL-PDC =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.10.110)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = prd1)
    )
  )

SNGS.FEDERAL.LOCAL =
  (DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.10.110)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = prd1)
    )
  )";
ocilogon($ora_user,$ora_senha, $ora_bd);die;
//Nesta linha fazemos a conexão com o banco usando os variáveis preenchidas	
//anterior mente, logo em seguida fazemos uma verificação, se a conexão ocorreu 
//com sucesso, será impresso na tela uma mensagem avisando nos de tal,
//caso não, ele imprimirá na tela uma mensagem avisando que houve um erro
if ($ora_conexao == oci_connect($ora_user, $ora_senha, $ora_bd))   
    echo "Conexão bem sucedida. Usuário conectado: $ora_user"; 
else	
    echo "Erro na conexão com o Oracle.";					   

print_r($ora_conexao);
?>