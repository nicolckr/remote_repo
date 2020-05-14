<body>
<?php

	require_once('models/bildungsgaengeModel.php');

	if(isset($_GET['action']))
	{
		if($_GET['action']=="delete" and isset($_GET['bg_id']))
		{
			bildungsgaenge_delete_one($_GET['bg_id']);
			$status="Bildungsgänge gelöscht: ".mysqli_affected_rows($db);
			?><script>
				window.alert('<?=$status?>');
				window.location = '?page=bildungsgaenge';
			</script><?php
		}

		else if ($_GET['action']=="view" and isset($_GET['bg_id']))
		{
			render_view('view', $_GET['bg_id']);
		}

		else if($_GET['action']=="edit" and isset($_GET['bg_id']))
		{
			if(count($_POST)>0)
			{
				bildungsgaenge_update_one($_GET['bg_id'],$_POST);
				$status="Bildungsgänge geändert: ".mysqli_affected_rows($db);
				?><script>
					window.alert('<?=$status?>');
					window.location = '?page=bildungsgaenge';
				</script><?php
			}
			else
			{
				render_view('update', $_GET['bg_id']);
			}
		}

		elseif($_GET['action']=="add")
		{
			if(count($_POST)>0)
			{
				bildungsgaenge_add_one($_POST);
				$status="Bildungsgänge angelegt: ".mysqli_affected_rows($db);
				?><script>
					window.alert('<?=$status?>');
					window.location = '?page=bildungsgaenge';
				</script><?php
			}
			else
			{
				render_view('create');
			}	
		}
	}
	else
	{
		render_view('index', $_GET['bg_id']);
	}
?>
</body>
