<h2>Bildungsgang bearbeiten: <i><?=$data['bg_name']?></i></h2>

<form method='POST'>
    <label for='bildungsgang'>Bildungsgang</label>
    <input id='bildungsgang' type='text' name='bg_name' value='<?=$data['bg_name']?>'><br><br>

    <input type='submit' value='Speichern'>
    <input type='button' name='Abbrechen' value='Abbrechen' onclick="window.location.href='?page=bildungsgaenge'">
</form>