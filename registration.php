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

        <!--registeration form-->
            <center id='form-title'>Sign up</center>
              <form class='form-group' method="post" action="registration.php">
                <div class="row">
                  <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                    <label class="control-label"></label>
                        <input type="text" class="form-control" placeholder="Firstname" name ="fname" id="input-firstname-text" required />
                      </div>
                  </div>
                <div class="row">
                  <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                    <label class="control-label"></label>
                        <input type="text" class="form-control" placeholder="Lastname" name ="lname" id="input-lastname-text" required />
                  </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                      <label class="control-label"></label>
                          <input type="number" class="form-control" placeholder="UM ID(8 digit numbers)" name='uid' id="input-userid-text" maxlength="8" onchange="checkID(this.value);" required />
                    </div>
                    </div>
                  <div class="row">
                    <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                      <label class="control-label"></label>
                          <input type="password" class="form-control" placeholder="Enter Password" name ='pass' id="input-password-text" required />
                    </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                        <label class="control-label"></label>
                            <select class="form-control" id="major-dropdown" onblur="checkRole(this.value)" required name = 'sem'/>
                              <option value="" id="major-dropdown-value">-Choose your term-</option>
                              <option value="Fall" id="major-dropdown-value">FALL</option>
                              <option value="Winter" id="major-dropdown-value">WINTER</option>
                              <option value="Summer" id="major-dropdown-value">SUMMER</option>
                              <option value="NA" id="major-dropdown-value">NONE(If instructor)</option>
                            </select>
                          </div>
                      </div>
                    <div class="row">
                      <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                        <label class="control-label"></label>
                            <input type="email" class="form-control" placeholder="Provide email" name ='email' id="input-email-text" required />
                          </div>
                      </div>
                     <div class="row">
                      <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                        <label class="control-label"></label>
                            <select class="form-control" id="major-dropdown" name='gender' required />
                              <option value="" id="major-dropdown-value">-Choose your gender-</option>
                              <option value="Male" id="major-dropdown-value">Male</option>
                              <option value="Female" id="role-dropdown-value">Female</option>
                            </select>
                          </div>
                      </div>
                    <div class="row">
                      <div class="form-group col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                        <label class="control-label"></label>
                        <input type="text" id="major-dropdown" placeholder="Choose term ! I will feed my self" class="form-control role" required name='usertype'>
                            <!-- <select class="form-control" id="major-dropdown" name='usertype' required />
                              <option value="" id="major-dropdown-value">-Choose your role-</option>
                              <option value="Student" id="major-dropdown-value">Student</option>
                              <option value="Faculty" id="role-dropdown-value">Instructor</option>
                            </select> -->
                          </div>
                      </div>

                      <div class="row">
                        <div class="col-lg-6 col-xl-6 col-sm-6 col-xs-12">
                            <button class="btn btn-primary"/>Register</button>
                        </div>
                      </div>
                  </form>
        <!-- end of registeration -->
      </div>
<?php
error_reporting(0);
if(isset($_POST['fname'])){
include('include/db_connection.php');
$ts_utype=$_POST['usertype'];
$ts_fname=$_POST['fname'];
$ts_lname=$_POST['lname'];
$ts_uid=$_POST['uid'];
$ts_pass=md5($_POST['pass']);
$ts_course=$_POST['course'];
$ts_email=$_POST['email'];
$ts_gender=$_POST['gender'];
$ts_sem=$_POST['sem'];
//$ts_year=$_POST['year'];
$ts_query="insert into new_user values('','$ts_utype','$ts_fname','$ts_lname','$ts_uid','$ts_pass','$ts_gender','$ts_email','$ts_sem')";
if($ts_fname!="" and $ts_uid!="" and  $ts_pass!="" and $ts_email!="" or $ts_sem=="")
{
$ts_res=mysql_query($ts_query);
//echo $ts_query;
if($ts_res)
{
echo "<p><strong>User Added Successfully</strong> proceed to <a href='index.php' style = 'color: blue;'>login</a></p>";
//header("Location:index.php");
}
else
{
echo "<strong>User Addition failure Try Again</strong>";
}
}
}
?>
<script>
  function checkID(umid)
  {
    if(umid.length == 8)
    {
      $("#input-password-text").focus();
      $("#input-userid-text").css('background-color', '#fff');
    }
    else {
      $("#input-userid-text").css('background-color', '#e74c3c');
      $("#input-userid-text").val("");
    }
  }
  $( document ).ready(function() {
               $( "#input-firstname-text").keypress(function(e) {
                   var key = e.keyCode;
                   if (key >= 48 && key <= 57) {
                       e.preventDefault();
                   }
               });
               $( "#input-lastname-text").keypress(function(e) {
                   var key = e.keyCode;
                   if (key >= 48 && key <= 57) {
                       e.preventDefault();
                   }
               });
           });
  function checkRole(term)
  {
    if(term =="NA"){
      $(".role").val("Instructor");
    }
    else{
      $(".role").val("Student");
    }
  }
  $( ".role" ).keypress(function(e) {
    if(e.keyCode){
      e.preventDefault();
    }
  });
</script>
</body>
