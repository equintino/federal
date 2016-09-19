<?php
/**
 * Model class representing one TODO item.
 */
final class Oracle {

    // priority
    const PRIORITY_IMEDIATA = 0;
    const PRIORITY_HIGH = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_LOW = 3;
    // status
    const STATUS_NULL = null;
    const STATUS_PENDING = "PENDENTE";
    const STATUS_DONE = "RESOLVIDA";
    const STATUS_VOIDED = "VENCIDO";
    const STATUS_CANCELADO = "CANCELADO";
    const ANDAMENTO = 0;

    /** @var int */
    private $id;
    /** @var string */
    private $priority;
    /** @var DateTime */
    private $createdOn;
    /** @var DateTime */
    private $ESI;
    private $ARQUIVO;
    /** @var DateTime */
    private $lastModifiedOn;
    /** @var string */
    private $AVISO;
    /** @var string */
    private $SINISTRO;
    /** @var string */
    private $PESSOA;
    /** @var string one of PENDING/COMPLETED/VOIDED */
    private $status;
    /** @var boolean */
    private $deleted;
    private $CERTIFICADO;
    private $CPF;
    private $OBS;
    private $SEGURADOS;
    private $N_PROC;
    private $N_NATIGO;
    private $NATUREZA;
    private $PROCED;
    private $UF;
    private $CIDADE;
    private $FORO;
    private $N_VARA;
    private $VARA;
    private $CLIENTE;
    private $RECLAMANTE;
    private $FASE;
    private $TP_PROBA;
    private $PROVAVIL;
    private $VLPEDIDO;
    private $DTPEDIDO;
    private $TPACAO;
    private $vlindeniza;
    private $IMPORTANCIA_SEGURADA;
    private $idtitular;
    private $DT_AVISO;
    
    private $COD_SIN;
    private $DTH_FASE_SIN;
    private $COD_FASE_SIN;
    private $OBS_FASE_SIN;
    private $USR_ATU;
    private $COD_DOC_EXTER;
    private $NUM_ITEM_EXTER;
    private $SEQ_PGTO_SIN;
    
    private $POSSIVEL;
    private $PROVAVEL;
    private $PARTE_CONTRARIA;
    private $VALOR_PEDIDO;
    private $HONORARIOS;
    /**
     * Create new {@link Todo} with default properties set.
     */
    public function __construct() {
        date_default_timezone_set ( "America/Sao_Paulo" );
        $now = new DateTime();
        $this->setCreatedOn($now);
        $this->setLastModifiedOn($now);
        $this->setStatus(self::STATUS_PENDING);
        $this->setDeleted(false);
    }

    public static function allStatuses() {
        return array(
            self::STATUS_NULL,
            self::STATUS_PENDING,
            self::STATUS_DONE,
            self::STATUS_VOIDED,
            self::STATUS_CANCELADO,
        );
    }
    public static function allPriorities() {
        return array(
            self::PRIORITY_IMEDIATA,
            self::PRIORITY_HIGH,
            self::PRIORITY_MEDIUM,
            self::PRIORITY_LOW,
        );
    }

    //~ Getters & setters

