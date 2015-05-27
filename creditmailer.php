<?php
include "control.php";
include "header.php";
include "banners.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
if ($accounttype == "PAID")
{
$levelname = $level2name;
$memberhoursbetweencreditsoloposts = $memberhoursbetweencreditsolopostspaid;
$creditsolosaveads = $creditsolosaveadspaid;
$creditsolomaxrecipients = $creditsolomaxrecipientspaid;
}
if ($accounttype != "PAID")
{
$levelname = $level1name;
$memberhoursbetweencreditsoloposts = $memberhoursbetweencreditsolopostsfree;
$creditsolosaveads = $creditsolosaveadsfree;
$creditsolomaxrecipients = $creditsolomaxrecipientsfree;
}
$allowedtomailq = "select * from members where userid!=\"$userid\" order by rand() limit $creditsolomaxrecipients";
$allowedtomailr = mysql_query($allowedtomailq);
$allowedtomail = mysql_num_rows($allowedtomailr);
if ($allowedtomail <= $credits)
{
$showcreditsinform = $allowedtomail;
}
else
{
$showcreditsinform = $credits;
}

$action = $_POST["action"];
$show = "";
################################################################################################
if ($action == "delete")
{
$deleteid = $_POST["deleteid"];
$delq = "delete from creditsolos where id=\"$deleteid\"";
$delr = mysql_query($delq);
$show = "The Credit Email record was deleted.";
} # if ($action == "delete")
################################################################################################
if ($action == "send")
{
	$q = "select * from members where userid=\"$userid\" and nextcreditsolopost<NOW()";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2"><br>You have already submitted a Credit Email at <?php echo $lastcreditsolopost ?>. You may submit one Solo Ad every <?php echo $memberhoursbetweencreditsoloposts ?> hours.</td></tr>
	<tr><td colspan="2" align="center"><br><a href="creditmailer.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

	$adbody = $_POST["adbody"];
	$subject = $_POST["subject"];
	$url = $_POST["url"];
	$save = $_POST["save"];
	$saveid = $_POST["saveid"];
	$creditcost = $_POST["creditcost"];

	if(!$subject)
	{
	$error .= "<div>No subject was entered.</div>";
	}
	if(!$adbody)
	{
	$error .= "<div>No message body was entered.</div>";
	}
	if(!$url)
	{
	$error .= "<div>No URL was entered.</div>";
	}
	if((!$creditcost) or ($creditcost < 1))
	{
	$error .= "<div>No Credits were entered.</div>";
	}
	if ($creditcost > $credits)
	{
	$error .= "<div>You don't have " . $creditcost . " Credits.</div>";
	}
	if ($creditcost > $allowedtomail)
	{
	$error .= "<div>" . $creditcost . " is too high. You're allowed to email a maximum of " . $allowedtomail . " members.</div>";
	}

	$urlpresentinadbody = "no";
	$showurlspresent = "";
	$urlpattern = '/((http|https|ftp):\/\/|www)'
				 .'[a-z0-9\-\._]+\/?[a-z0-9_\.\-\?\+\/~=@&#;,]*'
				 .'[a-z0-9\/]{1}/si';

	preg_match_all($urlpattern, $adbody, $matches);
	foreach ($matches[0] as $theurl)
		{
		$url_parts = pathinfo($theurl);
		$fileextension = $url_parts['extension'];
		$fileextension = strtolower($fileextension);
		if (($fileextension != "gif") and ($fileextension != "jpg") and ($fileextension != "bmp") and ($fileextension != "png") and ($fileextension != "jpeg"))
		{
		$urlpresentinadbody = "yes";
		$showurlspresent = $showurlspresent . $theurl . "<br>";
		}
		}
	if ($urlpresentinadbody == "yes")
	{
	$error .= "<br>Sorry, URLs are not permitted in the message body. The following URL(s) were found and need to be removed before the ad may be submitted:
	<br><br>" . $showurlspresent . "<br><br>";
	}

	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="creditmailer.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

	$adbody = stripslashes($adbody);
	$adbody = str_replace('\\', '', $adbody); 
	$subject = stripslashes($subject);
	$subject = str_replace('\\', '', $subject); 
	$adbody = mysql_real_escape_string($adbody);
	$subject = mysql_real_escape_string($subject);

	$q1 = "insert into creditsolos (userid,subject,adbody,url,creditcost,purchase) values ('$userid','$subject','$adbody','$url','$creditcost','".time()."')";
	$r1 = mysql_query($q1);
	$q2 = "update members set credits=credits-" . $creditcost . " where userid=\"$userid\"";
	$r2 = mysql_query($q1);

		if($save)
		{
		$addtoshow = "";
			if ($saveid != "")
			{
				$saveq = "select * from creditsolos_saved where id='$saveid' and userid='$userid'";
				$saver = mysql_query($saveq);
				$saverows = mysql_num_rows($saver);
				if ($saverows < 1)
				{
				$saveq2 = "select * from creditsolos_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $creditsolosaveads)
					{
					mysql_query("insert into creditsolos_saved (subject,adbody,userid,url) values('$subject','$adbody','$userid','$url')");
					}
					if ($saverows2 >= $creditsolosaveads)
					{
					$addtoshow = "New Credit Email could not be saved, because you already have saved the maximum <font color=#ff0000>$creditsolosaveads</font> allowed for your membership level.";
					}
				}
				if ($saverows > 0)
				{
				mysql_query("update creditsolos_saved set subject='$subject',adbody='$adbody',url='$url' where userid='$userid' and id='$saveid'");
				}
			}
			if ($saveid == "")
			{
				$saveq2 = "select * from creditsolos_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $creditsolosaveads)
					{
					mysql_query("insert into creditsolos_saved (subject,adbody,userid,url) values('$subject','$adbody','$userid','$url')");
					}
					if ($saverows2 >= $creditsolosaveads)
					{
					$addtoshow = "New Credit Email could not be saved, because you already have saved the maximum <font color=#ff0000>$creditsolosaveads</font> allowed for your membership level.";
					}
			}
		} # if($save)

	if ($memberhoursbetweencreditsoloposts != 0)
	{
	$lastpostq = "update members set lastcreditsolopost=NOW(),nextcreditsolopost=DATE_ADD(NOW(),INTERVAL $memberhoursbetweencreditsoloposts HOUR) where userid='".$userid."'";
	$lastpostr = mysql_query($lastpostq);
	}
	if ($memberhoursbetweencreditsoloposts == 0)
	{
	$lastpostq = "update members set lastcreditsolopost=NOW(),nextcreditsolopost=NOW() where userid='".$userid."'";
	$lastpostr = mysql_query($lastpostq);
	}

	$show = "Your Credit Email has been queued for sending!<br>Please allow time for message delivery, and return later to see your click stats for this campaign!";
	if ($addtoshow != "")
		{
		$show .= "<br>" . $addtoshow;
		}
} # if ($action == "send")
################################################################################################
if ($action == "delete")
{
$delq = "delete from creditsolos_saved where id='".$_POST['deleteid']."' and userid = '".$userid."'";
$delr = mysql_query($delq);
$show = "The saved ad was deleted.";
} # if ($action == "delete")
################################################################################################
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Credit Mailer</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Members Area Credit Mailer Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrlight"><td>Maximum Email Recipients for <?php echo $level1name ?> Members:</td><td><?php echo $creditsolomaxrecipientsfree ?></td></tr>
<tr class="sabrinatrlight"><td>Time Between <?php echo $level1name ?> Member Posts:</td><td><?php echo $memberhoursbetweencreditsolopostsfree ?></td></tr>
<tr class="sabrinatrlight"><td>Saved Credit Emails Allowed for <?php echo $level1name ?> Members:</td><td><?php echo $creditsolosaveadsfree ?></td></tr>
<tr class="sabrinatrlight"><td>Maximum Email Recipients for <?php echo $level2name ?> Members:</td><td><?php echo $creditsolomaxrecipientspaid ?></td></tr>
<tr class="sabrinatrlight"><td>Time Between <?php echo $level2name ?> Members Posts::</td><td><?php echo $memberhoursbetweencreditsolopostspaid ?></td></tr>
<tr class="sabrinatrlight"><td>Saved Credit Emails Allowed for <?php echo $level2name ?> Members:</td><td><?php echo $creditsolosaveadspaid ?></td></tr>
</table>
</td></tr>

