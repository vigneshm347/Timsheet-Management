<?php
include 'include\db_connection.php';
session_start();
  $userid = $_SESSION['userid'];
$date = $_POST['editDate'];
$return_arr = array();
$sql = "select FromTime, ToTime, ADate, SubName, StaffName, ClassType, Remarks, Others from
student_entry where User_ID = '$userid'  and ADate = '$date'";
$res = mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
  while ($row = mysql_fetch_assoc($res)) {
    $ftime = $row['FromTime'];
   $ttime = $row['ToTime'];
   $date = $row['ADate'];
   $subject = $row['SubName'];
   $staff = $row['StaffName'];
   $class = $row['ClassType'];
   $remarks = $row['Remarks'];
   $others = $row['Others'];
    $return_arr[] = array("from" => $ftime,
                    "to" => $ttime,
                    "date" => $date,
                    "subject"=>$subject,
                    "instructor" => $staff,
                    "class" => $class,
                    "remarks" => $remarks,
                    "others" => $others

                  );}
    echo json_encode($return_arr);
}

 ?>
