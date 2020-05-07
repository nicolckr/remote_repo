<div class="head">Bildungsgang bearbeiten: <b><?=$data['bg_name']?></b></div>

<form method='POST'>
    <table>
        <tr>
            <td class="info">
                <label for='bildungsgang'>Bildungsgang:</label>
            </td>
            <td class="inhalt">
                <input id='bildungsgang' type='text' name='bg_name' value='<?=$data['bg_name']?>'>
            </td>
        </tr>
    </table>

    <div class="auswahl">
        <input type='submit' value='Speichern'>
        <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=bildungsgaenge'">
    </div>
</form>