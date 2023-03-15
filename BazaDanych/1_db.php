<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uzytkownicy</title>
</head>
<body>
    <h4>Uzytkownicy z bazy danych</h4>

    <?php
        require_once "../skrypt/conect.php";
        $sql = "SELECT * FROM `users`";
        $result = $conn->query($sql);
       // $user = $result->fetch_assoc();
        //print_r($user);
       // echo "Imie i nazwisko: " . $user["firstName"] . " " . $user["lastName"] . "<br>" ;

        while($user = $result->fetch_assoc()) {
        echo <<< USER
            Imie i nazwisko: $user[firstName] $user[lastName] <br>
            Data Urodzenia: $user[DataUrodzenia]
            <hr>
        USER;
        }
    ?>
</body>
</html>