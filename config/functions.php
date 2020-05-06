<?php
    function render_view($view, $data=null)
    {
        global $page;
        $pfad = "views/$page/$view.php";
        require_once($pfad);
    }
?>