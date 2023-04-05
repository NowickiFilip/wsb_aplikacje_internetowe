<?php

print_r($_POST);
session_start();
foreach ($_POST as $key => $value){

    //echo "$key: $value<br>";


    if(empty($value)){
        //echo "$key<br>";
        $_SESSION["error"] = "Wypełnij wszystkie pola w formularzu";
        echo "<script>history.back();</script>";
        exit();
    }
}

require_once "./connect.php";

//$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `DataUrodzenia`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[DataUrodzenia]');";
//$conn->query($sql);
$sql = "UPDATE `users` SET `firstName` = '$_POST[firstName]', `lastName` = '$_POST[lastName]', `DataUrodzenia` = '$_POST[DataUrodzenia]' WHERE `users`.`id` = $_SESSION[updateUserId];";
$conn->query($sql);
unset($_SESSION["updateUserId"]);
if($conn->affected_rows == 1){

    $_SESSION["error"] = "Prawidłowo zaktualizowano rekord";
}else{
    $_SESSION["error"] = "niedodano rekordu";

}

header(header:"location: ../BazaDanych/3_db_table.php")

?>
