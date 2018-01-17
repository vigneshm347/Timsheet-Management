<?php
session_start();
if($_SESSION['userid']){
  $userid = $_SESSION['userid'];
  include 'include\db_connection.php';
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
</html>
<body style="background-color: #ecf0f1;">

<div class="topnav" id="myTopnav">
  <a href="home.php">Profile</a>
  <a href="newtimesheet.php">New Timesheet</a>
  <a href="#" class="active">Edit Timesheet</a>
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div><br><br><br>
	<div class="container">
    <h3> Choose a date to edit the corresponding timesheet ! !</h3> <br>
      <div>
        <form id="update-form" class="form-group">
          <div class="row">
          <div class="col-lg-2 col-sm-12 col-md-2 col-xl-2">
            <label for="editSheetDate">Choose date</label>
          <input type="date" class="form-control" id="editSheetDate" name="editTSDate" onchange="getSheetData();">
        </div>
        </div>
        </form>
        <div id="resultTable">
        </div><br>
        <div id="editChanges" style="display:none; margin-left:20%;">
        <h3>Edit Information for the above date:</h3>
            <form class="form-group" method = 'post' action='edittimesheet.php'>
              <div class="row">
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <label for="uftime">Attended From</label>
                  <input type="time" class="form-control" id="uftime" name="ftime"><br>
                      <input type="hidden" id="real-date" name="hidden-date">
                </div>
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <label for="uttime">Attended Till</label>
                  <input type="time" class="form-control" id="uttime" name = "ttime"><br>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <select type="" class="form-control" id="csubject" required name="csubname">
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
                  </select><br>
                </div>
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <select class="form-control" id="cprofessor" required name="cprofname">
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
                  </select><br>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <label for = "cclasstype">Choose Class Type</label>
                    <select id="cclasstype" class="form-control" name="cctype" required>
                      <option value="">Select class</option>
                      <option value="Lab">Lab</option>
                      <option value="In-class">In-class</option>
                    </select>
                </div>
              </div><br>
              <div class="row">
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <label for="cremark1">Important Remarks about class</label>
                  <textarea class="form-control" id="cremark1" name="cclassr" placeholder="Not more than 150 characters" maxlength="150"></textarea>
                </div>
                <div class="col-lg-4 col-sm-12 col-xl-4 col-md-4">
                  <label for="cremark2">Other remarks</label>
                  <textarea class="form-control" id="cremark2" name="cotherr" placeholder="Not more than 150 characters" maxlength="150"></textarea>
                </div>
              </div><br>

              <div class="row">
                <div class="col-lg-2 col-sm-12 col-xl-2 col-md-2" style="margin-right:100px;">
                  <input type="submit" class="btn btn-primary" value="Submit Changes ">
                </div>
                <div class="col-lg-2 col-sm-12 col-xl-2 col-md-2" style="margin-left:100px;">
                    <input type="button" class="btn btn-danger" value="Cancel Changes" onclick="hideForm()">
              </div>
            </div>

            </form>
        </div>
      </div>
	</div>

  <?php
  if(isset($_POST['ftime']) && isset($_POST['hidden-date']))
  {
  include('include/db_connection.php');
  $ts_tfrom=$_POST['ftime'];
  $ts_tto=$_POST['ttime'];
  $ts_realdate = $_POST['hidden-date'];
  $ts_sub=$_POST['csubname'];
  $ts_staff=$_POST['cprofname'];
  $ts_ctype=$_POST['cctype'];
  $ts_remark=$_POST['cclassr'];
  $ts_details=$_POST['cotherr'];
  $ts_query = "update student_entry SET FromTime='$ts_tfrom', ToTime='$ts_tto', SubName='$ts_sub',
              StaffName='$ts_staff', ClassType = '$ts_ctype', Remarks = '$ts_remark', Others = '$ts_details'
              where ADate = '$ts_realdate' and User_ID = '$userid'";
  $ts_res=mysql_query($ts_query);
  if($ts_res)
  {
  echo "<script>alert('Updated Successfully');</script>";
  //header("Location:index.php");
  }
  else
  {
  echo "<script>alert('Update failed');</script>";
  }
}

  ?>
<script type="text/javascript">
function getSheetData(){
  var date = $("#editSheetDate").val();
  console.log(date);
  $.ajax({
    url:'getTimeSheet.php',
    method: 'post',
    dataType: 'JSON',
    data: "editDate="+date,
    success: function(response){
      var len = response.length;
      console.log(len);
     for(var i=0; i<len; i++){
         var from = response[i].from;
         var to = response[i].to;
         var realDate = response[i].date;
         var subject = response[i].subject;
         var instructor = response[i].instructor;
         var _class = response[i].class;
         var remarks = response[i].remarks;
         var others = response[i].others;
         var string = "<table class='table table-striped' id='mytable'>"+
             "<thead>"+
               "<tr><th>Attended from</th><th>Attended To</th>"+
                 "<th>Subject Name</th><th>Instructor Name</th>"+
                 "<th>Class Name</th><th>Remarks</th><th>Other Remarks</th><th>Action</th></tr></thead>"+
             "<tbody><tr><td>"+from+"</td>"+
             "<td id='to'>"+to+"</td>"+
             "<td id='sub'>"+subject+"</td>"+
             "<td>"+instructor+"</td>"+
             "<td>"+_class+"</td>"+
             "<td>"+remarks+"</td>"+
             "<td id='othr'>"+others+"</td>"+
             "<td><input type='radio' id='action-radio' onclick='doAction();'></td>"+
               "</tr></tbody></table>";

    }

    $("#resultTable").append(string);
    $("#real-date").val(realDate);
  },
    error: function(){
      console.log("nope!")
    }
  });

}
function doAction()
{
  $("#editChanges").fadeIn("slow");
  $('#mytable tr').each(function() {
    if (!this.rowIndex) return; // skip first row
    var from = this.cells[0].innerHTML;
    var to = this.cells[1].innerHTML;
    var subject = this.cells[2].innerHTML;
    var ins = this.cells[3].innerHTML;
    var type = this.cells[4].innerHTML;
    var cremark1 = this.cells[5].innerHTML;
    var cremark2 = this.cells[6].innerHTML;
    $("#uftime").val(from);
    $("#uttime").val(to);
    $("#csubject").val(subject);
    $("#cprofessor").val(ins);
    $("#cremark1").val(cremark1);
    $("#cremark2").val(cremark2);
});

}
function hideForm()
{
  $("#editChanges").fadeOut("slow");
  $("#action-radio").prop('checked', false);
}

</script>

</body>
