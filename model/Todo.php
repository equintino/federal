<?php
/**
 * Model class representing one TODO item.
 */
final class Todo {

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
        if ($this->id !== null && $this->id != $id) {
            throw new Exception('Cannot change identifier to ' . $id . ', already set to ' . $this->id);
        }
        $this->id = (int) $id;
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
        $this->titulo = $OBS;
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
}
?>