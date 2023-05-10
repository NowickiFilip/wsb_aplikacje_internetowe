<?php

if ($_SERVER["REQUEST_METHOD"] == 'POST'){
    //print_r["$_POST"];
    $errors = [];
    foreach($_POST as $key => $value){
        if(isset($value)){
        $errors[] = "Pole $key musi być wypełnione";
        }
    }
    
    if(!empty($errors)){
        $error_message = implode (separator:"<br>", $errors);
        header("location:../Pages/index.php?error=".urlencode($error_message));
        exit();
    }

    echo "email: " $_POST("email") ." , hasło: " $_POST("pass")."<br>";

    //$email= filter_var($_POST("email", FILTER_SANITIZE_EMAIL));
    //echo $email;

    echo htmlentities($_POST["email"]);
}else{
    header("location:../Pages/register.php"); 
}

?>