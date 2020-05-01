<?php
    function render_view($view, $control, $data=null)
    {
        global $page;
        $pfad = "$control/$page/$view.php";
        require_once($pfad);
    }
?>