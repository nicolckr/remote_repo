<h3>Neue Klasse anlegen</h3>	
<hr>
<form method=post>
    <table>
        <tr>
            <td>Klasse:</td>
            <td><input type='text' required name='k_name' size=30></td>
        </tr>
        <tr>
            <td>Bildungsgang:</td>
            <td><select name='bg_id'>

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
    </table><br>
    <input type='submit' value='Speichern'>
    <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=klassen'">

</form>