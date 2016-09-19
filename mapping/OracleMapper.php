<?php
/**
 * Mapper for {@link Todo} from array.
 * @see TodoValidator
 */
final class OracleMapper {
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
     * @param Todo $oracle
     * @param array $properties
     */
    public static function map(Oracle $oracle, array $properties) {
     //print_r($properties);die;
        if (array_key_exists('id', $properties)) {
            $oracle->setId($properties['id']);
        }
        if (array_key_exists('ID', $properties)) {
            $oracle->setid($properties['ID']);
        }
        if (array_key_exists('idtitular', $properties)) {
            $oracle->setidtitular($properties['idtitular']);
        }
        if (array_key_exists('priority', $properties)) {
            $oracle->setPriority($properties['priority']);
        }
        if (array_key_exists('created_on', $properties)) {
            $createdOn = self::createDateTime($properties['created_on']);
            if ($createdOn) {
                $oracle->setCreatedOn($createdOn);
            }
        }
        if (array_key_exists('due_on', $properties)) {
            $dueOn = self::createDateTime($properties['due_on']);
            if ($dueOn) {
                $oracle->setDueOn($dueOn);
            }
        }
        if (array_key_exists('ESI', $properties)) {
            $ESI = $properties['ESI'];
            if ($ESI) {
                $oracle->setESI($ESI);
            }
        }
        if (array_key_exists('ARQUIVO', $properties)) {
            $ARQUIVO = $properties['ARQUIVO'];
            if ($ARQUIVO) {
                $oracle->setARQUIVO($ARQUIVO);
            }
        }
        if (array_key_exists('last_modified_on', $properties)) {
            $lastModifiedOn = self::createDateTime($properties['last_modified_on']);
            if ($lastModifiedOn) {
                $oracle->setLastModifiedOn($lastModifiedOn);
            }
        }
        if (array_key_exists('AVISO', $properties)) {
            $AVISO = self::createDateTime($properties['AVISO']);
            if ($AVISO) {
                $oracle->setAVISO($AVISO);
            }
        }
        if (array_key_exists('SINISTRO', $properties)) {
            $oracle->setSINISTRO($properties['SINISTRO']);
        }
        if (array_key_exists('PESSOA', $properties)) {
            $oracle->setPESSOA($properties['PESSOA']);
        }
        if (array_key_exists('CERTIFICADO', $properties)) {
            $oracle->setCERTIFICADO($properties['CERTIFICADO']);
        }
        if (array_key_exists('CPF', $properties)) {
            $oracle->setCPF($properties['CPF']);
        }
        if (array_key_exists('status', $properties)) {
            $oracle->setStatus($properties['status']);
        }
        if (array_key_exists('deleted', $properties)) {
            $oracle->setDeleted($properties['deleted']);
        }
        if (array_key_exists('OBS', $properties)){
            $oracle->setOBS($properties['OBS']);
        }
        if (array_key_exists('SEGURADOS', $properties)) {
            $oracle->setSEGURADOS($properties['SEGURADOS']);
        }
        if (array_key_exists('N_PROC', $properties)){
            $oracle->setN_PROC($properties['N_PROC']);
        }
        if (array_key_exists('N_NATIGO', $properties)){
            $oracle->setN_NATIGO($properties['N_NATIGO']);
        }
        if (array_key_exists('NATUREZA', $properties)){
            $oracle->setNATUREZA($properties['NATUREZA']);
        }
        if (array_key_exists('PROCED', $properties)){
            $oracle->setPROCED($properties['PROCED']);
        }
        if (array_key_exists('UF', $properties)){
            $oracle->setUF($properties['UF']);
        }
        if (array_key_exists('CIDADE', $properties)){
            $oracle->setCIDADE($properties['CIDADE']);
        }
        if (array_key_exists('FORO', $properties)){
            $oracle->setFORO($properties['FORO']);
        }
        if (array_key_exists('N_VARA', $properties)){
            $oracle->setN_VARA($properties['N_VARA']);
        }
        if (array_key_exists('VARA', $properties)){
            $oracle->setVARA($properties['VARA']);
        }
        if (array_key_exists('CLIENTE', $properties)){
            $oracle->setCLIENTE($properties['CLIENTE']);
        }
        if (array_key_exists('RECLAMANTE', $properties)) {
            $oracle->setRECLAMANTE($properties['RECLAMANTE']);
        }
        if (array_key_exists('FASE', $properties)) {
            $oracle->setFASE($properties['FASE']);
        }
        if (array_key_exists('TP_PROBA', $properties)){
            $oracle->setTP_PROBA($properties['TP_PROBA']);
        }
        if (array_key_exists('PROVAVIL', $properties)){
            $oracle->setPROVAVIL($properties['PROVAVIL']);
        }
        if (array_key_exists('VLPEDIDO', $properties)){
            $oracle->setVLPEDIDO($properties['VLPEDIDO']);
        }
        if (array_key_exists('DTPEDIDO', $properties)){
            $oracle->setDTPEDIDO($properties['DTPEDIDO']);
        }
        if (array_key_exists('TPACAO', $properties)) {
            $oracle->setTPACAO($properties['TPACAO']);
        }
        if (array_key_exists('DT_AVISO', $properties)) {
            $oracle->setDT_AVISO($properties['DT_AVISO']);
        }
        if (array_key_exists('vlindeniza', $properties)) {
            $oracle->setvlindeniza($properties['vlindeniza']);
        }
        if (array_key_exists('IMPORTANCIA_SEGURADA', $properties)) {
            $oracle->setIMPORTANCIA_SEGURADA($properties['IMPORTANCIA_SEGURADA']);
        }
        
        if (array_key_exists('COD_SIN', $properties)) {
            $oracle->setCOD_SIN($properties['COD_SIN']);
        }
        if (array_key_exists('DTH_FASE_SIN', $properties)) {
            $oracle->setDTH_FASE_SIN($properties['DTH_FASE_SIN']);
        }
        if (array_key_exists('COD_FASE_SIN', $properties)) {
            $oracle->setCOD_FASE_SIN($properties['COD_FASE_SIN']);
        }
        if (array_key_exists('OBS_FASE_SIN', $properties)) {
            $oracle->setOBS_FASE_SIN($properties['OBS_FASE_SIN']);
        }
        if (array_key_exists('USR_ATU', $properties)) {
            $oracle->setUSR_ATU($properties['USR_ATU']);
        }
        if (array_key_exists('COD_DOC_EXTER', $properties)) {
            $oracle->setCOD_DOC_EXTER($properties['COD_DOC_EXTER']);
        }
        if (array_key_exists('NUM_ITEM_EXTER', $properties)) {
            $oracle->setNUM_ITEM_EXTER($properties['NUM_ITEM_EXTER']);
        }
        if (array_key_exists('SEQ_PGTO_SIN', $properties)) {
            $oracle->setSEQ_PGTO_SIN($properties['SEQ_PGTO_SIN']);
        } 
        if (array_key_exists('POSSIVEL', $properties)) {
            $oracle->setPOSSIVEL($properties['POSSIVEL']);
        }
        if (array_key_exists('PROVAVEL', $properties)) {
            $oracle->setPROVAVEL($properties['PROVAVEL']);
        }
        if (array_key_exists('PARTE_CONTRARIA', $properties)) {
            $oracle->setPARTE_CONTRARIA($properties['PARTE_CONTRARIA']);
        }
        if (array_key_exists('VALOR_PEDIDO', $properties)) {
            $oracle->setVALOR_PEDIDO($properties['VALOR_PEDIDO']);
        }
        if (array_key_exists('HONORARIOS', $properties)) {
            $oracle->setHONORARIOS($properties['HONORARIOS']);
        }  
    }
    private static function createDateTime($input) {
        //return DateTime::createFromFormat('j-n-Y H:i:s', $input);
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }
}
?>