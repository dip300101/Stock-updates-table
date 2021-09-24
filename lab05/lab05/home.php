<?php
/* 
I certify all the work below is my own.
@author = Deep Patel
@ID = 000818379
@Desc = css file to decorate

*/
session_start();
include "connect.php";


if (isset($_POST["submit"])) {

        $stockname = $_POST['stockname'];
        $price = $_POST['stockprice'];
        $time = $_POST['stocktime'];

        filter_input(INPUT_POST, $stockname, FILTER_SANITIZE_SPECIAL_CHARS);
        filter_input(INPUT_POST, $price, FILTER_VALIDATE_FLOAT);
        filter_input(INPUT_POST, $time, FILTER_SANITIZE_STRING);
        
		date_default_timezone_set("America/Toronto");
		$today = date("H:i:s"); 
		$stocktime = $time . " " . $today;
		$command = "INSERT into stocks (stock_name, stock_price, update_dt) VALUES (?, ?, ?)";
		$stmt = $dbh->prepare($command);
		$success = $stmt->execute([$stockname, $price, $stocktime]);

		if ($success) {
			$msg =  "<p> Stock added succesfully ! </p>";
		} else {
			echo "<p> couldn't add </p>";
		}

}


?>
<!DOCTYPE html>
<html>
<head>
    <title>TODO supply a title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/
    jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>

	<?php
    if (isset($_SESSION["username"])) {
    
    ?>
    <div style="padding:20px;display:flex;">
    <h4> You are logged In as : <?php echo $_SESSION["username"]; ?> &nbsp</h4>
    <a href="logout.php" style="color:red;">Logout</a>
    </diV>
    
    <?php if(isset($msg)){echo "<p style=\"background-color:#4CAF50;padding:10px;
        border-radius:5px;color:white;\">{$msg}</p>"; }; ?>
    <div id="mydiv">
        <form id="myForm" method="post" action="home.php" style="padding:10px;">
            <input  type="text" name="stockname" id="stockname" placeholder="Stock Name">
            <input  type="text" name="stockprice" id="stockprice" placeholder="00.00">
            <input  type="date" name="stocktime" id="stocktime"><br><br>
            <input  class="add" type="submit" value="Add" name="submit" id="Add" />
        </form>
    </div>

    <?php 

    $query = $dbh->prepare("SELECT * FROM stocks;");
    $query->execute();
    
    echo "<table>";
    echo "<tr><th>Stock Title </th><th>Stock Price</th><th>Date and Time</th></tr>";
    foreach ($query->fetchAll() as $key => $value) {
    ?>

    <tr><td><?php echo $value['stock_name'];?></td><td><?php echo $value['stock_price'];?></td>
    <td><?php echo $value['update_dt'];?></td></tr>

    <?php
    }
    echo "</table>";

    } 
    
    
    ?>

    <script type="text/javascript" src="js/script.js"></script>

</body>
</html>