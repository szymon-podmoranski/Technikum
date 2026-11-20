<?php
require_once dirname(__FILE__).'/../config.php';

//ochrona widoku
include _ROOT_PATH.'/app/security/check.php';
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Chroniona strona</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">

    <a href="<?php print(_APP_ROOT); ?>/app/praca.php" class="pure-button">
        Powrót do obliczania pracy mechanicznej
    </a>

    <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">
        Wyloguj
    </a>

</div>

<div style="width:90%; margin: 2em auto;">

    <h2>Chroniona strona</h2>

    <p>To jest inna chroniona strona aplikacji internetowej.</p>

    <p>Temat aplikacji: Praca mechaniczna – W = F * s.</p>

    <p>Zalogowany użytkownik: <?php echo $role; ?></p>

</div>

</body>
</html>