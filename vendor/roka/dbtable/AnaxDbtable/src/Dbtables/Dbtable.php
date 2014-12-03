<?php


namespace Roka\Dbtables;
class Dbtable extends \Roka\Dbtables\DbtablesModel
{ 
  /**
   * Properties
   */
  private $options;
  private $db = null;
  private $tbl = null;
	
  /**
   * Constructor
   *
   * @param array $options to alter the default behaviour.
   */
  public function __construct() {
 
  $tbl = isset($_POST['tblName'])  ?($_POST['tblName'])   : null; // Selected directory as ?dir=xxx
    $db = new \Mos\Database\CDatabaseBasic();
  // $db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');
	 $db->setOptions(require ANAX_APP_PATH . 'config/config_sqlite.php');
     $db->connect();
 
	  dump($db);
	  
	 }

/**
 * View contents from a specific datatable 
 *
 * @returns a table with all contents and
 * fieldnames
 */
 public function listAction(){
	if('tbl'){
	//	$this->theme->setTitle("Visa tabell");
		$sql1="SELECT * FROM ".'tbl';
		$content=$this->readContent($sql1);  //
	    $title =" <h3>Visar Tabell " .$tbl ."</h3>" ; 
		$content = $title . $content;
		 return $content;
		 
	/*	$this->views->add('Dbtables/show', [
			'title' =>'',
			'tblcontent' => $content,
			'tblname' => $_POST['tblName'],
		]);*/
	}
	else{
		$this->selectAction();
	}
}
	
/**
 * Method to retrieve all datatables in the database 
 *
 * @returns a select list
*/
public function selectAction(){
	//$this->theme->setTitle("Mina Datatabeller");
	$sql="SELECT tbl_name FROM sqlite_master WHERE(type='table')";
	$res=$this->db->execute($sql);
	$res= $this->db->fetchAll();
	$lista= $this->readContentToArray($res);
	$content =$this->makeList($list);
	return $content;

	/*$this->views->add('Dbtables/maintbl', [
		'title' =>'Mina Data-Tabeller',
		'lista' =>$lista,
	  ]);
	  */
}	
	
/**
 * Function to  build an array from an object
 *
 *@params $res the object
 * @returns an array with datatables name
*/
function readContentToArray($res){
	$array=array();
	foreach($res as $key => $val){ 
		foreach ( $val as $rad => $val2){
			$array[]=$val2;
		}		
	}
	return $array;
}	
	
	
/**
 * Function to build a table of the content
 * in a datatable
 * params $sql the select query
 * returns a Table
*/
function readContent($sql){
	$res= parent::execute($sql);
	$res= $this->db->fetchAll();
	// rubrik till tabell
	$rubrik= $res[0];
	$html ="<table><tr>";
	foreach ($rubrik as $key => $val ){
		$html .="<th>$key</th>";
	}
	// rader till tabellen	
	foreach($res as $key => $val){ 
		$html .="<tr>";
		foreach ( $val as $rad => $val2){	
			$html .=" <td>$val2</td> ";
		}		
		$html .= "</tr>";
	}
	$html .="</table>";
	return $html;
}	
	
function makeList($list){
$url1= $this->url->create('Dbtables/create' );
$url2= $this->url->create('Dbtables/delete' );
$url3= $this->url->create('Dbtables/edit' );
$url4= $this->url->create('Dbtables/edit' );

$url1 =$url2 =$url3 =$url4 =$this->url->create('Dbtables/empty' );

$button1= "<form action='$url1' method='get'><button>Lägg till ny tabell</button></form>";

$button2= "<form action='$url2' method='get'><button>Ta bort befintlig tabell</button></form>";

$button3= "<form action='$url3' method='get'><button>Redigera befintlig tabell</button></form>";

$button4= "<form action='$url4' method='get'><button>Lägg till fält i befimtlig tabell</button></form>";

$cont=<<<EOD
 <h1>Huvudmeny för mina Datatabeller</h1>
 <div>
 <div class='float left'>
 <h3>Välj tabell :</h3>
 <p> Lista samtliga fält</p>
 <p>och poster i tabellen</p>
  <form method='POST' action = '<?=$this->url->create('Dbtables/list')?>' >
			<select size='7' name='tblName'>
			<?php foreach($lista as $dfile):?>
			<option value= '<?=$dfile?>'><?=$dfile?></option>
			<?php endforeach; ?>	
			</select><br/>
		   <input type='submit'  value='Hämta'> 	  
    </form>
</div>

<div class ='float right'>
<h3> Länkar till övriga funktioner. </h3>
<?=$button1?>
<?=$button2?>
<?=$button3?>
<?=$button4?>
</div>
</div>
EOD;

return $cont;
}
}

	
	
	
	
	
	
	
	
	
	