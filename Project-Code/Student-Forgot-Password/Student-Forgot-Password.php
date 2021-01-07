<?php

		$error = NULL;
		$db = new mysqli("localhost","root","","edu_right");

		if ($db -> connect_errno) {
			echo "Failed to connect to MySQL: " . $db -> connect_error;
			exit();
		}
		session_start();

		if($_SERVER["REQUEST_METHOD"] == "POST") {


			 $email = mysqli_real_escape_string($db,$_POST['email']);


			 $sql = "SELECT Email FROM student WHERE Email = '$email'";
			 $result = mysqli_query($db,$sql);
			 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

			 $count = mysqli_num_rows($result);

			 if($count == 1) {

			 	//Registration


			 		$to = $email;
 				 	$subject = "Forgot Password";
 				 	$messege = "<a href='http://www.edu-right.com/edu-right/project-code/Student-Forgot-Password/Student-Forgot-Password-Intermediate.php?email=$email'>Update your password</a>";
 				 	$headers = "From: iut.project.sad@gmail.com \r\n";
 				 	$headers .= "MIME-Version: 1.0" . "\r\n";
 				 	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

 				 	mail($to,$subject,$messege,$headers);

					//$_SESSION['login_user'] = $email;

        			header("location: ../Home-Page.php");




			 }else {

					$error = "Invalid Email";
			 }
		}

?>






<!DOCTYPE html>
<html lang="en">
<head>
	<title>Forgot Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100" >
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="" method="POST">

					<?php if($error!=NULL): ?>
						<div class="alert alert-danger">
							<center>Your email is invalid</center>
						</div>
						<br>
					<?php endif; ?>


					<span class="login100-form-title p-b-34 p-t-27">
							Forgot Password?
					</span><br>

					<div class="wrap-input100 validate-input" data-validate="Email is required">
						<span class="label-input100"></span>
						<input class="input100" type="text" name="email" placeholder="Provide your email here">
						<span class="focus-input100"></span>
					</div>



					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>

							<button class="login100-form-btn">
									Send Recovery Options
							</button>

						</div>
					</div>

				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
