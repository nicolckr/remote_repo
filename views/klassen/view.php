<h2>Detailansicht zur Klasse <b><?=$data[0]['k_name']?></b></h1>
			
<table>
    <tr>
        <td align="right">Klasse:</td>
        <td><b><?=$data[0]['k_name']?></b></td>
    </tr>
    <tr>
        <td align="right"><u>Personen:</u></td>
    </tr>
    <tr>

    <?php      
        foreach($data as $satz)
        {
            echo "
                <td align=right>".$satz['p_vname']." ".$satz['p_name']."</td>
            </tr>";
        }
    ?>

</table><br><br>

<a href='?page=klassen'>Zurück zu allen Klassen</a>