<?php
include "valida_cookies.inc";
include "fundo.php";
include "bdgen.php";
include "divfunc.php";

date_default_timezone_set("Brazil/East");
if(IsSet($_COOKIE["nome_usuario"])){
	$nome_usuario = $_COOKIE["nome_usuario"];
}
$encontra=mysql_query("select codigo,tipo from usuarios where username='$nome_usuario'");
$cod_usuario=mysql_result($encontra,0,"codigo");
$tipo=mysql_result($encontra,0,"tipo");
$codigo=$_GET["codigo"];
@$sla=$_GET["sla"];
@$chamado=$_GET['chamado'];

if ($sla){
	$sla=$_GET["sla"];
	$up=mysql_query("update chamados set sla='$sla' where numero=$codigo");
}
@$act=$_GET["act"];
$codigo=$_GET["codigo"];
@$status=$_GET["status"];
if ($status==7){
	$act="can";
}
@$deonde=$_GET["deonde"];
@$tipo=$_GET["tipo"];
@$escolha=$_GET["escolha"];
@$cliente=$_GET["cliente"];
@$data1=$_GET["data1"];
@$data2=$_GET["data2"];
@$testafec=$_GET["testafec"];
@$codigo_status=$_GET["cod_status"];
@$paga=$_GET["paga"];
if ($paga=="sim"){
	$vai=mysql_query("update chamados set pg=1 where numero=$codigo");
}elseif ($paga=="nao"){
	$vai=mysql_query("update chamados set pg=0 where numero=$codigo");
}
@$condpag=$_GET["condpag"];
@$formpag=$_GET["formpag"];
@$parcelas=$_GET["parcelas"];
@$v_par=$_GET["v_par"];
@$v_vista=$_GET["v_vista"];
@$data_pag=$_GET["data_pag"];
@$detpag=$_GET["detpag"];

