<?php
//Zeigt Fehlermeldungen an.
ini_set('display_errors', 1);
//Verbindung zur Datenbank wird hergestellt.
require("connection.php");


// Weiterleiten zum Login oder zur Registrierung

//Wenn "Login" gedrückt wird.

if(isset($_POST["login"])) {
    //Weiterleitung zum Login.
    header("Location: login.php");
}

//Wenn "Register" gedrückt wird.
if(isset($_POST["register"])) {
    //Weiterleitung zum Register
    header("Location: register.php");
}

?>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- 2 Button's die auf die jeweilige Seite weiterleiten -->
    <form action="index.php" method="POST">
        <h1>MineSolutions</h1>
 
        <button name="register">Registrieren</button>
        <button name="login">Zum Login</button>
    </form>


</body>
</html>