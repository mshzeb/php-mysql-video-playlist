<?php

require('./dbconfig.php');

// Src: https://www.youtube.com/watch?v=ygzfmRjVaV0

// if(isset($_POST['request'])) {
//     $request = $_POST['request'];

//     //$q = "SELECT * FROM tbl_video WHERE name"
// }

if(isset($_POST['submit'])) {
    echo "<script>alert('submit clicked')</script>";
} else {
    // Perform Query
    // The mysqli_query() function performs a query against a database.
    $qry = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

    $rs = mysqli_query($con, $qry);

    // if(mysqli_num_rows($rs) > 0) {

    // }

    // Fetch All Data
    $fetchAllData = mysqli_fetch_all($rs, MYSQLI_ASSOC);

    $vidhtml = '';
    $div = '';
    //$divVidlist = '<div class="vid" id="vidlist">';
    $divVidlist = '';


    foreach($fetchAllData as $vidData)
    {

        //$vidhtml = "<video src='uploads/$vidData[name]'.></video>";
        $divVidlist .= '<div class="vid" id="vidlist">';
        $divVidlist .= "<video src='uploads/$vidData[name]'></video>";
        //echo $vidhtml;
        $divVidlist .= '<div class="title">'.$vidData['name'].'</div>';
        $divVidlist .= '</div>';
        
    }

    //$divVidlist .= '</div>';
    
    //echo "<script>alert(".$vidhtml.")</script>";
    // echo $vidhtml;
    // echo $div;
    echo $divVidlist;

}
// // Perform Query
// // The mysqli_query() function performs a query against a database.
// $qry = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 MONTH)";

// $rs = mysqli_query($con, $qry);

// // if(mysqli_num_rows($rs) > 0) {

// // }

// // Fetch All Data
// $fetchAllData = mysqli_fetch_all($rs, MYSQLI_ASSOC);

// $vidhtml = '';
// $div = '';
// //$divVidlist = '<div class="vid" id="vidlist">';
// $divVidlist = '';


// foreach($fetchAllData as $vidData)
// {

//     //$vidhtml = "<video src='uploads/$vidData[name]'.></video>";
//     $divVidlist .= '<div class="vid" id="vidlist">';
//     $divVidlist .= "<video src='uploads/$vidData[name]'></video>";
//     //echo $vidhtml;
//     $divVidlist .= '<div class="title">'.$vidData['name'].'</div>';
//     $divVidlist .= '</div>';
    
// }

// //$divVidlist .= '</div>';
 
// //echo "<script>alert(".$vidhtml.")</script>";
// // echo $vidhtml;
// // echo $div;
// echo $divVidlist;
// //echo "<script>alert(".$vidhtml.")</script>";
 
// Close $rs connection
//mysqli_close($rs);
 
mysqli_close($con);

// **************** PHP Procedural Style Starts **********************
/*
// ***********************************************
PHP - Procedural Style
// ***********************************************

<?php 
$host = "localhost";
$dbUser = "root";
$password = "";
$database = "demo";
 
$dbConn = new mysqli($host,$dbUser,$password,$database);

if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}
 
// Perform Query
// The mysqli_query() function performs a query against a database.
$qry = "SELECT * FROM tbl_video WHERE date_created > DATE_SUB(NOW(), INTERVAL 1 HOUR)";

$rs = mysqli_query($dbConn, $qry);

// if(mysqli_num_rows($rs) > 0) {

// }

// Fetch All Data
$fetchAllData = mysqli_fetch_all($rs, MYSQLI_ASSOC);
 
$createTable = '<table>';
 
$createTable .= '<tr>';
$createTable .= '<th>First Name</th>';
$createTable .= '<th>Last Name</th>';
$createTable .= '<th>Email</th>';
$createTable .= '<th>Phone</th>';
$createTable .= '<th>City</th>';
$createTable .= '<th>Country</th>';
$createTable .= '</tr>';
 
 
foreach($fetchAllData as $customerData)
{
	$createTable .= '<tr>';
	$createTable .= '<td>'.$customerData['first_name'].'</td>';
	$createTable .= '<td>'.$customerData['last_name'].'</td>';
	$createTable .= '<td>'.$customerData['email'].'</td>';
	$createTable .= '<td>'.$customerData['phone'].'</td>';
	$createTable .= '<td>'.$customerData['city'].'</td>';
	$createTable .= '<td>'.$customerData['country'].'</td>';
	$createTable .= '</tr>';	
}
 
$createTable .= '</table>';
 
echo $createTable;
 
// Close $rs connection
mysqli_close($rs);
 
mysqli_close($dbConn);
 
?>

*/

// **************** PHP Procedural Style Ends **********************


/*
// ***********************************************
PHP - Object Oriented Style
// ***********************************************

<?php 
$host = "localhost";
$dbUser = "root";
$password = "";
$database = "demo";
 
$dbConn = new mysqli($host,$dbUser,$password,$database);
 
if($dbConn->connect_error)
{
	die("Database Connection Error, Error No.: ".$dbConn->connect_errno." | ".$dbConn->connect_error);
}
 
 
$qry = "select first_name, last_name, email, phone, city, country from customers";
 
$rs = $dbConn->query($qry);
 
$fetchAllData = $rs->fetch_all(MYSQLI_ASSOC);
 
$createTable = '<table>';
 
$createTable .= '<tr>';
$createTable .= '<th>First Name</th>';
$createTable .= '<th>Last Name</th>';
$createTable .= '<th>Email</th>';
$createTable .= '<th>Phone</th>';
$createTable .= '<th>City</th>';
$createTable .= '<th>Country</th>';
$createTable .= '</tr>';
 
 
foreach($fetchAllData as $customerData)
{
	$createTable .= '<tr>';
	$createTable .= '<td>'.$customerData['first_name'].'</td>';
	$createTable .= '<td>'.$customerData['last_name'].'</td>';
	$createTable .= '<td>'.$customerData['email'].'</td>';
	$createTable .= '<td>'.$customerData['phone'].'</td>';
	$createTable .= '<td>'.$customerData['city'].'</td>';
	$createTable .= '<td>'.$customerData['country'].'</td>';
	$createTable .= '</tr>';	
}
 
$createTable .= '</table>';
 
echo $createTable;
 
$rs->close();
 
$dbConn->close();
 
?>

*/

?>