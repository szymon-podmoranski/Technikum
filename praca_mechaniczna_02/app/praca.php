<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony pracy mechanicznej

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$form){
    $form['sila'] = isset($_REQUEST['sila']) ? $_REQUEST['sila'] : null;
    $form['droga'] = isset($_REQUEST['droga']) ? $_REQUEST['droga'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$messages){
    // sprawdzenie, czy parametry zostały przekazane
    if ( ! (isset($form['sila']) && isset($form['droga']))) {
        // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
        // teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
        return false;
    }

    // sprawdzenie, czy potrzebne wartości zostały przekazane
    if ( $form['sila'] == "") {
        $messages [] = 'Nie podano siły';
    }
    if ( $form['droga'] == "") {
        $messages [] = 'Nie podano drogi';
    }

    //nie ma sensu walidować dalej gdy brak parametrów
    if (count ( $messages ) != 0) return false;

    // sprawdzenie, czy siła i droga są liczbami
    if (! is_numeric( $form['sila'] )) {
        $messages [] = 'Siła nie jest liczbą';
    }

    if (! is_numeric( $form['droga'] )) {
        $messages [] = 'Droga nie jest liczbą';
    }

    if (count ( $messages ) != 0) return false;
    else return true;
}

function process(&$form,&$messages,&$praca){
    global $role;

    //konwersja parametrów na float
    $form['sila'] = floatval($form['sila']);
    $form['droga'] = floatval($form['droga']);

    //podział uprawnień w zależności od roli
    if ($role == 'user' && $form['sila'] > 100){
        $messages [] = 'Tylko administrator może obliczać pracę dla siły powyżej 100 N!';
    } else {
        //wykonanie operacji W = F * s
        $praca = $form['sila'] * $form['droga'];
    }
}

//definicja zmiennych kontrolera
$form = array();
$sila = null;
$droga = null;
$praca = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($form);
$sila = $form['sila'];
$droga = $form['droga'];

if ( validate($form,$messages) ) { // gdy brak błędów
    process($form,$messages,$praca);
    $sila = $form['sila'];
    $droga = $form['droga'];
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$sila,$droga,$praca)
//   będą dostępne w dołączonym skrypcie
include 'praca_view.php';