if ($act=="upd"){
	$status=$_GET["status"];
	$chamado=$_GET['chamado'];
	if ($status==5){
		$sql = "UPDATE `chamados` SET `status`=5 WHERE `numero`='$chamado'";
		mysql_query($sql)or die(mysql_error());
		echo "<table border=0 width=100% height=80%><td align=center valign=center>";
		echo "<font size=3 face=verdana><b>Alterando...";
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"1;URL=det2.php?codigo=$codigo&cliente=$cliente&chamado=$chamado&data1=$data1&data2=$data2&escolha=$escolha&tipo=$tipo&deonde=$deonde&cod_status=$codigo_status\">";
		exit;
	}else{
		$achasol=mysql_query("select solucao,hinicio,hfim from chamados where numero=$codigo");
		if ($achasol){
			$solucao=mysql_result($achasol,0,"solucao");
			$hinicio=mysql_result($achasol,0,"hinicio");
			$hfim=mysql_result($achasol,0,"hfim");				
		}

		if(!$hinicio){
			$hinicio=$_GET["hinicio"];
		}
		if(!$hfim){
			$hfim=$_GET["hfim"];
		}
		if(!$solucao){
			echo "<script>var answer=confirm('Não foi dada a entrada de uma solução para este chamado.  Deseja entrar com a solução agora?');";
			echo "if (answer)";
			echo "{window.location='ed_cham2.php?codigo=$codigo&qual=solucao&act=upd&status=8&chamado=$chamado&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog'};";
			echo "else{window.location='det2.php?codigo=$codigo&chamado=$chamado'};";
			echo "</script>";
			exit;
		}		
		if((!$hinicio)||(!$hfim)){
			echo "<script>var answer=confirm('Não foi dada a entrada da hora de início ou fim para este chamado.  Deseja fazê-lo agora?');";
			echo "if (answer)";
			echo "{window.location='ed_cham2.php?codigo=$codigo&source=fim&qual=prog&act=upd&status=8&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog'};";
			echo "else{window.location='det2.php?codigo=$codigo&chamado=$chamado'};";
			echo "</script>";
			exit;
		}		
		if(!$_GET["fecha"]){
			echo "<script>var answer=confirm('Tem certeza de que deseja solicitar o fechamento deste chamado?');";
			echo "if (answer)";
			echo "{window.location='det2.php?codigo=$codigo&act=upd&status=8&fecha=1&chamado=$chamado'};";
			echo "else{window.location='det2.php?codigo=$codigo&chamado=$chamado'};";
			echo "</script>";
			exit;
		}		
		if($_GET["fecha"]){
			$agora=mktime();
			$qhora=mysql_query("select fechamento from chamados where numero=$codigo");
			$res=mysql_query("update chamados set status=8 where numero=$codigo");
			if ($qhora)
				$lin=mysql_num_rows($qhora);
			if ($lin)
				$fecha=mysql_result($qhora,0,"fechamento");
			if (!$fecha)
				$res=mysql_query("update chamados set fechamento=$agora where numero=$codigo");
			echo "<script>alert('Chamado encerrado com sucesso!')</script>"; 
			echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=tabela2.php\">";
			echo "<table border=0 width=100% height=80%><td align=center valign=center>";
			echo "<font size=3 face=verdana><b>Aguarde...";
			exit;
		}
	}	
}
$resultado=mysql_query("select * from chamados where numero='$chamado'");
if (!$resultado){
	echo "<table border=0 width=100% height=80%><td align=center valign=center>";
	echo "Chamado Nº <b> $chamado<p>";
	echo "Este chamado foi excluído do sistema.";
	echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=tabela2.php\">";
	exit;
}else{
	$linhas=mysql_num_rows($resultado);
	if (!$linhas){
		echo "<table border=0 width=100% height=80%><td align=center valign=center>";
		echo "Chamado Nº <b> $chamado<p>";
		echo "Este chamado foi excluído do sistema.";
		echo "<META HTTP-EQUIV=\"REFRESH\" CONTENT=\"2;URL=tabela2.php\">";
		exit;
	}	
}
$solucao=nl2br(mysql_result($resultado,0,"solucao"));
if (!$solucao)
	$solucao='&nbsp';
$agente=mysql_result($resultado,0,"agente");
if ($agente==10){
	$nome_agente="A DEFINIR";
}else{
	$cade=mysql_query("select nick from usuarios where codigo=$agente");
	if ($cade){
		$nome_agente=mysql_result($cade,0,"nick");
	}
}
$status=mysql_result($resultado,0,"status");
$descricao=nl2br(mysql_result($resultado,0,"descricao"));
if (!$descricao)
	$descricao='Sem descrição do problema.';

$cod_cliente=mysql_result($resultado,0,"codigo");
$obs=nl2br(mysql_result($resultado,0,"obs"));
if (!$obs)
	$obs='&nbsp';

$obs_cli=nl2br(mysql_result($resultado,0,"obs_cli"));
if (!$obs_cli)
	$obs_cli='&nbsp';

$sla=mysql_result($resultado,0,"sla");
if (!$sla){
	$sla='';
}
/*
$equip=mysql_result($resultado,0,"equip");
if (!$equip)
	$equip='';
*/
$prog=mysql_result($resultado,0,"prog");
if (!$prog){
	$nome_prog="NÃO AGENDADO";
}else{
	$nome_prog="Agendado para: ".timestamp_para_humano($prog);
}
$abertura=mysql_result($resultado,0,"abertura");
$abre=timestamp_para_humano($abertura);
$fechamento=mysql_result($resultado,0,"fechamento");
if ($fechamento){
	$fecha=substr(timestamp_para_humano($fechamento),0,10);
}
$nome_status=statusChamado($status);
if (!$solucao)
	$solucao="";

if (!$obs)
	$obs="";

