<?php
namespace Roka\Dbtables;

/**
 * HTML Form elements.
 *
 */
class DbTablesTest extends \PHPUnit_Framework_TestCase
{

private $dbTable;


 public function setUp(){
 
// Create services and inject into the app. 
$di  = new \Anax\DI\CDIFactoryDefault();
$app = new \Anax\Kernel\CAnax($di);
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app = new \Anax\MVC\CApplicationBasic($di);

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
  // $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
	 $db->setOptions(require ANAX_APP_PATH . 'config/config_sqlite.php');
    $db->connect();
    return $db;
	//$this->db->setDI($this->di);
	
});
$di->set('DbtablesController', function() use ($di) {
    $controll = new \Roka\Dbtables\DbtablesController();
    $controll->setDI($di);
    return $controll;
});

  $this->dbTable =$di->get('DbtablesController');
// $this->db = $di->get('db');
		
	}	
    /**
     * Test 
     *
     * @return void
     *
     */
    public function testSelectTable() {
 
	 $this->dbTable->selectAction();
		//select;
 	 /*
	try{
	

		}
		catch(Exception $e){
	}*/
	}
	
	 /**
     * Test 
     *
     * @return void
     *
     */
    public function testListTable() {
	
	$_POST['tblName']= 'comments';
		$this->dbTable->listAction();
	
	}
	
	 /**
     * Test 
     *
     * @return void
     *
     */
    public function testEmptyTable() {
	
		$this->dbTable->emptyAction();
	
	}
	
	
	

	
} // end of class