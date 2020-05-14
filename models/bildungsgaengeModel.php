<?php
    function bildungsgaenge_delete_one($id)
    {
        global $db;
        $sql = "DELETE from bildungsgaenge where bg_id = $id";
        return mysqli_query($db, $sql);
    }
    
    function bildungsgaenge_update_one($id, $data)
    {
        global $db;
        $sql = "UPDATE bildungsgaenge
                SET bg_name='".$data['bg_name']."'
                WHERE bg_id=$id";
        return mysqli_query($db, $sql);
    }

    function bildungsgaenge_add_one($data)
    {
        global $db;
        $name = $data['bg_name'];
        $sql = "INSERT INTO bildungsgaenge (bg_name)
                VALUES ('$name')";
        return mysqli_query($db, $sql);
    }

    function bildungsgaenge_get_one($id)
    {
        global $db;
        $sql = "SELECT bildungsgaenge.*, count(k_id) as k_anzahl
              from bildungsgaenge left join klassen using(bg_id)
              where bg_id = $id";
        $result=mysqli_query($db,$sql);
        return mysqli_fetch_assoc($result);
    }

    function bildungsgaenge_get_all()
    {
        global $db;
        $sql = "SELECT * from bildungsgaenge order by bg_name";
        $result = mysqli_query($db,$sql);
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
?>