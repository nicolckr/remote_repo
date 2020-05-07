<div class="head">Detailansicht zu <b><?=$data['p_vname']. " " .$data['p_name']?></b></div>
			
<table class="view">
    <tr>
        <td class="info">ID:</td>
        <td class="inhalt"><?=$data['p_id']?></td>
    </tr>
    <tr>
        <td class="info">Name:</td>
        <td class="inhalt"><?=$data['p_name']?></td>
    </tr>
    <tr>
        <td class="info">Vorname:</td>
        <td class="inhalt"><?=$data['p_vname']?></td>
    </tr>
    <tr>
        <td class="info">User:</td>
        <td class="inhalt"><?=$data['p_user']?></td>
    </tr>
    <tr>
        <td class="info">E-Mail:</td>
        <td class="inhalt"><?=$data['p_mail']?></td>
    </tr>
    <tr>
        <td class="info">Klasse:</td>
        <td class="inhalt"><?=$data['k_name']?></td>
    </tr>
    <tr>
        <td class="info">Bildungsgang:</td>
        <td class="inhalt"><?=$data['bg_name']?></td>
    </tr>
</table>

<div class="auswahl">
    <a href='?page=personen'><br>Zurück zu allen Personen</a>
</div>