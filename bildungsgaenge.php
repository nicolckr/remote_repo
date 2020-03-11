<html>
	<head>
		<link rel="stylesheet" href="css/formate.css">
	</head>
	
	<body>

<?php

	require_once('config/db.php');

	if(isset($_GET['bg_id']) && isset($_GET['action']))
	{
		//echo $_GET['bg_id'];
		//echo $_GET['action'];
		if($_GET['action']=="delete")
		{
			$sql="DELETE from bildungsgaenge where bg_id = ".$_GET['bg_id'];
			//echo $sql;
			$result = mysqli_query($db, $sql);
			header("Location: ?page=bildungsgaenge");
		}
		else if ($_GET['action']=="view")
		{
			$sql="SELECT *
				  from bildungsgaenge right join klassen using(bg_id)
				  where bg_id = ".$_GET['bg_id'];

			$result = mysqli_query($db, $sql);
			$satz = mysqli_fetch_array($result,MYSQLI_ASSOC);

			echo "<h1>Informationen</h1><br>
			
			<table>
				<tr>
					<td><u>Bildungsgang:</u></td>
					<td><b>".$satz['bg_name']."</b></td>
				</tr>
				<tr>
					<td align=right>Klassen:</td>
					<td>".$satz['k_name']."</td>
				</tr>
			</table>";
			

			/*
			while($satz = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				echo $satz['k_name'];
			}
			echo"<br>";
			*/
		}
	}

    $result = mysqli_query($db, "SELECT * from bildungsgaenge order by bg_id");

    $satz = mysqli_fetch_array($result,MYSQLI_ASSOC);

	echo "<h1>Bildungsgänge</h1>";

    echo "<hr>";
	echo "<table border=2>";
    echo "<tr>
			<th>bg_id</th>
			<th>bg_name</th>
			<th>action</th>
	      </tr>";
    mysqli_data_seek($result,0);
    while($satz = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
		echo "<tr>
				<td>".$satz['bg_id']."</td>
				<td>".$satz['bg_name']."</td>
				<td>
					<a href='?page=bildungsgaenge&action=view&bg_id=".$satz['bg_id']."'><img src='icons/view.png' width=15></a>
					<a href='?action=edit&bg_id=".$satz['bg_id']."'><img src='icons/bearbeiten.png' width=15></a>
					<a href='?page=bildungsgaenge&action=delete&bg_id=".$satz['bg_id']."'><img src='icons/loeschen.png' width=15></a>
				</td>
			  </tr>";

	}
	echo "</table>";

?>
	</body>
</html>