<div class="head">Neue Person anlegen</div>	

<form method=post>
    <table>
        <tr>
            <td class="info">Nachname:</td>
            <td class="inhalt"><input type='text' required name='p_name' size=30></td>
        </tr>
        <tr>
            <td class="info">Vorname:</td>
            <td class="inhalt"><input type='text' required name='p_vname' size=30></td>
        </tr>
        <tr>
            <td class="info">User:</td>
            <td class="inhalt"><input type='text' name='p_user' size=30></td>
        </tr>
        <tr>
            <td class="info">E-Mail:</td>
            <td class="inhalt"><input type='email' name='p_mail' size=30></td>
        </tr>
        <tr>
            <td class="info">Passwort:</td>								
            <td class="inhalt">
                <input type='password' name='p_pass' id='p_pass' required autocomplete='off' 
                                                                    minlength=8 maxlength=20 
                                                                    value='Dein Passwort' size=30>
            </td>	
            <td>
                <img id='check' src='icons/view.png' width=25>
            </td>							
        </tr>
        <tr>
            <td class="info">Klasse:</td>
            <td class="inhalt"><select name='k_id'>

            <?php      
                foreach ($data as $kl)
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

        </select> </td>
        </tr>
    </table>
    
    <div class="auswahl">
        <input type='submit' value='Speichern'>
        <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=personen'"> 
    </div>
</form>