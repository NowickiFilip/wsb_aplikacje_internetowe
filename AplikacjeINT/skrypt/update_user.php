<?php

print_r($_POST);
session_start();
foreach($_POST as $key => $value){
    //echo "$key: $value<br>";

    if (empty($value)){

        //echo "$key<br>";
$_SESSION["error"] = "Wypełnij wszystkie pola w formularzu";
        echo "<script>history.back();</script>";
        exit();
    }

}

require_once "./conect.php";

//$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `DataUrodzenia`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[DataUrodzenia]');";
$sql ="UPDATE `users` SET `city_id` = '$_POST[city_id]', `firstName` = '$_POST[firstName]', `lastName` = '$_POST[lastName]', `DataUrodzenia` = '$_POST[DataUrodzenia]' WHERE `users`.`id` = $_SESSION[updateUserId];";
$conn ->query($sql);
unset($_SESSION["updateUserId"]);
//echo $conn->affected_rows;

if ($conn->affected_rows == 1){
//echo "Prawidlowo dodano rekord";
$_SESSION["error"] = "Prawidlowo zmieniono rekord";
}else{
//echo "Nie dodano rekordu!";
$_SESSION["error"] = "Nie zaktualizowano";
}


header("location:../BazyDanych/5_db_table.php?");
?>
