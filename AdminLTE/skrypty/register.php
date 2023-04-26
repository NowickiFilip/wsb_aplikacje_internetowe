<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";


session_start();


foreach ($_POST as $key => $value){
    if (empty($value)){
        $_SESSION["error"] = "Wypełnij wszystie pola!";
        echo "<script>history.back();</script>";
        exit();
    }
}

$error = 0;

if (!isset($_POST['terms'])){
    $error = 1;
    $_SESSION["error"] = "Zaznacz przycisk regulaminu!";
        echo "<script>history.back();</script>";
        exit();
    }

if ($_POST['pass1'] != $_POST['pass2']){
    $error = 1;
    $_SESSION["error"] = "Hasla sa rozne";
    echo "<script>history.back();</script>";
    exit();
}

if ($_POST['email1'] != $_POST['email2']){
    $error = 1;
    $_SESSION["error"] = "Adresy mail sa rozne";
    echo "<script>history.back();</script>";
    exit();
}

//duplikacja adresu email


if ($error != 0){
        echo "<script>history.back();</script>";
        exit(); 
    }


require_once "./conect.php";

$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `DataUrodzenia`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());");

$pass = password_hash($_POST["pass1"],PASSWORD_ARGON2ID);
$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["DataUrodzenia"], $pass);

$stmt->execute();


if($stmt->affected_rows == 1){
    $_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lansName]";

}else{
    $_SESSION["error"] = "Nie udało się dodać użytkownika";

}


header( header: "location: ../Pages/register.php");