<tr><td><br>
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
<script language="javascript" type="text/javascript">
function changeSoloHiddenInput(objDropDown)
{
	var solodata=objDropDown.value.split("||");
	var soloid=solodata[0];
	if (soloid)
	{
		var solourl=solodata[1];
		var solosubject=solodata[2];
		var soloadbody=solodata[3];
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsaveurl = document.getElementById("url");
		var objsavesubject = document.getElementById("subject");
		objdeleteid.value = soloid;
		objsaveid.value = soloid;
		objsaveurl.value = solourl; 
		objsavesubject.value = solosubject;
		document.getElementById('save').checked = true;
		tinyMCE.execCommand('mceSetContent',false,soloadbody);
	}
	else
	{
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsaveurl = document.getElementById("url");
		var objsavesubject = document.getElementById("subject");
		objdeleteid.value = "";
		objsaveid.value = "";
		objsaveurl.value = ""; 
		objsavesubject.value = "";
		document.getElementById('save').checked = false;
		tinyMCE.execCommand('mceSetContent',false,'');
	}
}
</script>
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="600">
<?php
$mq = "select * from members where userid=\"$userid\" and lastcreditsolopost<DATE_SUB(NOW(), INTERVAL $memberhoursbetweencreditsoloposts HOUR)";
$mr = mysql_query($mq);
$mrows = mysql_num_rows($mr);
if ($mrows < 1)
{
?>
<tr class="sabrinatrdark"><td align="center" colspan="2"><br>You have already submitted a Credit Email at <?php echo $lastcreditsolopost ?>. You may submit one Solo Ad every <?php echo $memberhoursbetweencreditsoloposts ?> hours.</td></tr>
<?php
}
if ($mrows > 0)
{
	$q = "select * from members where verified=\"yes\" order by email";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
	?>
	<tr class="sabrinatrdark"><td align="center" colspan="2"><br>There are no other members to send to yet.</td></tr>
	<?php
	}
	if ($rows > 0)
	{
	############################################# START SAVED CREDIT SOLOS
	$savedq = "select * from creditsolos_saved where userid=\"$userid\"";
	$savedr = mysql_query($savedq);
	$savedrows = mysql_num_rows($savedr);
	if (($savedrows > 0) and ($memberhoursbetweencreditsoloposts > 0))
	{
	?>
	<tr class="sabrinatrlight"><td align="center">
	<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable">
	<tr class="sabrinatrdark"><td align="center" colspan="2">Your Saved Credit Email Ads</td></tr>
	<tr class="sabrinatrlight"><td colspan="2">Select a campaign from the ones you've saved below, or enter a new one.</td></tr>
	<tr class="sabrinatrlight"><td>Your Saved Credit Email Ads:</td><td><?php echo $savedrows ?></td></tr>
	<tr class="sabrinatrlight"><td colspan="2">If you have reached the maximum saved ads, you will need to open and delete one before saving a new one.</td></tr>
	<form action="creditmailer.php" method="post">
	<tr class="sabrinatrlight"><td colspan="2">Saved Credit Email Campaigns: </td></tr>
	<tr class="sabrinatrlight"><td colspan="2" align="center"><select name="creditsolosavedchoice" id="creditsolosavedchoice" onchange="changeSoloHiddenInput(this)">
	<option value=""> - Select Saved Ad - </option>
	<?php
	while ($savedrowz = mysql_fetch_array($savedr))
		{
		$savedsubject = $savedrowz["subject"];
		$savedsubject = stripslashes($savedsubject);
		$savedsubject = str_replace('\\', '', $savedsubject); 
		$savedadbody = $savedrowz["adbody"];
		$savedadbody = stripslashes($savedadbody);
		$savedadbody = str_replace('\\', '', $savedadbody);
		$savedadbody = htmlentities($savedadbody, ENT_COMPAT, "ISO-8859-1");
		$savedurl = $savedrowz["url"];
		$savedid = $savedrowz["id"];
	?>
	<option value="<?php echo $savedid ?>||<?php echo $savedurl ?>||<?php echo $savedsubject ?>||<?php echo $savedadbody ?>"><?php echo $savedsubject ?></option>
	<?php
		}
	?>
	</select>&nbsp;&nbsp;<input type="hidden" name="deleteid" id="deleteid" value=""><input type="hidden" name="action" value="delete"><input type="submit" value="Delete Saved"  class="sendit" style="font-size: 10px;"></td></tr></form>
	</table>
	</td></tr>
	<?php		
	} # if (($savedrows > 0) and ($memberhoursbetweencreditsoloposts > 0))
	############################################# END SAVED CREDIT SOLOS
	?>
	<form action="creditmailer.php" method="post" name="theform">
	<tr class="sabrinatrdark"><td align="center" colspan="2"><b>Send Credit Mailing</b></td></tr>
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
	<tr class="sabrinatrlight"><td>Subject:</td><td><input type="text" name="subject" id="subject" maxlength="255" size="122" value=""></td></tr>
	<tr class="sabrinatrlight"><td >URL:</td><td><input type="text" name="url" id="url" maxlength="255" size="122" value=""></td></tr>
	<tr class="sabrinatrlight"><td valign="top">Ad Body:</td><td><textarea name="adbody" id="adbody" rows="20" cols="91"></textarea></td></tr>
	<tr class="sabrinatrlight"><td>Credits:</td><td><input type="text" name="creditcost" id="creditcost" maxlength="12" size="4" value="<?php echo $showcreditsinform ?>"><br>Your message will cost 1 credit for every member your message is sent to. Your maximum number of credits you may use per send is <?php echo $allowedtomail ?>.</td></tr>
	<?php
	if ($creditsolosaveads > 0)
	{
	?>
	<tr class="sabrinatrlight"><td>Save Ad</td><td><input type="checkbox" name="save" id="save" value="1"></td></tr>
	<?php
	}
	?>
	<tr class="sabrinatrlight">
	<td align="center" colspan="2">
	<input type="hidden" name="saveid" id="saveid" value="">
	<input type="hidden" name="action" value="send">
	<input type="submit" value="SUBMIT" class="sendit">
	</form>
	</td>
	</tr>
	<?php
	} # if ($rows > 0)
} # if ($mrows > 0)
?>
</table>
</td></tr>

