<?php 

/* 

@author = Deep Patel
@ID = 000818379
@Desc = main screen for login

*/

if(isset($_POST['submit'])){

//to add the database
include('connect.php');


$username = $_POST["username"]; 
$password = $_POST["password"]; 

filter_input(INPUT_POST, $username, FILTER_SANITIZE_SPECIAL_CHARS);
filter_input(INPUT_POST, $password, FILTER_SANITIZE_SPECIAL_CHARS);

$command = "SELECT * FROM users WHERE username = ? AND password = ? ";
$stmt = $dbh->prepare($command);
$success = $stmt->execute([$username,$password]);

if ($success) {
session_start();
$message = "User logged in successfully!";
$_SESSION["username"] = $username;

header('location:home.php');
       
}else{

$message = " please enter valid username and password !";

}

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>My Stock App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
    <div style="margin-top:50px;">
        <h2> LOGIN FORM </h2>
        <?php if(isset($message)){echo "<p style=\"background-color:tomato;padding:10px;
        border-radius:5px;color:white;\">{$message}</p>"; }; ?>
        <form method="post" action="index.php" style="margin-top:20px;">
            <label for="userid">User Name</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password</label>
            <input type='password' name='password' id="password" required>
            <input type="submit" value="Login" id="submit" name="submit">
        </form><br>
        <p> Please enter valid Username and Password to login !</p>
    </div>
</body>
</html>