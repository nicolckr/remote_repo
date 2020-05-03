<h3>Klasse bearbeiten: <i> <?=$data['k_name']?><i></h3>	
<hr>
<form method=post>
    <table>
        <tr>
            <td>Bezeichnung:</td>
            <td><input type='text' name='k_name' value='<?=$data['k_name']?>' size=10></td>
        </tr>
        <tr>
            <td>Bildungsgang:</td>
            <td><select name='bg_id'>

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
    </table><br>
    <input type='submit' value='Speichern'>
    <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=klassen'">
</form>