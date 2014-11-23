<?php

/**
 * Database wrapper, provides a database API for the framework but hides details of implementation.
 *
 */
class CContent extends CDatabase{
 
  /**
   * Members
  */ 
  private $options;                   // Options used when creating the PDO object
 // private $db   = null;               // The PDO object
 // private $stmt = null;               // The latest statement used to execute a query
 // private static $numQueries = 0;     // Count all queries made
//  private static $queries = array();  // Save all queries for debugging purpose
  private static $params = array();   // Save all parameters for debugging purpose



 /**
   * Constructor creating a PDO object connecting to a choosen database.
 */
/*
public function __construct($options)
  {
 parent::__construct($options);
 } 
 */
 /*$default = array(
      'dsn' => null,
      'username' => null,
      'password' => null,
      'driver_options' => null,
      'fetch_style' => PDO::FETCH_OBJ,
	
    );
    $this->options = array_merge($default, $options);
 
    $this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
    $this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']); 
	 // Get debug information from session if any.
    if(isset($_SESSION['CDatabase'])) {
      self::$numQueries = $_SESSION['CDatabase']['numQueries'];
      self::$queries    = $_SESSION['CDatabase']['queries'];
      self::$params     = $_SESSION['CDatabase']['params'];
      unset($_SESSION['CDatabase']);
	  
	  }
	*/


/*
*  Funktion för att visa utvalda data i databasen 
*  params $sgl är urvalsfrågan
* returns a Table
*/
function readContent($sql, $params = null){

// $sql= " select * from Content" ;
$res = ExecuteSelectQueryAndFetchAll($sql, $params);

// rubrik till tabell
$rubrik= $res[0];
$html ="<div><table><tr>";
foreach ($rubrik as $key => $val )
	{
	 $html .="<th>$key</th>";
	}

 // rader till tabellen	

	foreach($res as $key => $val) 
	{
	$html .="<tr>";
		foreach ( $val as $rad => $val2)
		{
				
		$html .=" <td>$val2</td> ";
		}		
	$html .= "</tr>";
	}
	$html .="</table></div>";
	
return $html;
}

/**
 * Create a link to the content, based on its type.
 *
 * @param object $content to link to.
 * @return string with url to display content.
 */
function getUrlToContent($content) {
  switch($content->TYPE) {
    case 'page': return "page.php?url={$content->url}"; break;
    case 'post': return "blog.php?slug={$content->slug}"; break;
    default: return null; break;
  }
}

/*
*  Function för att skapa menyn
*/
function selectContent($sql,$params = null){

$res = $this->ExecuteSelectQueryAndFetchAll($sql,$params);

/// Put results into a list
$html = "<ul>";

foreach($res AS $key => $val) {
  $html .= "<li>{$val->TYPE} (" . (!$val->available ? 'inte ' : null) . "publicerad): " . htmlentities($val->title, null, 'UTF-8') . " (<a href='edit.php?id={$val->id}'>editera</a> <a href='" . $this ->getUrlToContent($val) . "'>visa</a>)</li>\n";
}

$html .= "</ul>";
return $html;
}


/** Function för att hämta en lista genrer och skapa en länkad 
*lista av dem.
*  Param $res innehåller resultatet av sökning i databasen
*/
function readGenres($genre){
// Hämta hem en lista med använda genre´er
$sql ="SELECT DISTINCT G.name
FROM genre AS G
  INNER JOIN movie2genre AS M2G
    ON G.id = M2G.idGenre";
	
$res = $this -> ExecuteSelectQueryAndFetchAll($sql);

/*$html = " <h4>";
// rader till tabellen		
foreach($res as  $val) 
	{
	$html .= "<a href='?genre={$val -> name}'>{$val -> name}</a>" ;
	}
$html .="</h4>";
return $html; */
$genres = null;
foreach($res as $val) {
  if($val->name == $genre) {
    $genres .= "$val->name ";
  }
  else {
    $genres .= "<a href='" . $this->getQueryString(array('genre' => $val->name)) . "'>{$val->name}</a> ";
  }
  
}
//$genres .= "</h4>";
return $genres;
 }	
 

/* Function för att hämta en lista av rubriker till tabellen
*  Param $res innehåller resultatet av sökning i databasen
*/
function readHeads( $sql = null){
if (!$sql)
{
$sql = "SELECT * comments";
}
$res = $this->ExecuteSelectQueryAndFetchAll($sql);
$rubrik= $res[0];
$html ="<div><table><tr>";
foreach ($rubrik as $key => $val )
	{
	 $html .="<th>$key</th>";
	}
//echo $html;
return $html;
 }
 
