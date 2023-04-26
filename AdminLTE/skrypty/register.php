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

    if (!isset($_POST['gender'])){
        $error = 1;
        $_SESSION["error"] = "Zaznacz płeć";
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

$sql = "SELECT * FROM `users` where email = ?";
$stmt = $conn->prepare("SELECT * FROM `users` where email = ?");
$stmt->bind_param('s', $_POST["email1"]);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 1){

    $_SESSION["error"] = "Adres: $_POST[email1] jest zajety";
    echo "<script>history.back();</script>";
    exit();
}




if($stmt->affected_rows == 1){
    $_SESSION["success"] = "Dodano uzytkownika $_POST[firstName] $_POST[lastName]";
}else{
    $_SESSION["error"] = "Email juz istnieje";
}




$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `DataUrodzenia`,`gender`,`avatar`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, current_timestamp());");

$pass = password_hash($_POST["pass1"], PASSWORD_ARGON2ID);

$avatar = ($_POST["gender"] = 'm') = ('./jpg.man.png' ? './jpg.woman.png')

$stmt->bind_param('sissssss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["DataUrodzenia"],$_POST["gender"],$avatar, $pass);


$stmt->execute();

if($stmt->affected_rows == 1){
    $_SESSION["success"] = "Dodano uzytkownika $_POST[firstName] $_POST[lastName]";
}else{
    $_SESSION["error"] = "Nie udalo sie dodac uzytkownika";
}

//header("location:../Pages/register.php"); 