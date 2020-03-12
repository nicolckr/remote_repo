<html>
	<head>
		<meta charset="utf-8">
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
			
			echo "<h2>Detailansicht der Person <b>".$satz['p_vname']." ".$satz['p_name']."</b></h1>
			
			<table>
				<tr>
					<td align=right>ID:</td>
					<td>".$satz['p_id']."</td>
				</tr>
				<tr>
					<td align=right>Name:</td>
					<td>".$satz['p_name']."</td>
				</tr>
				<tr>
					<td align=right>Vorname:</td>
					<td>".$satz['p_vname']."</td>
				</tr>
				<tr>
					<td align=right>User:</td>
					<td>".$satz['p_user']."</td>
				</tr>
				<tr>
					<td align=right>E-Mail:</td>
					<td>".$satz['p_mail']."</td>
				</tr>
				<tr>
					<td align=right>Klasse:</td>
					<td>".$satz['k_name']."</td>
				</tr>
				<tr>
					<td align=right>Bildungsgang:</td>
					<td>".$satz['bg_name']."</td>
				</tr>
			</table><br><br>

			<a href='?page=personen'>Zurück zu allen Personen</a> ";
		}
	}
	else
	{
	
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
	}

?>

	</body>
</html>