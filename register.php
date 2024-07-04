<?php
//Verbindung zur Datenbank wird hergestellt
require ("connection.php");
//If Funktion sobald man auf den Button seine Registrierung bestätigt
if (isset($_POST["submit"])) {
    //Variablen werden mit Werten gefüllt.
    $username = $_POST["username"];
    $password = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];
    //Bereite vor das die Spalten aus der Tabelle "users" auszusuchen
    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username OR email=:email");
    //Username Parameter wird zu der Username Variable gebunden
    $stmt->bindParam(":username", $username);
    //Email Parameter wird zu der Email Variable gebunden
    $stmt->bindParam(":email", $email);
    //Ausführen des Statements
    $stmt->execute();

    $userAlreadyExists = $stmt->fetchColumn();

    $emailAlreadyExists = $stmt->fetchColumn();
    //Hier wird überprüft ob die Email Gültig ist
    if (!empty($_POST["email"])) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //Hier wird überprüft ob Username und Passwort bereits existieren
            if (!$userAlreadyExists && !$emailAlreadyExists) {

                registerUser($username, $email, $password);
            } else {
                ?> <div class="error"; method="POST">
        
                    <p style='color: red;font-family: "minecraft_font";font-size: large;'> Dieser Benutzername oder diese Email existiert bereits </p>
            
                </div>
                   <?php
            }
        } else {
            ?> <div class="error"; method="POST">
        
                <p style='color: red;font-family: "minecraft_font";font-size: large;'> Die eingegebene E-Mail-Adresse ist ungültig. </p>
        
            </div>
               <?php
            $email = ""; // Setze die E-Mail-Adresse zurück, um sie im Formular erneut anzuzeigen}
        }
    } else {
        ?> <div class="error"; method="POST">
        
            <p style='color: red;font-family: "minecraft_font";font-size: large;'> Bitte geben Sie eine E-Mail-Adresse ein. </p>
    
        </div>
           <?php
    }
}
//Wenn der Button zum Login gedrückt wird wird der User weitergeleitet.
if (isset($_POST["zumLogin"])) {
    header("Location: login.php");
}

function registerUser($username, $email, $password)
{
    global $con;
    //Oben geschriebene daten werden in die Datenbank eingefügt
    $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->execute();
    header("Location: login.php");
}

?>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrieren</title>
    <link rel="stylesheet" href="style.css">
    <style>
  .error{
    background-color: #00000053;
    width: 35%;
    height: 7%;
    align-self: right;
    text-align: center;
    -webkit-border-radius: 12px 0px 0px 12px;
    border-radius: 12px 0px 0px 12px;
  }
  </style>


</head>

<body>
    <form action="register.php" method="POST">

        <h1>Account Erstellen</h1>
        <!-- 3 felder zu texteingabe -->

        <div class="inputs_container">
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
            <input type="text" placeholder="Email" name="email" autocomplete="off">
            <input type="password" placeholder="Passwort" name="password" autocomplete="off">
        </div>

        <!-- Button um die Registrier abfrage abzuschicken -->


        <button name="submit">Erstellen</button>
        <button name="zumLogin">Zum Login</button>

    </form>


</body>

</html>