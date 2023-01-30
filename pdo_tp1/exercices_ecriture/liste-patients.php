<?php
include "../pdo-hospital.php";
?>
<a href="../menu">MENU(1)</a><br>
<a href="./ajout-patient.php">ADD A PATIENT(2)</a><br>
* PATIENTS LIST(3) *<br>
<a href="./ajout-rendezvous.php">ADD AN APPOINTMENT(4)</a><br>
<a href="./liste-rendezvous.php">APPOINTMENTS LIST(5)</a>
<h3>~~~~~~~~ PATIENTS LIST : ~~~~~~~~</h3><br>
<h5>~~~~~ Quick search : ~~~~~</h5>
<?php
//  SEARCHBAR :
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $query = "SELECT * FROM patients WHERE id=:id";
    $result = $database->prepare($query);
    $executerecord = $result->execute(array("id" => $id));
    if ($executerecord) {
        if ($result->rowCount() > 0) {
            foreach ($result as $row) {
                $id = $row["id"];
                $firstname = $row["firstname"] . ", ";
                $lastname = $row["lastname"] . ", ";
                $birthdate = $row["birthdate"] . ", ";
                $email = $row["mail"] . ", ";
                $phone = $row["phone"] . ", ";
            }
        } else {
            echo "Search not found.";
        }
    }
}


?>

<form method='POST' action=''>
    Enter patient's ID : <input type='text' name='id'>
    <input type='submit' name='find' value='SEARCH'>
    <table>
        <tr>
            <td>Patient' id : <b><?php if (!empty($id)) {
                                    echo $id;
                                } ?></b></td>
            <td>First name : <b><?php if (!empty($firstname)) {
                                    echo $firstname;
                                } ?></b></td>
            <td>Last name : <b><?php if (isset($lastname)) {
                                    echo $lastname;
                                } ?></b></td>
            <td>Birth date : <b><?php if (isset($birthdate)) {
                                    echo $birthdate;
                                } ?></b></td>
            <td>E-mail : <b><?php if (isset($email)) {
                                echo $email;
                            } ?></b></td>
            <td>Phone : <b><?php if (isset($phone)) {
                                echo $phone;
                            } ?></b></td>
        </tr>
    </table>
</form>
~~~~~~~~~~~~~~~<br>
<?php

$query = "SELECT * FROM patients";

// tentative de connexion et de récupération de la requete dans la base
try {
    $results = $database->query($query);
} catch (PDOException $e) {
    die("ERROR : " . $e->getMessage() . "<br />");
}

// conversion des données récupérées en un tableau + affichage 
$data = $results->fetchAll(PDO::FETCH_ASSOC);
foreach ($data as $array) {
    echo "Patient ID : " . $array["id"] . "<br> First name : " . $array["firstname"] . "<br> Last name :" . $array["lastname"] . "<br> Birth date : "
        . $array["birthdate"] . "<br> E-mail : " . $array["mail"] . "<br> Phone number : " . $array["phone"] . "<br><a href='profil-patients.php?id=" . $array['id'] . "'>SHOW PROFILE</a>";
    echo "<form method='post' action='liste-patients.php'>
        <input type='submit' name=" . $array['id'] . " value='DELETE'><br><br>";

    if (isset($_POST[$array['id']])) {
        try {
            $sql = $database->prepare("DELETE FROM patients WHERE id = :id ");
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
    }
}
?>