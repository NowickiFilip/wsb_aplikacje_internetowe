<?php
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

foreach ($_POST as $key => $value){
    if (empty($value)){
        $_SESSION["error"] = "Wypełnij wszystie pola!";
        echo "<script>history.back();</script>";
        exit();
    }
}

require_once "./conect.php";

$stmt = $conn->prepare("INSERT INTO `users` (`email`, `city_id`, `firstName`, `lastName`, `DataUrodzenia`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, current_timestamp());");


$stmt->bind_param('sissss', $_POST["email1"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["DataUrodzenia"], $_POST["pass1"]);

$stmt->execute();

echo $stmt->affected_rows;