<?php

//print_r($_POST);

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

$sql = "INSERT INTO `users` (`id`, `city_id`, `firstName`, `lastName`, `DataUrodzenia`) VALUES (NULL, '$_POST[city_id]', '$_POST[firstName]', '$_POST[lastName]', '$_POST[DataUrodzenia]');";
$conn->query($sql);

if($conn->affected_rows == 1){

    $_SESSION["error"] = "Prawidłowo dodano rekord";
}else{
    $_SESSION["error"] = "niedodano rekordu";

}

header(header:"location: ../BazaDanych/3_db_table.php")

?>
