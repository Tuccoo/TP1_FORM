<?php
include "../pdo-hospital.php"; ?>

<h3>~~~~~~~~ Update appointment data : ~~~~~~~~</h3>
<a href="../menu">MENU(1)</a><br>
<a href="./ajout-patient.php">ADD PATIENT(2)</a><br>
<a href="./liste-patients.php">PATIENTS LIST(3)</a><br>
<a href="./ajout-rendezvous.php">ADD AN APPOINTMENT(4)</a><br>
<a href="./liste-rendezvous.php">APPOINTMENTS LIST(5)</a>
<?php
$id = $_GET["id"];

try {
    $sql = $database->prepare("SELECT * FROM appointments WHERE id = :id");
    $sql->bindParam("id", $id);
    $sql->execute();
} catch (PDOException $e) {
    echo "Connexion error : " . $e->getMessage() . "<br />";
    echo "Number : " . $e->getCode();
    exit();
}

$app = $sql->fetch();

if (!$app) {
    echo "Patient not found.";
    exit();
}

echo "<h3>~~~~~~~ Appointment informations : ~~~~~~~</h3>";
echo "Date : " . $app['dateHour'] . "<br>";
echo "Patient's ID: " . $app['idPatients'] . "<br>";
?>

<form action="rendezvous.php?id=<?php echo $id; ?>" method="post">
    <label for="dateHour">Appointment date :</label>
    <input type="datetime-local" name="date"><br>
    <label for="idPatients">Patient's ID : </label>
    <input type="number" name="id"><br>
    <input type="submit" name="submit" value="SUBMIT">
</form>

<?php



if (isset($_POST['submit'])) {
    try {
        $sql = $database->prepare("UPDATE appointments SET dateHour = :dateHour, idPatients = :idPatients WHERE id = :id");
        $sql->bindParam(':dateHour', $_POST['date']);
        $sql->bindParam(':idPatients', $_POST['id']);
        $sql->bindParam(':id', $id);
        echo "Processing..<br>";
        header("refresh:0.5"); 
        $sql->execute();
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage() . "<br />";
        echo "Number : " . $e->getCode();
    }
}


?>