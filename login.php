<?php
//Datenbankverbindung wird Hergestellt.

require("connection.php");

//Wenn der Login Button gedr�ckt wird wird die Datenbank abgefragt.
if(isset($_POST["login"])){
    //Username und Passwort werden aus dem Formular gelesen.
    $username = $_POST["username"];
    $password = $_POST["password"];
    //Abfrage ob der Username in der Datenbank vorhanden ist.
    $stmt = $con->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $userExists = $stmt->fetchAll();
    
    
    $passwordHashed = $userExists[0]["password"];
    $checkPassword = password_verify($password, $passwordHashed);
    //Passwort wird �berpr�ft
    
    

    if( !$userExists ==FALSE ||  $checkPassword === false){
        //Wenn falsches Passwort oder Username dann Fehlermeldung
        ?> <div class="error"; method="POST">
        
        <p style='color: red;font-family: "minecraft_font";font-size: large;'> Login fehlgeschlagen, Passwort oder Benutzername falsch </p>

    </div>
       <?php
}

if($checkPassword === true){
    //Wenn Passwort stimmt wird die Session gestartet und der Username wird in die Session gespeichert.
    session_start();
    $_SESSION["username"] = $userExists[0]["username"];
    $_SESSION['login'] = true;
    header("Location: homepage.php");
}
}
//Wenn der Button "Registrieren" gedr�ckt wird wird man auf die Register Seite weitergeleitet.

if(isset($_POST["register"])){
    header("Location: register.php");
}



?>

<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
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
    <!-- Login abfrage -->

    <form action="login.php" method="POST">
        
        <h1>Login</h1>
        
        <div class="inputs_container">
            <input type="text" placeholder="Benutzername" name="username" autocomplete="off">
            <input type="password" placeholder="Passwort" name="password" autocomplete="off">
        </div>

        <!-- Login Button -->

        <button name="login">Login</button>
        <button name="register">Register</button>

    </form>


</body>
</html>