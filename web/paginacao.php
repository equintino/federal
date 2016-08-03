<?php
   include '../dao/OdbcDao.php';
   include '../dao/OdbcSearchCriteria.php';
   include '../config/Config.php';
   include '../model/Odbc.php';
   include '../mapping/OdbcMapper.php';
   include '../validation/OdbcValidator.php';
          $tabela1='sinipend';
          $tabela2='Beneficiarios';
          $file_x='exclui';
          
          $conn=odbc_connect('federal','','');
          
// Selecionar servidor
//$conectar = mysql_connect("servidor", "usuario", "senha") or die ("Erro ao logar no BD");
// Selecionar BD
//mysql_select_db("bancodedados", $conectar);

// Pegar a página atual por GET
@$p = $_GET["p"];
// Verifica se a variável tá declarada, senão deixa na primeira página como padrão
if(isset($p)) {
$p = $p;
} else {
$p = 1;
}
// Defina aqui a quantidade máxima de registros por página.
$qnt = 5;
// O sistema calcula o início da seleção calculando: 
// (página atual * quantidade por página) - quantidade por página
$inicio = ($p*$qnt) - $qnt;
// Seleciona no banco de dados com o LIMIT indicado pelos números acima
$sql = "SELECT top 5 * FROM $tabela1";

//print_r($sql);die;
// Executa o Query

//$query=odbc_exec($conn, $sql);
          //var_dump($query);die;
//$sql_query = mysql_query($sql_select);
          $result=  odbc_exec($conn,$sql);
          //odbc_result_all($result,'border=1');
          //die;

//ar_dump(odbc_fetch_array($result));die;
// Cria um while para pegar as informações do BD
while($array = odbc_fetch_array($result)) {
// Variável para capturar o campo "nome" no banco de dados
$nome = $array["TITULAR"];
// Exibe o nome que está no BD e pula uma linha
echo $nome." <br /> ";
}
//print_r($array);die;

// Depois que selecionou todos os nome, pula uma linha para exibir os links(próxima, última...)
echo "<br />";

$pag=11;
// Faz uma nova seleção no banco de dados, desta vez sem LIMIT, 
// para pegarmos o número total de registros
$sql_select_all = "SELECT top 2 * FROM $tabela1 where idtitular > $pag order by idtitular";
//print_r($sql_select_all);
//die;
// Executa o query da seleção acimas
$sql_query_all = odbc_exec($conn,$sql_select_all);
//print_r($sql_query_all);
//die;
// Gera uma variável com o número total de registros no banco de dados
$total_registros = odbc_num_rows($sql_query_all);
//print_r($total_registros);die;
// Gera outra variável, desta vez com o número de páginas que será precisa. 
// O comando ceil() arredonda "para cima" o valor
print_r(odbc_result_all($sql_query_all));die;
$pags = ceil($total_registros/$qnt);
// Número máximos de botões de paginação
$max_links = 3;
// Exibe o primeiro link "primeira página", que não entra na contagem acima(3)
echo "<a href=\"paginacao.php?p=1\" target=\"_self\">primeira pagina</a> ";
// Cria um for() para exibir os 3 links antes da página atual
for($i = $p-$max_links; $i <= $p-1; $i++) {
// Se o número da página for menor ou igual a zero, não faz nada
// (afinal, não existe página 0, -1, -2..)
if($i <=0) {
//faz nada
// Se estiver tudo OK, cria o link para outra página
} else {
echo "<a href=\"paginacao.php?p=".$i."\" target=\"_self\">".$i."</a> ";
}
}
// Exibe a página atual, sem link, apenas o número
echo $p." ";
// Cria outro for(), desta vez para exibir 3 links após a página atual
for($i = $p+1; $i <= $p+$max_links; $i++) {
// Verifica se a página atual é maior do que a última página. Se for, não faz nada.
if($i > $pags)
{
//faz nada
}
// Se tiver tudo Ok gera os links.
else
{
echo "<a href=\"paginacao.php?p=".$i."\" target=\"_self\">".$i."</a> ";
}
}
// Exibe o link "última página"
echo "<a href=\"paginacao.php?p=".$pags."\" target=\"_self\">ultima pagina</a> ";
?>