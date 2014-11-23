<?php
namespace Anax\CButton;
/**
 * A utility class to easy creating and handling of Buttons 
 * 
 */
class ButtonController implements \Anax\DI\IInjectionAware
{
    use \Anax\DI\TInjectable;
 
 

 public function viewButton($action, $text)
{ 
$link="<form action={$action} method='get'><button>{$text}</button></form>";
	return $link;
/*
	$actions = $this->url->create($action);
	$link="<form action='{$actions}' method='get'><button>{$text}</button></form>";
	return $link;
*/
} 

}//end of class
