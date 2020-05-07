<?php
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
        require('controller/'.$page.'Controller.php');
    }
    else
    {
        if(isset($_GET['site']))
        {
            $site = $_GET['site'];
        }
        else
        {
            $site = 'home';
        }
        render_view($site);
    }
?>