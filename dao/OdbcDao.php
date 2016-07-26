<?php
final class OdbcDao {  
  private $db = null;
  
    public function __destruct(){  
        $this->db = null;
    }
    public function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("odbc");
        try {
            $this->db = odbc_connect($config['banco'],$config['username'],$config['password'])or die(odbc_errormsg());
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }
    public function query($sql) {
        //print_r($sql);die;
        $sql = "SELECT * FROM Beneficiarios WHERE exclui like 0";
      $statement = odbc_exec($this->getDb(),$sql);
        //print_r($statement);die;
      while($linha = odbc_fetch_array($statement)){
        $result[]=$linha;
      }
      return @$result;
    }
    public function query2($sql) {
      $statement = odbc_exec($this->getDb(),$sql);
      //while($linha = odbc_fetch_array($statement)){
        //$result[]=$linha;
      //}
      return $statement;
    }
    public function listaTabela(){	
        $result = odbc_tables($this->getDb());
        $tables = array();
        while (odbc_fetch_row($result)){
            if(odbc_result($result,"TABLE_TYPE")=="TABLE")
            $tabelas[] = odbc_result($result,"TABLE_NAME");
        }
        return $tabelas;
    }
    public function listaConteudo($tabela){
        $sql = "SELECT * FROM $tabela WHERE `exclui` like '%0%'";
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        return $result;
        odbc_result($result,'Border=1 cellspacing=0 cellpadding=5'); 
    }
    public function buscaConsolidada($tabela1,$tabela2,$col1,$col2){
        $sql = "SELECT * FROM $tabela1 INNER JOIN $tabela2 ON $tabela1.$col1=$tabela2.$col2 WHERE 1";
        $conn = new OdbcDao();
        $result=$conn->query($sql);
        return $result;
    }
    public function listaCampo($tabela,$campo,$busca){
        $sql = "SELECT * FROM $tabela WHERE $campo=$busca";
        $conn = new OdbcDao();
        @$result=$conn -> query($sql);
        
        return @$result_;
        /*
        echo '<table>';
        while (odbc_fetch_row($result)) {
            //for($x=0;$x<count($data);$x++){
                //$col[$x] = $data[$x];
                //echo odbc_result($result);
        print_r(odbc_result($result, $campo));
        echo ' - ';
        print_r(odbc_result($result, 'nome'));
                echo '</td>';
            //}
            echo "</tr>";
        }
        echo '</table>';
         */
    }
    public function listaColunas($tabela){
     $conn = new OdbcDao();
     $sql = "SELECT * FROM $tabela WHERE 1";
     $result=$conn->query2($sql);
     //print_r($result);
     //var_dump(odbc_num_fields($result));die;
     $colunas_num=odbc_num_fields($result);
     //print_r($colunas_num);
     for($x=1;$x<$colunas_num+1;$x++){
       $colunas[]=odbc_field_name($result,$x);
     }
     return $colunas;
    }
    public function find(OdbcSearchCriteria $search = null) {
        $result = array();
        //echo '<br>teste<br>';
         //echo($this->query($this->getFindSql($search)));
         //echo '<br>';
         //print_r($this->query($this->getFindSql($search)));
         //print_r($this->getFindSql($search));
         //echo '<br>teste<br>';
         //print_r($search);
        foreach ($this->query($this->getFindSql($search)) as $row) {
            $odbc = new Odbc();
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidbenefi()] = $odbc;
        }
        return $result;
    }
    private function getFindSql(OdbcSearchCriteria $search = null) {
        $sql = 'SELECT * FROM Beneficiarios WHERE 1';
                //deleted = 0 ';
        //$orderBy = null;
                //' priority, due_on';
        if ($search !== null) {
            if ($search->getStatus() !== null) {
                $sql .= 'AND status = ' . $this->getDb()->quote($search->getStatus());
                /*
                switch ($search->getStatus()) {
                    case Todo::STATUS_PENDING:
                        $orderBy = 'due_on, priority';
                        break;
                    case Todo::STATUS_DONE:
                    case Todo::STATUS_VOIDED:
                    case Todo::STATUS_CANCELADO:
                        $orderBy = 'due_on DESC, priority';
                        break;
                    default:
                        throw new Exception('No order for status: ' . $search->getStatus());
                }          
                 */
            }
        }
        //$sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    public function find2(OdbcSearchCriteria $search = null) {
     //print_r($search);die;
      $busca = $this->query($this->getFindSql2($search));
      //print_r($busca);die;
      //$row = odbc_($busca);
     //print_r($busca);
     //die;
      //var_dump($odbc);
      //echo "<br><br>";
      //$odbc = odbc_fetch_array($busca);
      //var_dump($odbc);
         //echo "<br><br>";
        foreach ($busca as $key => $row) {
         //echo "<br><br>";
            $odbc = new Odbc();
            //print_r($row);
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidbenefi()] = $odbc;
            //print_r($result);die;
            //$idbenefi = $odbc->getidbenefi();
        }
        //die;
            //echo '<br>';
            //print_r($result);
            //echo '<br>';
        //print_r($result);die;
        return @$result;
    }
    public function busca(OdbcSearchCriteria $search = null){
        //print_r($search);
        //print_r($this->getBuscaSql($search));
        //$busca = $this->query("select * from Beneficiarios where sinistro='0153.93.03.00001654'");
        $busca = $this->query($this->getBuscaSql($search));
        //print_r($busca);die;
        foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getsinistro()] = $odbc;
        }
            //print_r($odbc);die;
        //print_r($result);die;
        return @$result;
    }
    private function getBuscaSql(OdbcSearchCriteria $search = null){
        $sql = "SELECT * FROM Beneficiarios WHERE ";
        $orderBy = 'sinistro';
        if ($search !== null) {
            if ($search->getsinistro() != null ) {
                //echo "sinistro defenido";
                $sql .= "sinistro = '".$search->getsinistro()."'";
            }elseif($search->getnome() != null){
                //echo "nome defenido";
                $sql .= "nome like '%".$search->getnome()."%'";
            }
        }else{
          $sql.= 1;
        }
        //$sql .= " AND exclui like '0' ";
        //$sql .= ' ORDER BY ' . $orderBy;
        return $sql;
        
    }
    private function getFindSql2(OdbcSearchCriteria $search = null) {
     //print_r(foreach($this->query($search) as $item));die;
        //print_r($search);die;
        $sql = "SELECT * FROM Beneficiarios WHERE ";
        $orderBy = 'sinistro';
        if ($search !== null && $search->getsinistro() != 'lista') {
            if ($search->getsinistro() !== null ) {
                $sql .= "sinistro like '%".$search->getsinistro()."%'";
            }
        }else{
          $sql.= 1;
        }
        $sql .= ' ORDER BY ' . $orderBy;
        return $sql;
    }
    public function save($odbc){
      if($odbc->getidbenefi === null){
       return insert($odbc);
      }
      return update($odbc);
    }
    public function insert($odbc){
        $now = new DateTime();
        $odbc->setidbenefi(null);
        $odbc->setCreatedOn($now);
        $odbc->setLastModifiedOn($now);
        
        $sql = '
            INSERT INTO Beneficiarios (idbenefi,idtitular,sinistro,apolice,endosso,nome,tipo,endereco,numero,complemento,bairro,municipio,estado,uf,cep,vlindeniza,tpcobertura,cpf,identidade,percentual,tel_fixo,tel_cel,email,banco,agencia,conta,abertura,modificacao,exclui)
                VALUES (:idbenefi,:idtitular,:sinistro,:apolice,:endosso,:nome,:tipo,:endereco,:numero,:complemento,:bairro,:municipio,:estado,:uf,:cep,:vlindeniza,:tpcobertura,:cpf,:identidade,:percentual,:tel_fixo,:tel_cel,:email,:banco,:agencia,:conta,:abertura,:modificacao,:exclui)';
        return $this->odbc_exe($sql, $odbc);
    }
    public function update($odbc){
        $odbc->setLastModifiedOn(new DateTime(), new DateTimeZone('America/Sao_Paulo'));
        $sql = '
          UPDATE Beneficiarios SET 
            idbenefi=:idbenefi,
            idtitular=:idtitular,
            sinistro=:sinistro,
            apolice=:apolice,
            endosso=:endosso,
            nome=:nome,
            tipo=:tipo,
            endereco=:endereco,
            numero=:numero,
            complemento=:complemento,
            bairro=:bairro,
            municipio=:municipio,
            estado=:estado,
            uf=:uf,
            cep=:cep,
            vlindeniza=:vlindeniza,
            tpcobertura=:tpcobertura,
            cpf=:cpf,
            identidade=:identidade,
            percentual=:percentual,
            tel_fixo=:tel_fixo,
            tel_cel=:tel_cel,
            email=:email,
            banco=:banco,
            agencia=:agencia,
            conta=:conta,
            abertura=:abertura,
            modificacao=:modificacao,
            exclui=:exclui
          WHERE
            idbenefi = :idbenefi';
        return $this->execute($sql, $odbc);
     
    }
    private function getParams(Odbc $odbc) {
        $params = array(
            'idbenefi' => $odbc->getidbenefi(),
            ':idtitular' => $odbc->getidtitular(),
            ':sinistro' => $odbc->getsinistro(),
            ':apolice' => $odbc->getapolice(),
            ':endosso' => $odbc->getendosso(),
            ':nome' => $odbc->getnome(),
            ':tipo' => $odbc->gettipo(),
            ':endereco' => $odbc->getendereco(),
            ':numero' => $odbc->getnumero(),
            ':complemento' => $odbc->getcomplemento(),
            ':bairro' => $odbc->getbairro(),
            ':municipio' => $odbc->getmunicipio(),
            ':estado' => $odbc->getestado(),
            ':uf' => $odbc->getuf(),
            ':cep' => $odbc->getcep(),
            ':vlindeniza' => $odbc->getvlindeniza(),
            ':tpcobertura' => $odbc->gettpcobertura(),
            ':cpf' => $odbc->getcpf(),
            ':identidade' => $odbc->getidentidade(),
            ':percentual' => $odbc->getpercentual(),
            ':tel_fixo' => $odbc->gettel_fixo(),
            ':tel_cel' => $odbc->gettel_cel(),
            ':email' => $odbc->getemail(),
            ':banco' => $odbc->getbanco(),
            ':agencia' => $odbc->getagencia(),
            ':conta' => $odbc->getconta(),
            ':abertura' => self::formatDateTime($odbc->getabertura()),
            ':modificacao' => self::formatDateTime($odbc->getmodificacao()),
            ':exclui' => $odbc->getexclui()
        );
        if ($odbc->getidbenefi()) {
            unset($params[':abertura']);
        }
        return $params;
    }
}