<?php
// Definiert die MySQL-Datenbankverbindung
$dsn = 'mysql:dbname=projekt;host=localhost';
// Username für MySQL Datenbank Verbindung
$username = 'root';
// Passwort für MYSQL Datenbank Verbindung
$password = '';
//Erstellen eines neues PDO-Objekts zur Darstellung der Datenbankverbindung
//Übergeben des Benutzernamen und Passworts an die Datenbank.
$con = new PDO("$dsn","$username","$password",);
?>