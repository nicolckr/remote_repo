<div class="head">Klassen</div>

<table class="index" border="1">						
    <tr>
        <th>k_id</th>
        <th>k_name</th>
        <th>bg_id</th>
        <th>bg_name</th>
        <th>action</th>
    </tr>
        
    <?php
        foreach($data as $satz)		//aus dem 2-dim, assoziativen Array, werden die Abfrageergebnisse aufgeteilt. Also je nachdem, welches Array (Indize) angesprochen wird. Solange die Variable $data noch ein neues Ergebnis übergibt, läuft die foreach-Schleife
        {
    ?>
        <tr>
            <td><?=$satz['k_id']?></td>
            <td><?=$satz['k_name']?></td>
            <td><?=$satz['bg_id']?></td>
            <td><?=$satz['bg_name']?></td>
            <td>
                <a href='?page=klassen&action=view&k_id=<?=$satz['k_id']?>'><img src='icons/view.png' width=15></a>
                <a href='?page=klassen&action=edit&k_id=<?=$satz['k_id']?>'><img src='icons/bearbeiten.png' width=15></a>
                <a href='?page=klassen&action=delete&k_id=<?=$satz['k_id']?>' onclick ="return confirm('Dieser Datensatz wird gelöscht!');"><img src='icons/loeschen.png' width=15></a>
            </td>

        </tr>
    <?php
        }
    ?>
</table>

<div class="auswahl"><a href='?page=klassen&action=add'><button type='button'>Neue Klasse</button></a></div>
	