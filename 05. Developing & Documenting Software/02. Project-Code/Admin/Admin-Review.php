<?php

		$db = new mysqli("localhost","root","","edu_right");

		if ($db -> connect_errno) {
  		echo "Failed to connect to MySQL: " . $db -> connect_error;
  		exit();
		}
  	session_start();

		if(!isset($_SESSION['login_user']))
			header("Location: ../Home-Page.php");

		if($_SESSION['Total']==0) {
			header("location: ./admin.php");
		}


    $current_row = $_SESSION["Current_row"];

		while(1){
			$sql = "SELECT * FROM pre_student LIMIT $current_row,1";
	    $result = mysqli_query($db,$sql);
	    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

			if($row['Vkey']=='0')break;
			if($current_row == $_SESSION['Total']-1)
				header("location: ./admin.php");

			$current_row = $current_row+1;
		}


    $fullname = $row['Full_Name'];
    $myusername = $row["Username"];
    $email = $row["Email"];
    $mobileno = $row["Mobile_No"];
    $mypassword = $row["Password"];
    $application = $row["Eligibility"];


		if(isset($_POST['logout'])) {
			unset($_SESSION['login_user']);
			header("location: ../home-page.php");
		}


    if(isset($_POST['previous'])) {

      if($_SESSION["Current_row"]>0){
        $_SESSION["Current_row"] = $_SESSION["Current_row"]-1;
        header("location: ./admin-review.php");

      }

    }
    if(isset($_POST['reject'])){

      $sql = "DELETE FROM pre_student WHERE Email = '$email'";
      $result = mysqli_query($db,$sql);

			$_SESSION['Total'] = $_SESSION['Total']-1;

			if($_SESSION['Total'] == 0) {
				header("location: ./admin.php");

			}
			else if($_SESSION['Total'] == $_SESSION['Current_row']) {
				$_SESSION["Current_row"] = $_SESSION["Current_row"]-1;
				header("location: ./admin-review.php");

			}
			else
				header("location: ./admin-review.php");

    }
    if(isset($_POST['approve'])) {

        //inserting in Student table
        $sql = "INSERT INTO Student (Full_Name, Username, Email, Mobile_No, Password) VALUES ('$fullname', '$myusername', '$email', '$mobileno', '$mypassword')";
        $result = mysqli_query($db,$sql);





				$sql = "SELECT COUNT(*) FROM Pending";
				$result = mysqli_query($db,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$c = $row['COUNT(*)'];

				if($c>0) {

					//SELECT Email FROM Request LIMIT 0,1
					$sql = "SELECT Sponsor_email FROM Pending LIMIT 0,1";
					$result = mysqli_query($db,$sql);
					$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

					$sponsor_email = $row['Sponsor_email'];

					//$sql = "DELETE FROM Pending where Sponsor_email = '$sponsor_email'";
					$sql = "DELETE FROM Pending where Sponsor_email = '$sponsor_email' LIMIT 1";
					$result = mysqli_query($db,$sql);

					date_default_timezone_set('Asia/Dhaka');
					$date = date('Y-m-d H:i:s');
					$sql = "INSERT INTO Transaction (Student_Email, Sponsor_Email, Trx_Date) VALUES ('$email', '$sponsor_email', '$date')";
					$result = mysqli_query($db,$sql);

				}
				else {
					//inserting in Review Table
	        $sql = "INSERT INTO Request (Email) VALUES ('$email')";
	        $result = mysqli_query($db,$sql);
				}










				//delete from pre_student table
        $sql = "DELETE FROM pre_student WHERE Email = '$email'";
        $result = mysqli_query($db,$sql);

				$_SESSION['Total'] = $_SESSION['Total']-1;

				if($_SESSION['Total'] == 0) {
					header("location: ./admin.php");

				}
				else if($_SESSION['Total'] == $_SESSION['Current_row']) {
					$_SESSION["Current_row"] = $_SESSION["Current_row"]-1;
					header("location: ./admin-review.php");
				}
				else {
					header("location: ./admin-review.php");
				}

    }
    if(isset($_POST['next'])) {

				if($_SESSION["Current_row"] == $_SESSION['Total']-1) {

        }
        else {
        	$_SESSION["Current_row"] = $_SESSION["Current_row"]+1;
        	header("location: ./admin-review.php");
				}
    }

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    	body{
    margin-top:20px;
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: 17px;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    adding: 1rem;
    border-radius: 17px;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
    border-radius: 17px;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}


.btn-primary {
  background-color: #f55858;
  border-color: #f55858;
}

.btn-outline-primary {
  background-color: #f55858;
  border-color: #f55858;
  color: white;
}

.profile{

  background-image: linear-gradient(to right top, #8c7eeb, #4594f5, #00a5ef, #00b0dd, #00b8c7, #00b6c5, #00b4c4, #00b2c2, #00a6d1, #3397d7, #6984d0, #926ebb);

}

.mb-3{
  background: #9152f8;
  background: -webkit-linear-gradient(top, #7579ff, #b224ef);
  background: -o-linear-gradient(top, #7579ff, #b224ef);
  background: -moz-linear-gradient(top, #7579ff, #b224ef);
  background: linear-gradient(top, #7579ff, #b224ef);

  font-size: 20px;
}

.mb-0
{
  font-size: 20px;

}

.col-sm-3{
  color:white;

}
.test{
  background-color: black;
}

.button_test{
  margin-left: 30%;
}


.login100-form-btn
{
  /*background-color:#374366;*/
  background-color:white;
  color: purple;

}

.login100-form-btn:hover{
  background-color: transparent;
  border-color: white;
  border-width: 2.5px;
  color:white;
}


    </style>
</head>
<body>
<div class="container">
    <div class="main-body">


          <nav aria-label="breadcrumb" class="main-breadcrumb">
          <h3> Review Students </h3>
					<hr class = "test">
          </nav>



              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                     <?php echo '<span style="color:white;">'.$fullname.'</span>'; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo '<span style="color:white;">'.$myusername.'</span>'; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo '<span style="color:white;">'.$email.'</span>'; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile No</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo '<span style="color:white;">'.'0'.$mobileno.'</span>'; ?>
                    </div>
                  </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Application</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo '<span style="color:white;">'.$application.'</span>'; ?>
                    </div>
                  </div>
                  <hr>




                </div>
                    <form method="post">
                      <div class="container-login100-form-btn">

                          <button class="login100-form-btn" style="float: left; width: 100px; height: 50px; margin-left: 15px; margin-bottom: 15px; border-radius: 22px;" name="previous">
                           Previous
                          </button>

                          <button class="login100-form-btn button_test" style="width: 100px;height: 50px;margin-bottom: 15px; border-radius: 22px;" name="reject">
                            Reject
                          </button>

                          <button class="login100-form-btn" style="float: center;width: 100px;height: 50px;margin-bottom: 15px; border-radius: 22px;" name="approve">
                           Approve
                          </button>

                          <button class="login100-form-btn" style="float: right;width: 100px;height: 50px;margin-right: 15px; margin-bottom: 15px; border-radius: 22px;" name="next">
                           Next
                          </button>

                      </div>

											<div>
												<button class="login100-form-btn" style="float: left; width: 100px; height: 50px; margin-bottom: 15px; margin-left:  500px; border-radius: 22px;" name="logout">
												 Logout
												</button>
											</div>

                    </form>
              </div>




        </div>
    </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
