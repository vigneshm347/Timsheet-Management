<?php
include 'include\db_connection.php';
$subjects = array();
$sql = "select subject_name from cis_subjects"; 
$res=mysql_query($sql);
if(mysql_num_rows($res) > 0)
{
	while ($s = mysql_fetch_assoc($res)) {
		$subjects[] = $s;
	}
	echo json_encode($subjects);
}
else
{
	echo "error";
}
?>