/*
$res=mysql_query("select * from chamados where clientes='$cliente'") or die (mysql_error());
//$endereco=mysql_result($res,0,"endereco");
//mysql_result($res,0,"clientes");
//$cidade=mysql_result($res,0,"cidade");
//$estado=mysql_result($res,0,"estado");
//$bairro=mysql_result($res,0,"bairro");
//$contrato=mysql_result($res,0,"contrato");

if ($contrato)
	$valor_contrato="SIM";
else
	$valor_contrato="NÃO";

$res=mysql_query("select * from telefones where cod_cliente=$cod_cliente");
if ($res)
	$lin=mysql_num_rows($res);
if ($lin)
{$ddd=mysql_result($res,0,"ddd");
$telefone=mysql_result($res,0,"telefone");}
*/
echo "<form name=form5 action=det2.php?chamado=$chamado method=GET>";
echo "<table bgcolor=silver border=1 bordercolor=silver width=100% cellpadding=2 cellspacing=3>";
echo "<tr><td bgcolor=#DEDFDE align=center colspan=2>";
echo "<font face=verdana size=2><b>SLA: $sla</td></tr>";
echo "<tr height=350 bgcolor=white><td width=50% valign=top height=100%>";
echo "<table border=1 bordercolor=WHITE width=100% cellspacing=3 cellpadding=2>";
echo "<tr><td bgcolor=#DEDFDE valign=MIDDLE COLSPAN=4 align=CENTER><font size=2 face=VERDANA COLOR=RED><B>DADOS DO CLIENTE</td>";
echo "<tr><td valign=MIDDLE width=10% align=right><font size=1 face=tahoma>CLIENTE:</td><td valign=top COLSPAN=3><font size=2 face=verdana color=blue>$nome</td></tr>";
//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>ENDEREÇO:</td><td valign=top COLSPAN=3><font size=2 face=verdana color=blue>$endereco</td></tr>";
//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>BAIRRO:</td><td valign=top COLSPAN=3><font size=2 face=verdana color=blue>$bairro</td></tr>";
//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>CIDADE:</td><td valign=top COLSPAN=3><font size=2 face=verdana color=blue>$cidade</td></tr>";
//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>ESTADO:</td><td valign=top><font size=2 face=verdana color=blue>$estado</td>";
/*
echo "<td valign=MIDDLE align=right WIDTH=30%><font size=1 face=tahoma>TELEFONE:</td><td valign=top><font size=2 face=verdana color=blue>($ddd) $telefone</td></tr>";
*/
echo "</tr></table>";
echo "</td>";
echo "<td valign=top align=right width=50%>";
echo "<table border=1 bordercolor=white bgcolor=white width=100% cellspacing=3 cellpadding=2>";
echo "<tr><td bgcolor=#DEDFDE valign=MIDDLE COLSPAN=2 align=CENTER><font size=2 face=VERDANA COLOR=RED><B>DADOS DO CHAMADO</td>";
echo "<tr><td width=25% valign=MIDDLE align=right><font size=1 face=tahoma>ABERTURA:</td><td valign=top width=50%><font size=2 face=verdana color=blue>$abre</td></tr>";

if ($fechamento)
	echo "<tr><td width=25% valign=MIDDLE align=right><font size=1 face=tahoma>ENCERRAMENTO:</td><td valign=top><font size=2 face=verdana color=blue>$fecha</td></tr>";

//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>SLA:</td><td valign=top><font size=2 face=verdana color=blue><input type=text size=10 name=sla value=$sla><input type=submit value=Enviar></td></tr>";
//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>CONTRATO:</td><td valign=top><font size=2 face=verdana color=blue>$valor_contrato</td></tr>";

echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>LOGIN:</td><td valign=top align=left";
echo "><font size=2 face=verdana color=blue>$nome_usuario</td></tr>";

//echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>EQUIPAMENTO:</td><td valign=top align=left><font size=2 face=verdana color=blue>$equip</td></tr>";
echo "<tr><td valign=MIDDLE align=right><font size=1 face=tahoma>TÉCNICO:</td><td valign=top";
echo "><font size=2 face=verdana color=blue>$agente</td></tr>";

echo "<tr><td valign=middle align=right><font size=1 face=tahoma>STATUS:</td><td valign=top align=left><font size=2 face=verdana color=blue>";

if ($status==4){
	$chamado=$_GET['chamado'];
	//@$status_old=mysql_result($res,0,"status");
	//$res=mysql_query("select * from status order by status");
/*
	if ($res)
		$linhas=mysql_num_rows($res);
	@$status_old=$nome_status;
	if ($status_old=="NOVO")
		$status_old="SOLICITADA ABERTURA";
	if ($linhas){
*/
		echo "<input type=hidden name=solucao value='$solucao'>";
		echo "<input type=hidden name=act value=upd>";
		echo "<input type=hidden name=codigo value=$codigo>";
		echo "<input type=hidden name=chamado value=$chamado>";
		echo "<select name=status onchange=\"submit()\">";
		echo "<option value=''>$nome_status</option>";
		echo "<option value=5>FECHADO</option>";
/*
		for ($i=0;$i<$linhas;$i++){
			$nome_status=maiusculo(mysql_result($res,$i,"status"));
			$cod_status=mysql_result($res,$i,"codigo");
			if ($status!=$cod_status)
				if (($cod_status>$cod_status_old)&&($cod_status!=6))
					if (($cod_status>0)&&($cod_status<3) ||($cod_status==8)||($cod_status==11))
					{
						IF ($cod_status==0)
							$nome_status="SOLICITADA ABERTURA";
						IF ($cod_status==8)
							$nome_status="SOLICITAR FECHAMENTO";
						echo "<option value='$cod_status'>$nome_status</option>";
					}
			}
*/
			echo "</select></td>";
	}else{
		switch($status){
			case 1:
			echo "AGUARDANDO RETORNO";
			break;
			case 2:
			echo "PENDÊNCIA GERAL";
			break;
			case 3:
			echo "PENDÊNCIA TÉCNICA";
			break;
			case 5:
			echo "FECHADO";
			break;
		}
	}
echo "</td></tr></table>";
echo "</form>";
echo "</td></tr>";
echo "<tr><td bgcolor=white colspan=2><table border=0 bgcolor=white cellpadding=2 cellspacing=3 width=100%>";
echo "<tr><td bgcolor=#DEDFDE valign=MIDDLE COLSPAN=2 align=CENTER><font size=2 face=VERDANA COLOR=RED><B>DETALHES DO ATENDIMENTO</td>";
//echo "<tr><td colspan=2>&nbsp</td></tr>";
echo "<tr><td colspan=2><hr color=#DEDFDE></td></tr>";
echo "<tr><td WIDTH=15% valign=middle align=right><font size=1 face=tahoma>SOLICITAÇÃO/DEFEITO:</td><td valign=top";
/*
if (($status<3)||($status=9))
	echo " align=left onmouseover=\"this.style.backgroundColor='yellow';this.style.cursor='hand';\" style=\"CURSOR: hand; BACKGROUND-COLOR: white\" onmouseout=\"this.style.backgroundColor='white';\" onclick=\"link('ed_cham2.php?codigo=$codigo&qual=descricao&chamado=$chamado&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog')\"";
*/
echo "><font size=2 face=verdana color=blue>$descricao</td></tr>";
echo "<tr><td colspan=2><hr color=#DEDFDE></td></tr>";
echo "<tr><td valign=middle align=right><font size=1 face=tahoma>SOLUÇÃO:</td><td valign=top";
if ($cod_usuario==4){
	echo" align=left onmouseover=\"this.style.backgroundColor='yellow';this.style.cursor='hand';\" style=\"CURSOR: hand; BACKGROUND-COLOR: white\" onmouseout=\"this.style.backgroundColor='white';\" onclick=\"link('ed_cham2.php?codigo=$codigo&qual=solucao&chamado=$chamado&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog')\"";
}
echo "><font size=2 face=verdana color=blue>$solucao</td></tr>";
echo "<tr><td colspan=2><hr color=#DEDFDE></td></tr>";

