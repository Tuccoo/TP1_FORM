<?php include "../pdo-colyseum.php"; ?>

<html>
<link rel="stylesheet" href="../public/style.css">

<body>
    <a href="http://localhost/pdo_TP1/menu">MENU</a>
</body>

</html>

<!-- EXERCICE 5 -->
<h2> ~~~~~~~~~ EXERCICE 5 ~~~~~~~~~~ <br></h2>
<h3>
    Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la
    lettre "M".
</h3>

<?php
$query = "SELECT * FROM clients WHERE LEFT(lastName, 1) = 'M' ORDER BY lastName ASC ;";

// tentative de connexion et de récupération de la requete dans la base
try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 
$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array)
    echo "<h5>" . $array["firstName"] . " " . $array["lastName"] . "<br></h5>";
?>