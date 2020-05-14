<?php
    $data=bildungsgaenge_get_all($data);
?>

<div class="head">Bildungsgänge</div>

<table class="index" border="1">
    <tr>
        <th>bg_id</th>
        <th>bg_name</th>
        <th>action</th>
    </tr>

    <?php
        foreach($data as $satz)
        {
    ?>

    <tr>
        <td><?=$satz['bg_id']?></td>
        <td><?=$satz['bg_name']?></td>
        <td>
            <a href='?page=bildungsgaenge&action=view&bg_id=<?=$satz['bg_id']?>'><img src='icons/view.png' width=15></a>
            <a href='?page=bildungsgaenge&action=edit&bg_id=<?=$satz['bg_id']?>'><img src='icons/bearbeiten.png' width=15></a>
            <a href='?page=bildungsgaenge&action=delete&bg_id=<?=$satz['bg_id']?>' onclick= "return confirm('Dieser Datensatz wird gelöscht!');"><img src='icons/loeschen.png' width=15></a>
        </td>
    </tr>

    <?php
        }
    ?>
</table>

<div class="auswahl"><a href='?page=bildungsgaenge&action=add'><button type='button'>Neuer Bildungsgang</button></a></div>