<h1>Personen</h1>
<hr>
<table border="2">								
    <tr>
        <th>p_name</th>
        <th>p_vname</th>
        <th>p_user</th>
        <th>bg_name</th>
        <th>k_name</th>
        <th>action</th>
    </tr>

    <?php
        foreach($data as $satz)				//aus dem 2-dim, assoziativen Array, werden die Abfrageergebnisse aufgeteilt. Also je nachdem, welches Array (Indize) angesprochen wird. Solange die Variable $data noch ein neues Ergebnis übergibt, läuft die foreach-Schleife
        {
    ?>
    <tr>
        <td><?=$satz['p_name']?></td>
        <td><?=$satz['p_vname']?></td>
        <td><?=$satz['p_user']?></td>
        <td><?=$satz['bg_name']?></td>
        <td><?=$satz['k_name']?></td>
        <td>
            <a href='?page=personen&action=view&p_id=<?=$satz['p_id']?>'><img src='icons/view.png' width=15></a>
            <a href='?page=personen&action=edit&p_id=<?=$satz['p_id']?>'><img src='icons/bearbeiten.png' width=15></a>
            <a href='?page=personen&action=delete&p_id=<?=$satz['p_id']?>' onclick ="return confirm('Dieser Datensatz wird gelöscht!');"><img src='icons/loeschen.png' width=15></a>
        </td>
    </tr>
    <?php
        }
    ?>
</table><br>
<a href='?page=personen&action=add'><button type='button'>Neue Person</button></a>