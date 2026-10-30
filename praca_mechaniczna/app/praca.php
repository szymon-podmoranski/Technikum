<?php
// KONTROLER strony pracy mechanicznej
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$sila = $_REQUEST ['sila'];
$droga = $_REQUEST ['droga'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($sila) && isset($droga))) {
    //sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
    $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ( $sila == "") {
    $messages [] = 'Nie podano siły';
}
if ( $droga == "") {
    $messages [] = 'Nie podano drogi';
}

//nie ma sensu walidować dalej gdy brak parametrów
if (empty( $messages )) {

    // sprawdzenie, czy sila i droga są liczbami
    if (! is_numeric( $sila )) {
        $messages [] = 'Siła nie jest liczbą';
    }

    if (! is_numeric( $droga )) {
        $messages [] = 'Droga nie jest liczbą';
    }

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów

    //konwersja parametrów na float
    $sila = floatval($sila);
    $droga = floatval($droga);

    //wykonanie operacji
    $praca = $sila * $droga;

}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$sila,$droga,$praca)
//   będą dostępne w dołączonym skrypcie

include 'praca_view.php';