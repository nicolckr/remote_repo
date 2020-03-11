<html>
	<head>
		<link rel="stylesheet" href="css/formate.css">
	</head>
	
	<body>

<?php

	require_once('config/db.php');				//Fügt hier den Inhalt der Datei db.php ein

	if(isset($_GET['p_id']) && isset($_GET['action']))
	{
		/*echo $_GET['p_id'];
		echo $_GET['action'];*/
		if($_GET['action']=="delete")
		{
			$sql="delete from personen where p_id = ".$_GET['p_id'];
			//echo "<br>". $sql;
			$result = mysqli_query($db, $sql);
			header("Location: ?page=personen");
		}
		elseif($_GET['action']=="view")
		{
			$sql="SELECT * 
				  from personen left join klassen using(k_id)
								left join bildungsgaenge using(bg_id)				  
				  where p_id = ".$_GET['p_id'];
				  
			$result = mysqli_query($db, $sql);
			$satz = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			echo "<h1>Informationen</h1><br>

			ID:".$satz['p_id']."<br>
			Name:".$satz['p_name']."<br>
			Vorname:".$satz['p_vname']."<br>
			User:".$satz['p_user']."<br>
			E-Mail:".$satz['p_mail']."<br>
			Klasse:".$satz['k_name']."<br>
			Bildungsgang:".$satz['bg_name']."<br>";
			
		}
	}
	$sql = "SELECT * from personen left join klassen using(k_id) left join bildungsgaenge using(bg_id) order by p_name";
    $result = mysqli_query($db, $sql);		//sql-Abfrage wird in die Variable $result übergeben

    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);			//alle Zeilen der Abfrage, die in $result stehen, werden als 2-dim, assoziatives Array, in die Variable $data übergeben

		echo "<h1>Personen</h1>";

    echo "<hr>";
		echo "<table border=2>";						//Tabelle mit der Headerzeile
	echo "<tr>
						<th>p_name</th>
						<th>p_vname</th>
						<th>p_user</th>
						<th>bg_name</th>
						<th>k_name</th>
						<th>action</th>
	      	</tr>";
    //mysqli_data_seek($result,0);
    //while($satz = mysqli_fetch_array($result,MYSQLI_ASSOC))
		foreach($data as $satz)		//aus dem 2-dim, assoziativen Array, werden die Abfrageergebnisse aufgeteilt. Also je nachdem, welches Array (Indize) angesprochen wird. Solange die Variable $data noch ein neues Ergebnis übergibt, läuft die foreach-Schleife
    {
		echo "<tr>
				<td>".$satz['p_name']."</td>
				<td>".$satz['p_vname']."</td>
				<td>".$satz['p_user']."</td>
				<td>".$satz['bg_name']."</td>
				<td>".$satz['k_name']."</td>
				<td>
					<a href='?page=personen&action=view&p_id=".$satz['p_id']."'><img src='icons/view.png' width=15></a>
					<a href='?page=personen&action=edit&p_id=".$satz['p_id']."'><img src='icons/bearbeiten.png' width=15></a>
					<a href='?page=personen&action=delete&p_id=".$satz['p_id']."'><img src='icons/loeschen.png' width=15></a>
				</td>

			  </tr>";

	    /* foreach($satz as $feld)
        {
			echo "<td>";
            echo "$feld | ";
			echo "
        }
		*/


	}
	echo "</table>";

?>

	</body>
</html>