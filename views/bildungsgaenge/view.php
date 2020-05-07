<div class="head">Detailansicht zum Bildungsgang <b><?=$data[0]['bg_name']?></b></div>
			
<table>
    <tr>
        <td class="info">Bildungsgang:</td>
        <td class="inhalt"><u><?=$data[0]['bg_name']?></u></td>
    </tr>
    <tr>
        <td class="info">Klassen:</td>
        
    

    <?php      
        foreach($data as $satz)
        {
            echo "
                <td class=inhalt>".$satz['k_name']."</td>
            </tr>
            <tr>
                <td></td>";
        }
    ?>
</table>

<div class="auswahl">
    <a href='?page=bildungsgaenge'>Zurück zu allen Bildungsgaengen</a>
</div>