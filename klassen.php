<html>
	<head>
		<link rel="stylesheet" href="css/formate.css">
	</head>
	
	<body>

<?php

	require_once('config/db.php');				//Fügt hier den Inhalt der Datei db.php ein

	if(isset($_GET['k_id']) && isset($_GET['action']))
	{
		//echo $_GET['k_id'];
		//echo $_GET['action'];
		if($_GET['action']=="delete")
		{
			$sql="delete from klassen where k_id = ".$_GET['k_id'];
			//echo "<br>".$sql;
			$result = mysqli_query($db, $sql);
			header("Location: ?page=klassen");
		}
	}
	
    $result = mysqli_query($db, "SELECT * from klassen left join bildungsgaenge using(bg_id) order by k_name");		//sql-Abfrage wird in die Variable $result übergeben

    $data = mysqli_fetch_all($result,MYSQLI_ASSOC);			//alle Zeilen der Abfrage, die in $result stehen, werden als 2-dim, assoziatives Array, in die Variable $data übergeben

		echo "<h1>Klassen und Bildungsgang</h1>";

    echo "<hr>";
		echo "<table border=2>";						//Tabelle mit der Headerzeile
    echo "<tr>
			<th>k_id</th>
			<th>k_name</th>
			<th>bg_id</th>
			<th>bg_name</th>
			<th>action</th>
	      </tr>";
    //mysqli_data_seek($result,0);
    //while($satz = mysqli_fetch_array($result,MYSQLI_ASSOC))
		foreach($data as $satz)		//aus dem 2-dim, assoziativen Array, werden die Abfrageergebnisse aufgeteilt. Also je nachdem, welches Array (Indize) angesprochen wird. Solange die Variable $data noch ein neues Ergebnis übergibt, läuft die foreach-Schleife
    {
		echo "<tr>
				<td>".$satz['k_id']."</td>
				<td>".$satz['k_name']."</td>
				<td>".$satz['bg_id']."</td>
				<td>".$satz['bg_name']."</td>
				<td>
					<a href='?page=klassen&action=view&k_id=".$satz['k_id']."'><img src='icons/view.png' width=15></a>
					<a href='?page=klassen&action=edit&k_id=".$satz['k_id']."'><img src='icons/bearbeiten.png' width=15></a>
					<a href='?page=klassen&action=delete&k_id=".$satz['k_id']."'><img src='icons/loeschen.png' width=15></a>
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