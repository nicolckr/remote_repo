<!-- Requiring -->
<?php
    require_once('config/db.php');
    require_once('config/functions.php');
?>

<!-- HTML-Head -->
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">  <!-- Sonderzeichen: ä,ü,ö -->
    <link rel="stylesheet" href="css/formate.css">
</head>

<ul class="topnav">
    <li><a class="active" href="?site=home">Home</a></li>
    <li><a href="?page=klassen">Klassen</a></li>
    <li><a href="?page=bildungsgaenge">Bildungsgänge</a></li>
    <li><a href="?page=personen">Personen</a></li>
    <li style="float:right"><a href="?site=impressum">Impressum</a></li>
</ul>

<?php
    require_once('controller/siteController.php');
?>  


