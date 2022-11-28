<?php

require('./dbconfig.php');

// If Login button is pressed
if(isset($_POST['submit'])) {

    $un = $_POST['un'];
    $password = $_POST['password'];

    $errors = array();

    // Code to Check Username
    //$unQuery = "SELECT * FROM tbl_admin WHERE name='$un'";
    //$unQ = mysqli_query($con, $unQuery);

    // If username is empty
    if(empty($un)) {
        $errors['u'] = "Username is Required.";
    }

    if(empty($password)) {
        $errors['p'] = "Password is Required."; 
    }

    if(count($errors) == 0) {
        $query = "SELECT * FROM tbl_admin WHERE name='$un' AND pass='$password'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if($row['name'] == $un && $row['pass'] == $password) {
                header("Location: dashboard.php?Username password matched"); // redirect to the dashboard page if UN and PASS successfull
                //exit();
            } else {
                header("Location: index.php"); //Stay on the same page
                //exit();
            }
        } else {
            header("Location: index.php?error=Username does not exist in db");
            //exit();
        }
    } else {
        header("Location: index.php?error=username and password empty");
        //exit();   
    }
}

?>

<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE-Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PHP Login Page</title>
  <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
  <!-- Bootstrap -->
  <link href="./css/bootstrap.min.css" rel="stylesheet" />
  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
  <link href="./css/login.css" rel="stylesheet" />

  <link href="./css/bootstrap.min.css" rel="stylesheet" />
  <script src="./js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="./js/bootstrap.min.js"></script>  
 </head>
 
 <body>
	<div class="container">
		<div class="login-form">
			<?php // require_once 'templates/message.php'; ?>
			<h1 class="text-center">Login to View Videos</h1>
			<div class="form-header">
				<i class="fa fa-user"></i>
			</div>
			
			<!-- <form id="login-form" method="post" class="form-signin" role="form" action="<?php // echo $_SERVER['PHP_SELF']; ?>"> -->
			<form method="POST" class="form-signin form-horizontal" role="form"> <!-- old value: action="video_list.php"  // dashboard.php -->
				
				<h3 class="well well-sm text-center">Login To Your Account</h3>
                <div>Username: admin <br /> password: admin</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Username:</label>
					<div class="col-sm-10">
						<input name="un" id="username" type="text" class="form-control" placeholder="Username" autofocus />
                        <p class="text-danger"><?php if(isset($errors['u'])) echo $errors['u']; ?></p>
					</div>
				</div>
				 
				<div class="form-group">
					<label class="control-label col-sm-2">Password:</label>
					<div class="col-sm-10">
						<input name="password" id="password" type="password" class="form-control" placeholder="Password" />
						<p class="text-danger"><?php if(isset($errors['p'])) echo $errors['p']; ?></p>
					</div>
				</div>

				
				<div class="text-xs-center">
				<!-- <button id="btnSubmit" name="submit" class="btn btn-block bt-login" type="submit" >Sign in</button> --> <!-- onClick="validate()" -->
				<input type="submit" id="btnSubmit" name="submit" class="btn btn-block bt-login" value="Log In" />
				
			</form>
		</div>
	</div>
	<!-- /container -->
 </body>
</html>