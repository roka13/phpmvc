<?php
$url1= $this->url->create('Dbtables/create' );
$url2= $this->url->create('Dbtables/delete' );
$url3= $this->url->create('Dbtables/edit' );
$url4= $this->url->create('Dbtables/edit' );

$url1 =$url2 =$url3 =$url4 =$this->url->create('Dbtables/empty' );

<<<<<<< HEAD
$button1= "<form action='$url1' method='get'><button>Lägg till ny tabell</button></form>";

$button2= "<form action='$url2' method='get'><button>Ta bort befintlig tabell</button></form>";

$button3= "<form action='$url3' method='get'><button>Redigera befintlig tabell</button></form>";

$button4= "<form action='$url4' method='get'><button>Lägg till fält i befimtlig tabell</button></form>";
=======
$button1= "<td><form action='$url1' method='get'><button>Lägg till ny tabell</button></form></td>";

$button2= "<td><form action='$url2' method='get'><button>Ta bort befintlig tabell</button></form></td>";

$button3= "<td><form action='$url3' method='get'><button>Redigera befintlig tabell</button></form></td>";

$button4= "<td><form action='$url4' method='get'><button>Lägg till fält i befimtlig tabell</button></form></td>";
>>>>>>> dfb112fc2e73c8ab382cf2b88b1d62325c4e5dbf


?>

 <h1>Huvudmeny för mina Datatabeller</h1>
 <div>
 <div class='float left'>
 <h3>Välj tabell :</h3>
<<<<<<< HEAD
 <p> Lista samtliga fält</p>
 <p>och poster i tabellen</p>
=======
 <p> Lista samtliga fält</br> och poster i tabellen</p>
>>>>>>> dfb112fc2e73c8ab382cf2b88b1d62325c4e5dbf
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
<<<<<<< HEAD
<?=$button1?>
<?=$button2?>
<?=$button3?>
<?=$button4?>


=======
<p><?=$button1?></p>
<p><?=$button2?></p>
<p><?=$button3?></p>
<p><?=$button4?></p>

</p>
>>>>>>> dfb112fc2e73c8ab382cf2b88b1d62325c4e5dbf
</div>
</div>


