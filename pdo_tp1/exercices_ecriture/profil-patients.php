<?php
include "../pdo-hospital.php";?>
<a href="../menu">MENU</a><br>
<a href="./ajout-patient.php">ADD A PATIENT</a><br>
<a href="./liste-patients.php">PATIENTS LIST</a><br>
<a href="./ajout-rendezvous.php">ADD AN APPOINTMENT</a><br>
<a href="./liste-rendezvous.php">APPOINTMENTS LIST</a>
<?php
$id = $_GET['id'];

try {
    $sql = $database->prepare("SELECT * FROM patients WHERE id = :id");
    $sql->bindParam("id", $id);
    $sql->execute();
} catch (PDOException $e) {
    echo "Connexion error : " . $e->getMessage() . "<br />";
    echo "Number : " . $e->getCode();
    exit();
}

$array = $sql->fetch();

if (!$array) {
    echo "Patient not found.";
    exit();
}

echo "<h3>~~~~~~~~ Patient informations : ~~~~~~~~</h3>" .
    "First name : " . $array['firstname'] . "<br>" .
    "Last name : " . $array['lastname'] . "<br>" .
    "Birth date : " . $array['birthdate'] . "<br>" .
    "Phone number : " . $array['phone'] . "<br>" .
    "E-mail : " . $array['mail'] . "<br><br>";

try {
    $appQuery = $database->prepare("SELECT * FROM appointments WHERE idPatients = :id");
    $appQuery->bindParam("id", $id);
    $appQuery->execute();
    $app = $appQuery->fetchAll();
} catch (PDOException $e) {
    echo "Connexion error : " . $e->getMessage() . "<br />";
    echo "Number : " . $e->getCode();
    exit();
}

echo "<h3>~~~~~~~~ Appointments list : ~~~~~~~~</h3>";
foreach ($app as $app) {
    echo "Date : " . $app['dateHour'] . "<br>";
}
if (!$app) {
    echo "This patient has no appointment.";
}


?>
<!-- PARTIE CHANGEMENT D'INFOS -->
<h3>~~~~~~~~ Update patient data : ~~~~~~~~</h3>
<form action="profil-patients.php?id=<?php echo $id; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label for="firstname">First name :</label>
    <input type="text" name="firstName" value="<?php echo $array['firstname']; ?>"><br>
    <label for="lastname">Name :</label>
    <input type="text" name="lastName" value="<?php echo $array['lastname']; ?>"><br>
    <label for="birthdate">Birth date :</label>
    <input type="date" name="birthDate" value="<?php echo $array['birthdate']; ?>"><br>
    <label for="phone">Phone number :</label>
    <input type="text" name="phone" value="<?php echo $array['phone']; ?>"><br>
    <label for="mail">E-mail :</label>
    <input type="text" name="email" value="<?php echo $array['mail']; ?>"><br>
    <input type="submit" name="submit" value="Update">
</form>

<?php



if (isset($_POST['submit'])) {
    try {
        $sql = $database->prepare("UPDATE patients SET firstname = :firstname, lastname = :lastname, birthdate = :birthdate, phone = :phone, mail = :mail WHERE id = :id");
        $sql->bindParam(':firstname', $_POST['firstName']);
        $sql->bindParam(':lastname', $_POST['lastName']);
        $sql->bindParam(':birthdate', $_POST['birthDate']);
        $sql->bindParam(':phone', $_POST['phone']);
        $sql->bindParam(':mail', $_POST['email']);
        $sql->bindParam(':id', $id);
        
        $sql->execute();
        header("refresh:1"); 
        echo "Processing..";
        
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage() . "<br />";
        echo "Number : " . $e->getCode();
    }
}


?>