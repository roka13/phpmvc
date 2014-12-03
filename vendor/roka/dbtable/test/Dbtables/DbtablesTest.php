<?php
namespace Roka\Dbtables;

/**
 * HTML Form elements.
 *
 */
class DbTablesTest extends \PHPUnit_Framework_TestCase
{
public $dbTable;
public static $db;


public static function setUpBeforeClass(){

	try {
			$data= "../roka/test/roka2.db";
		self::$db= new \PDO("sqlite:$data",'ATTR_DEFAULT_FETCH_MODE');
	//	self::$db= setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE);
	//$dbase= self::$db;
	// $this->dbTable =new \Roka\Dbtables\DbtablesController($dbase);
	 
		} catch(\Exception $e) {
			throw new \PDOException("Could not connect to database");          
		}
    }

    public static function tearDownAfterClass()
    {
       self::$db = NULL;
    }


public function setUp(){
 
	//$this->dump('db');
	$dbase=self::$db;
	 $this->dbTable =new \Roka\Dbtables\DbtablesController($dbase);
	}	



    /**
     * Test 
     *
     * @return void
     *
     */
    public function testSelectTable() {
	

	   
	$this->dbTable->selectAction();
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