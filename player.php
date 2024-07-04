<?php 
//Verbindung zur Datenbank wird hier hergestellt
require 'connection.php';
//Prüft ob der User angemeldet ist
require 'logincheck.php';

//Prüft ob projectname und username in der $_POST Variable gesetzte sind
if (isset($_POST["projectname"]) && isset($_POST["username"])) {
    $projectname = $_POST["projectname"];
    $username = $_POST["username"];

    //Bereitet eine SQL-Abfrage zum ausgeben der Projekte und Benutzer vor
    $stmt = $con->prepare("SELECT * FROM projects WHERE projectname = :projectname AND username = :username");
    $stmt->bindParam(':projectname', $projectname);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
}
?>


<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
    <link rel="stylesheet" href="style_projekt.css">
</head>

<body>
    <?php
    //SQL Abfrage um alle Projekte und Benutzernamen auszuwählen
    $sql = "SELECT projects.projectname, projects.description, projects.username FROM projects; ";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    ?>
    <h3>Hallo
        <?php
        echo $_SESSION["username"];
        ?>
    </h3>

    <table>
        <thead>
            <tr>
                <th>Player</th>
                <th>Project</th>
            </tr>
        </thead>
        <tbody>
            <?php
            //Schleife zum ausgeben der Projekte und des jeweiligen Erstellers
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td><a href='?id=" . $row['id'] . "'>" . $row['projectname'] . "</a></td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
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

</html>