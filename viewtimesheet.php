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
  <a href="instructor_dashboard.php">Profile</a>
  <a href="#" class="active">View Timesheet</a>
  <a href="logout.php">Logout</a>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div><br><br><br>
	<div class="container">
    <h3>Enter Student Michigan ID</h3> <br>
      <div>
        <form id="update-form" class="form-group" autocomplete="off">
          <div class="row">
          <div class="col-lg-2 col-sm-12 col-md-2 col-xl-2">
            <label for="studid">Michigan ID</label>
          <input type="text" class="form-control" id="studid" required name="studid"><br>
          <button type="submit" onclick="getStudData();" id="submit-btn" class="form-control btn btn-info">Get Details</button>
        </div>
        </div>
        </form>
        <div id="resultTable">
          <h3 id="Studentid"> </h3><br>
        </div><br>
      </div>
	</div>
<script type="text/javascript">
var string ="";
function getStudData(){
  var id = $("#studid").val();
  string = "<table class='table table-condensed'>"+
      "<thead>"+
        "<tr><th>Attended from</th><th>Attended To</th><th>Date (YYYY/MM/DD)</th>"+
          "<th>Subject Name</th><th>Instructor Name</th>"+
          "<th>Class Name</th><th>Remarks</th><th>Other Remarks</th></tr></thead>";
  $.ajax({
    url:'getStudentSheets.php',
    method: 'post',
    dataType: 'JSON',
    data: "id="+id,
    success: function(response){
      var len = response.length;
      console.log(response);

     for(var i=0; i<len; i++){
         var from = response[i].from;
         var to = response[i].to;
         var realDate = response[i].date;
         var subject = response[i].subject;
         var instructor = response[i].instructor;
         var _class = response[i].class;
         var remarks = response[i].remarks;
         var others = response[i].others;
         string = string +
             "<tbody><tr><td>"+from+"</td>"+
             "<td>"+to+"</td>"+
             "<td>"+realDate+"</td>"+
             "<td>"+subject+"</td>"+
             "<td>"+instructor+"</td>"+
             "<td>"+_class+"</td>"+
             "<td>"+remarks+"</td>"+
             "<td>"+others+"</td>";
             if(i ==(len-1) ){
$("#resultTable").html("");
$("#resultTable").append(string);
var id = document.getElementById("studid").value;
console.log("static"+id);
document.getElementById("Studentid").innerHTML = "Time sheet filled by "+id;
$("#studid").val("");
}
           }
},
    error: function(){
      console.log("nope!")
    }
  });

}
$('#submit-btn').click(function(e){
    e.preventDefault();
    // Code goes here
});
</script>

</body>
