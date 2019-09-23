<?php
    $dbhost = '127.0.0.1';
	$dbuser = 'root';
	$dbpass = 'OURugbyTeam';
	$dbbase = 'OURugby';
    //$conn = new mysqli($dbhost,$dbuser,$dbpass,'OURugby');
    $conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbbase);
    if (!$conn) {
        die("Connection error: " . mysqli_connect_error());
    }
?>
