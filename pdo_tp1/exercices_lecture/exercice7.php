<?php include "../pdo-colyseum.php"; ?>

<html>
<link rel="stylesheet" href="../public/style.css">

<body>
    <a href="http://localhost/pdo_TP1/menu">MENU</a>
</body>

</html>

<!-- EXERCICE 7 -->
<h2> ~~~~~~~~~ EXERCICE 7 ~~~~~~~~~~ <br></h2>
<h3>
    Afficher tous les clients comme ceci :<br>
    Nom : Nom de famille du client<br>
    Prénom : Prénom du client<br>
    Date de naissance : Date de naissance du client<br>
    Carte de fidélité : Oui (Si le client en possède une) ou Non (s'il n'en possède pas)<br>
    Numéro de carte : Numéro de la carte fidélité du client s'il en possède une.<br><br>
</h3>


<?php
$query = "SELECT * FROM clients ";

// tentative de connexion et de récupération de la requete dans la base
try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 
$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array) {

    echo "<h5>Last name : " . $array["lastName"] . ",<br>" .
        "First name : " . $array["firstName"] . ",<br>" .
        "Birth date : " . $array["birthDate"] . ",<br>";
    if ($array["card"] == 1) {
        echo "Loyality card : YES,<br>" .
            "Card number : " . $array["cardNumber"] . ".<br><br></h5>";

    } else {
        echo "Loyality card : NO.<br><br></h5>";

    }
}
?>