<?php
    function render_view($view, $data=null)
    {
        //global $page;
        $pfad = "./views/klassen/$view.php";
        //echo $pfad;
        require_once($pfad);
    }
?>