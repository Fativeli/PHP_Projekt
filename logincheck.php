<?php
//Erstelle eine Sitzungscookie und setzte Ihn auf die definierte Zeit (hier 60 min)
ini_set('session.cookie_lifetime', 60*60);

# Session prüfen

session_start();

//Speichert die letzte Aktivität wenn der Benutzer sich eingeloggt hat
if (!isset($_SESSION['letzteAktiv'])) {
    $_SESSION['letzteAktiv'] = time();
}

//Prüfung ob die Sitzung abgelaufen ist ausführung der destroy Funktion
if (isset($_SESSION['letzteAktiv']) && (time() - $_SESSION['letzteAktiv'] > 60*60)) {
    session_destroy();
    //Rückleitung zum LogIn
    header('Location: index.php');
    die('Session expired');

}

//Prüfung ob man eingeloggt ist, ansonsten wird man zum LogIn geschickt
if (@$_SESSION['login']!== true) {
    //Aktualisiert die letzte Zeit der Aktivität
    $_SESSION['letzteAktiv'] = time();
    //Rückleitung zum LogIn
    header('Location: index.php');
    die('Please log in');
}
session_regenerate_id();
?>
