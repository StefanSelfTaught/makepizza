<?php 
// connect to DB
	$conn = mysqli_connect('localhost', 'stefan', 'test1234', 'ninjapizza');

	//check connection
	if(!$conn){
		echo 'Connection error: ' . mysqli_connect_error(); 
	} 
?>
