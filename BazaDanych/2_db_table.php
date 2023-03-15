<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/table.css">
    <title>Użytkownicy</title>

    
</head>
<body>
    <h4>Użytkownicy</h4>
    
<?php
require_once "../skrypt/connect.php";
$sql = "SELECT * FROM `users` inner join `cities` on users.city_id = cities.id INNER join `states` on cities.state_id = states.id inner JOIN `country` on states.id_country=country.id;";
$result = $conn->query($sql);
echo <<< USERTABLE
    <table>
    <tr>
        <th>imie</th>
        <th>nazwisko</th>
        <th>data_uodzenia</th>
        <th>miasto</th>
        <th>wojewodztwo</th>
        <th>państwo</th>
        
    </tr>
USERTABLE;

while($user = $result->fetch_assoc()){
    echo <<< USERSTABLE

    <tr>
    <td>$user[firstName]</td>
    <td>$user[lastName]</td>
    <td>$user[DataUrodzenia]</td>
    <td>$user[city]</td>
    <td>$user[state]</td>
    <td>$user[country]</td>

   
    


USERSTABLE; 
}
echo "</table>";
 
?>
</body>
</html>