    /**
     * @return int <i>null</i> if not persistent
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        //if ($this->id !== null && $this->id != $id) {
            //throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        //}
        $this->id = (int) $id;
    }
    
    public function getidtitular() {
        return $this->idtitular;
    }
    public function setidtitular($idtitular) {
        $this->idtitular = (int) $idtitular;
    }
    
    public function getESI(){
        return $this->ESI;
    }
    public function setESI($ESI){
        $this->ESI = $ESI;
    }

    /**
     * @return int one of 1/2/3
     */
    public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        TodoValidator::validatePriority($priority);
        $this->priority = $priority;
    }
    public function getCreatedOn() {
        return $this->createdOn;
    }

    public function setCreatedOn(DateTime $createdOn) {
        $this->createdOn = $createdOn;
    }
    public function getARQUIVO() {
        return $this->ARQUIVO;
    }

    public function setARQUIVO($ARQUIVO) {
        $this->ARQUIVO = $ARQUIVO;
    }
    public function getAVISO() {
        return $this->AVISO;
    }

    public function setAVISO($AVISO) {
        $this->AVISO = $AVISO;
    }
    public function getSINISTRO() {
        return $this->SINISTRO;
    }

    public function setSINISTRO($SINISTRO) {
        $this->SINISTRO = $SINISTRO;
    }
    public function getPESSOA() {
        return $this->PESSOA;
    }

    public function setPESSOA($PESSOA) {
        $this->PESSOA = $PESSOA;
    }
    public function getLastModifiedOn() {
        return $this->lastModifiedOn;
    }

    public function setLastModifiedOn(DateTime $lastModifiedOn) {
        $this->lastModifiedOn = $lastModifiedOn;
    }
    public function getCERTIFICADO() {
        return $this->CERTIFICADO;
    }

    public function setCERTIFICADO($CERTIFICADO) {
        $this->CERTIFICADO = $CERTIFICADO;
    }
    public function getCPF() {
        return $this->CPF;
    }
    public function setCPF($CPF) {
        $this->CPF = $CPF;
    }
    public function getOBS(){
        return $this->OBS;
    }
    public function setOBS($OBS){
        $this->OBS = $OBS;
    }
    public function getSEGURADOS() {
        return $this->SEGURADOS;
    }

    public function setSEGURADOS($SEGURADOS) {
        $this->SEGURADOS = $SEGURADOS;
    }
    public function getN_PROC(){
        return $this->N_PROC;
    }
    public function setN_PROC($N_PROC){
        $this->N_PROC = $N_PROC;
    }
    public function getN_NATIGO() {
        return $this->N_NATIGO;
    }

    public function setN_NATIGO($N_NATIGO) {
        $this->N_NATIGO = $N_NATIGO;
    }
    public function getNATUREZA(){
        return $this->NATUREZA;
    }
    public function setNATUREZA($NATUREZA){
        $this->NATUREZA = $NATUREZA;
    }
    public function getPROCED(){
        return $this->PROCED;
    }
    public function setPROCED($PROCED){
        $this->PROCED = $PROCED;
    }
    public function getUF(){
        return $this->UF;
    }
    public function setUF($UF){
        $this->UF = $UF;
    }
    public function getCIDADE(){
        return $this->CIDADE;
    }
    public function setCIDADE($CIDADE){
        $this->CIDADE = $CIDADE;
    }
    public function getFORO(){
        return $this->FORO;
    }
    public function setFORO($FORO){
        $this->FORO = $FORO;
    }
    public function getN_VARA(){
        return $this->N_VARA;
    }
    public function setN_VARA($N_VARA){
        $this->N_VARA = $N_VARA;
    }
    public function getVARA(){
        return $this->VARA;
    }
    public function setVARA($VARA){
        $this->VARA = $VARA;
    }
    public function getCLIENTE(){
        return $this->CLIENTE;
    }
    public function setCLIENTE($CLIENTE){
        $this->CLIENTE = $CLIENTE;
    }
    public function getRECLAMANTE(){
        return $this->RECLAMANTE;
    }
    public function setRECLAMANTE($RECLAMANTE){
        $this->RECLAMANTE = $RECLAMANTE;
    }
    public function getFASE(){
        return $this->FASE;
    }
    public function setFASE($FASE){
        $this->FASE = $FASE;
    }
    public function getTP_PROBA(){
        return $this->TP_PROBA;
    }
    public function setTP_PROBA($TP_PROBA){
        $this->TP_PROBA = $TP_PROBA;
    }
    public function getPROVAVIL(){
        return $this->PROVAVIL;
    }
    public function setPROVAVIL($PROVAVIL){
        $this->PROVAVIL = $PROVAVIL;
    }
    public function getVLPEDIDO(){
        return $this->VLPEDIDO;
    }
    public function setVLPEDIDO($VLPEDIDO){
        $this->VLPEDIDO = $VLPEDIDO;
    }
    public function getDTPEDIDO(){
        return $this->DTPEDIDO;
    }
    public function setDTPEDIDO($DTPEDIDO){
        $this->DTPEDIDO = $DTPEDIDO;
    }
    public function getTPACAO(){
        return $this->TPACAO;
    }
    public function setTPACAO($TPACAO){
        $this->TPACAO = $TPACAO;
    }
    public function getDT_AVISO(){
        return $this->DT_AVISO;
    }
    public function setDT_AVISO($DT_AVISO){
        $this->DT_AVISO = $DT_AVISO;
    }
    public function getvlindeniza(){
        return $this->vlindeniza;
    }
    public function setvlindeniza($vlindeniza){
        $this->vlindeniza = $vlindeniza;
    }
    public function getIMPORTANCIA_SEGURADA(){
        return $this->IMPORTANCIA_SEGURADA;
    }
    public function setIMPORTANCIA_SEGURADA($IMPORTANCIA_SEGURADA){
        $this->IMPORTANCIA_SEGURADA = $IMPORTANCIA_SEGURADA;
    }
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        TodoValidator::validateStatus($status);
        $this->status = $status;
    }
    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = (bool) $deleted;
    }
    
    public function getCOD_SIN(){
        return $this->COD_SIN;
    }
    public function setCOD_SIN($COD_SIN){
        $this->COD_SIN = $COD_SIN;
    }
    public function getDTH_FASE_SIN(){
        return $this->DTH_FASE_SIN;
    }
    public function setDTH_FASE_SIN($DTH_FASE_SIN){
        $this->DTH_FASE_SIN = $DTH_FASE_SIN;
    }
    public function getCOD_FASE_SIN(){
        return $this->COD_FASE_SIN;
    }
    public function setCOD_FASE_SIN($COD_FASE_SIN){
        $this->COD_FASE_SIN = $COD_FASE_SIN;
    }
    public function getUSR_ATU(){
        return $this->USR_ATU;
    }
    public function setUSR_ATU($USR_ATU){
        $this->USR_ATU = $USR_ATU;
    }
    public function getCOD_DOC_EXTER(){
        return $this->COD_DOC_EXTER;
    }
    public function setCOD_DOC_EXTER($COD_DOC_EXTER){
        $this->COD_DOC_EXTER = $COD_DOC_EXTER;
    }
    public function getNUM_ITEM_EXTER(){
        return $this->NUM_ITEM_EXTER;
    }
    public function setNUM_ITEM_EXTER($NUM_ITEM_EXTER){
        $this->NUM_ITEM_EXTER = $NUM_ITEM_EXTER;
    }
    public function getOBS_FASE_SIN(){
        return $this->OBS_FASE_SIN;
    }
    public function setOBS_FASE_SIN($OBS_FASE_SIN){
        $this->OBS_FASE_SIN = $OBS_FASE_SIN;
    }
    public function getSEQ_PGTO_SIN(){
        return $this->SEQ_PGTO_SIN;
    }
    public function setSEQ_PGTO_SIN($SEQ_PGTO_SIN){
        $this->SEQ_PGTO_SIN = $SEQ_PGTO_SIN;
    }
    public function getPOSSIVEL(){
        return $this->POSSIVEL;
    }
    public function setPOSSIVEL($POSSIVEL){
        $this->POSSIVEL = $POSSIVEL;
    }
    public function getPROVAVEL(){
        return $this->PROVAVEL;
    }
    public function setPROVAVEL($PROVAVEL){
        $this->PROVAVEL = $PROVAVEL;
    }
    public function getPARTE_CONTRARIA(){
        return $this->PARTE_CONTRARIA;
    }
    public function setPARTE_CONTRARIA($PARTE_CONTRARIA){
        $this->PARTE_CONTRARIA = $PARTE_CONTRARIA;
    }
    public function getVALOR_PEDIDO(){
        return $this->VALOR_PEDIDO;
    }
    public function setVALOR_PEDIDO($VALOR_PEDIDO){
        $this->VALOR_PEDIDO = $VALOR_PEDIDO;
    }
    public function getHONORARIOS(){
        return $this->HONORARIOS;
    }
    public function setHONORARIOS($HONORARIOS){
        $this->HONORARIOS = $HONORARIOS;
    }
}
?>