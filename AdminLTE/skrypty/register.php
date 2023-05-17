<?php
//	echo "<pre>";
//		print_r($_POST);
//	echo "</pre>";
function sanitizeInput($input){
$input = trim($input);
$input = stripslashes($input);
$input = htmlentities($input);
return $input;
}
echo $_POST["firstName"]. " ==> ". sanitizeInput($_POST["firstName"]). " ilość znaków: " .strlen($_POST["firstName"]);

exit();

if($_SERVER["REQUEST_METHOD"] == "POST"){

	$required_fields =["firstName","lastName", "email1", "email2", "pass1", "pass2", "DataUrodzenia", "city_id", "gender"];

	//foreach($required_fields as $key => $value){
		//echo "$key: $value<br>";
	//}
	exit();

	session_start();

	$errors = [];

	foreach ($required_fields as $key => $value){
		if (empty($_POST[$value])){
			$errors[] = "Pole <br>$value<br> jest wymagane";
			echo "<script>history.back();</script>";
			exit();
		}
	}

	if(!empty($errors)){
		$_SESSION["error"] = implode("<br>", $errors);
		echo "<script>history.back();</script>";
		exit();
	}


	//regulamin
	if (!isset($_POST["terms"])){
		$errors[] = "Zatwierdź regulamin!";
	}

	if (!isset($_POST["gender"])){
		$errors[] = "Zaznacz płeć!";
	}

	//hasło
	if ($_POST["pass1"] != $_POST["pass2"]){
		$errors[] = "Hasła są różne!";
	}

	//email
	if ($_POST["email1"] != $_POST["email2"]){
		$errors[] = "Adresy email są różne!";
	}
	if ($_POST["additional_email1"] != $_POST["additional_email2"]){
		$errors[] = "Adresy email są różne!";
		
	}else{
	if(empty($_POST["additional_email1"]))
	$_POST["additional_email1"] = NULL;

	}
	

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $_POST["pass1"])) {
        $error = 1;
        $_SESSION["error"] = "Hasło nie spełnia wymagań!";
    }
	if ($error != 0){
		echo "<script>history.back();</script>";
		exit();
	}

	require_once "./conect.php";
	$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
	$stmt->bind_param('s', $_POST["email1"]);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows != 0){
		$_SESSION["error"] = "Adres $_POST[email1] jest zajęty!";
		echo "<script>history.back();</script>";
		exit();
	}
	foreach ($_POST as $key => $value){
		if(!$_POST["pass1"])
		sanitizeInput($_POST["$key"]);
	}

	$stmt = $conn->prepare("INSERT INTO `users` (`email`, `additional_email`,`city_id`, `firstName`, `lastName`, `DataUrodzenia`, `gender`, `avatar`, `password`, `created_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp());");

	$pass = password_hash('$_POST["pass1"]', PASSWORD_ARGON2ID);

	$avatar = ($_POST["gender"] == 'm') ? './jpg/man.png' : './jpg/woman.png';

	$stmt->bind_param('ssissssss', $_POST["email1"],$_POST["additional_email"], $_POST["city_id"], $_POST["firstName"], $_POST["lastName"], $_POST["DataUrodzenia"], $_POST["gender"], $avatar, $pass);

	$stmt->execute();

	if ($stmt->affected_rows == 1){
		$_SESSION["success"] = "Dodano użytkownika $_POST[firstName] $_POST[lastName]";
	}else{
		$_SESSION["error"] = "Nie udało się dodać użytkownika!";
	}

	header("location: ../pages/register.php");
}