<?php
/**
 * Mapper for {@link Todo} from array.
 * @see TodoValidator
 */
final class TodoMapper {
    private function __construct() {
    }
    /**
     * Maps array to the given {@link Todo}.
     * <p>
     * Expected properties are:
     * <ul>
     *   <li>id</li>
     *   <li>priority</li>
     *   <li>created_on</li>
     *   <li>due_on</li>
     *   <li>last_modified_on</li>
     *   <li>title</li>
     *   <li>description</li>
     *   <li>comment</li>
     *   <li>status</li>
     *   <li>deleted</li>
     * </ul>
     * @param Todo $todo
     * @param array $properties
     */
    public static function map(Todo $todo, array $properties) {
        if (array_key_exists('id', $properties)) {
            $todo->setId($properties['id']);
        }
        if (array_key_exists('idtitular', $properties)) {
            $todo->setidtitular($properties['idtitular']);
        }
        if (array_key_exists('priority', $properties)) {
            $todo->setPriority($properties['priority']);
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $todo->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('due_on', $properties)) {
            $dueOn = self::createDateTime($properties['due_on']);
            if ($dueOn) {
                $todo->setDueOn($dueOn);
            }
        }
        if (array_key_exists('ESI', $properties)) {
            $ESI = $properties['ESI'];
            if ($ESI) {
                $todo->setESI($ESI);
            }
        }
        if (array_key_exists('ARQUIVO', $properties)) {
            $ARQUIVO = $properties['ARQUIVO'];
            if ($ARQUIVO) {
                $todo->setARQUIVO($ARQUIVO);
            }
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $todo->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('AVISO', $properties)) {
            $AVISO = self::createDateTime($properties['AVISO']);
            if ($AVISO) {
                $todo->setAVISO($AVISO);
            }
        }
        if (array_key_exists('SINISTRO', $properties)) {
            $todo->setSINISTRO($properties['SINISTRO']);
        }
        if (array_key_exists('PESSOA', $properties)) {
            $todo->setPESSOA($properties['PESSOA']);
        }
        if (array_key_exists('CERTIFICADO', $properties)) {
            $todo->setCERTIFICADO($properties['CERTIFICADO']);
        }
        if (array_key_exists('CPF', $properties)) {
            $todo->setCPF($properties['CPF']);
        }
        if (array_key_exists('status', $properties)) {
            $todo->setStatus($properties['status']);
        }
        if (array_key_exists('deleted', $properties)) {
            $todo->setDeleted($properties['deleted']);
        }
        if (array_key_exists('OBS', $properties)){
            $todo->setOBS($properties['OBS']);
        }
        if (array_key_exists('SEGURADOS', $properties)) {
            $todo->setSEGURADOS($properties['SEGURADOS']);
        }
        if (array_key_exists('N_PROC', $properties)){
            $todo->setN_PROC($properties['N_PROC']);
        }
        if (array_key_exists('N_NATIGO', $properties)){
            $todo->setN_NATIGO($properties['N_NATIGO']);
        }
        if (array_key_exists('NATUREZA', $properties)){
            $todo->setNATUREZA($properties['NATUREZA']);
        }
        if (array_key_exists('PROCED', $properties)){
            $todo->setPROCED($properties['PROCED']);
        }
        if (array_key_exists('UF', $properties)){
            $todo->setUF($properties['UF']);
        }
        if (array_key_exists('CIDADE', $properties)){
            $todo->setCIDADE($properties['CIDADE']);
        }
        if (array_key_exists('FORO', $properties)){
            $todo->setFORO($properties['FORO']);
        }
        if (array_key_exists('N_VARA', $properties)){
            $todo->setN_VARA($properties['N_VARA']);
        }
        if (array_key_exists('VARA', $properties)){
            $todo->setVARA($properties['VARA']);
        }
        if (array_key_exists('CLIENTE', $properties)){
            $todo->setCLIENTE($properties['CLIENTE']);
        }
        if (array_key_exists('RECLAMANTE', $properties)) {
            $todo->setRECLAMANTE($properties['RECLAMANTE']);
        }
        if (array_key_exists('FASE', $properties)) {
            $todo->setFASE($properties['FASE']);
        }
        if (array_key_exists('TP_PROBA', $properties)){
            $todo->setTP_PROBA($properties['TP_PROBA']);
        }
        if (array_key_exists('PROVAVIL', $properties)){
            $todo->setPROVAVIL($properties['PROVAVIL']);
        }
        if (array_key_exists('VLPEDIDO', $properties)){
            $todo->setVLPEDIDO($properties['VLPEDIDO']);
        }
        if (array_key_exists('DTPEDIDO', $properties)){
            $todo->setDTPEDIDO($properties['DTPEDIDO']);
        }
        if (array_key_exists('TPACAO', $properties)) {
            $todo->setTPACAO($properties['TPACAO']);
        }
        if (array_key_exists('DT_AVISO', $properties)) {
            $todo->setDT_AVISO($properties['DT_AVISO']);
        }
        if (array_key_exists('vlindeniza', $properties)) {
            $todo->setvlindeniza($properties['vlindeniza']);
        }
        if (array_key_exists('IMPORTANCIA_SEGURADA', $properties)) {
            $todo->setIMPORTANCIA_SEGURADA($properties['IMPORTANCIA_SEGURADA']);
        }
    }
    private static function createDateTime($input) {
        //return DateTime::createFromFormat('j-n-Y H:i:s', $input);
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }
}
?>