<script>
document.addEventListener('DOMContentLoaded', function ()
{
	document.querySelector('#check').addEventListener('click', function ()
	{
		if(document.getElementById('p_pass').type == 'password')
		{
			document.getElementById('p_pass').type = 'text';
			this.innerText = 'Passwort verstecken';
		}
		else
		{
			document.getElementById('p_pass').type = 'password';
			this.innerText = 'Passwort anzeigen';
		}
	});
});
</script>


<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/formate.css">
	</head>
	
	<body>

<?php

	require_once('config/db.php');				//Fügt hier den Inhalt der Datei db.php ein

	if(isset($_GET['action']))
	{
		//Action: Delete
		if($_GET['action']=="delete" and isset($_GET['p_id']))
		{
			$sql="delete from personen where p_id = ".$_GET['p_id'];
			$result = mysqli_query($db, $sql);
			header("Location: ?page=personen");
		}

		//Action: View
		elseif($_GET['action']=="view" and isset($_GET['p_id']))
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

		//Action: Edit
		elseif($_GET['action']=="edit" and isset($_GET['p_id']))
		{
			if(isset($_POST['p_name']))
			{
				$sql="UPDATE personen
					  SET p_name='".$_POST['p_name']."',
					  	  p_vname='".$_POST['p_vname']."',
						  p_user='".$_POST['p_user']."',
						  p_mail='".$_POST['p_mail']."',
						  k_id = ".$_POST['k_id'];
				if($_POST['p_pass']<>"Dein Passwort")
				{
					$sql.=",p_pass=md5('".$_POST['p_pass']."')";
				}
				$sql.=" WHERE p_id=".$_GET['p_id'];
	
				$res=mysqli_query($db,$sql);
				echo "<br><br>Personen geändert: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=personen'>zurück zu den Personen</a>";
			}
			else
			{
				//SQL-Abfragen
				$sql="	SELECT personen.*				
						FROM personen				
						WHERE p_id = ".$_GET['p_id'];
				
				$result = mysqli_query($db, $sql);
				$data = mysqli_fetch_assoc($result);
				

				$sql2="	SELECT klassen.*				
						FROM klassen
						ORDER BY k_name";
				
				$result2 = mysqli_query($db, $sql2);
				$kls = mysqli_fetch_all($result2, MYSQLI_ASSOC); 
				

				//Formular
				echo "<h3>Person bearbeiten: <i> ".$data['p_vname']." ".$data['p_name']."<i></h3>";	
				echo "<hr>";
				echo "<form method=post>
						
						<table>
							<tr>
								<td>Nachname:</td>
								<td><input type='text' name='p_name' value='".$data['p_name']."' size=30></td>
							</tr>
							<tr>
								<td>Vorname:</td>
								<td><input type='text' name='p_vname' value='".$data['p_vname']."' size=30></td>
							</tr>
							<tr>
								<td>User:</td>
								<td><input type='text' name='p_user' value='".$data['p_user']."' size=30></td>
							</tr>
							<tr>
								<td>E-Mail:</td>
								<td><input type='text' name='p_mail' value='".$data['p_mail']."' size=30></td>
							</tr>
							<tr>
								<td>Passwort:</td>
								<td>
									<input type='password' name='p_pass' id='p_pass' required autocomplete='off' minlength=8 maxlength=20 value='Dein Passwort' size=30>
									<button id='check' type='button'>Passwort anzeigen</button>
								</td>
							</tr>
							<tr>
								<td>Klasse:</td>
								<td><select name='k_id'>";       
								foreach ($kls as $kl)
								{
									if($kl['k_id']==$data['k_id'])
									{
										echo "<option selected value='".$kl['k_id']."'>".$kl['k_name']."</option>";
									}
									else
									{
										echo "<option value='".$kl['k_id']."'>".$kl['k_name']."</option>";
									}
								}

				echo "			</select></td>
							</tr>
						</table>
						<input type='submit' value='Speichern'>
					</form>";
			}
		}

		//Action: Add
		elseif($_GET['action']=="add")
		{
			if(isset($_POST['name']))
			{
				$name = $_POST['name'];
				$vname = $_POST['vname'];
				$new_user = $_POST['new_user'];
				$mail = $_POST['mail'];
				$new_pass = $_POST['pass'];
				$k_id = $_POST['k_id'];
	
				$sql = "INSERT INTO personen (k_id, p_name, p_vname, p_user, p_pass, p_mail)
						VALUES ($k_id, '$name', '$vname', '$new_user', '$mail', '$new_pass')";
				
				echo $sql;
				$res = mysqli_query($db,$sql);
				echo "<br><br>Personen angelegt: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=personen'>zurück zu den Personen</a>";
	
			}
			else
			{
				$sql2="	SELECT klassen.*				
						FROM klassen
						ORDER BY k_name";
					
				$result2 = mysqli_query($db, $sql2);
				$kls = mysqli_fetch_all($result2, MYSQLI_ASSOC);

				echo "<h3>Neue Person anlegen</h3>";	
					echo "<hr>";
					echo "<form method=post>
			
							<table>
								<tr>
									<td>Nachname:</td>
									<td><input type='text' name='name' size=30></td>
								</tr>
								<tr>
									<td>Vorname:</td>
									<td><input type='text' name='vname' size=30></td>
								</tr>
								<tr>
									<td>User:</td>
									<td><input type='text' name='new_user' size=30></td>
								</tr>
								<tr>
									<td>E-Mail:</td>
									<td><input type='text' name='mail' size=30></td>
								</tr>
								<tr>
									<td>Passwort:</td>								
									<td><input type='password' name='pass' size=30></td>								
								</tr>
								<tr>
									<td>Klasse:</td>
									<td><select name='k_id'>";       
									foreach ($kls as $kl)
									{	
										if($kl['k_id']==$data['k_id'])
										{
											echo "<option selected value='".$kl['k_id']."'>".$kl['k_name']."</option>";
										}
										else
										{
											echo "<option value='".$kl['k_id']."'>".$kl['k_name']."</option>";
										}
									}

					echo "			</select> </td>
								</tr>
							</table>
							<input type='submit' value='Speichern'>";
					echo "</form>";	
			}	
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
		echo "		<tr>
						<th>p_name</th>
						<th>p_vname</th>
						<th>p_user</th>
						<th>bg_name</th>
						<th>k_name</th>
						<th>action</th>
			  		</tr>";
		
		foreach($data as $satz)		//aus dem 2-dim, assoziativen Array, werden die Abfrageergebnisse aufgeteilt. Also je nachdem, welches Array (Indize) angesprochen wird. Solange die Variable $data noch ein neues Ergebnis übergibt, läuft die foreach-Schleife
		{
			echo "	<tr>
						<td>".$satz['p_name']."</td>
						<td>".$satz['p_vname']."</td>
						<td>".$satz['p_user']."</td>
						<td>".$satz['bg_name']."</td>
						<td>".$satz['k_name']."</td>
						<td>
							<a href='?page=personen&action=view&p_id=".$satz['p_id']."'><img src='icons/view.png' width=15></a>
							<a href='?page=personen&action=edit&p_id=".$satz['p_id']."'><img src='icons/bearbeiten.png' width=15></a>
							<a href='?page=personen&action=delete&p_id=".$satz['p_id']."' onclick =\"return confirm('Dieser Datensatz wird gelöscht!');\"><img src='icons/loeschen.png' width=15></a>
						</td>
				  	</tr>";
		}
		echo "</table><br>";

		echo "<a href='?page=personen&action=add'>Neue Person anlegen</a>";
	}
		
?>

	</body>
</html>