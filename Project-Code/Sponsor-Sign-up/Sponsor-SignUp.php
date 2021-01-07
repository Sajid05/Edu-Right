<?php

		$error = NULL;

		$db = new mysqli("localhost","root","","edu_right");

		if ($db -> connect_errno) {
			echo "Failed to connect to MySQL: " . $db -> connect_error;
			exit();
		}
		session_start();

		if($_SERVER["REQUEST_METHOD"] == "POST") {
			 // username and password sent from form

			 $fullname = mysqli_real_escape_string($db,$_POST['name']);
					$myusername = mysqli_real_escape_string($db,$_POST['username']);
			 $email = mysqli_real_escape_string($db,$_POST['email']);
			 $mobileno = mysqli_real_escape_string($db,$_POST['MobileNo']);
			 $mypassword = mysqli_real_escape_string($db,$_POST['pass']);

			 $sql = "SELECT Email FROM sponsor WHERE Email = '$email'";
			 $result = mysqli_query($db,$sql);
			 $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			 //$active = $row['active'];

			 $count = mysqli_num_rows($result);

			 // If result matched $myusername and $mypassword, table row must be 1 row

			 if($count == 1) {
					// session_register("myusername");
				//  $_SESSION['login_user'] = $email;

				$to = $email;
				$subject = "Email Verification";
				$messege = "BBBBBBBBBBBBBBBBBBBB";
				$headers = "From: iut.project.sad@gmail.com";

				mail($to,$subject,$messege,$headers);


				$error = "Email is already taken.";

			 }else {

					//Registration

					$query = "INSERT INTO sponsor (Email, Username, Full_Name, Mobile_No, Password)
								VALUES('$email','$myusername','$fullname', '$mobileno', '$mypassword')";

					mysqli_query($db, $query);
					$_SESSION['login_user'] = $email;
					$_SESSION['success'] = "You are now logged in";
					header('location: ../Sponsor-Profile/Sponsor-Profile.php');

			 }
		}

?>







<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sponsor Sign up</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!--===============================================================================================-->

<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
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
<body style="background-color: #999999;">

	<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/donation-charity.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">


				<form class="login100-form validate-form" action="" method="POST" >
				<!--	<span class="login100-form-title p-b-59">
						Sign Up
					</span> -->

					<?php if($error!=NULL): ?>
						<div class="alert alert-danger">
							Email is already taken
						</div>
					<?php endif; ?>

					<div>
					<h2><b>Sign Up</b></h2> <br><br>
						<p><cite>"We make a living by what we get, We make a life by what we give"</cite> <br><br> <br></p>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Name is required">
						<span class="label-input100">Full Name</span>
						<input class="input100" type="text" name="name" placeholder="Name">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Username is required">
						<span class="label-input100">Username</span>
						<input class="input100" type="text" name="username" placeholder="Username">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email addess">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid mobile number is required">
						<span class="label-input100">Mobile No</span>
						<input class="input100" type="number" name="MobileNo" placeholder="Mobile No">
						<span class="focus-input100"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Repeat Password is required">
						<span class="label-input100">Repeat Password</span>
						<input class="input100" type="password" name="repeat-pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>



					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>

							<button class="login100-form-btn">
									Sign Up
							</button>



			<!--<button class="login100-form-btn" formaction="../Sponsor-Profile/Sponsor-Profile.php">
									Sign Up
							</button>-->

						</div>

						<a href="../Sponsor-Login/Sponsor-login.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Log in
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

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
