<?php  
//Verbindung zur Datenbank wird hier hergestellt
require 'connection.php';
//Prüft ob der User angemeldet ist
require 'logincheck.php';
//Prüft ob projectname und description in der $_POST Variable gesetzte sind
if (isset($_POST["projectname"]) && isset($_POST["description"])) {
    $projectname = $_POST["projectname"];
    $description = $_POST["description"];
    //Bereitet eine SQL-Abfrage zum ausgeben der Projekte und Beschreibungen vor
    $stmt = $con->prepare("SELECT * FROM projects WHERE projectname = :projectname AND description = :description");
    $stmt->bindParam(':projectname', $projectname);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
}




?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_projekt.css">
    <title>Projekte</title>
</head>
<body>
<h3>Hallo
        <?php
        echo $_SESSION["username"];
        ?>
    </h3>
<div class="dropdown">
    <button class="dropbtn"><img src="images/creeper_face.png" width="20px" height="20px"></button>

    <div class="dropdown-content">

      <a href="homepage.php">Startseite</a>

      <a href="player.php">Player</a>

      <a href="projekte.php">Projekte</a>

      
      <a href="logout.php">Logout</a>
    </div>
  </div>
   <?php
   //SQL Abfrage um alles aus Projekte auszuwählen
    $sql = "SELECT * FROM projects";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    ?>
<table>
        <thead>
            <tr>
                <th>Projektname</th>
                <th>Beschreibung</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Schleife zum ausgeben der Projekte und ihrer Beschreibung
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td><a href='?id=". $row['id']."'>". $row['projectname']. "</a></td>";;
                echo "<td>".substr($row['description'],0,50). "</td>";
                echo "</tr>";
            }
 
           ?>
        </tbody>
    </table>  
</body>
</html>