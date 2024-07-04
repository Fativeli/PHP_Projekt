<?php
//Verbindung zur Datenbank wird hier hergestellt
require 'connection.php';
//Prüft ob der User angemeldet ist
require 'logincheck.php';

if (isset($_POST["button"])) {
  //Wenn der Projekt name und die Beschreibung nicht Leer sind, wird die Abfrage ausgeführt.
  if (!empty($_POST["projectname"]) && !empty($_POST["description"]) ) {


  $username = $_SESSION['username'];
  $projectname = $_POST["projectname"];
  $description = $_POST["description"];

 

 try {
  // Angegebene Daten werden in die Tabelle "projects" geschrieben.
  $stmt = $con->prepare("INSERT INTO projects (projectname, description, username) VALUES (:projectname, :description, :username)");
  $stmt->bindParam(":projectname", $projectname);
  $stmt->bindParam(":description", $description);
  $stmt->bindParam(":username", $username);


  // Ausf�hrung der Abfrage
  $stmt->execute();


 
} catch(PDOException $e) {
  //Wenn die Abfrage nicht ausgeführt werden kann, wird die Fehlermeldung ausgegeben.
  echo "Error: " . $e->getMessage();
 }
}
else {
  //Alle Felden müssen Ausgefüllt werden, wenn nicht wird diese Meldung ausgegeben.
  ?> <div class="error"; method="POST">
        
  <p style='color: red;font-family: "minecraft_font";font-size: large;'> Alle Felder ausfüllen bitte und danke </p>

</div>
 <?php   
}


}




?>



<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Homepage</title>
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
  <!-- Begr��ung an den User -->
  <h3>Hallo
    <?php
    echo $_SESSION["username"];
    ?>
  </h3>
  <form action="homepage.php" method="POST" enctype="multipart/form-data">

    <div class="inputs_container">
      <input type="text" placeholder="Projektname" name="projectname" autocomplete="off" maxlength="30"><br>
      <textarea placeholder="Beschreibung" name="description" autocomplete="off"
        maxlenght="500"></textarea><br>

    </div>
    <button type="submit" name="button" value="hochladen">Abschicken</button>

  </form>
  <div class="dropdown">

    <button class="dropbtn"><img src="images/creeper_face.png" width="20px" height="20px"></button>

    <div class="dropdown-content">

      <a href="homepage.php">Startseite</a>

      <a href="player.php">Player</a>

      <a href="projekte.php">Projekte</a>

      
      <a href="logout.php">Logout</a>
    </div>
  </div>




</body>