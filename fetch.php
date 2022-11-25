<?php

// Create Connection
$con = mysqli_connect("localhost", "root", "", "dbnskhost");

// Check connection
if(!$con) {
    die("Connection Falied" . mysqli_connect_error());
}
//echo "Connected Successfully";
// Src: https://www.youtube.com/watch?v=ygzfmRjVaV0

if(isset($_POST['request'])) {
    $request = $_POST['request'];

    //$q = "SELECT * FROM tbl_video WHERE name"
}

?>