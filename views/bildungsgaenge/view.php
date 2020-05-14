<?php
    $data=bildungsgaenge_get_one($data);
?>

<div class="head">Detailansicht zum Bildungsgang <b><?=$data['bg_name']?></b></div>
			
<table>
    <tr>
        <td class="info">Bildungsgang:</td>
        <td class="inhalt"><u><?=$data['bg_name']?></u></td>
    </tr>
    <tr>
        <td class="info">Anzahl Klassen:</td>
        <td class="inhalt"><?=$data['k_anzahl']?></td>
    </tr>
</table>

<div class="auswahl">
    <a href='?page=bildungsgaenge'>Zurück zu allen Bildungsgaengen</a>
</div>