 /** Function för att hämta en lista av rubriker till tabellen
*  Param $res innehåller resultatet av sökning i databasen med inlagda länkar för 
*sortering
*/
// Put results into a HTML-table
/*$tr = "<tr><th>Rad</th><th>Id " . orderby('id') . "</th><th>Bild</th><th>Titel " . orderby('title') . "</th><th>År " . orderby('year') . "</th><th>Genre</th></tr>";
foreach($res AS $key => $val) {
  $tr .= "<tr><td>{$key}</td><td>{$val->id}</td><td><img width='80' height='40' src='{$val->image}' alt='{$val->title}' /></td><td>{$val->title}</td><td>{$val->year}</td><td>{$val->genre}</td></tr>";
}
*/
function getRubriks(){
/* rubrikrad till tabellen
*tabellhuvud
*/
$sql = 'SELECT * FROM vmovie';
$res = $this->ExecuteSelectQueryAndFetchAll($sql);
$rubrik= $res[0];
$html ="<div><table><tr>";
foreach ($rubrik as $key => $val )
	{
	 $html .="<th>$key";
	 
	 if(in_array($key, array('id', 'Titel','Regissör','Produktionsår')))
	 {
	 $html .= $this-> orderby($key);
	 }
	 $html .= "</th>";
	}
	
//echo $html;
return $html;
 }	
 
 /**
 * Function to create links for sorting
 *
 * @param string $column the name of the database column to sort by
 * @return string with links to order by column.
 */
function orderby($column)
 {
  $nav  = "<a href='" .$this-> getQueryString(array('orderby'=>$column, 'order'=>'asc')) . "'>&darr;</a>";
  $nav .= "<a href='" . $this->getQueryString(array('orderby'=>$column, 'order'=>'desc')) . "'>&uarr;</a>";
  return "<span class='orderby'>" . $nav . "</span>";
 
 // return "<a href='?orderby={$column}&amp;order=asc'>&darr;</a> <a href='?orderby={$column}&amp;order=desc'>&uarr;</a>";	
}

// för att hämta samtliga godkända rubriker för kontroll av inmatning
function getHeadArray()
{
$sql = "SELECT * FROM vmovie;";
$res = $this->ExecuteSelectQueryAndFetchAll($sql);
$head = array();
$rubrik= $res[0];
foreach ($rubrik as $key => $val )
	{
	$head[]= strtolower($key);
	}
return $head;
 }	
 
 /** 
 * This function will not validate in unicorn. Use the other one below:
 * Use the current querystring as base, modify it according to $options and return the modified query string
 * @param array $options to set/change.
 * @param string $prepend this to the resulting query string
 * @return string with an updated query string.
*/
function getQueryString($options, $prepend='?') {
  // parse query string into array
  $query = array();
  parse_str($_SERVER['QUERY_STRING'], $query);
 //Modify the existing query string with new options
  $query = array_merge($query, $options);
//Return the modified querystring
 return $prepend . htmlentities(http_build_query($query));
}


/**
 * @param array $options to set/change.
 * @return string with an updated query string. 

function  getQueryString($options){
 $query = array();
  parse_str($_SERVER['QUERY_STRING'], $query);
// echo " Efter parsning";
// dump($query);
 //Modify the existing query string with new options
 $query = array_merge($query, $options);
// dump($query);
$html= null;
	foreach($query as $key => $val) 
	{
	$html .= "$key=$val&amp;";
	}	
$out = "?$html";
//echo $out;
return $out;
}
*/
/**
 * Create links for hits per page.
 *
 * @param array $hits a list of hits-options to display.
 * @return string as a link to this page.
 */
public function getHitsPerPage($hits,$current= null) {
  $nav = "Träffar per sida: ";
  foreach($hits AS $val) 
  {
   if($current == $val) {
      $nav .= "$val ";
    } 
	else
	{
    $nav .= "<a href='" .$this-> getQueryString(array('hits' => $val)) . "'>$val</a> ";
  }  
  }
  return $nav;
}


/**
 * Create navigation among pages.
 *
 * @param integer $hits per page.
 * @param integer $page current page.
 * @param integer $max number of pages. 
 * @param integer $min is the first page number, usually 0 or 1. 
 * @return string as a link to this page.
 */
public function getPageNavigation($hits, $page, $max,$min=1) {
  $nav  = "<a href='".$this->getQueryString(array('page' => $min))."'>Första Sidan</a>";
  $nav .= "<a href='".$this->getQueryString(array('page' => ($page > $min ? $page - 1 : $min) ))."'>Föregående sida</a>";
 
  for($i=$min; $i<=$max; $i++) 
  {
    $nav .= "<a href='".$this->getQueryString(array('page' => $i))."'>$i</a>";
  }
 
  $nav .= "<a href='".$this->getQueryString(array('page' => ($page < $max ? $page + 1 : $max) ))."'>Nästa sida</a>";
  $nav .= "<a href='".$this->getQueryString(array('page' => $max))."'>Sista sidan</a>";
  return $nav;
}
public function removeMovie($id)
{
$sql = "DELETE FROM movie WHERE  id = $id LIMIT 1" ;
 $params = array($id);
   $this->ExecuteQuery($sql,$params);
$this-> SaveDebug("Det raderades " .$this-> RowCount() . " rader från databasen.");
}
}