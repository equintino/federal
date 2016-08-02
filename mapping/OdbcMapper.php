<?php
class OdbcMapper {
    private function __construct() {
    }
    public static function map(Odbc $odbc, array $properties) {
        if (array_key_exists('idbenefi', $properties)) {
            $odbc->setidbenefi($properties['idbenefi']);
        }
        if (array_key_exists('idtitular', $properties)) {
            $odbc->setidtitular($properties['idtitular']);
        }
        if (array_key_exists('TITULAR', $properties)){
            $odbc->setTITULAR($properties['TITULAR']);
        }
        if (array_key_exists('IMPORTANCIA_SEGURADA', $properties)){
            $odbc->setIMPORTANCIA_SEGURADA($properties['IMPORTANCIA_SEGURADA']);
        }
        if (array_key_exists('sinistro', $properties)) {
            $odbc->setsinistro($properties['sinistro']);
        }
        if (array_key_exists('certificado', $properties)) {
            $odbc->setcertificado($properties['certificado']);
        }
        if (array_key_exists('SINISTRO', $properties)) {
            $odbc->setSINISTRO($properties['SINISTRO']);
        }
        if (array_key_exists('apolice', $properties)) {
            $odbc->setapolice($properties['apolice']);
        }
        if (array_key_exists('endosso', $properties)) {
            $odbc->setendosso($properties['endosso']);
        }
        if (array_key_exists('nome', $properties)) {
            $odbc->setnome($properties['nome']);
        }
        if (array_key_exists('tipo', $properties)) {
            $odbc->settipo($properties['tipo']);
        }
        if (array_key_exists('endereco', $properties)) {
            $odbc->setendereco($properties['endereco']);
        }
        if (array_key_exists('numero', $properties)) {
            $odbc->setnumero($properties['numero']);
        }
        if (array_key_exists('complemento', $properties)) {
            $odbc->setcomplemento($properties['complemento']);
        }
        if (array_key_exists('bairro', $properties)) {
            $odbc->setbairro($properties['bairro']);
        }
        if (array_key_exists('municipio', $properties)) {
            $odbc->setmunicipio($properties['municipio']);
        }
        if (array_key_exists('estado', $properties)) {
            $odbc->setestado($properties['estado']);
        }
        if (array_key_exists('uf', $properties)) {
            $odbc->setuf($properties['uf']);
        }
        if (array_key_exists('cep', $properties)) {
            $odbc->setcep($properties['cep']);
        }
        if (array_key_exists('vlindeniza', $properties)) {
            $odbc->setvlindeniza($properties['vlindeniza']);
        }
        if (array_key_exists('tpcobertura', $properties)) {
            $odbc->settpcobertura($properties['tpcobertura']);
        }
        if (array_key_exists('cpf', $properties)) {
            $odbc->setcpf($properties['cpf']);
        }
        if (array_key_exists('identidade', $properties)) {
            $odbc->setidentidade($properties['identidade']);
        }
        if (array_key_exists('percentual', $properties)) {
            $odbc->setpercentual($properties['percentual']);
        }
        if (array_key_exists('tel_fixo', $properties)) {
            $odbc->settel_fixo($properties['tel_fixo']);
        }
        if (array_key_exists('tel_cel', $properties)) {
            $odbc->settel_cel($properties['tel_cel']);
        }
        if (array_key_exists('email', $properties)) {
            $odbc->setemail($properties['email']);
        }
        if (array_key_exists('banco', $properties)) {
            $odbc->setbanco($properties['banco']);
        }
        if (array_key_exists('agencia', $properties)) {
            $odbc->setagencia($properties['agencia']);
        }
        if (array_key_exists('conta', $properties)) {
            $odbc->setconta($properties['conta']);
        }
        
        if (array_key_exists('CÓDIGO', $properties)) {
            $odbc->setCÓDIGO($properties['CÓDIGO']);
        }
        if (array_key_exists('COBERTURA', $properties)) {
            $odbc->setCOBERTURA($properties['COBERTURA']);
        }
        /*
        if (array_key_exists('priority', $properties)) {
            $odbc->setPriority($properties['priority']);
        }
         * 
         */
        if (array_key_exists('abertura', $properties)) {
            $abertura = self::createDateTime($properties['abertura']);
            if ($abertura) {
                $odbc->setCreatedOn($abertura);
            }
        }
        if (array_key_exists('due_on', $properties)) {
            $dueOn = self::createDateTime($properties['due_on']);
            if ($dueOn) {
                $odbc->setDueOn($dueOn);
            }
        }
        if (array_key_exists('modificacao', $properties)) {
            $modificacao = self::createDateTime($properties['modificacao']);
            if ($modificacao) {
                $odbc->setmodificacao($modificacao);
            }
        }
        if (array_key_exists('status', $properties)) {
            $odbc->setStatus($properties['status']);
        }
        if (array_key_exists('exclui', $properties)) {
            $odbc->setexclui($properties['exclui']);
        }
        //echo "<br><br><br>";
        //print_r($properties);
        //echo "<br><br><br>";
    }
    private static function createDateTime($input) {
        //return DateTime::createFromFormat('j-n-Y H:i:s', $input);
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }
}