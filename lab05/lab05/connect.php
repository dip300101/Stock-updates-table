<?php

/* 
I certify all the work below is my own.
@author = Deep Patel
@ID = 000818379
@Desc = to connect the database

*/
try{

    $dbh = new PDO("mysql:host=csunix.mohawkcollege.ca;dbname=000818379","000818379","20010130");

}catch(PDOException $e){
	exit('Database error.'.$e->getMessage());
}

?>
