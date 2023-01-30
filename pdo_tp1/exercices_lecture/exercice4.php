<?php include "../pdo-colyseum.php"; ?>

<html>
<link rel="stylesheet" href="../public/style.css">

<body>
    <a href="http://localhost/pdo_TP1/menu">MENU</a>
</body>

</html>

<!-- EXERCICE 4 : -->
<h2> ~~~~~~~~~ EXERCICE 4 ~~~~~~~~~~ <br></h2>
<h3>N'afficher que les clients ne possédant pas de carte.
</h3>

<?php
$query = "SELECT * FROM clients WHERE cardNumber is NULL";

// tentative de connexion et de récupération de la requete dans la base
try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 
$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array)
    echo "<h5>" . $array["firstName"] ." ".$array["lastName"]."<br></h5>";
?>