<?php

// Create Connection
$con = mysqli_connect("localhost", "root", "", "dbnskhost");

// Check connection
if(!$con) {
    die("Connection Failed" . mysqli_connect_error());
}
//echo "Connected Successfully";

?>