<?php include "../pdo-colyseum.php"; ?>

<html>
<link rel="stylesheet" href="../public/style.css">

<body>
    <a href="http://localhost/pdo_TP1/menu">MENU</a>
</body>

</html>

<!-- EXERCICE 6 -->
<h2> ~~~~~~~~~ EXERCICE 6 ~~~~~~~~~~ <br></h2>
<h3>Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. Trier les titres par<br>
    ordre alphabétique. Afficher les résultats comme ceci : Spectacle par artiste, le date à heure.</h3>

<?php
$query = "SELECT * FROM shows ORDER BY title ASC";

// tentative de connexion et de récupération de la requete dans la base
try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 
$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array)
    echo "<h5> Le spectacle '" . $array["title"] . "' par " . $array["performer"] . ", le " . $array["date"] . " à " . $array["startTime"] . "<br></h5>";
?>