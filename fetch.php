<?php

// Create Connection
$con = mysqli_connect("localhost", "root", "", "dbnskhost");

// Check connection
if(!$con) {
    die("Connection Falied" . mysqli_connect_error());
}
//echo "Connected Successfully";

if(isset($_POST['request'])) {
    $request = $_POST['request'];

    //$q = "SELECT * FROM tbl_video WHERE "
}

?>