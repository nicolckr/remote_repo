<html>
	<head>
		<link rel="stylesheet" href="css/formate.css">
	</head>
	
	<body>

<?php

	require_once('config/db.php');				//Fügt hier den Inhalt der Datei db.php ein
	require_once('config/functions.php');

	if(isset($_GET['action']))
	{
		//echo $_GET['k_id'];
		//echo $_GET['action'];
		if($_GET['action']=="delete" and isset($_GET['k_id']))
		{
			$sql="delete from klassen where k_id = ".$_GET['k_id'];
			//echo "<br>".$sql;
			$result = mysqli_query($db, $sql);
			header("Location: ?page=klassen");
		}
		else if ($_GET['action']=="view" and isset($_GET['k_id']))
		{
			$sql="SELECT *
				  from klassen left join personen using(k_id)
				  where k_id = ".$_GET['k_id'];

			$result = mysqli_query($db, $sql);
			$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

			render_view('view', $data);
		}
		elseif($_GET['action']=="edit" and isset($_GET['k_id']))
		{
			if(isset($_POST['k_name']))
			{
				$sql="UPDATE klassen
					    SET k_name='".$_POST['k_name']."',
					      	bg_id ='".$_POST['bg_id']."'
					  WHERE k_id=".$_GET['k_id'];

				$res=mysqli_query($db,$sql);
				echo "<br><br>Klassen geändert: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=klassen'>zurück zu den Klassen</a>";
			}
			else
			{
				//SQL-Abfragen
				$sql="	SELECT klassen.*				
						FROM klassen				
						WHERE k_id = ".$_GET['k_id'];
				
				$result = mysqli_query($db, $sql);
				$data = mysqli_fetch_assoc($result);
				

				$sql2="	SELECT bildungsgaenge.*				
						FROM bildungsgaenge
						ORDER BY bg_name";
				
				$result2 = mysqli_query($db, $sql2);
				$bgs = mysqli_fetch_all($result2, MYSQLI_ASSOC); 


				//Formular
				echo "<h3> Klasse bearbeiten: <i> ".$data['k_name']."<i></h3>";	
				echo "<hr>";
				echo "<form method=post>
						
						<table>
							<tr>
								<td>Bezeichnung:</td>
								<td><input type='text' name='k_name' value='".$data['k_name']."' size=10></td>
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
						</table><br>
						<input type='submit' value='Speichern'>
						<input type='button' name='Abbrechen' value='Abbrechen' onclick=\"window.location.href='?page=klassen'\">
					</form>";
			}
		}

		elseif($_GET['action']=="add")
		{
			if(isset($_POST['k_name']))
			{
				$name = $_POST['k_name'];
				$bg_id = $_POST['bg_id'];
	
				$sql = "INSERT INTO klassen (bg_id, k_name)
						VALUES ($bg_id, '$name')";
				
				$res = mysqli_query($db,$sql);
				echo "<br><br>Klasse angelegt: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=klassen'>zurück zu den Klassen</a>";
	
			}
			else
			{
				$sql2="	SELECT bildungsgaenge.*				
						FROM bildungsgaenge
						ORDER BY bg_name";
					
				$result2 = mysqli_query($db, $sql2);
				$bgs = mysqli_fetch_all($result2, MYSQLI_ASSOC);

				echo "<h3>Neue Klasse anlegen</h3>";	
					echo "<hr>";
					echo "<form method=post>
							<table>
								<tr>
									<td>Klasse:</td>
									<td><input type='text' required name='k_name' size=30></td>
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
							</table><br>
							<input type='submit' value='Speichern'>
							<input type='button' name='Abbrechen' value='Abbrechen' onclick=\"window.location.href='?page=klassen'\">";

					echo "</form>";	
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
						<a href='?page=klassen&action=delete&k_id=".$satz['k_id']."' onclick =\"return confirm('Dieser Datensatz wird gelöscht!');\"><img src='icons/loeschen.png' width=15></a>
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
		echo "</table><br>";
		echo "<a href='?page=klassen&action=add'><button type='button'>Neue Klasse</button></a>";
	}
?>

	</body>
</html>