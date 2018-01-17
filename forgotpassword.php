<?php
session_start();
 ?>
<html>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/index.js"></script>
</html>
<body>
  <div class = "col-lg-3 col-xl-3 col-xs-3 col-sm-3 side-jumbotron">
    <img class = "img-logo" src = images/logo.png alt="University Logo">
    <!--<h4 class="side-jumbotron-title">
       TIME SHEET
    </h4> -->
  </div>
  <div class="col-lg-9 col-xl-9 col-sm-9 col-xs-9">
    <div class="container">
<!-- Login form -->
    <div class="jumbotron">
        <center id='form-title'>Reset Password</center>
        <div class="login-form">
          <form class='form-group' method="get" action="forgotpassword.php">
            <div class="row">
              <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                <label class="control-label"></label>
                    <input type="text" class="form-control" placeholder="Enter Email" name="email" id="input-userid-text" required />
              </div>
            </div>
            <div class="row">
              <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                <label class="control-label"></label>
                    <input type="password" class="form-control" placeholder="Enter new password" name="password" id="input-password-text" required />
              </div>
              </div>
              <div class="row">
                <div class="col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                    <input class="btn btn-primary" type="submit" name="submit" value="Change Password"/>
                </div>
              </div><br>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<?php
include('include\db_connection.php');
if(isset($_GET['submit'])){
$ts_email=$_GET['email'];
$ts_password=md5($_GET['password']);
if(($_GET['email']!="") && ($_GET['password'] !="")){
  $check_email = "select Sno from new_user where Email = '$ts_email'";
  $check_email_res = mysql_query($check_email);
  if(mysql_num_rows($check_email_res)>0)
  {
     $sql="update new_user SET UPassword = '$ts_password' where Email = '$ts_email'";
	    $res=mysql_query($sql);
         if($res){
          		echo "<script>alert('Password Updated!')</script>";
              header("Location:index.php");
          		}
    }
              else{
                echo "
                  <script>
                    alert('Email match not found');
                  </script>
                ";
              }
        }

    }

?>
