<script>
document.addEventListener('DOMContentLoaded', function ()
{
	document.querySelector('#check').addEventListener('click', function ()
	{
		if(document.getElementById('p_pass').type == 'password')
		{
			document.getElementById('p_pass').type = 'text';
			this.innerText = 'Passwort verstecken';
			this.src = 'icons/view-not.png';
		}
		else
		{
			document.getElementById('p_pass').type = 'password';
			this.innerText = 'Passwort anzeigen';
			this.src = 'icons/view.png';
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
	require_once('config/functions.php');

	if(isset($_GET['action']))
	{
		//Action: Delete
		if($_GET['action']=="delete" and isset($_GET['p_id']))
		{
			$sql="DELETE from personen where p_id = ".$_GET['p_id'];
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
			$data = mysqli_fetch_assoc($result);

			render_view('view', $data);
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
				$data['kls']=$kls;
				
				render_view('update', $data);
			}
		}

		//Action: Add
		elseif($_GET['action']=="add")
		{
			if(isset($_POST['p_name']))
			{
				$name = $_POST['p_name'];
				$vname = $_POST['p_vname'];
				$new_user = $_POST['p_user'];
				$mail = $_POST['p_mail'];
				$new_pass = $_POST['p_pass'];
				$k_id = $_POST['k_id'];
	
				$sql = "INSERT INTO personen (k_id, p_name, p_vname, p_user, p_pass, p_mail)
						VALUES ($k_id, '$name', '$vname', '$new_user', '$new_pass', '$mail')";
				
				$res = mysqli_query($db, $sql);
				echo "<br><br>Personen angelegt: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=personen'>zurück zu den Personen</a>";
			}
			else
			{
				$sql2="	SELECT klassen.*				
						FROM klassen
						ORDER BY k_name";
					
				$result2 = mysqli_query($db, $sql2);
				$data = mysqli_fetch_all($result2, MYSQLI_ASSOC);

				render_view('create', $data);
			}	
		}
	}
	else
	{
		$sql = "SELECT * from personen left join klassen using(k_id) left join bildungsgaenge using(bg_id) order by p_name";
		$result = mysqli_query($db, $sql);						//sql-Abfrage wird in die Variable $result übergeben

		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);			//alle Zeilen der Abfrage, die in $result stehen, werden als 2-dim, assoziatives Array, in die Variable $data übergeben

		render_view('index', $data);
	}
		
?>
	</body>
</html>