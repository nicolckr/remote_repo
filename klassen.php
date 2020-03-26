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
		else if ($_GET['action']=="view")
		{
			$sql="SELECT *
				  from klassen left join personen using(k_id)
				  where k_id = ".$_GET['k_id'];

			$result = mysqli_query($db, $sql);
			$satz = mysqli_fetch_array($result,MYSQLI_ASSOC);

			echo "<h2>Detailansicht zur Klasse <b>".$satz['k_name']."</b></h1>
			
			<table>
				<tr>
					<td align=right>Klasse:</td>
					<td><b>".$satz['k_name']."</b></td>
				</tr>
				<tr>
					<td align=right>Personen:</td>
					<td>".$satz['p_vname']." ".$satz['p_name']."</td>
				</tr>
			</table><br><br>
			
			<a href='?page=klassen'>Zurück zu allen Klassen</a>";
			
			/*
			while($satz = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				echo $satz['k_name'];
			}
			echo"<br>";
			*/
		}
		elseif($_GET['action']=="edit")
		{
			if(isset($_POST['k_name']))
			{
				//print_r($_POST);
				$sql="update klassen
					  set k_name='".$_POST['k_name']."',
					      bg_id = ".$_POST['bg_id']."
					  where k_id=".$_GET['k_id'] ;
				//echo $sql;
				$res=mysqli_query($db,$sql);
				echo "<br><br>Klassen geändert: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=klassen'>zurück zu den Klassen</a>";
			}
			else
			{
				$sql="	SELECT klassen.*				
						from klassen				
						where k_id = ".$_GET['k_id'];
				
				//echo $sql;
				$result = mysqli_query($db, $sql);
				$data = mysqli_fetch_assoc($result);
				
				$sql2="	SELECT bildungsgaenge.*				
						from bildungsgaenge
						order by bg_name";
				
				//echo $sql;
				$result2 = mysqli_query($db, $sql2);
				$bgs = mysqli_fetch_all($result2, MYSQLI_ASSOC); 
				//print_r($bgs);
				//Formular
				echo "<h3> Klasse bearbeiten: <i> ".$data['k_name']."<i></h3>";	
				echo "<hr>";
				echo "<form method=post>
						
						<table>
							<tr>
								<td>Bezeichnung:</td>
								<td> <input type='text' name='k_name' value='".$data['k_name']."' size=50></td>
							</tr>
							<tr>
								<td>Bildungsgang:</td>
								<td><select name='bg_id'>";       
								foreach ($bgs as $bg)
								{
									if($bg['bg_id']==$data['bg_id'])
									{
										echo "<option selected value='".$bg['bg_id']."'>".$bg['bg_name']."</option>";
									}
									else
									{
										echo "<option value='".$bg['bg_id']."'>".$bg['bg_name']."</option>";
									}
								}

				echo "			</select> </td>
							</tr>
						</table>
						<input type='submit' value='Speichern'>
					</form>";
			}
		}
	}
	else
	{
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
	}
?>

	</body>
</html>