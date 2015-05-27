<?php
include "control.php";
include "header.php";
include "banners.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
$action = $_POST["action"];
if ($action == "send")
{
	$fromfield = $_POST['fromfield'];
	$subjectfield = $_POST['subjectfield'];
	$messagefield = $_POST['messagefield'];
	if(!$fromfield)
	{
	$error .= "<li>Please return and enter your name to appear in the from field of your message.</li>";
	}
	if(!$subjectfield)
	{
	$error .= "<li>Please return and enter the subject of your email.</li>";
	}
	if(!$messagefield)
	{
	$error .= "<li>Please return and enter a message body for your email.</li>";
	}
		if(!$error == "")
		{
		?>
		<!-- PAGE CONTENT //-->
		<table cellpadding="4" cellspacing="0" border="0" align="center">
		<tr><td align="center" colspan="2"><div class="heading">ERROR</div></td></tr>
		<tr><td colspan="2"><br>Please return to the form and correct the following problems:<br>
		<ul><?php echo $error ?></ul>
		</td></tr>
		<tr><td align="center" colspan="2"><br>
		<input type="button" value="Return To Form" onclick="javascript:history.back();" class="sendit">
		</td></tr>

		<tr><td align="center" colspan="2"><br><a href="members.php">Return To Main Page</a></td></tr>
		</table>
		<!-- END PAGE CONTENT //-->
		<?php
		include "footer.php";
		exit;
		}
	$q = "select * from members where verified=\"yes\" and referid=\"$userid\" order by email";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
		?>
		<!-- PAGE CONTENT //-->
		<table cellpadding="4" cellspacing="0" border="0" align="center">
		<tr><td align="center" colspan="2"><div class="heading">ERROR</div></td></tr>
		<tr><td colspan="2" align="center"><br>You don't have any referrals yet to email.</td></tr>
		<tr><td align="center" colspan="2"><br><a href="members.php">Return To Main Page</a></td></tr>
		</table>
		<!-- END PAGE CONTENT //-->
		<?php
		include "footer.php";
		exit;
	}
	if ($rows > 0)
	{
		$mq = "select * from members where userid=\"$userid\" and lastmailedreferrals<DATE_SUB(NOW(), INTERVAL $howoftensponsorscanmailreferrals HOUR)";
		$mr = mysql_query($mq);
		$mrows = mysql_num_rows($mr);
		if ($mrows < 1)
		{
		?>
		<!-- PAGE CONTENT //-->
		<table cellpadding="4" cellspacing="0" border="0" align="center">
		<tr><td align="center" colspan="2"><div class="heading">ERROR</div></td></tr>
		<tr><td colspan="2" align="center"><br>You emailed your downline less than <?php echo $howoftensponsorscanmailreferrals ?> hour(s) ago, at <?php echo $lastmailedreferrals ?>.</td></tr>
		<tr><td align="center" colspan="2"><br><a href="members.php">Return To Main Page</a></td></tr>
		</table>
		<!-- END PAGE CONTENT //-->
		<?php
		include "footer.php";
		exit;
		}
		if ($mrows > 0)
		{
		?>
		<!-- PAGE CONTENT //-->
		<table cellpadding="4" cellspacing="0" border="0" align="center">
		<tr><td align="center" colspan="2"><div class="heading">SENDING YOUR MESSAGE PLEASE WAIT . . .</div></td></tr>
		<?php
			while ($rowz = mysql_fetch_array($r))
				{
				$subject = "";
				$message = "";
				$from = "";
				$refid = $rowz["id"];
				$refuserid = $rowz["userid"];
				$refemail = $rowz["email"];
				$refpassword = $rowz["password"];
				$reffirstname = $rowz["firstname"];
				$reflastname = $rowz["lastname"];
				$reffullname = $reffirstname . " " . $reflastname;
				$refaffiliate_url = $domain . "/index.php?referid=" . $refuserid;

				$to = $refemail;
				$message = str_replace("~AFFILIATE_URL~",$refaffiliate_url,$messagefield);
				$message = str_replace("~USERID~",$refuserid,$message);
				$message = str_replace("~FULLNAME~",$reffullname,$message);
				$message = str_replace("~FIRSTNAME~",$reffirstname,$message);
				$message = str_replace("~LASTNAME~",$reflastname,$message);
				$message = str_replace("~EMAIL~",$refemail,$message);
				$message = stripslashes($message);
				$subject = str_replace("~AFFILIATE_URL~",$refaffiliate_url,$subjectfield);
				$subject = str_replace("~USERID~",$refuserid,$subject);
				$subject = str_replace("~FULLNAME~",$reffullname,$subject);
				$subject = str_replace("~FIRSTNAME~",$reffirstname,$subject);
				$subject = str_replace("~LASTNAME~",$reflastname,$subject);
				$subject = str_replace("~EMAIL~",$refemail,$subject);
				$subject = stripslashes($subject);
				$from = stripslashes($fromfield);

				$message = $message . "<br><br>--------------------------------------------------------------<br><br>";
				$message .= "This message was sent by your " . $sitename . " upline sponsor, $userid.";
				$message .= ".<br><br>";
				$message .= "--------------------------------------------------------------<br><br>";
				$message .= "This is a Solo Advertisement from your upline sponsor in ".$sitename.". You are receiving this because you are a double opted-in member of " . $sitename . " with userid " . $refuserid . "<br><br>";
				$message .= "You can opt out of receiving all emails from this website by deleting your account by clicking here:<br><br><a href=\"$domain/remove.php?r=".$refemail."\">".$domain."/remove.php?r=".$refemail."</a>.<br><br>";
				$message .= "Kindly allow up to 24 hours to stop receiving list mail once you delete your account.<br><br>";
				$message .= "Thank you,<br>$adminname<br>$sitename<br><br><br>";
				$message .= "Live Removal Assistance or Questions (Network): <a href='mailto:sabrina@sunshinehosting.net'>sabrina@sunshinehosting.net</a> or <a href='http://sunshinehosting.net/helpdesk'>http://sunshinehosting.net/helpdesk</a><br><br>This commercial email is sent in strict compliance with International spam laws.<br><br>Sabrina Markon, <a href='http://sunshinehosting.net'>SunshineHosting.net</a>, <a href='http://phpsitescripts.com'>PHPSiteScripts.com</a><br>Marc Tori, <a href='http://e-webs.us'>e-Webs.us</a><br>1338-41 Street, S.E.<br>Calgary, AB<br>Canada<br>T2A 1K6<br><br>";

				$headers = "From: $sitename<$bounceemail>\n";
				$headers .= "Reply-To: <$bounceemail>\n";
				$headers .= "X-Sender: <$bounceemail>\n";
				$headers .= "X-Mailer: PHP5 - PHPSiteScripts\n";
				$headers .= "X-UserID: " . $refuserid . "\n";
				$headers .= "X-Subscribed: " . $refemail . "\n";
				$headers .= "X-Domain: " . $domain . "\n";
				$headers .= "X-Priority: 3\n";
				$headers .= "Precedence: bulk\n";
				$headers .= "List-Unsubscribe: <mailto:" . $adminemail . ">, <" . $domain . "/remove.php?r=" . $refemail . ">\n";
				$headers .= "Return-Path: <" . $bounceemail . ">\nContent-type: text/html; charset=iso-8859-1\n";

				@mail ($to, $subject, $message, $headers, "-f" . $bounceemail);
				echo "<tr><td colspan=2 align=center><br>Message sent to " . $reffullname . "</td></tr>";
						} # while ($rowz = mysql_fetch_array($r))

				$saveq = "insert into downlinemails (userid,subject,adbody,sent,datesent) values ('$userid','$subject','".$adbody."','yes','".time()."')";
				$saver = mysql_query($saveq) or die(mysql_error());

				$timeq = "update members set lastmailedreferrals=NOW() where userid=\"$userid\"";
				$timer = mysql_query($timeq);
				?>
				<tr><td align="center" colspan="2"><br>SEND COMPLETED!</td></tr>
				<tr><td align="center" colspan="2"><br><a href="members.php">Return To Main Page</a></td></tr>
				</table>
				<!-- END PAGE CONTENT //-->
				<?php
				include "footer.php";
				exit;
		} # if ($mrows > 0)
	} # if ($rows > 0)
} # if ($action == "send")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">
<tr><td align="center" colspan="2"><div class="heading">Mail Your Downline</div></td></tr>

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<?php
$q = "select * from pages where name='Members Area Mail Downline Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2"><br>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
theme : "advanced",
mode : "textareas",
//save_callback : "customSave",
content_css : "./jscripts/tiny_mce/advanced.css",
extended_valid_elements : "a[href|target|name],font[face|size|color|style],span[class|align|style]",
theme_advanced_toolbar_location : "top",
plugins : "table",
theme_advanced_buttons3_add_before : "tablecontrols,separator",
//invalid_elements : "a",
relative_urls : false,
theme_advanced_styles : "Header 1=header1;Header 2=header2;Header 3=header3;Table Row=tableRow1", // Theme specific setting CSS classes
debug : false,
verify_html : false
});
</script>
<!-- /tinyMCE -->
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="600">
<?php
$mq = "select * from members where userid=\"$userid\" and lastmailedreferrals<DATE_SUB(NOW(), INTERVAL $howoftensponsorscanmailreferrals HOUR)";
$mr = mysql_query($mq);
$mrows = mysql_num_rows($mr);
if ($mrows < 1)
{
?>
<tr class="sabrinatrdark"><td align="center" colspan="2">You emailed your downline less than <?php echo $howoftensponsorscanmailreferrals ?> hour(s) ago, at <?php echo $lastmailedreferrals ?>.</td></tr>
<?php
}
if ($mrows > 0)
{
	$q = "select * from members where verified=\"yes\" and referid=\"$userid\" order by email";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
	?>
	<tr class="sabrinatrdark"><td align="center" colspan="2">You don't have any verified referrals yet to send mail to.</td></tr>
	<?php
	}
	if ($rows > 0)
	{
	?>
	<tr class="sabrinatrdark"><td align="center" colspan="2">

	<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%" class="sabrinatable">
	<tr class="sabrinatrlight"><td align="center" colspan="4"><b>Your Referrals</b></td></tr>
	<tr class="sabrinatrdark"><td align="center">UserID</td><td align="center">Name</td><td align="center">Membership Level</td><td align="center">Verified</td></tr>
	<?php
		while ($rrowz = mysql_fetch_array($r))
		{
		$ruserid = $rrowz["userid"];
		$rfirstname = $rrowz["firstname"];
		$rlastname = $rrowz["lastname"];
		$rfullname = $rfirstname . " " . $rlastname;
		$raccounttype = $rrowz["accounttype"];
		$rverified = $rrowz["verified"];
		?>
		<tr class="sabrinatrlight"><td align="center"><?php echo $ruserid ?></td><td align="center"><?php echo $rfullname ?></td><td align="center"><?php echo $raccounttype ?></td><td align="center"><?php echo $rverified ?></td></tr>
		<?php
		}
	?>
	</table>

	</td></tr>
	<form action="maildownline.php" method="post" name="theform">
	<tr class="sabrinatrdark"><td align="center" colspan="2"><b>Send Email To Your Downline Referrals</b></td></tr>
	<tr class="sabrinatrlight"><td align="center" colspan="2">Please use the personalization substitution below anywhere in your subject or message, typed EXACTLY as shown (cAsE sEnSiTiVe):</td></tr>
	<tr class="sabrinatrdark"><td align="center" colspan="2">
	<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="100%">
	<tr class="sabrinatrlight"><td align="center">Type</td><td align="center">Substitutes</td></tr>
	<tr class="sabrinatrdark"><td align="center">~USERID~</td><td align="center">Member's UserID</td></tr>
	<tr class="sabrinatrdark"><td align="center">~FULLNAME~</td><td align="center">Member's First and Last Name</td></tr>
	<tr class="sabrinatrdark"><td align="center">~FIRSTNAME~</td><td align="center">Member's First Name</td></tr>
	<tr class="sabrinatrdark"><td align="center">~LASTNAME~</td><td align="center">Member's Last Name</td></tr>
	<tr class="sabrinatrdark"><td align="center">~EMAIL~</td><td align="center">Member's Email Address</td></tr>
	<tr class="sabrinatrdark"><td align="center">~AFFILIATE_URL~</td><td align="center">Member's Affiliate URL</td></tr>
	</table>
	</td></tr>
	<tr class="sabrinatrlight"><td colspan="2" align="center" >Your Name That Should Appear In The From Field In The Recipient Inboxes:</td></tr>
	<tr class="sabrinatrlight"><td align="center"><input type="text" class="typein" name="fromfield" maxlength="255" size="95"></td></tr>
	<tr class="sabrinatrlight"><td colspan="2" align="center" >Subject Of Your Email:</td></tr>
	<tr class="sabrinatrlight"><td align="center"><input type="text" class="typein" name="subjectfield" maxlength="255" size="95"></td></tr>
	<tr class="sabrinatrlight"><td colspan="2" align="center" >Your Message Body:</td></tr><tr><td colspan="2" align="center"><textarea name="messagefield" maxlength="50000" rows="15" cols="72"></textarea></td></tr>
	<tr class="sabrinatrdark"><td colspan="2" align="center"><input type="hidden" name="action" value="send"><input type="submit" value="SEND EMAIL" class="sendit" style="width: 150px;"></form></td></tr>
	<?php
	} # if ($rows > 0)
} # if ($mrows > 0)
?>
</table>
</td></tr>

</table>
<br><br>
<?php
include "footer.php";
exit;
?>