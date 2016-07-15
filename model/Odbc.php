<?php
/**
 * Model class representing one TODO item.
 */
final class Odbc {

    // priority
    //const PRIORITY_HIGH = 1;
    //const PRIORITY_MEDIUM = 2;
    //const PRIORITY_LOW = 3;
    // status
    //const STATUS_PENDING = "PENDENTE";
    //const STATUS_DONE = "RESOLVIDA";
    //const STATUS_VOIDED = "VENCIDO";
    //const STATUS_CANCELADO = "CANCELADO";
    //const ANDAMENTO = 0;

    // colunas tabela Beneficiarios //
    private $idbenefi;
    private $idtitular;
    private $sinistro;
    private $apolice;
    private $endosso;
    private $nome;
    private $tipo;
    private $endereco;
    private $numero;
    private $complemento;
    private $bairro;
    private $municipio;
    private $estado;
    private $uf;
    private $cep;
    private $vlindeniza;
    private $tpcobertura;
    private $cpf;
    private $identidade;
    private $percentual;
    private $tel_fixo;
    private $tel_cel;
    private $email;
    private $banco;
    private $agencia;
    private $conta;
    private $CreateOn;
    private $LastModifiedOn;
    private $Deleted;

    // colunas tabela Beneficiarios //
    private $CÓDIGO;
    private $COBERTURA;
    
    private $status;
    
    public function __construct() {
        date_default_timezone_set ( "America/Sao_Paulo" );
        $now = new DateTime();
        $this->setCreatedOn($now);
        $this->setLastModifiedOn($now);
        $this->setDeleted(false);
    }
    public static function variaveis($dados){
      foreach($dados as $item){
       $coluna = $item;
       echo "$coluna<br>";
      }
    }
    public static function allStatuses() {
        return array(
            self::STATUS_PENDING,
            self::STATUS_DONE,
            self::STATUS_VOIDED,
            self::STATUS_CANCELADO,
        );
    }
    public static function allPriorities() {
        return array(
            self::PRIORITY_HIGH,
            self::PRIORITY_MEDIUM,
            self::PRIORITY_LOW,
        );
    }

    //~ Getters & setters

    /**
     * @return int <i>null</i> if not persistent
     */
    public function getidtitular() {
        return $this->idtitular;
    }

    public function setidtitular($idtitular) {
        if ($this->idtitular !== null && $this->idtitular != $idtitular) {
            throw new Exception('Cannot change identifier to ' . $idtitular . ', already set to ' . $this->idtitular);
        }
        $this->idtitular = (int) $idtitular;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function setNumero($numero){
        $this->numero = $numero;
    }

    /**
     * @return int one of 1/2/3
     */
    public function getidbenefi() {
        return $this->idbenefi;
    }

    public function setidbenefi($idbenefi) {
        $this->idbenefi = $idbenefi;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn() {
        return $this->createdOn;
    }

    public function setCreatedOn(DateTime $createdOn) {
        $this->createdOn = $createdOn;
    }

    /**
     * @return DateTime
     */
    public function getDueOn() {
        return $this->dueOn;
    }

    public function setDueOn(DateTime $dueOn) {
        $this->dueOn = $dueOn;
    }
    public function getEliminacao() {
        return $this->eliminacao;
    }

    public function setEliminacao(DateTime $eliminacao) {
        $this->eliminacao = $eliminacao;
    }
    public function getEliminacao_novo() {
        return $this->eliminacao_novo;
    }

    public function setEliminacao_novo(DateTime $eliminacao_novo) {
        $this->eliminacao_novo = $eliminacao_novo;
    }
    public function getPrazo() {
        return $this->prazo;
    }

    public function setPrazo(DateTime $prazo) {
        $this->prazo = $prazo;
    }

    /**
     * @return DateTime
     */
    public function getLastModifiedOn() {
        return $this->lastModifiedOn;
    }

    public function setLastModifiedOn(DateTime $lastModifiedOn) {
        $this->lastModifiedOn = $lastModifiedOn;
    }
    public function getEficazData() {
        return $this->eficaz_data;
    }

    public function setEficazData(DateTime $eficaz_data) {
        $this->eficaz_data = $eficaz_data;
    }

    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    /**
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    /**
     * @return string
     */
    public function getComment() {
        return $this->comment;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }
    public function getComentario(){
        return $this->comentario;
    }
    public function setComentario($comentario){
        $this->comentario = $comentario;
    }
    public function getDetalhamento(){
        return $this->detalhamento;
    }
    public function setDetalhamento($detalhamento){
        $this->detalhamento = $detalhamento;
    }
    public function getOrigem(){
        return $this->origem;
    }
    public function setOrigem($origem){
        $this->origem = $origem;
    }
    public function getTipoacao(){
        return $this->tipoacao;
    }
    public function setTipoacao($tipoacao){
        $this->tipoacao = $tipoacao;
    }
    public function getProcesso(){
        return $this->processo;
    }
    public function setProcesso($processo){
        $this->processo = $processo;
    }
    public function getIdentificador(){
        return $this->identificador;
    }
    public function setIdentificador($identificador){
        $this->identificador = $identificador;
    }
    public function getCausa(){
        return $this->causa;
    }
    public function setCausa($causa){
        $this->causa = $causa;
    }
    public function getimediata(){
        return $this->imediata;
    }
    public function setImediata($imediata){
        $this->imediata = $imediata;
    }
    public function getCorretiva(){
        return $this->corretiva;
    }
    public function setCorretiva($corretiva){
        $this->corretiva = $corretiva;
    }
    public function getImplementador(){
        return $this->implementador;
    }
    public function setImplementador($implementador){
        $this->implementador = $implementador;
    }
    public function getRegEficacia(){
        return $this->reg_eficacia;
    }
    public function setRegEficacia($reg_eficacia){
        $this->reg_eficacia = $reg_eficacia;
    }
    public function getRespVerificacao(){
        return $this->resp_verificacao;
    }
    public function setRespVerificacao($resp_verificacao){
        $this->resp_verificacao = $resp_verificacao;
    }
    public function getNovoRnc(){
        return $this->novo_rnc;
    }
    public function setNovoRnc($novo_rnc){
        $this->novo_rnc = $novo_rnc;
    }
    public function getEficaz(){
        return $this->eficaz;
    }
    public function setEficaz($eficaz){
        $this->eficaz = $eficaz;
    }
    public function getAndamento(){
        return $this->andamento;
    }
    public function setAndamento($andamento){
        $this->andamento = $andamento;
    }

    /**
     * @return string one of PENDING/DONE/VOIDED
     */
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        TodoValidator::validateStatus($status);
        $this->status = $status;
    }

    /**
     * @return boolean
     */
    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = (bool) $deleted;
    }
}
?>