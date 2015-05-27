<?php
include "db.php";
if($_REQUEST['userid'])
{
$message = $_REQUEST['message'];
$message = mysql_real_escape_string($message);
$email = $_REQUEST['email'];
$userid = $_REQUEST['userid'];
$q1 = "insert into bounces (userid,email,bouncedate,bounceerror) values ('".$userid."','".$email."',NOW(),'".$message."')";
$r1 = mysql_query($q1);
$q2 = "select * from bounces where userid='".$userid."' or email='".$email."'";
$r2 = mysql_query($q2);
$rows2 = mysql_num_rows($r2);
if ($rows2 >= $bouncesmax)
	{
	$q2 = "update members set vacation=1, vacation_date = '".time()."' where userid='".$userid."'";
	$r2 = mysql_query($q2);
	}
}
$q3 = "delete from bounces where bouncedate<='".(time()-7*24*60*60)."'";
$r3 = mysql_query($q3);
exit;
?> 