<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="8"><b>Your Credit Email Campaign Stats</b></td></tr>
<tr class="sabrinatrlight"><td align="center" colspan="8">Sent Credit Emails over 31 days old are automatically cleared from the system.</td></tr>
<?php
$statsq = "select * from creditsolos where userid=\"$userid\" and sent=\"1\" order by datesent desc";
$statsr = mysql_query($statsq);
$statsrows = mysql_num_rows($statsr);
if ($statsrows < 1)
{
?>
<tr class="sabrinatrdark"><td align="center" colspan="8">You don't have any Credit Emails in the system.</td></tr>
<?php
}
if ($statsrows > 0)
{
?>
<tr class="sabrinatrdark">
<td align="center">ID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Ad Body</td>
<td align="center">Credit Cost</td>
<td align="center">Date Sent</td>
<td align="center">Clicks</td>
<td align="center">Delete</td>
</tr>
<?php
	while ($statsrowz = mysql_fetch_array($statsr))
	{
	$adid = $statsrowz["id"];
	$subject = $statsrowz["subject"];
	$subject = stripslashes($subject);
	$subject = str_replace('\\', '', $subject);
	$adbody = $statsrowz["adbody"];
	$adbody = stripslashes($adbody);
	$adbody = str_replace('\\', '', $adbody);
	$url = $statsrowz["url"];
	$creditcost = $statsrowz["creditcost"];
	$clicks = $statsrowz["clicks"];
	$datesent = $statsrowz["datesent"];
	$showdatesent = date("M d Y", $datesent);
	?>
	<tr class="sabrinatrlight">
	<td align="center"><?php echo $adid ?></td>
	<td align="center"><?php echo $subject ?></td>
	<td align="center"><a href="<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
	<td align="center"><div style="width: 200px; height: 100px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #eeeeee; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td>
	<td align="center"><?php echo $creditcost ?></td>
	<td align="center"><?php echo $showdatesent ?></td>
	<td align="center"><?php echo $clicks ?></td>
	<td align="center">
	<input type="hidden" name="deleteid" value="<?php echo $adid ?>">
	<input type="hidden" name="action" value="delete">
	<input type="submit" name="submit" value="DELETE">
	</form>	
	</td>
	</td>
	</tr>
	<?php
	} # while ($statsrowz = mysql_fetch_array($statsr))
} # if ($statsrows > 0)
?>
</table>
</td></tr>

</table>
<br><br>
<?php
include "footer.php";
exit;
?>