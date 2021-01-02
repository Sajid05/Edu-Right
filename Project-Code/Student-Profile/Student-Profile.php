<?php

		$db = new mysqli("localhost","root","","edu_right");

		if ($db -> connect_errno) {
  		echo "Failed to connect to MySQL: " . $db -> connect_error;
  		exit();
		}
  	session_start();

		if(!isset($_SESSION['login_user']))
			header("Location: ../Home-Page.php");  

    $email = $_SESSION['login_user'];




    $sql = "SELECT * FROM student WHERE Email = '$email'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $fullname = $row['Full_Name'];
    $myusername = $row["Username"];
    $mobileno = $row["Mobile_No"];
    $dob = $row["DOB"];
    $address = $row["Address"];
    $school = $row["School"];
    $standard = $row["Standard"];
    $hobby = $row["Hobby"];
    $profilepic = $row["Profile_Picture"];
    $result = $row["Result"];

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

    </style>
</head>
<body>
<div class="container">
    <div class="main-body">

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="../Home-Page.php">Home</a></li>
              <li class="breadcrumb-item"><a href="../Home-Page.php">Scholarship</a></li>
              <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body profile">
                  <div class="d-flex flex-column align-items-center text-center">
                    <br> <br><br>
                    <?php


                    if(!empty($profilepic)){
                    echo '<img src="data:image/jpeg;base64,'. $profilepic.'" alt="Admin" class="rounded-circle" height="150" width="150"/>';
                  }

                    else
                    {
                      echo '<img src = "Default-Avatar.png" alt = "" class="rounded-circle" height="150" width="150">';
                    }



                    ?>
                    <div class="mt-3">
                      <?php

                         echo '<h4>'.$myusername.'</h4> <br><br>';

                      ?>
                      <p class="text-secondary mb-1"><text style="color:black;">Student of Class 5</text></p>
                      <p class="text-muted font-size-sm"><text style="color:black;">Feni Sadar</text></p><br><br>
                      <a href="../Update-Student-Profile/Update-Student-Profile.php"<button class="btn btn-primary">Update Profile</button></a> <br> <br>
                      <a href= "../View-Sponsor-Profile/View-Sponsor-Profile.php"><button class="btn btn-primary">View Sponsor's Profile</button></a> <br> <br>
                      <a href="../Home-Page.php"><button class="btn btn-outline-primary">Log out</button></a> <br> <br>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $fullname; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $myusername; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $email; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile No</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo '0'.$mobileno; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $dob; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $address; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">School</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $school; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Standard</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $standard; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Hobby</h6>
                    </div>
                      <div class="col-sm-9 text-secondary">
                          <?php echo $hobby; ?>
                      </div>
                    </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Result</h6>
                    </div>
                      <div class="col-sm-9 text-secondary">
                        <?php


                        if(!empty($result)){
                        echo '<img src="data:image/jpeg;base64,'.$result.'" alt="Admin" height="300" width="450"/>';
                      }

                        else
                        {
                          echo 'Result not added yet';
                        }



                        ?>
                      </div>
                    </div>
                  <hr>

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
