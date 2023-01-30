<?php
include "../pdo-hospital.php";
?>
<a href="../menu">MENU(1)</a><br>
<a href="./ajout-patient.php">ADD A PATIENT(2)</a><br>
<a href="./liste-patients.php">PATIENTS LIST(3)</a><br>
<a href="./ajout-rendezvous.php">ADD AN APPOINTMENT(4)</a><br>
* APPOINTMENTS LIST(5) *
<h3>~~~~~~~~~ APPOINTMENTS LIST : ~~~~~~~~~</h3><br>
<?php
$query = "SELECT * FROM appointments";

// tentative de connexion et de récupération de la requete dans la base
try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 
$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array){
    echo "Appointment date and hour : " . $array["dateHour"] . "<br> Patient ID : " . $array["idPatients"] . "<br><a href='rendezvous.php?id=" . $array['id'] . "'>UPDATE APPOINTMENT</a><br>
    <form method='post' action='liste-rendezvous.php'>
    <input type='submit' name=".$array['id']." value='DELETE'><br><br>";
    

// ajout de la fonction du bouton delete
if (isset($_POST[$array['id']])) {
    try {
        $sql = $database->prepare("DELETE FROM appointments WHERE id = :id ");
        $sql->bindParam("id", $array["id"]);
        $sql->execute();
        $sqlAll = $sql->fetchAll();
        echo "Processing..<br>";
        header("refresh:0.5"); 
    } catch (PDOException $e) {
        echo "Connexion error : " . $e->getMessage() . "<br />";
        echo "Number : " . $e->getCode();
        exit();
    }
} else {
}}
?>