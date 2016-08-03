<?php
$sinistro = Utils::getUrlParam('sinistro');

$dao = new OdbcDao();
$search = new OdbcSearchCriteria();
$search->setsinistro($sinistro);
$tabela = 'Beneficiarios';
//$dados = $dao->listaColunas($tabela);
$listaTabelas=$dao->listaTabela();

$odbcs = $dao->find2($search);

$title = Utils::capitalize('Sistema de Sinistro');



///// area de teste /////
class teste {
    public function form(){
        echo "<div class='sinistro'>";
        echo "<table>
        <tr><td>SINISTRO: </td><td><input type='text' name='sinistro' /></td>
        <td>APÓLICE: </td><td><input type='text' name='apolice' /></td>
        <td>CERTIFICADO: </td><td><input type='text' name='certificado' /></td>
        <td>No. RAMO: </td><td><input type='text' name='ramo' /></td>
        <td>COBERTURA: </td><td><input type='text' name='cobertura' /></td></tr>
        <tr><td>DT SINISTRO: </td><td><input type='text' name='sinistro_data' /></td>
        <td>DT AVISO: </td><td><input type='text' name='aviso_data' /></td>
        <td>DT VIGENCIA INICIAL: </td><td><input type='text' name='vigencia_data' /></td>
        <td>DT DOC OK: </td><td><input type='text' name='doc_ok' /></td></tr>
        <tr><td>TITULAR: </td><td><input type='text' name='titular' /></td>
        <td>CPF: </td><td><input type='text' name='cpf' /></td>
        <td>AV/RUA/TRAV/PÇA/ALAM: </td><td><input type='text' name='rua' /></td></tr>
        <tr><td>ENDEREÇO: </td><td><input type='text' name='endereco' /></td>
        <td>NUMERO: </td><td><input type='text' name='numero' /></td>
        <td>COMPLEMENTO: </td><td><input type='text' name='complemento' /></td></tr>
        <tr><td>BAIRRO: </td><td><input type='text' name='bairro' /></td>
        <td>CIDADE: </td><td><input type='text' name='cidade' /></td>
        <td>ESTADO: </td><td><input type='text' name='estado' /></td></tr>
        <tr><td>CEP: </td><td><input type='text' name='cep' /></td>
        <td>TEL: </td><td><input type='tel' name='tel' /></td>
        <td>EMAIL: </td><td><input type='email' name='email' /></td>
        <td>TIPO SEGURO: </td><td><input type='text' name='tipo_seguro' /></td>
        <td>IMPORTÂNCIA SEGURADA: </td><td><input type='text' name='imp_segurada' /></td></tr>";
        echo "</table>";
        echo "</div>";
    }
}

//$teste = new teste();
//print_r($teste -> form());

//// fim area de teste ////


/*
TodoValidator::validateStatus($status);
*/
//// area de teste ////
/*
$tabela='Beneficiarios';
$sql="UPDATE `$tabela` SET `idtitular`='1' WHERE `idbenefi`=1";
$sql2="SELECT * FROM `$tabela` WHERE `idbenefi`=1";

$result=  odbc_exec($conn,$sql);
$result2=  odbc_exec($conn,$sql2);
odbc_commit($conn);
var_dump($result);
ECHO '<BR>';
$i=2;
$campo=odbc_num_fields($result2);
$campo2=odbc_field_name($result2,$i);
print_r($campo2);
echo ' -> ';
echo(odbc_result($result2,$campo2));

//// fim area de teste ////


//// fecha conexao ////	
odbc_close($conn);
	
$table="Beneficiarios";
$sql = "SELECT * FROM $table"; 
$result=odbc_exec($conn,$sql);
//odbc_result_all($result, 'id="users" class="listing"');
//odbc_result_all($result, 'border=1');
odbc_result_all($result, 'Border=0 cellspacing=0 cellpadding=5', "style='FONT-FAMILY:Tahoma; FONT-SIZE:8pt; BORDER-BOTTOM:solid 1pt gree'");
while ($rows = odbc_fetch_object($result)) {
    //print $rows->COLUMNNAME;
}
 * 
 */
?>
