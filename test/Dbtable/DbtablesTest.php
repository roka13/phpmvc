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

$di->set('DbtablesController', function() use ($di) {
    $controll = new \Roka\Dbtables\DbtablesController();
    $controll->setDI($di);
    return $controll;
});

$di->setShared('db', function() {
    $db = new \Mos\Database\CDatabaseBasic();
  // $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
	 $db->setOptions(require ANAX_APP_PATH . 'config/config_sqlite.php');
    $db->connect();
    return $db;
	//$this->db->setDI($this->di);
	
});


  $this->dbTable =$di->get('DbtablesController');
 $this->db = $di->get('db');
		
	}	
	
	 /**
     * Test Create new table, populate it
     * with testdata and fetch it to compare
     * @return void
     *
     */
    public function testCreateReadDb() {

	$sql="DROP TABLE IF EXISTS 'test'";
	$stmt= $this->db->execute($sql);
	
	$sql="CREATE TABLE test(
		id integer primary key ,
		namn varchar(10),
		yrke varchar(10),
		betyg varchar(3)
	)";
	$this->db->execute($sql);
	
	$values =array(5,'jonte','sotare','aaa');
	$sql="INSERT INTO test VALUES( 5,'jonte','sotare','aaa')";
	$this->db->execute($sql);
	
	$sql="SELECT * FROM test";
	$res=$this->db->execute($sql);
	$res=$this->db->fetchAll();
	$answer=array();
	
	$answer= $this->dbTable->readContentToArray($res);
	$this->assertEquals($values,$answer,' not equal');
}
	
	
	
	
    /**
     * Test 
     *
     * @return void
     *
     */
    public function testSelectTable() {
 
	 $this->dbTable->selectAction();

	}
	
	 /**
     * Test 
     *
     * @return void
     *
     */
    public function testListTable() {
	
	$_POST['tblName']= 'test';
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