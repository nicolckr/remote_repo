<!-- Requiring -->
<?php
    require_once('config/db.php');
    require_once('config/functions.php');
?>

<!-- HTML-Head -->
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">  <!-- Sonderzeichen: ä,ü,ö -->
</head>

<h1>Bücherbörse</h1>
<a href="?site=home">Home</a>
<a href="?site=impressum">Impressum</a>
<a href="?page=klassen">Klassen</a>
<a href="?page=bildungsgaenge">Bildungsgänge</a>
<a href="?page=personen">Personen</a>
<hr>

<?php
    require_once('controller/siteController.php');
?>
