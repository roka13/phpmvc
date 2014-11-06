<h1><?=$title?></h1>
 <table >
	<tr>
        <th>Idnr</th>
        <th>Alias</th>
        <th>Namn</th>
        <th>Epost</th>
        <th>Status</th>
	<th></th>
    </tr>

<?php foreach ($users as $user) {
	$properties = $user->getProperties();

	$url = $this->url->create('users/id/' . $properties['id']);
		
	echo <<<EOD
	<tr>
		 <td> {$properties['id']}</td>
		 <td> {$properties['acronym']}</td>
		 <td> {$properties['name']}</td>
		 <td> {$properties['email']}</td>
		 <td>{$properties['status']}</td> 
		 <td><form  action="$url" method="get"><button>Mer info och redigera</button></form></td>
     </tr> 
EOD;

}
?>

</table>

 <form style="display: inline" action='<?=$this->url->create('users/add')?>' method="get">
 	 <button>Lägg till användare</button></form>
 <form style="display: inline" action='<?=$this->url->create('users/active')?>' method="get">
 	 <button>Visa Aktiva</button></form>
 <form style="display: inline" action='<?=$this->url->create('users/softdeleted')?>' method="get">
 	 <button>Visa Papperskorgen</button></form>
 <form style="display: inline" action='<?=$this->url->create('users/inactive')?>' method="get">
	  <button>Visa Inaktiva</button></form>	
 <form style="display: inline" action='<?=$this->url->create('users/list')?>' method="get">
 	 <button>Åter till Visa Alla</button></form> 
