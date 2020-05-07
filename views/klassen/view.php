<div class="head">Detailansicht zur Klasse <b><?=$data[0]['k_name']?></b></div>
			
<table>
    <tr>
        <td class="info">Klasse:</td>
        <td class="inhalt"><?=$data[0]['k_name']?></td>
    </tr>
    <tr>
        <td class="info">Personen:</td>
    

    <?php      
        foreach($data as $satz)
        {
            echo "
                <td class=inhalt>".$satz['p_vname']." ".$satz['p_name']."</td>
            </tr>
            <tr>
                <td></td>";
        }
    ?>
</table>

<div class="auswahl">
    <a href='?page=klassen'>Zurück zu allen Klassen</a>
</div>