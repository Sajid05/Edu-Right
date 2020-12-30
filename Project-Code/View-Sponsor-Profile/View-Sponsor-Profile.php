<?php

    $db = new mysqli("localhost","root","","edu_right");

    if ($db -> connect_errno) {
      echo "Failed to connect to MySQL: " . $db -> connect_error;
      exit();
    }
    session_start();

    $email = $_SESSION['login_user'];




    $sql = "SELECT Sponsor_Email FROM transaction WHERE Student_Email = '$email'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $sponsor_email = $row['Sponsor_Email'];

    $sql2 = "SELECT * FROM Sponsor WHERE Email = '$sponsor_email'";
    $result2 = mysqli_query($db,$sql2);
    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

    $sponsor_fullname = $row2['Full_Name'];
    $sponsor_username = $row2["Username"];
    $sponsor_mobileno = $row2["Mobile_No"];
    $sponsor_dob = $row2["DOB"];
    $sponsor_address = $row2["Address"];
    $sponsor_education = $row2["Education"];
    $sponsor_profession = $row2["Profession"];
    $sponsor_hobby = $row2["Hobby"];
    $sponsor_profilepic = $row2["Profile_Picture"];
    

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
     <title>Sponsor Profile</title>
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
              <li class="breadcrumb-item"><a href="../Student-Profile/Student-Profile.php">Student Profile</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Sponsor's Profile</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body profile">
                  <div class="d-flex flex-column align-items-center text-center">
                    <br><br><br><br><br><br><br>
                    

                    <?php


                    if(!empty($sponsor_profilepic)){
                    echo '<img src="data:image/jpeg;base64,'. $sponsor_profilepic.'" alt="Admin" class="rounded-circle" height="150" width="150"/>';
                  }

                    else
                    {
                      echo '<img src = "Default-Avatar.png" alt = "" class="rounded-circle" height="150" width="150">';
                    }



                    ?>
                    <div class="mt-3">
                      <?php

                         echo '<h4>'.$sponsor_username.'</h4> <br><br>';

                      ?>
                    </div>
                    <br> <br><br> <br>

                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-8">
              <div class="card mb-3"  >
                
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_fullname; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_username; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_email; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile No</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_mobileno; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_dob; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_address; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Education</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_education; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Profession</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $sponsor_profession; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Hobby</h6>
                    </div>
                      <div class="col-sm-9 text-secondary">
                          <?php echo $sponsor_hobby; ?>
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
