<div class="head">Neue Klasse anlegen</div>	

<form method=post>
    <table>
        <tr>
            <td class="info">Klasse:</td>
            <td class="inhalt"><input type='text' required name='k_name' size=30></td>
        </tr>
        <tr>
            <td class="info">Bildungsgang:</td>
            <td class="inhalt"inhalt><select name='bg_id'>

            <?php  
                foreach ($data as $bg)
                {
                    if($bg['bg_id']==$data['bg_id'])
                    {
                        echo "<option selected value='".$bg['bg_id']."'>".$bg['bg_name']."</option>";
                    }
                    else
                    {
                        echo "<option value='".$bg['bg_id']."'>".$bg['bg_name']."</option>";
                    }
                }
            ?>

            </select> </td>
        </tr>
    </table>

    <div class="auswahl">
        <input type='submit' value='Speichern'>
        <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=klassen'">
    </div>
</form>