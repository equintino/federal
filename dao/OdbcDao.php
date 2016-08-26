<?php
final class OdbcDao {  
  private $db = null;
  
    public function __destruct(){  
        $this->db = null;
        odbc_close_all();
    }
    public function getDb() {
        if ($this->db !== null) {
            return $this->db;
        }
        $config = Config::getConfig("odbc");
        try {
            $this->db = odbc_connect($config['banco'],$config['username'],$config['password']) or die (odbc_errormsg());
        } catch (Exception $ex) {
            throw new Exception('DB connection error: ' . $ex->getMessage());
        }
        return $this->db;
    }
    public function query($sql) {
            set_time_limit(3600);
        //var_dump($this->getDb(),$sql);die;
        //$sql = "SELECT * FROM Beneficiarios WHERE exclui like 0";
     //print_r($sql);
      $statement = odbc_exec($this->getDb(),$sql);
      //print_r($sql);die;
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
    public function listaConteudo($table){
        $sql = "SELECT * FROM $table WHERE 1";
        if($table == 'sinipend'){
            $sql .= " ORDER BY SINISTRO ";
        }elseif($table == 'Beneficiarios'){
            $sql .= " ORDER BY sinistro";
        }
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        return $result;
        odbc_result($result,'Border=1 cellspacing=0 cellpadding=5'); 
    }
    public function listaConteudo2($table){
        $sql = "SELECT * FROM $table WHERE 1";
        
        if($table=='Beneficiarios'){
         $sql .= " ORDER BY sinistro";
        }else{
         $sql .= " ORDER BY SINISTRO";
        }
                 //"exclui like 0";
        $conn = new OdbcDao();
        $result=$conn -> query($sql);
        return $result;
        odbc_result($result,'Border=1 cellspacing=0 cellpadding=5'); 
    }
    public function listaConteudo3($table){
        $sql = "SELECT TOP 10 * FROM $table WHERE 1";
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
        //$sql = "SELECT * FROM $tabela WHERE $campo='$busca'";
        $sql = "SELECT * FROM $tabela WHERE $campo like '%$busca%'";
        //print_r($sql);die;
        $conn = new OdbcDao();
        @$result=$conn -> query($sql);
        //print_r($result);die;
        
        return @$result;
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
    public function listaCampo2($tabela,$campo,$busca,$pagAtual){
        $odbc = new Odbc();
        //print_r($odbc);
        if($odbc->getidtitular()==null){
         $odbc->setidtitular(0);
        }
        if(!$pagAtual){
         $pagAtual=0;
        }
         //$odbc->setidtitular($pagAtual);
        //print_r($odbc->getidtitular());
        $sql = "SELECT TOP 3 * FROM $tabela WHERE $campo like '%$busca%'";
        $sql .= ' AND idtitular > '.$pagAtual;
        $sql .= ' ORDER BY idtitular';
        $conn = new OdbcDao();
        @$result=$conn -> query($sql);
        
        return @$result;
    }
    public function listaCampo3($tabela,$campo,$busca,$pagAtual){
        $odbc = new Odbc();
        if($odbc->getidtitular()==null){
         $odbc->setidtitular(0);
        }
        if(!$pagAtual){
         $pagAtual=0;
        }
        $sql = "SELECT * FROM $tabela WHERE $campo like '%$busca%'";
        $sql .= ' AND idtitular > '.$pagAtual;
        $sql .= ' ORDER BY idtitular';
        $conn = new OdbcDao();
        @$result=$conn -> query($sql);
        
        return @$result;
    }
    public function listaCampo4($tabela,$campo,$busca,$pagAtual){
     //print_r($busca);
     //echo "<br>";
        $odbc = new Odbc();
        //print_r($odbc);
        //if($odbc->getidbenefi()==null){
         //$odbc->setidbenefi(0);
        //}
        //if(!$pagAtual){
         //$pagAtual=0;
       // }
         //$odbc->setidtitular($pagAtual);
        //print_r($odbc->getidtitular());
        $sql = "SELECT * FROM $tabela WHERE $campo like '%$busca%'";
        //$sql .= ' AND idbenefi > '.$pagAtual;
        //$sql .= ' ORDER BY idbenefi';
        $conn = new OdbcDao();
        //print_r($sql);die;
        //echo "<br>";
        @$result=$conn -> query($sql);
        
        return @$result;
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
     //print_r($this->getFindSql2($search));die;
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
        foreach ($busca as $row) {
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
    public function ultimoSinistrado(OdbcSearchCriteria $search = null){
        $result=array();
        $sql="SELECT TOP 1 * FROM sinipend ORDER BY idtitular DESC";
        $busca = $this->query($sql);
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidtitular()] = $odbc;
         }
        return @$result;
    }
    public function buscaSinistrado(OdbcSearchCriteria $search = null){
        $odbc = new Odbc();
        $result=array();
        $sql="SELECT * FROM sinipend WHERE idtitular=".$search->getidtitular()." ORDER BY idtitular";
        if($this->query($sql)){
        $busca = $this->query($sql);
        if(@$busca){
         foreach ($busca as $key => $row) {
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidtitular()] = $odbc;
         }
        }
        }else{
         return $result="nulo";
        }
        return @$result;
    }
    public function busca(OdbcSearchCriteria $search = null){
        $result=array();
        //echo "estou aqui";
        //print_r($search);die;
        //print_r($this->getBuscaSql($search));
        //$busca = $this->query("select * from Beneficiarios where sinistro='0153.93.03.00001654'");
        $busca = $this->query($this->getBuscaSql($search));
        //print_r($this->getBuscaSql($search));die;
        if(@$busca){
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            //print_r($odbc);die;
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidbenefi()] = $odbc;
            //print_r($result);
         }
         //die;
        }
            //print_r($odbc);die;
        //print_r($result);die;
        //die;
        return @$result;
    }
    public function busca2(OdbcSearchCriteria $search = null){
        $result=array();
        //print_r($this->getBuscaSql2($search));
        //die;
        $busca = $this->query($this->getBuscaSql2($search));
        if(@$busca){
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            //print_r($row);echo "<br><br>";
            //print_r($odbc);echo "<br><br>";
            OdbcMapper::map($odbc, $row);
            //print_r($odbc);die;
            //$result[$odbc->getidbenefi()] = $odbc;
            $result[$odbc->getidtitular()] = $odbc;
         }
        }else{
         echo "<p>*Nao foi encontrado nenhum registro</p>"; 
        }
        return @$result;
    }
    public function busca3(OdbcSearchCriteria $search = null){
        $result=array();
        $busca = $this->query($this->getBuscaSql3($search));
        //print_r($this->getBuscaSql3($search));
        if(@$busca){
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            //print_r($row);echo "<br><br>";
            //print_r($odbc);echo "<br><br>";
            OdbcMapper::map($odbc, $row);
            //print_r($odbc);die;
            //$result[$odbc->getidbenefi()] = $odbc;
            $result[$odbc->getidtitular()] = $odbc;
         }
        }else{
         echo "<p>*Nao foi encontrado nenhum registro</p>"; 
        }
        return @$result;
    }
    public function busca4(OdbcSearchCriteria $search = null){
        //print_r($this->getBuscaSql4($search));die;
        $result=array();
        $busca = $this->query($this->getBuscaSql4($search));
        //print_r($busca);die;
        if(@$busca){
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            //print_r($row);echo "<br><br>";
            //print_r($odbc);echo "<br><br>";
            OdbcMapper::map($odbc, $row);
            //print_r($odbc);die;
            //$result[$odbc->getidbenefi()] = $odbc;
            $result[$odbc->getidbenefi()] = $odbc;
         }
        }else{
         echo "<p>*Nao foi encontrado nenhum registro</p>"; 
        }
        return @$result;
    }
    
    public function busca5(OdbcSearchCriteria $search = null){
        $result=array();
        $busca = $this->query($this->getBuscaSql5($search));
        //print_r($busca);die;
        if(@$busca){
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidbenefi()] = $odbc;
         }
        }else{
         echo "<p>*Nao foi encontrado nenhum registro</p>"; 
        }
        return @$result;
    }
    public function busca6(OdbcSearchCriteria $search = null){
        $result=array();
        //print_r($this->getBuscaSql2($search));die;
        $busca = $this->query($this->getBuscaSql6($search));
        if(@$busca){
         foreach ($busca as $key => $row) {
            $odbc = new Odbc();
            OdbcMapper::map($odbc, $row);
            $result[$odbc->getidtitular()] = $odbc;
         }
        }
        return @$result;
    }
    public function queryLinhas($sql){
      set_time_limit(3600);
      $statement = odbc_exec($this->getDb(),$sql);
      return @$statement;
    }
    public function totalLinhas(OdbcSearchCriteria $search = null,$tabela){
        $busca = $this->queryLinhas($this->getBuscaLinhas($search,$tabela)); 
        $x=0;
        //print_r($this->getBuscaLinhas($search,$tabela));die;
        //print_r(odbc_result_all($busca));
        while($linhas=odbc_fetch_row($busca)){
            $x++;
        }
        return $x;
    }
    private function getBuscaLinhas(OdbcSearchCriteria $search = null,$tabela){
        $sql = "SELECT * FROM $tabela WHERE ";
        //print_r($search);die;
        
        if(@$search->getENDOSSO()){
         $campo=' ENDOSSO';
         $busca=$search->getENDOSSO();
        }elseif(@$search->getsinistro()){
         $campo=' SINISTRO';
         $busca=$search->getsinistro();
        }elseif(@$search->getTITULAR() || @$search->getnome()){           
            if($tabela=='sinipend'){
                $campo=' TITULAR';
                $busca=$search->getTITULAR();
            }else{
                $campo=' nome';
                $busca=$search->getnome();
            }
        }
        //elseif($search->getIMPORTANCIA_SEGURADA()){
          //  $campo=' IMPORTANCIA_SEGURADA';
            //$busca=$search->getIMPORTANCIA_SEGURADA();
        //}
        
        if($search->getsinistro()==null && $search->getENDOSSO()==null && $search->getTITULAR()==null && $search->getnome()==null ){
            $sql .= ' 1';
        }else{
            $sql .= "$campo like '%".$busca."%'";
        }
        if($search->getIMPORTANCIA_SEGURADA()){
            $sql .=' AND IMPORTANCIA_SEGURADA > '.$search->getIMPORTANCIA_SEGURADA();
        }elseif($search->getvlindeniza()){
            $sql .=' AND vlindeniza > '.$search->getvlindeniza();
        }
        //print_r($sql);die;
        return $sql;
    }
    private function getBuscaSql(OdbcSearchCriteria $search = null){
        //$sql = "SELECT * FROM Beneficiarios WHERE ";
        $sql = "SELECT * FROM Beneficiarios WHERE ";
        $orderBy = 'sinistro';
        
        //if()
        //print_r($search->getnome());
        //echo '<br>';
        if(@$search->getendosso()){
         $campo='endosso';
         $busca=$search->getendosso();
        }elseif(@$search->getsinistro()){
         $campo='sinistro';
         $busca=$search->getsinistro();
        }
        if(@!$campo){
         $campo=null;
        }
        if(@!$busca){
         $busca=null;
        }
        
        if($search->getvlindeniza() == null){
            $search->setvlindeniza(0);
        }
        //echo "campo - $campo -- busca - $busca";
        //echo "<br>";
        if ($search->getnome() !== '' && $search->getsinistro() !== '') {
            //echo "search nao esta nulo".$search->getnome();die;
            if (($search->getsinistro() != null || $search->getendosso() != null) && $campo != null){
                //echo "sinistro defenido";
                $sql .= "$campo like '%".$busca."%'";
            }elseif($search->getnome() != null){
                //echo "nome defenido";
                $sql .= "nome like '%".$search->getnome()."%'";
            }
            if($search->getnome() == null && $campo == null){
             $sql .= ' vlindeniza > '.$search->getvlindeniza().' ';
            }else{
             $sql.= ' AND vlindeniza > '.$search->getvlindeniza().' ';
            }
        }else{
            //echo $search->getsinistro();
            //echo "search esta nulo";die;
           //$sql .= "1";
          $sql.= ' vlindeniza > '.$search->getvlindeniza().' ';
        }
        //$sql .= " AND vlindeniza > ".$search->getvlindeniza();
        //$sql .= " AND exclui like '0' ";
        //$sql .= ' ORDER BY ' . $orderBy;
        //print_r($sql);
        //echo "<br><br>";
        return $sql;
        
    }
    private function getBuscaSql2(OdbcSearchCriteria $search = null){
        $sql = "SELECT * FROM sinipend WHERE ";
        //$sql .= "SINISTRO='".$search->getsinistro()."'";
        //var_dump($search->setsinistro(0));
        if(@$search->getENDOSSO()){
         $campo='ENDOSSO';
         $busca=$search->getENDOSSO();
        }elseif(@$search->getsinistro()){
         $campo='SINISTRO';
         $busca=$search->getsinistro();
        }
        //print_r($search);die;
        if($search->getIMPORTANCIA_SEGURADA() == null){
            //echo "nulo";
            $search->setIMPORTANCIA_SEGURADA(0);
        }
        //print_r($search);
        //var_dump($search->getsinistro() != null);die;
        //var_dump($search->getTITULAR() != null || $search->getsinistro() != null);die;
        if ($search->getTITULAR() != null || $search->getsinistro() != null || $search->getENDOSSO() != null) {
         //echo $search->getENDOSSO();
            //echo "search nao esta nulo".$search->getnome();die;
            if ($search->getsinistro() != null || $search->getENDOSSO() != null) {
                //echo "sinistro defenido";
                $sql .= "$campo like '%".$busca."%'";
            }elseif($search->getTITULAR() != null){
                //echo "nome defenido";
                $sql .= "TITULAR like '%".$search->getTITULAR()."%'";
            }
            //$sql.= ' AND IMPORTANCIA_SEGURADA > '.$search->getIMPORTANCIA_SEGURADA().' ';
        }else{
            //echo $search->getsinistro();
            //echo "search esta nulo";die;
          //$sql .= "1";
          //$sql.= ' IMPORTANCIA_SEGURADA > '.$search->getIMPORTANCIA_SEGURADA().' ';
        }
        //print_r($sql);die;
        return $sql;
    }
    private function getBuscaSql3(OdbcSearchCriteria $search = null){
        $sql = "SELECT TOP 14 * FROM sinipend WHERE ";
        $order = ' idtitular';
        //$sql .= "SINISTRO='".$search->getsinistro()."'";
        //var_dump($search->setsinistro(0));
        if(@$search->getENDOSSO()){
         $campo='ENDOSSO';
         $busca=$search->getENDOSSO();
        }elseif(@$search->getsinistro()){
         $campo='SINISTRO';
         $busca=$search->getsinistro();
        }
        //print_r($search);die;
        if($search->getIMPORTANCIA_SEGURADA() == null){
            //echo "nulo";
            $search->setIMPORTANCIA_SEGURADA(0);
        }
        if(@!$search->getidtitular()){
            $idtitular=0;
        }else{
            $idtitular=$search->getidtitular();
        }
        //print_r($search);
        //var_dump($search->getsinistro() != null);die;
        //var_dump($search->getTITULAR() != null || $search->getsinistro() != null);die;
        if ($search->getTITULAR() != null || $search->getsinistro() != null || $search->getENDOSSO() != null) {
         //echo $search->getENDOSSO();
            //echo "search nao esta nulo".$search->getnome();die;
            if ($search->getsinistro() != null || $search->getENDOSSO() != null) {
                //echo "sinistro defenido";
                $sql .= "$campo like '%".$busca."%'";
            }elseif($search->getTITULAR() != null){
                //echo "nome defenido";
                $sql .= "TITULAR like '%".$search->getTITULAR()."%'";
            }
            if($search->getIMPORTANCIA_SEGURADA()>0){
              $sql.= ' AND IMPORTANCIA_SEGURADA > '.$search->getIMPORTANCIA_SEGURADA().' ';
            }
        }else{
            //echo $search->getsinistro();
            //echo "search esta nulo";die;
          if($search->getIMPORTANCIA_SEGURADA()>0){
            $sql.= ' IMPORTANCIA_SEGURADA > '.$search->getIMPORTANCIA_SEGURADA().' ';
          }else{
            $sql .= "1";           
          }
        }
        $sql .= ' AND idtitular > '.$idtitular.' ';
        //print_r($sql);die;
        $sql .= ' ORDER BY '.$order;
        //print_r($sql);
        return $sql;
    }
    private function getBuscaSql4(OdbcSearchCriteria $search = null){
        $sql = "SELECT TOP 14 * FROM Beneficiarios WHERE ";
        $order = ' idbenefi';
        //$sql .= "SINISTRO='".$search->getsinistro()."'";
        //var_dump($search->setsinistro(0));
        if(@$search->getENDOSSO()){
         $campo='endosso';
         $busca=$search->getENDOSSO();
        }elseif(@$search->getsinistro()){
         $campo='sinistro';
         $busca=$search->getsinistro();
        }
        //print_r($search);die;
        if($search->getvlindeniza() == null){
            //echo "nulo";
            $search->setvlindeniza(0);
        }
        if(@!$search->getidbenefi()){
            $idbenefi=0;
        }else{
            $idbenefi=$search->getidbenefi();
        }
        //print_r($search);
        //var_dump($search->getsinistro() != null);die;
        //var_dump($search->getTITULAR() != null || $search->getsinistro() != null);die;
        if ($search->getnome() != null || $search->getsinistro() != null || $search->getendosso() != null) {
         //echo $search->getENDOSSO();
            //echo "search nao esta nulo".$search->getnome();die;
            if ($search->getsinistro() != null || $search->getendosso() != null) {
                //echo "sinistro defenido";
                $sql .= "$campo like '%".$busca."%'";
            }elseif($search->getnome() != null){
                //echo "nome defenido";
                $sql .= "nome like '%".$search->getnome()."%'";
            }
            $sql.= ' AND vlindeniza > '.$search->getvlindeniza().' ';
        }else{
            //echo $search->getsinistro();
            //echo "search esta nulo";die;
          //$sql .= "1";
          $sql.= ' vlindeniza > '.$search->getvlindeniza().' ';
        }
        $sql .= " AND idbenefi > $idbenefi ";
        //print_r($sql);die;
        $sql .= ' ORDER BY '.$order;
        //print_r($sql);die;
        return $sql;
    }
    private function getBuscaSql5(OdbcSearchCriteria $search = null){
        $sql = "SELECT * FROM Beneficiarios WHERE ";
            $idbenefi=$search->getidbenefi();
                $sql .= "idbenefi=$idbenefi";
        return $sql;
    }
    private function getBuscaSql6(OdbcSearchCriteria $search = null){
        $sql = "SELECT * FROM sinipend WHERE ";
        $order = ' SINISTRO';
        if(@$search->getENDOSSO()){
         $campo='ENDOSSO';
         $busca=$search->getENDOSSO();
        }elseif(@$search->getsinistro()){
         $campo='SINISTRO';
         $busca=$search->getsinistro();
        }
        if($search->getIMPORTANCIA_SEGURADA() == null){
            $search->setIMPORTANCIA_SEGURADA(0);
        }
        if ($search->getTITULAR() != null || $search->getsinistro() != null || $search->getENDOSSO() != null) {
            if ($search->getsinistro() != null || $search->getENDOSSO() != null) {
                $sql .= "$campo like '%".$busca."%'";
            }elseif($search->getTITULAR() != null){
                $sql .= "TITULAR like '%".$search->getTITULAR()."%'";
            }
        }
        $sql .= ' ORDER BY'.$order;
        //print_r($search);
        //print_r($sql);die;
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
            INSERT INTO Beneficiarios (idbenefi,idtitular,sinistro,apolice,endosso,nome,tipo,endereco,numero,complemento,bairro,municipio,estado,uf,cep,vlindeniza,tpcobertura,cpf,identidade,percentual,tel_fixo,tel_cel,email,banco,agencia,conta,abertura,modificacao)
                VALUES (:idbenefi,:idtitular,:sinistro,:apolice,:endosso,:nome,:tipo,:endereco,:numero,:complemento,:bairro,:municipio,:estado,:uf,:cep,:vlindeniza,:tpcobertura,:cpf,:identidade,:percentual,:tel_fixo,:tel_cel,:email,:banco,:agencia,:conta,:abertura,:modificacao)';
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
            modificacao=:modificacao
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
            ':modificacao' => self::formatDateTime($odbc->getmodificacao())
        );
        if ($odbc->getidbenefi()) {
            unset($params[':abertura']);
        }
        return $params;
    }
    private function execute($sql, Odbc $odbc) {
        $statement = $this->getDb()->prepare($sql);
        $this->executeStatement($statement, $this->getParams($odbc));
        if (!$todo->getId()) {
            return $this->findById($this->getDb()->lastInsertId());
        }
        if (!$statement->rowCount()) {
            throw new NotFoundException('Processo com ID "' . $odbc->getId() . '" nao existe.');
        }
        return $odbc;
    }
}