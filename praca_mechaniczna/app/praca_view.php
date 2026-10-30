<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Praca mechaniczna</title>
</head>
<body>

<h2>Praca mechaniczna</h2>

<form action="<?php print(_APP_URL);?>/app/praca.php" method="get">

    <label for="id_sila">Siła (N): </label>
    <input id="id_sila" type="text" name="sila" value="<?php print($sila ?? ''); ?>" /><br />

    <label for="id_droga">Droga (m): </label>
    <input id="id_droga" type="text" name="droga" value="<?php print($droga ?? ''); ?>" /><br />

    <input type="submit" value="Oblicz" />

</form>

<?php
//wyświetlenie listy błędów, jeśli istnieją
if (isset($messages)) {
    if (count ( $messages ) > 0) {
        echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
        foreach ( $messages as $key => $msg) {
            echo '<li>'.$msg.'</li>';
        }
        echo '</ol>';
    }
}
?>

<?php if (isset($praca)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Praca mechaniczna: '.$praca.' J'; ?>
</div>
<?php } ?>

</body>
</html>