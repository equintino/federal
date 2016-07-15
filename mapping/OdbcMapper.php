<?php
class OdbcMapper {
    private function __construct() {
    }
    public static function map(Odbc $odbc, array $properties) {
        if (array_key_exists('id', $properties)) {
            $odbc->setId($properties['id']);
        }
        if (array_key_exists('priority', $properties)) {
            $odbc->setPriority($properties['priority']);
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $odbc->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('due_on', $properties)) {
            $dueOn = self::createDateTime($properties['due_on']);
            if ($dueOn) {
                $odbc->setDueOn($dueOn);
            }
        }
        if (array_key_exists('eliminacao', $properties)) {
            $eliminacao = self::createDateTime($properties['eliminacao']);
            if ($eliminacao) {
                $odbc->setEliminacao($eliminacao);
            }
        }
        if (array_key_exists('eliminacao_novo', $properties)) {
            $eliminacao_novo = self::createDateTime($properties['eliminacao_novo']);
            if ($eliminacao_novo) {
                $odbc->setEliminacao_novo($eliminacao_novo);
            }
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $odbc->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('eficaz_data', $properties)) {
            $eficaz_data = self::createDateTime($properties['eficaz_data']);
            if ($eficaz_data) {
                $odbc->setEficazData($eficaz_data);
            }
        }
        if (array_key_exists('title', $properties)) {
            $odbc->setTitle(trim($properties['title']));
        }
        if (array_key_exists('andamento', $properties)) {
            $odbc->setAndamento($properties['andamento']);
        }
        if (array_key_exists('description', $properties)) {
            $odbc->setDescription(trim($properties['description']));
        }
        if (array_key_exists('comment', $properties)) {
            $odbc->setComment(trim($properties['comment']));
        }
        if (array_key_exists('status', $properties)) {
            $odbc->setStatus($properties['status']);
        }
        if (array_key_exists('deleted', $properties)) {
            $odbc->setDeleted($properties['deleted']);
        }
        if (array_key_exists('descricao', $properties)){
            $odbc->setDescricao($properties['descricao']);
        }
        if (array_key_exists('numero', $properties)) {
            $odbc->setNumero(trim($properties['numero']));
        }
        if (array_key_exists('origem', $properties)){
            $odbc->setOrigem($properties['origem']);
        }
        if (array_key_exists('tipoacao', $properties)){
            $odbc->setTipoacao($properties['tipoacao']);
        }
        if (array_key_exists('processo', $properties)){
            $odbc->setProcesso($properties['processo']);
        }
        if (array_key_exists('identificador', $properties)){
            $odbc->setIdentificador($properties['identificador']);
        }
        if (array_key_exists('causa', $properties)){
            $odbc->setCausa($properties['causa']);
        }
        if (array_key_exists('imediata', $properties)){
            $odbc->setImediata($properties['imediata']);
        }
        if (array_key_exists('corretiva', $properties)){
            $odbc->setCorretiva($properties['corretiva']);
        }
        if (array_key_exists('implementador', $properties)){
            $odbc->setImplementador($properties['implementador']);
        }
        if (array_key_exists('reg_eficacia', $properties)){
            $odbc->setRegEficacia($properties['reg_eficacia']);
        }
        if (array_key_exists('resp_verificacao', $properties)){
            $odbc->setRespVerificacao($properties['resp_verificacao']);
        }
        if (array_key_exists('novo_rnc', $properties)) {
            $odbc->setNovoRnc($properties['novo_rnc']);
        }
        if (array_key_exists('eficaz', $properties)) {
            $odbc->setEficaz($properties['eficaz']);
        }
    }
    private static function createDateTime($input) {
        //return DateTime::createFromFormat('j-n-Y H:i:s', $input);
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }
}