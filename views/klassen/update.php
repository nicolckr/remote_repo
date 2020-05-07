<div class="head">Klasse bearbeiten: <b><?=$data['k_name']?><b></div>	

<form method=post>
    <table>
        <tr>
            <td class="info">Bezeichnung:</td>
            <td class="inhalt"><input type='text' name='k_name' value='<?=$data['k_name']?>' size=10></td>
        </tr>
        <tr>
            <td class="info">Bildungsgang:</td>
            <td class="inhalt"><select name='bg_id'>

            <?php   
                foreach ($data['bgs'] as $bg)
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