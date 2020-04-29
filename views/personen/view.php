<h2>Detailansicht der Person <b><?=$data['p_vname'] .$data['p_name']?></b></h1>
			
<table>
    <tr>
        <td align=right>ID:</td>
        <td><?=$data['p_id']?></td>
    </tr>
    <tr>
        <td align=right>Name:</td>
        <td><?=$data['p_name']?></td>
    </tr>
    <tr>
        <td align=right>Vorname:</td>
        <td><?=$data['p_vname']?></td>
    </tr>
    <tr>
        <td align=right>User:</td>
        <td><?=$data['p_user']?></td>
    </tr>
    <tr>
        <td align=right>E-Mail:</td>
        <td><?=$data['p_mail']?></td>
    </tr>
    <tr>
        <td align=right>Klasse:</td>
        <td><?=$data['k_name']?></td>
    </tr>
    <tr>
        <td align=right>Bildungsgang:</td>
        <td><?=$data['bg_name']?></td>
    </tr>
</table><br><br>

<a href='?page=personen'>Zurück zu allen Personen</a> 