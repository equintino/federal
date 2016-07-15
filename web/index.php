<?PHP
// Main application class.
final class Index {
    const DEFAULT_PAGE = 'home';
    const PAGE_DIR = '../page/';
    const LAYOUT_DIR = '../layout/';
// System config.
    public function init() {
		// error reporting - all errors for development (ensure you have display_errors = On in your php.ini file)
        error_reporting(E_ALL | E_STRICT);
        mb_internal_encoding('UTF-8');
        set_exception_handler(array($this, 'handleException'));
        spl_autoload_register(array($this, 'loadClass'));
        // session
        session_start();
    }
//     Run the application!
    public function run() {
        $this->runPage($this->getPage());
    }
//     Exception handler.
    public function handleException(Exception $ex) {
        $extra = array('message' => $ex->getMessage());
        if ($ex instanceof NotFoundException) {
            header('HTTP/1.0 404 Not Found');
            $this->runPage('404', $extra);
        } else {
            // TODO log exception
            header('HTTP/1.1 500 Internal Server Error');
            $this->runPage('500', $extra);
        }
    }
//    Class loader.
    public function loadClass($name) {
        $classes = array(
            'Config' => '../config/Config.php',
            'Error' => '../validation/Error.php',
            'Flash' => '../flash/Flash.php',
            'NotFoundException' => '../exception/NotFoundException.php',
            'TodoDao' => '../dao/TodoDao.php',
            'OdbcDao' => '../dao/OdbcDao.php',
            'TodoMapper' => '../mapping/TodoMapper.php',
            'OdbcMapper' => '../mapping/OdbcMapper.php',
            'Todo' => '../model/Todo.php',
            'Odbc' => '../model/Odbc.php',
            'TodoSearchCriteria' => '../dao/TodoSearchCriteria.php',
            'OdbcSearchCriteria' => '../dao/OdbcSearchCriteria.php',
            'TodoValidator' => '../validation/TodoValidator.php',
            'Utils' => '../util/Utils.php',
        );
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        require_once $classes[$name];
    }

    private function getPage() {
        $page = self::DEFAULT_PAGE;
        if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
        }
        return $this->checkPage($page);
    }

    private function checkPage($page) {
        if (!preg_match('/^[a-z0-9-]+$/i', $page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Unsafe page "' . $page . '" requested');
        }
        if (!$this->hasScript($page) && !$this->hasTemplate($page)) {
            // TODO log attempt, redirect attacker, ...
            throw new NotFoundException('Page "' . $page . '" not found');
        }
        return $page;
    }

    private function runPage($page, array $extra = array()) {
        $run = false;
        if ($this->hasScript($page)) {
            $run = true;
            require $this->getScript($page);
        }
        if ($this->hasTemplate($page)) {
            $run = true;
            // data for main template
            $template = $this->getTemplate($page);
            $flashes = null;
            if (Flash::hasFlashes()) {
                $flashes = Flash::getFlashes();
            }

            // main template (layout)
            require self::LAYOUT_DIR . 'index.phtml';
        }
        if (!$run) {
            die('Page "' . $page . '" has neither script nor template!');
        }
    }

    private function getScript($page) {
        return self::PAGE_DIR . $page . '.php';
    }

    private function getTemplate($page) {
        return self::PAGE_DIR . $page . '.phtml';
    }

    private function hasScript($page) {
        return file_exists($this->getScript($page));
    }

    private function hasTemplate($page) {
        return file_exists($this->getTemplate($page));
    }
}
$index = new Index();
$index->init();
// run application!
$index->run();
    /*
include '../dao/odbc.class.php';


// chama a classe //
$teste = new odbc();
print_r($teste -> listaTabela());// Listar tabelas // ok

$tabela = 'sinipend';
$campo = 'TITULAR';
$busca = 'MARIA julia';
//$sql = "SELECT * FROM $tabela WHERE $campo LIKE '%$busca%'";// busca //
//$sql = "SELECT * FROM $tabela WHERE 1";// lista todo o conteudo //
//$teste -> listaConteudo($sql);// metodo de busca //
//$tabela = 'Beneficiarios';
echo "<br>";
$col1 = "ENDOSSO";
$col2 = "TITULAR";
//print_r(odbc_result($result,$col1));
//echo ' - ';
//print_r(odbc_result($result,$col2));
//echo '<br>';
$data = array('TITULAR','ENDOSSO');
$sql = "SELECT * FROM $tabela WHERE 1";
//$teste->listaCampo($sql,$data);// executa uma query // ok
print_r($teste->listaColunas($sql));// lista colunas // ok
die;

//// area de teste ////
$tabela='Beneficiarios';
$sql="UPDATE `$tabela` SET `idtitular`='1' WHERE `idbenefi`=1";
$sql2="SELECT * FROM `$tabela` WHERE `idbenefi`=1";


$result=  odbc_exec($conn,$sql);
$result2=  odbc_exec($conn,$sql2);
odbc_commit($conn);
var_dump($result);
ECHO '<BR>';
$i=2;
$campo=odbc_num_fields($result2);
$campo2=odbc_field_name($result2,$i);
print_r($campo2);
echo ' -> ';
echo(odbc_result($result2,$campo2));

//// fim area de teste ////


//// fecha conexao ////	
odbc_close($conn);
die;
	
$table="Beneficiarios";
$sql = "SELECT * FROM $table"; 
$result=odbc_exec($conn,$sql);
//odbc_result_all($result, 'id="users" class="listing"');
//odbc_result_all($result, 'border=1');
odbc_result_all($result, 'Border=0 cellspacing=0 cellpadding=5', "style='FONT-FAMILY:Tahoma; FONT-SIZE:8pt; BORDER-BOTTOM:solid 1pt gree'");
while ($rows = odbc_fetch_object($result)) {
    //print $rows->COLUMNNAME;
}
     * 
     */
?>