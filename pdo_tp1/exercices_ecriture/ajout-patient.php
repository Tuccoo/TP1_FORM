<?php
include "../pdo-hospital.php";
?>

<html>
<body>
<a href="../menu">MENU(1)</a><br>
* ADD A PATIENT(2) *<br>
<a href="./liste-patients.php">PATIENTS LIST(3)</a><br>
<a href="./ajout-rendezvous.php">ADD AN APPOINTMENT(4)</a><br>
<a href="./liste-rendezvous.php">APPOINTMENTS LIST(5)</a>
<h3>~~~~~~~~~ ADD PATIENT : ~~~~~~~~~</h3><br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="firstname">First name : </label>
        <input type="text" placeholder="First name.." name="firstname" required><br>
        <label for="lastname">Last name :</label>
        <input type="text" placeholder="Last name.." name="lastname" required><br>
        <label for="birthdate">Birth date :</label>
        <input type="date" name="birthdate" required><br>
        <label for="phone">Phone number :</label>
        <input type="tel" placeholder="Phone number.." name="phone" required><br>
        <label for="mail">Email :</label>
        <input type="email" placeholder="Email.." name="mail" required><br>
        <input type="submit" name="submit" value="ADD PATIENT"><br>
    </form>
</body>

</html>
<?php


$firstName = !empty($_POST["firstname"]) ? $_POST["firstname"] : "";
$lastName = !empty($_POST["lastname"]) ? $_POST["lastname"] : "";
$birthDate = !empty($_POST["birthdate"]) ? $_POST["birthdate"] : "";
$phone = !empty($_POST["phone"]) ? $_POST["phone"] : "";
$email = !empty($_POST["mail"]) ? $_POST["mail"] : "";

if (isset($_POST['submit'])) {
    echo "Patient added.<br>";

    $emailPattern = "/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/";
    if (!preg_match($emailPattern, $email)) {
        echo "Email invalide<br>";
    }

    try {
        $sql = $database->prepare("INSERT INTO patients (firstname, lastname, birthdate, phone, mail) VALUES (:firstname, :lastname, :birthdate, :phone, :mail)");
        $sql->bindParam("firstname", $firstName);
        $sql->bindParam("lastname", $lastName);
        $sql->bindParam("birthdate", $birthDate);
        $sql->bindParam("phone", $phone);
        $sql->bindParam("mail", $email);

        $sql->execute();
    } catch (PDOException $e) {
        echo "Connexion error : " . $e->getMessage() . "<br />";
        echo "Number : " . $e->getCode();
        exit();
    }
}
?>