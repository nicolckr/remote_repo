<!-- Requiring -->
<?php
    require_once('config/db.php');
    require_once('config/functions.php');
?>

<!-- HTML-Head -->
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">  <!-- Sonderzeichen: ä,ü,ö -->
</head>

<?php
    //Menü
    render_view('site', 'controller');
    
    //Kontrollstrunktur
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
        if($page=='klassen')
        {
            require('controller/klassen.php');
        }
        elseif($page=='bildungsgaenge')
        {
            require('controller/bildungsgaenge.php');
        }
        elseif($page=='personen')
        {
            require('controller/personen.php');
        }
    }
    else
    {
        $page='home';
        require('controller/home.php');
    }
?>
