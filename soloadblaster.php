<?php
## copyright 2014 Sabrina Markon phpsitescripts.com - SOLOADBLASTER.INFO RECEIVER FILE FOR VIRAL MAILER SCRIPT
include "db.php";
if($_REQUEST['subject'])
{
mysql_query("insert into solos set purchase='".time()."',subject='".$_REQUEST['subject']."', adbody='".$_REQUEST['adbody']."', url='".$_REQUEST['url']."', added=1, approved=1, userid='".$_REQUEST['userid']."'");
mysql_query("update members set lastlogin=NOW() where userid='".$_REQUEST['userid']."'");
}
exit;
?>