<h2>Detailansicht zum Bildungsgang <b><?=$data[0]['bg_name']?></b></h2>
			
<table>
    <tr>
        <td>Bildungsgang:</td>
        <td><b><?=$data[0]['bg_name']?></b></td>
    </tr>
    <tr>
        <td align=right><u>Klassen:</u></td>
        <td></td>
    </tr>
    <tr>

    <?php      
        foreach($data as $satz)
        {
            echo "
                <td align=right>".$satz['k_name']."</td>
            </tr>";
        }
    ?>

</table><br><br>

<a href='?page=bildungsgaenge'>Zurück zu allen Bildungsgaengen</a>