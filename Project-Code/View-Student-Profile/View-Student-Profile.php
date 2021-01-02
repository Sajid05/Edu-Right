<?php

    $db = new mysqli("localhost","root","","edu_right");

    if ($db -> connect_errno) {
      echo "Failed to connect to MySQL: " . $db -> connect_error;
      exit();
    }
    session_start();

    if($_SESSION['Total']==0)
      header("location: ../Sponsor-Profile/Sponsor-Profile.php");

    $email = $_SESSION['login_user'];


    $sql = "SELECT Student_Email FROM transaction WHERE Sponsor_Email = '$email'";
    $result = mysqli_query($db,$sql);
    $i = -1;


    while($row = mysqli_fetch_array($result))
    {
      $i++;
      if($i==$_SESSION['Current_row'])break;

    }

      $student_email = $row['Student_Email'];

      $sql2 = "SELECT * FROM Student WHERE Email = '$student_email'";
      $result2 = mysqli_query($db,$sql2);
      $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);

      $student_fullname = $row2['Full_Name'];
      $student_username = $row2["Username"];
      $student_mobileno = $row2["Mobile_No"];
      $student_dob = $row2["DOB"];
      $student_address = $row2["Address"];
      $student_school = $row2["School"];
      $student_standard = $row2["Standard"];
      $student_hobby = $row2["Hobby"];
      $student_profilepic = $row2["Profile_Picture"];
      $student_result = $row2["Result"];


    if(isset($_POST['previous'])) {

      if($_SESSION["Current_row"]>0){
        $_SESSION["Current_row"] = $_SESSION["Current_row"]-1;
        header("location: ./View-Student-Profile.php");

      }
      //less than 0 show korte hobe

    }
    if(isset($_POST['next'])) {

        if($_SESSION["Current_row"] == $_SESSION['Total']-1) {

        }
        else {
          $_SESSION["Current_row"] = $_SESSION["Current_row"]+1;
          header("location: ./View-Student-Profile.php");
        }

    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Sponsored Student Profile</title>
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

.login100-form-btn{
  background-color: #f55858;
  border-color: #f55858;
}

.login100-form-btn: hover{
    background-color: #f55858;
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
              <li class="breadcrumb-item"><a href="../Home-Page.php#about2">Sponsorship</a></li>
               <li class="breadcrumb-item"><a href="../Sponsor-Profile/Sponsor-Profile.php">Sponsor Profile</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Sponsored Student</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->

          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body profile">
                  <div class="d-flex flex-column align-items-center text-center">
                    <br> <br><br> <br><br><br><br>
                    <?php


                    if(!empty($student_profilepic)){
                     echo '<img src="data:image/jpeg;base64,'.$stuent_profilepic .'" alt="Admin" class="rounded-circle" height="150" width="150"/>';
                    }

                    else
                    {
                      echo '<img src = "Default-Avatar.png" alt = "" class="rounded-circle" height="150" width="150">';
                    }



                    ?>
                    <div class="mt-3">
                      <?php

                         echo '<h4>'.$student_username.'</h4> <br><br>';

                      ?>
                      <p class="text-secondary mb-1"><text style="color:black;">Student of Class 5</text></p>
                      <p class="text-muted font-size-sm"><text style="color:black;">Feni Sadar</text></p><br><br><br><br><br>
                    </div>
                    <form method="post">
                      <div class="container-login100-form-btn">

                          <button class="login100-form-btn" style="float: left; width: 100px; height: 50px; margin-left: 15px; margin-bottom: 15px; border-radius: 22px;" name="previous">
                           Previous
                          </button>

                          <button class="login100-form-btn" style="float: right;width: 100px;height: 50px;margin-right: 15px; margin-bottom: 15px; border-radius: 22px;" name="next">
                           Next
                          </button>

                      </div>
                    </form>
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
                      <?php echo $student_fullname; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_username; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_email; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Mobile No</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_mobileno; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Date of Birth</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_dob; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_address; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">School</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_school; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Standard</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <?php echo $student_standard; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Hobby</h6>
                    </div>
                      <div class="col-sm-9 text-secondary">
                          <?php echo $student_hobby; ?>
                      </div>
                    </div>
                  <hr>

                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Result</h6>
                    </div>
                      <div class="col-sm-9 text-secondary">
                        <?php


                        if(!empty($student_result)){
                         echo '<img src="data:image/jpeg;base64,'.$student_result .'" alt="Admin" class="rounded-circle" height="150" width="150"/>';
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
