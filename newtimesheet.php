<?php
session_start();
if($_SESSION['userid']){
  include 'include\db_connection.php';
  $userid = $_SESSION['userid'];
}
else {
  header("Location: index.php");
}
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
  <script src="js/date.js"></script>
</html>
<body style="background-color: #ecf0f1;">

<div class="topnav" id="myTopnav">
  <a href="home.php">Profile</a>
  <a href="#news" class="active">New Timesheet</a>
  <a href="edittimesheet.php">Edit Timesheet</a>
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div><br><br><br>
	<div class="container">
    <form class="form-group" method="post" action="newtimesheet.php">
		<div class="row">
			<div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
					<label for = "intime">Time-in</label>
					<input type="time" class="form-control" id="intime" required name="tfrom">
					</div>
					<div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
           <label for = "totime">Time-out</label>
          <input type="time" class="form-control" id="totime" onblur="checkTime(this.value);" required name="tto">
          </div>
					<div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
          <label for = "date">Class Date</label>
          <input type="date" class="form-control" required id="date"name="sdate" onblur="checkDate(this.value);">
          </div>
        </div><br>
        <div class="row">
      <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
          <label for = "subject">Subject Name</label>
          <select type="" class="form-control" id="subject" required name="subname">
            <option value ="" >Select Subject</option>
              <!-- php code -->
              <?php
              $sql = "select subject_name from cis_subjects";
              $res=mysql_query($sql);
              if(mysql_num_rows($res) > 0)
              {
                while ($s = mysql_fetch_assoc($res)) {
                ?>
                  <option value="<?php echo $s["subject_name"]; ?>"><?php echo $s["subject_name"]; ?></option>
                <?php }} ?>
              <!-- php code ends -->
          </select>
          </div>
          <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
            <label for = "professor">Instructor Name</label>
            <select class="form-control" id="professor" required name="profname">
              <option value ="" >Select Instructor</option>
                <!-- php code -->
                <?php
                $sql = "select professor_name from professor";
                $res=mysql_query($sql);
                if(mysql_num_rows($res) > 0)
                {
                  while ($s = mysql_fetch_assoc($res)) {
                  ?>
                    <option value="<?php echo $s["professor_name"]; ?>"><?php echo $s["professor_name"]; ?></option>
                  <?php }} ?>

                <!-- php code ends -->
            </select>
          </div>
          <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
            <label for = "classtype">Choose Class Type</label>
              <select id="classtype" class="form-control" name="ctype" required>
                <option value="">Select class</option>
                <option value="lab">Lab</option>
                <option value="inclass">inclass</option>
              </select>
              </div>
        </div><br>
          <div class="row">
            <div class="col-lg-12 col-sm-12 col-xl-12 col-md-12">
              <label for="remark1">Important Remarks about class</label>
              <textarea class="form-control" id="remark1" name="classr" placeholder="Not more than 150 characters" maxlength="150"></textarea>
            </div>
          </div><br>
            <div class="row">
              <div class="col-lg-12 col-sm-12 col-xl-12 col-md-12">
                <label for="remark2">Other remarks</label>
                <textarea class="form-control" id="remark2" name="otherr" placeholder="Not more than 150 characters" maxlength="150"></textarea>
              </div>
              </div>
              <br>
              <div class="row">
                <div class="col-lg-12 col-sm-12 col-xl-12 col-md-12">
                  <button class="btn btn-info" id="btn-submit">Submit my timesheet</button>
                </div>
                </div>
				</form>
			</div>
<script type="text/javascript">
	function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
function checkTime(to_time){
  var from_time = $("#intime").val();
to_time = to_time;
t = to_time.split(':');
f = from_time.split(':');
if(f[0] > t[0])
{
  $("#intime").css("background-color", "#e74c3c");
  $("#totime").css("background-color", "#e74c3c");
  $("#btn-submit").prop("disabled", true);
}
else if (f[0] == t[0]) {
  if(f[1] >= t[1])
  {
    $("#intime").css("background-color", "#e74c3c");
    $("#totime").css("background-color", "#e74c3c");
    $("#btn-submit").prop("disabled", true);
  }
  else{
    $("#intime").css("background-color", "#fff");
    $("#totime").css("background-color", "#fff");
    $("#btn-submit").prop("disabled", false);
  }
}
else {
  {
    $("#intime").css("background-color", "#fff");
    $("#totime").css("background-color", "#fff");
    $("#btn-submit").prop("disabled", false);
  }
}
}
function checkDate(date_box){

  var selected_date = moment(date_box);
  selected_date.format("YYYY-MM-DD");
  var check_weekend =  selected_date.day();
  var today = moment();
  today.format("YYYY-MM-DD");
  var diff = selected_date.diff(today.format("YYYY-MM-DD"), 'days');
  if(diff > 0 || (check_weekend == 0)|| (check_weekend == 6))
  {
    $("#date").css("background-color", "#e74c3c");

    $("#btn-submit").prop("disabled", true);
    alert('Check date properly ! It could be a weekend or future date :(');
  }
  else{
      $("#date").css("background-color", "#fff");
      $("#btn-submit").prop("disabled", false);
  }
}
</script>
<?php
if(isset($_POST['tfrom']))
{
include('include/db_connection.php');
$ts_uid=$_SESSION['userid'];
$ts_tfrom=$_POST['tfrom'];
$ts_tto=$_POST['tto'];
$ts_dat=$_POST['sdate'];
$ts_sub=$_POST['subname'];
$ts_staff=$_POST['profname'];
$ts_ctype=$_POST['ctype'];
$ts_remark=$_POST['classr'];
$ts_details=$_POST['otherr'];
$check_query = "select ADate from student_entry where ADate = '$ts_dat' and User_ID = '$userid'";
$check_res = mysql_query($check_query);
if(mysql_num_rows($check_res) > 0)
{
  echo "<strong style='margin-left:17%; color: #e74c3c; font-size:20px;'>Time sheet already added for the date ".$ts_dat.". You can edit your timesheet if needed!</strong>";
}
else {
  $ts_query = "insert into student_entry(User_ID, FromTime, ToTime, ADate,SubName, StaffName, ClassType, Remarks, Others)
              values ($ts_uid,'$ts_tfrom', '$ts_tto', '$ts_dat', '$ts_sub', '$ts_staff' ,'$ts_ctype', '$ts_remark','$ts_details')";
  $ts_res=mysql_query($ts_query);
  if($ts_res)
  {
  echo "<p style='margin-left: 17%; color:#27ae60; font-size:20px;'><strong>Added Successfully</strong></p>";
  //header("Location:index.php");
  }
  else
  {
  echo "<p style='margin-left: 150px;'><strong>Unable to add timesheet! Please try again</strong></p>";
  }
}

}
?>
</body>
