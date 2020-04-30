<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/formate.css">
	</head>
	
	<body>

<?php

	require_once('../config/db.php');
	require_once('../config/functions.php');

	if(isset($_GET['action']))
	{
		//echo $_GET['bg_id'];
		//echo $_GET['action'];
		if($_GET['action']=="delete" and isset($_GET['bg_id']))
		{
			$sql="DELETE from bildungsgaenge where bg_id = ".$_GET['bg_id'];
			//echo $sql;
			$result = mysqli_query($db, $sql);
			header("Location: ?page=bildungsgaenge");
		}
		else if ($_GET['action']=="view" and isset($_GET['bg_id']))
		{
			$sql="SELECT *
				  from bildungsgaenge left join klassen using(bg_id)
				  where bg_id = ".$_GET['bg_id'];

			$result = mysqli_query($db, $sql);
			$data = mysqli_fetch_all($result,MYSQLI_ASSOC);

			render_view('view', 'views', $data);
		}
		else if($_GET['action']=="edit" and isset($_GET['bg_id']))
		{
			if(isset($_POST['bg_name']))
			{
				$sql = "UPDATE bildungsgaenge
						SET bg_name='".$_POST['bg_name']."'
						WHERE bg_id = ".$_GET['bg_id'];

				$res = mysqli_query($db, $sql);

				echo "<br><br>Bildungsgänge geändert: ".mysqli_affected_rows($db)."<br>";
				echo "<a href='?page=bildungsgaenge'>Zurück zu den Bildungsgängen</a>";
			}
			else
			{
				$sql = "SELECT * from bildungsgaenge where bg_id = ".$_GET['bg_id'];
				$result = mysqli_query($db, $sql);
				$data = mysqli_fetch_array($result,MYSQLI_ASSOC);

				render_view('update', 'views', $data);
			}
		}

		elseif($_GET['action']=="add")
		{
			if(isset($_POST['bg_name']))
			{
				$name = $_POST['bg_name'];
	
				$sql = "INSERT INTO bildungsgaenge (bg_name)
						VALUES ('$name')";
				
				$res = mysqli_query($db,$sql);
				echo "<br><br>Bildungsgang angelegt: ".mysqli_affected_rows($db)."<br>";
				echo"<a href='?page=bildungsgaenge'>zurück zu den Bildungsgängen</a>";
	
			}
			else
			{
				render_view('create', 'views');
			}	
		}
	}
	else
	{
		$result = mysqli_query($db, "SELECT * from bildungsgaenge order by bg_id");
		$data = mysqli_fetch_all($result,MYSQLI_ASSOC);

		render_view('index', 'views', $data);
	}
?>
	</body>
</html>