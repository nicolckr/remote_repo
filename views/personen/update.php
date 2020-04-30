<h3>Person bearbeiten: <i><?=$data['p_vname'] .$data['p_name']?><i></h3>	
<hr>
<form method=post>
    <table>
        <tr>
            <td>Nachname:</td>
            <td><input type='text' name='p_name' value='<?=$data['p_name']?>' size=30></td>
        </tr>
        <tr>
            <td>Vorname:</td>
            <td><input type='text' name='p_vname' value='<?=$data['p_vname']?>' size=30></td>
        </tr>
        <tr>
            <td>User:</td>
            <td><input type='text' name='p_user' value='<?=$data['p_user']?>' size=30></td>
        </tr>
        <tr>
            <td>E-Mail:</td>
            <td><input type='email' name='p_mail' value='<?=$data['p_mail']?>' size=30></td>
        </tr>
        <tr>
            <td>Passwort:</td>
            <td>
                <input type='password' name='p_pass' id='p_pass' 	required autocomplete='off' 
                                                                    minlength=8 maxlength=20 
                                                                    value='Dein Passwort' size=30>
            </td>
            <td>	
                <button id='check' type='button'>Passwort anzeigen</button>
            </td>
        </tr>
        <tr>
            <td>Klasse:</td>
            <td><select name='k_id'>

            <?php     
                foreach ($kls as $kl)
                {
                    if($kl['k_id']==$data['k_id'])
                    {
                        echo "<option selected value='".$kl['k_id']."'>".$kl['k_name']."</option>";
                    }
                    else
                    {
                        echo "<option value='".$kl['k_id']."'>".$kl['k_name']."</option>";
                    }
                }
            ?>

            </select></td>
        </tr>
    </table><br>
    
    <input type='submit' value='Speichern'>
    <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=personen'">
</form>