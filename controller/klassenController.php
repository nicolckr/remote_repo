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
				echo"<div class=affected>Klassen geändert: ".mysqli_affected_rows($db);
				echo"<br><a href='?page=klassen'>zurück zu den Klassen</a></div>";
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
				$data['bgs']=$bgs;

				render_view('update', $data);			
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
				echo"<div class=affected>Klasse angelegt: ".mysqli_affected_rows($db);
				echo"<br><a href='?page=klassen'>zurück zu den Klassen</a></div>";
	
			}
			else
			{
				$sql2="	SELECT bildungsgaenge.*				
						FROM bildungsgaenge
						ORDER BY bg_name";
					
				$result2 = mysqli_query($db, $sql2);
				$data = mysqli_fetch_all($result2, MYSQLI_ASSOC);

				render_view('create', $data);
			}	
		}
	}
	else
	{
		$result = mysqli_query($db, "SELECT * from klassen left join bildungsgaenge using(bg_id) order by k_name");		
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);			

		render_view('index', $data);
	}
?>
</body>