echo "<tr><td valign=middle align=right><font size=1 face=tahoma>OBSERVAÇÕES CLIENTE:</td><td valign=top";
if ($cod_usuario<4 && $status<>5){
	echo " align=left onmouseover=\"this.style.backgroundColor='yellow';this.style.cursor='hand';\" style=\"CURSOR: hand; BACKGROUND-COLOR: white\" onmouseout=\"this.style.backgroundColor='white';\" onclick=\"link('ed_cham2.php?codigo=$codigo&qual=obs_cli&chamado=$chamado&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog')\"";
}
echo "><font size=2 face=verdana color=blue>$obs_cli</td></tr>";
echo "<tr><td colspan=2><hr color=#DEDFDE></td></tr>";

echo "<tr><td valign=middle align=right><font size=1 face=tahoma>OBSERVAÇÕES TÉCNICAS:</td><td valign=top";
if ($status==4){
	echo " align=left onmouseover=\"this.style.backgroundColor='yellow';this.style.cursor='hand';\" style=\"CURSOR: hand; BACKGROUND-COLOR: white\" onmouseout=\"this.style.backgroundColor='white';\" onclick=\"link('ed_cham2.php?codigo=$codigo&qual=obs&chamado=$chamado&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog')\"";
}
echo "><font size=2 face=verdana color=blue>$obs</td></tr>";
echo "<tr><td colspan=2><hr color=#DEDFDE></td></tr>";

echo "<tr><td valign=middle align=right><font size=1 face=tahoma>ATENDIMENTO:</td><td valign=top";
if ($status==4){
	echo " align=left onmouseover=\"this.style.backgroundColor='yellow';this.style.cursor='hand';\" style=\"CURSOR: hand; BACKGROUND-COLOR: white\" onmouseout=\"this.style.backgroundColor='white';\" onclick=\"link('ed_cham2.php?codigo=$codigo&qual=prog&chamado=$chamado&agente=$agente&descricao=$descricao&obs=$obs&obs_cli=$obs_cli&solucao=$solucao&prog=$prog')\"";
}
echo "><font size=2 face=verdana color=blue>$nome_prog";
/*
if (($hinicio) && ($hfim)){
	echo " - Atendido em: $fecha, Início: ".substr($inicio,11,5).", Fim: ".substr($fim,11,5);
}
*/
echo "</td></tr>";
echo "<tr><td colspan=2><hr color=#DEDFDE></td></tr>";
echo "</table>";
echo "</td></tr>";
echo "<tr><td bgcolor=white colspan=2 align=center valign=center>";
echo "</td></tr></table>";
echo "</td></tr>";
echo "<tr><td bgcolor=white colspan=2 align=center valign=center>";
echo "</td></tr>";
echo "<tr><td colspan=2 align=center valign=center>";
echo "<div align=center><table><td>"; 
	echo "<input type=button value=\"Voltar para Controle\" onclick=\"location.href='tabela2.php'\">";
	echo"<input type=button value=\"Gerar Relatório\" onclick=\"printLink('gera.php?codigo=$codigo&chamado=$chamado&status=$status','_blank')\">";
/*
}
if (!$_GET["detpag"]){
	echo "</td></table></div>";
}
*/
echo "</td></tr>";
echo "<tr><td colspan=3><table width=100% bgcolor=#DEDFDE border=0><tr><td><font size=1 face=verdana color=red><center><b>TECNOLOGIA DA INFORMAÇÃO</td></tr></table>";
echo "</table>";
echo "</form>";
mysql_close($conexao);
exit;
?>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                