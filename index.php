<h1>Bücherbörse</h1>
<a href="?page=klassen">Klassen</a>
<a href="?page=bildungsgaenge">Bildungsgänge</a>
<a href="?page=personen">Personen</a>

<?php

require_once('config/db.php');

if(isset($_GET['page']))
{
    if($_GET['page']=='klassen')
    {
        require('klassen.php');
    }
    elseif($_GET['page']=='bildungsgaenge')
    {
        require('bildungsgaenge.php');
    }
    elseif($_GET['page']=='personen')
    {
        require('personen.php');
    }
}
else
{
    require('home.php');
}

?>
