<?php

		session_start();

		
		$email = $_GET['email'];
		$_SESSION['login_user'] = $email;

		header("location: ../Update-Sponsor-Profile/Update-Sponsor-Profile.php");
?>
