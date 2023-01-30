<?php
include "../pdo-hospital.php";
?>
<a href="../menu">MENU(1)</a><br>
<a href="./ajout-patient.php">ADD A PATIENT(2)</a><br>
<a href="./liste-patients.php">PATIENTS LIST(3)</a><br>
* ADD AN APPOINTMENT(4) * <br>
<a href="./liste-rendezvous.php">APPOINTMENTS LIST(5)</a><br>
<h3>~~~~~~~~~ ADD AN APPOINTMENT : ~~~~~~~~~</h3><br>
<form method="post" action="ajout-rendezvous.php">
    <label for="dateHour">Appointment date :</label>
    <input type="datetime-local" name="date" id="dateHour"><br>
    <label for="idPatients">Patient ID : </label>
    <input type="number" name="id" id="idPatients"><br>
    <input type="submit" name="submit" value="ADD APPOINTMENT">
</form>

<?php

if (isset($_POST['submit'])) {
    try {
        $sql = $database->prepare("INSERT INTO appointments (dateHour, idPatients) VALUES (:date, :id)");
        $sql->bindParam(':date', $_POST['date']);
        $sql->bindParam(':id', $_POST['id']);
        $sql->execute();
        echo "Success.<br>";
        
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage() . "<br />";
        echo "Number : " . $e->getCode();
    }
}


?>
