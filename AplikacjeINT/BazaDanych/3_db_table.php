<?php
session_start()
?>
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
if(isset($_sSESSION["error"])){


echo $_SESSION["error"];
unset($_SESSION["error"]);
}
require_once "../skrypt/connect.php";
$sql = "SELECT users.id,firstName,lastName,DataUrodzenia,city,state,country FROM users inner join cities on users.city_id = cities.id INNER join states on cities.state_id = states.id inner JOIN countries on states.id_country=countries.id;";
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
    <td><a href="../skrypt/delete_user.php?deleteUserId=$user[id]">Usuń</a></td>
    <td><a href="./3_db_table.php?updateUserId=$user[id]">Edytuj</a></td>
    </tr>
    
   
    


USERSTABLE; 
}
if($result->num_rows > 0){
while($user = $result->fetch_assoc()){
    echo <<< USERSTABLE

    <tr>
    <td>$user[firstName]</td>
    <td>$user[lastName]</td>
    <td>$user[DataUrodzenia]</td>
    <td>$user[city]</td>
    <td>$user[state]</td>
    <td>$user[country]</td>
    <td><a href="../skrypt/delete_user.php?deleteUserId=$user[id]">Usuń</a></td>
    </tr>
   

   
    


USERSTABLE; 
}}
else{
    echo <<< USERSTABLE
    <tr>
    <td colspan="6"> Brak rekordów do wyśtwietlenia</td>
    </tr>
    USERSTABLE;
}


echo "</table>";
if(isset($_GET['deleteUser']))
if($_GET["deleteUser"] !=0){
    echo "<hr>Usunięto użytkownika o id = $_GET[deleteUser]";
}
else{
    echo "<hr> Nie usunięto użytkownika";
}

if(isset($_GET["addUserForm"])){
    echo <<< ADDUSERFORM
    <hr><h4>Dodawanie użytkownika</h4>
    <form action="../skrypt/add_user.php" method="post">
    <input type="text" name="firstName" placeholder="Podaj imie" autofocus><br><br>
    <input type="text" name="lastName" placeholder="Podaj nazwisko"><br><br>
    <select name="city_id">
ADDUSERFORM;
$sql = "SELECT * from cities";
$result = $conn->query($sql);
while($city = $result->fetch_assoc()){
    echo "<option value=\"$city[id]\">$city[city]</option>";
    

}
    echo <<< ADDUSERFORM
    
    <input type="date" name="DataUrodzenia">Podaj date urodzenia<br><br>
    <input type ="checkbox" name="tera" checked>Regulamin<br><br>
    <input type="submit" value="Dodaj Użytkownika"><br><br>
    </form>
ADDUSERFORM;
}else{
   echo '<a href="./3_db_table.php?addUserForm=1">Dodawanie użytkownika</a>';
}

 if(isset($_GET["updateUserId"])){
    $sql = "SELECT * from users where id = $_GET[updateUserId]";
    $result = $conn->query($sql);
    $updateUser = $result->fetch_assoc();
    $_SESSION["updateUserId"] = $_GET["updateUserId"];
    
    echo <<< UPDATEUSERFORM
    <hr><h4>Aktualizacja</h4>
    <form action="../skrypt/update_user.php" method="post">
    <input type="text" name="firstName" placeholder="Podaj imie" value ="$updateUser[firstName]"autofocus><br><br>
    <input type="text" name="lastName" placeholder="Podaj nazwisko" value ="$updateUser[lastName]"><br><br>
    <select name="city_id">
UPDATEUSERFORM;
    $sql = "SELECT * from cities";
    $result = $conn->query($sql);
    while($city = $result->fetch_assoc()){
    
    if($updateUser["city_id"] == $city["id"]){

        echo "<option value=\"$city[id]\" selected>$city[city]</option>";
    }else{

        echo "<option value=\"$city[id]\">$city[city]</option>";
    }

}
    echo <<< UPDATEUSERFORM
    
    <input type="date" name="DataUrodzenia" value ="$updateUser[DataUrodzenia]">Podaj date urodzenia<br><br>
    <input type="submit" value="Aktualizuj użytkownika"><br><br>
   
    </form>
UPDATEUSERFORM;
 }
 $conn->close();
?>





</body>
</html>