<?php
// setup url and buttons
 $properties = $user->getProperties();
	
 $url1= $this->url->create('users/update/' . $properties['id']);
 $url2= $this->url->create('users/unactivate/' . $properties['id']);
 $url3= $this->url->create('users/activate/'. $properties['id']);
 $url4= $this->url->create('users/softdelete/' . $properties['id']);
 $url5= $this->url->create('users/softundelete/' . $properties['id']);
 $url6= $this->url->create('users/delete/' . $properties['id']);
 $url7= $this->url->create('users/list');
 
 $button1= "<td><form action='$url1' method='get'><button>Uppdatera</button></form></td>";
 $button2= "<td><form action='$url2' method='get'><button>Avaktivera</button></form></td>";  
 $button3= "<td><form action='$url3' method='get'><button>Aktivera</button></form></td>";
 $button4= "<td><form action='$url4' method='get'><button>Till papperskorg</button></form></td>";
 $button5= "<td><form action='$url5' method='get'><button>Ångra Papperskorg</button></form></td>";
 $button6= "<td><form action='$url6' method='get'><button>Ta bort Definitivt</button></form></td>"; 
 $button7= "<td><form action='$url7' method='get'><button>Åter till Visa Alla</button></form></td>";

 //check status and unset not applicable  buttons 
   switch($properties['status']){
		case 'aktiv':
			$button3=$button5=$button6=null;
		break;	
		
		case 'inaktiv':
			$button1=$button2=$button5=$button6=null;
		break;

		case 'papperskorg':
			$button1=$button2=$button3=$button4=null;
		break;	
	
		default:
	}
?>


<h2><?=$title?> med Idnr <?= $properties['id'] ?>  är  <?= $properties['name'] ?></h2>

<table >
	    <tr><td>Alias:</td><td> <?= $properties['acronym'] ?></td><?=$button1?></tr>
	    <tr><td>Namn:</td><td> <?= $properties['name'] ?></td><?=$button2?></tr>
	    <tr><td>Epost:</td><td> <?= $properties['email'] ?></td><?=$button3?></tr>
	    <tr><td>Skapad: </td><td><?= $properties['created'] ?></td><?=$button4?></tr>
	    <tr><td>Uppdaterad: </td><td><?= $properties['updated'] ?></td><?=$button5?></tr>
	    <tr><td>Borttagen: </td><td><?= $properties['softdeleted'] ?></td><?=$button6?></tr>
	    <tr><td>Status:</td><td><?=$properties['status'] ?></td><?=$button7?></tr>
</table>