<?php
include "control.php";
include "header.php";
include "banners.php";
if ($vacation == "yes")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Vacation Mode Enabled</div></td></tr>
<tr><td colspan="2"><br>You are unable to post ads currently because your account's email address is in vacation mode. Please visit the profile page to turn off vacation mode in order to be able to post ads again. Note that after turning off vacation mode, you must wait for 24 hours before being able to post (prevents cheating).</td></tr>
<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}
if ($vacation != "yes")
{
$vacationq = "select * from members where vacationdate>DATE_SUB(NOW(),INTERVAL 24 HOUR) and userid='$userid'";
$vacationr = mysql_query($vacationq);
$vacationrows = mysql_num_rows($vacationr);
if ($vacationrows > 0)
	{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Vacation Mode Enabled</div></td></tr>
<tr><td colspan="2"><br>You are unable to post ads currently because your account's email address was taken off vacation mode within the past 24 hours. After turning off vacation mode, you must wait for 24 hours before being able to post (prevents cheating).</td></tr>
<tr><td colspan="2" align="center"><br><a href="members.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
	}
}

$action = $_POST['action'];
$show = "";
$adtype = $_REQUEST["adtype"];
$adtype_saved = $adtype . "_saved";
if ($adtype == "solos")
{
$showadtype = "Solo";
	if ($accounttype == "PAID")
	{
	$solosaveads = $solosaveadspaid;
	}
	if ($accounttype != "PAID")
	{
	$solosaveads = $solosaveadsfree;
	}
$adq = "select * from solos where userid='$userid' and added=0 order by id limit 1";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "banners")
{
$showadtype = "Banner";
	if ($accounttype == "PAID")
	{
	$bannersaveads = $bannersaveadspaid;
	}
	if ($accounttype != "PAID")
	{
	$bannersaveads = $bannersaveadsfree;
	}
$adq = "select * from banners where userid='$userid' and added=0 order by id limit 1";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "buttons")
{
$showadtype = "Button";
	if ($accounttype == "PAID")
	{
	$buttonsaveads = $buttonsaveadspaid;
	}
	if ($accounttype != "PAID")
	{
	$buttonsaveads = $buttonsaveadsfree;
	}
$adq = "select * from buttons where userid='$userid' and added=0 order by id limit 1";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "textads")
{
$showadtype = "Text";
	if ($accounttype == "PAID")
	{
	$textadsaveads = $textadsaveadspaid;
	}
	if ($accounttype != "PAID")
	{
	$textadsaveads = $textadsaveadsfree;
	}
$adq = "select * from textads where userid='$userid' and added=0 order by id limit 1";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "fullloginads")
{
$showadtype = "Full Page Login";
	if ($accounttype == "PAID")
	{
	$fullloginadsaveads = $fullloginadsaveadspaid;
	}
	if ($accounttype != "PAID")
	{
	$fullloginadsaveads = $fullloginadsaveadsfree;
	}
$adq = "select * from fullloginads where userid='$userid' and added=0 order by id limit 1";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
else
{
$showadtype = "";
$adrows = 0;
}
################################################################################################
$soloq = "select * from solos where userid='$userid' and added=0 order by datesent desc";
$solor = mysql_query($soloq);
$solorows = mysql_num_rows($solor);

$bannerq = "select * from banners where userid='$userid' and added=0 order by purchase desc";
$bannerr = mysql_query($bannerq);
$bannerrows = mysql_num_rows($bannerr);

$buttonq = "select * from buttons where userid='$userid' and added=0 order by purchase desc";
$buttonr = mysql_query($buttonq);
$buttonrows = mysql_num_rows($buttonr);

$textadq = "select * from textads where userid='$userid' and added=0 order by purchase desc";
$textadr = mysql_query($textadq);
$textadrows = mysql_num_rows($textadr);

$fullloginadq = "select * from fullloginads where userid='$userid' and added=0 order by purchase desc";
$fullloginadr = mysql_query($fullloginadq);
$fullloginadrows = mysql_num_rows($fullloginadr);
################################################################################################
?>
<link rel="stylesheet" href="./jscripts/colorpicker/js_color_picker_v2.css" media="screen">
<script type="text/javascript" src="./jscripts/colorpicker/color_functions.js"></script>
<script type="text/javascript" src="./jscripts/colorpicker/js_color_picker_v2.js"></script>
<script type="text/javascript">
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

function changeBannerHiddenInput(objDropDown)
{
	var bannerdata=objDropDown.value.split("||");
	var bannerid=bannerdata[0];
	if (bannerid)
	{
		var name=bannerdata[1];
		var bannerurl=bannerdata[2];
		var targeturl=bannerdata[3];
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsavename = document.getElementById("name");
		var objsavebannerurl = document.getElementById("bannerurl");
		var objsavetargeturl = document.getElementById("targeturl");
		objdeleteid.value = bannerid;
		objsaveid.value = bannerid;
		objsavename.value = name;
		objsavebannerurl.value = bannerurl;
		objsavetargeturl.value = targeturl;
		document.getElementById('save').checked = true;
	}
	else
	{
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsavename = document.getElementById("name");
		var objsavebannerurl = document.getElementById("bannerurl");
		var objsavetargeturl = document.getElementById("targeturl");
		objdeleteid.value = "";
		objsaveid.value = "";
		objsavename.value = ""; 
		objsavebannerurl.value = "";
		objsavetargeturl.value = "";
		document.getElementById('save').checked = false;
	}
}

function changeTextAdHiddenInput(objDropDown)
{
	var textaddata=objDropDown.value.split("||");
	var textadid=textaddata[0];
	if (textadid)
	{
		var heading=textaddata[1];
		var url=textaddata[2];
		var description=textaddata[3];
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsaveheading = document.getElementById("heading");
		var objsaveurl = document.getElementById("url");
		var objsavedescription = document.getElementById("description");
		objdeleteid.value = textadid;
		objsaveid.value = textadid;
		objsaveheading.value = heading;
		objsaveurl.value = url;
		objsavedescription.value = description;
		document.getElementById('save').checked = true;
	}
	else
	{
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsaveheading = document.getElementById("heading");
		var objsaveurl = document.getElementById("url");
		var objsavedescription = document.getElementById("description");
		objdeleteid.value = "";
		objsaveid.value = "";
		objsaveheading.value = ""; 
		objsaveurl.value = "";
		objsavedescription.value = "";
		document.getElementById('save').checked = false;
	}
}

function changeHotLinkHiddenInput(objDropDown)
{
	var hotlinkdata=objDropDown.value.split("||");
	var hotlinkid=hotlinkdata[0];
	if (hotlinkid)
	{
		var hotlinksubject=hotlinkdata[1];
		var hotlinkurl=hotlinkdata[2];
		var objdeleteid = document.getElementById("deleteid");
		var objsaveid = document.getElementById("saveid");
		var objsaveurl = document.getElementById("url");
		var objsavesubject = document.getElementById("subject");
		objdeleteid.value = hotlinkid;
		objsaveid.value = hotlinkid;
		objsaveurl.value = hotlinkurl; 
		objsavesubject.value = hotlinksubject;
		document.getElementById('save').checked = true;
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
	}
}


</script>
<?php
################################################################################################
if ($action == "delete")
{
$deletetable = $adtype . "_saved";
$delq = "delete from $deletetable where id='".$_POST['deleteid']."' and userid = '".$userid."'";
$delr = mysql_query($delq);
$show = "The saved ad was deleted.";
} # if ($action == "delete")
################################################################################################
################################################################################################
if ($action == "send")
{
	if ($enableautoapprove == "yes")
	{
		$approved = "1";
	}
	if ($enableautoapprove != "yes")
	{
		$approved = "0";
	}

	if ($adtype == "solos")
	{
	$q = "select * from members where userid=\"$userid\" and nextsolopost<NOW()";
	$r = mysql_query($q);
	$rows = mysql_num_rows($r);
	if ($rows < 1)
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2"><br>You have already submitted a Solo Ad. You may submit one Solo Ad every <?php echo $memberhoursbetweensoloposts ?> hours.</td></tr>
	<tr><td colspan="2" align="center"><br><a href="postads.php?orderedby=<?php echo $orderedby ?>&adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}
	} # if ($adtype == "solos")

if ($adtype == "solos")
{
$adbody = $_POST["adbody"];
$subject = $_POST["subject"];
$url = $_POST["url"];
$save = $_POST["save"];
$saveid = $_POST["saveid"];
$id = $_POST["id"];

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
	<tr><td colspan="2" align="center"><br><a href="postads.php?orderedby=<?php echo $orderedby ?>&adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
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


		$q1 = "update $adtype set subject='$subject',adbody='$adbody',url='$url',added=1,approved='$approved',purchase='".time()."' where id=".$id;
		$r1 = mysql_query($q1);

		$allowedtosave = $solosaveads;

		if($save)
		{
		$addtoshow = "";
			if ($saveid != "")
			{
				$saveq = "select * from $adtype_saved where id='$saveid' and userid='$userid'";
				$saver = mysql_query($saveq);
				$saverows = mysql_num_rows($saver);
				if ($saverows < 1)
				{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $allowedtosave)
					{
					mysql_query("insert into $adtype_saved (subject,adbody,userid,url) values('$subject','$adbody','$userid','$url')");
					}
					if ($saverows2 >= $allowedtosave)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$allowedtosave</font> $showadtype Ads.";
					}
				}
				if ($saverows > 0)
				{
				mysql_query("update $adtype_saved set subject='$subject',adbody='$adbody',url='$url' where userid='$userid' and id='$saveid'");
				}
			}
			if ($saveid == "")
			{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $allowedtosave)
					{
					mysql_query("insert into $adtype_saved (subject,adbody,userid,url) values('$subject','$adbody','$userid','$url')");
					}
					if ($saverows2 >= $allowedtosave)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$allowedtosave</font> $showadtype Ads.";
					}
			}
		} # if($save)

		if ($adtype == "solos")
		{
			if ($memberhoursbetweensoloposts != 0)
			{
			$lastpostq = "update members set lastsolopost=NOW(),nextsolopost=DATE_ADD(NOW(),INTERVAL $memberhoursbetweensoloposts HOUR) where userid='".$userid."'";
			$lastpostr = mysql_query($lastpostq);
			}
			if ($memberhoursbetweensoloposts == 0)
			{
			$lastpostq = "update members set lastsolopost=NOW(),nextsolopost=NOW() where userid='".$userid."'";
			$lastpostr = mysql_query($lastpostq);
			}
		}
} # if ($adtype == "solos")
########################################################
if (($adtype == "banners") or ($adtype == "buttons"))
{
$id = $_POST["id"];
$name = $_POST["name"];
$bannerurl = $_POST["bannerurl"];
$targeturl = $_POST["targeturl"];
$save = $_POST["save"];
$saveid = $_POST["saveid"];

	if(!$name)
	{
	$error .= "<div>No name was entered.</div>";
	}
	if(!$targeturl)
	{
	$error .= "<div>No target url was entered.</div>";
	}
	if(!$bannerurl)
	{
	$error .= "<div>No image url was entered.</div>";
	}

	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="postads.php?orderedby=<?php echo $orderedby ?>&adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

$q1 = "update $adtype set name='$name', targeturl='$targeturl', bannerurl='$bannerurl', added=1, approved='$approved', purchase='".time()."' where id=".$id;
$r1 = mysql_query($q1);

		if($save)
		{
		$addtoshow = "";
			if ($adtype == "banners")
			{
			$maxsaveads = $bannersaveads;
			}
			if ($adtype != "banners")
			{
			$maxsaveads = $buttonsaveads;
			}

			if ($saveid != "")
			{
				$saveq = "select * from $adtype_saved where id='$saveid' and userid='$userid'";
				$saver = mysql_query($saveq);
				$saverows = mysql_num_rows($saver);
				if ($saverows < 1)
				{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $maxsaveads)
					{
					mysql_query("insert into $adtype_saved (userid,name,bannerurl,targeturl) values('$userid','$name','$bannerurl','$targeturl')");
					}
					if ($saverows2 >= $maxsaveads)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$maxsaveads</font> $showadtype Ads.";
					}
				}
				if ($saverows > 0)
				{
				mysql_query("update $adtype_saved set name='$name',bannerurl='$bannerurl',targeturl='$targeturl' where userid='$userid' and id='$saveid'");
				}
			}
			if ($saveid == "")
			{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $maxsaveads)
					{
					mysql_query("insert into $adtype_saved (userid,name,bannerurl,targeturl) values('$userid','$name','$bannerurl','$targeturl')");
					}
					if ($saverows2 >= $maxsaveads)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$maxsaveads</font> $showadtype Ads.";
					}
			}
		} # if($save)

} # if (($adtype == "banners") or ($adtype == "buttons"))
########################################################
if ($adtype == "textads")
{
$id = $_POST["id"];
$heading = $_POST["heading"];
$url = $_POST["url"];
$description = $_POST["description"];
$save = $_POST["save"];
$saveid = $_POST["saveid"];

	if(!$heading)
	{
	$error .= "<div>No heading was entered.</div>";
	}
	if(!$description)
	{
	$error .= "<div>No description was entered.</div>";
	}
	if(!$url)
	{
	$error .= "<div>No URL was entered.</div>";
	}

	$urlpresentinadbody = "no";
	$showurlspresent = "";
	$urlpattern = '/((http|https|ftp):\/\/|www)'
				 .'[a-z0-9\-\._]+\/?[a-z0-9_\.\-\?\+\/~=@&#;,]*'
				 .'[a-z0-9\/]{1}/si';

	preg_match_all($urlpattern, $description, $matches);
	foreach ($matches[0] as $theurl)
		{
		$url_parts = pathinfo($theurl);
		$fileextension = $url_parts['extension'];
		$fileextension = strtolower($fileextension);
		if (($fileextension != "gif") and ($fileextension != "jpg") and ($fileextension != "bmp") and ($fileextension != "png") and ($fileextension != "jpeg"))
		{
		$urlpresentindescription = "yes";
		$showurlspresent = $showurlspresent . $theurl . "<br>";
		}
		}
	if ($urlpresentindescription == "yes")
	{
	$error .= "<br>Sorry, URLs are not permitted in the description. The following URL(s) were found and need to be removed before the ad may be submitted:
	<br><br>" . $showurlspresent . "<br><br>";
	}

	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="postads.php?orderedby=<?php echo $orderedby ?>&adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

$description = stripslashes($description);
$description = str_replace('\\', '', $description); 
$heading = stripslashes($heading);
$heading = str_replace('\\', '', $heading); 
$description = mysql_real_escape_string($description);
$heading = mysql_real_escape_string($heading);

$q1 = "update $adtype set heading='$heading',description='$description',url='$url',added=1,approved='$approved',purchase='".time()."' where id=".$id;
$r1 = mysql_query($q1);

		if($save)
		{
		$addtoshow = "";
			if ($saveid != "")
			{
				$saveq = "select * from $adtype_saved where id='$saveid' and userid='$userid'";
				$saver = mysql_query($saveq);
				$saverows = mysql_num_rows($saver);
				if ($saverows < 1)
				{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $textadsaveads)
					{
					mysql_query("insert into $adtype_saved (heading,description,userid,url) values('$heading','$description','$userid','$url')");
					}
					if ($saverows2 >= $textadsaveads)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$textadsaveads</font> $showadtype Ads.";
					}
				}
				if ($saverows > 0)
				{
				mysql_query("update $adtype_saved set url='$url' where userid='$userid' and id='$saveid'");
				}
			}
			if ($saveid == "")
			{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $textadsaveads)
					{
					mysql_query("insert into $adtype_saved (heading,description,userid,url) values('$heading','$description','$userid','$url')");
					}
					if ($saverows2 >= $textadsaveads)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$textadsaveads</font> $showadtype Ads.";
					}
			}
		} # if($save)

} # if ($adtype == "textads")
########################################################
if ($adtype == "fullloginads")
{
$id = $_POST["id"];
$subject = $_POST["subject"];
$subject = stripslashes($subject);
$subject = str_replace('\\', '', $subject);
$url = $_POST["url"];
$save = $_POST["save"];
$saveid = $_POST["saveid"];

	if(!$subject)
	{
	$error .= "<div>No subject was entered.</div>";
	}
	if(!$url)
	{
	$error .= "<div>No URL was entered.</div>";
	}
	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td align="center" colspan="2"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="postads.php?orderedby=<?php echo $orderedby ?>&adtype=<?php echo $adtype ?>">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

$subject = mysql_real_escape_string($subject);

$q1 = "update $adtype set subject='$subject',url='$url',added=1,approved='$approved',purchase='".time()."' where id=".$id;
$r1 = mysql_query($q1);

		if($save)
		{
		$addtoshow = "";

		$maxsaveads = $fullloginadsaveads;

			if ($saveid != "")
			{
				$saveq = "select * from $adtype_saved where id='$saveid' and userid='$userid'";
				$saver = mysql_query($saveq);
				$saverows = mysql_num_rows($saver);
				if ($saverows < 1)
				{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $maxsaveads)
					{
					mysql_query("insert into $adtype_saved (subject,userid,url) values('$subject','$userid','$url')");
					}
					if ($saverows2 >= $maxsaveads)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$maxsaveads</font> $showadtype Ads.";
					}
				}
				if ($saverows > 0)
				{
				mysql_query("update $adtype_saved set url='$url',subject='$subject' where userid='$userid' and id='$saveid'");
				}
			}
			if ($saveid == "")
			{
				$saveq2 = "select * from $adtype_saved where userid='$userid'";
				$saver2 = mysql_query($saveq2);
				$saverows2 = mysql_num_rows($saver2);
					if ($saverows2 < $maxsaveads)
					{
					mysql_query("insert into $adtype_saved (subject,userid,url) values('$subject','$userid','$url')");
					}
					if ($saverows2 >= $maxsaveads)
					{
					$addtoshow = "New Ad could not be saved, because you already have saved the maximum <font color=#ff0000>$maxsaveads</font> $showadtype Ads.";
					}
			}
		} # if($save)

} # if ($adtype == "fullloginads")
########################################################

$show = "Your $showadtype Ad has been set up, and has been placed in the queue for approval.";
if ($addtoshow != "")
	{
	$show .= "<br>" . $addtoshow;
	}

} # if ($action == "send")
################################################################################################
################################################################################################
?>
<br>
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2">Post&nbsp;Ads</td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<form action="postads.php" method="post" name="viewform" id="viewform">
<tr class="sabrinatrlight"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrlight"><td>Solo Ads To Add:</td><td align="center"><?php echo $solorows ?></td></tr>
<tr class="sabrinatrlight"><td>Banner Ads To Add:</td><td align="center"><?php echo $bannerrows ?></td></tr>
<tr class="sabrinatrlight"><td>Button Ads To Add:</td><td align="center"><?php echo $buttonrows ?></td></tr>
<tr class="sabrinatrlight"><td>Text Ads To Add:</td><td align="center"><?php echo $textadrows ?></td></tr>
<tr class="sabrinatrlight"><td>Full Page Login Ads To Add:</td><td align="center"><?php echo $fullloginadrows ?></td></tr>
</table>
</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<select name="adtype" id="adtype" onchange="this.form.submit();">
<option value="" <?php if ($adtype == "") { echo "selected"; } ?>> - Select Ad Type - </option>
<option value="solos" <?php if ($adtype == "solos") { echo "selected"; } ?>>Solo Ads</option>
<option value="banners" <?php if ($adtype == "banners") { echo "selected"; } ?>>Banner Ads</option>
<option value="buttons" <?php if ($adtype == "buttons") { echo "selected"; } ?>>Button Ads</option>
<option value="textads" <?php if ($adtype == "textads") { echo "selected"; } ?>>Text Ads</option>
<option value="fullloginads" <?php if ($adtype == "fullloginads") { echo "selected"; } ?>>Full Page Login Ads</option>
</select></form></td></tr>
<?php
if ($adtype != "")
{
if ($adrows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">No <?php echo $showadtype ?> Ads To Add</td></tr>
<?php
}
if ($adrows > 0)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="0" class="sabrinatable" align="center">
<?php
while ($adrowz = mysql_fetch_array($adr))
	{
		if ($adtype == "solos")
		{
		$nextpostq = "select * from members where userid=\"$userid\" and nextsolopost<NOW()";
		$timer = $memberhoursbetweensoloposts;
		$nextpostr = mysql_query($nextpostq);
		$nextpostrows = mysql_num_rows($nextpostr);
		if ($nextpostrows < 1)
			{
			?>
			<tr class="sabrinatrlight"><td>You have already submitted a <?php echo $showadtype ?> Ad. You may submit one <?php echo $showadtype ?> Ad every <?php echo $timer ?> hours.</td></tr>
			<?
			}
		if ($nextpostrows > 0)
			{
			############################################# START SAVED SOLOS
			$savedq = "select * from $adtype_saved where userid=\"$userid\"";
			$savedr = mysql_query($savedq);
			$savedrows = mysql_num_rows($savedr);
			if ($savedrows > 0)
			{
			$saveads = $solosaveads;
			?>
			<tr class="sabrinatrlight"><td align="center">
			<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable">
			<tr class="sabrinatrlight"><td align="center" colspan="2">Your Saved <?php echo $showadtype ?> Ads</td></tr>
			<tr class="sabrinatrlight"><td colspan="2">Select an ad campaign from the ones you've saved below, or enter a new one.</td></tr>
			<tr class="sabrinatrlight"><td>Saved <?php echo $showadtype ?> Ads Allowed:</td><td><?php echo $saveads ?></td></tr>
			<tr class="sabrinatrlight"><td>Your Saved <?php echo $showadtype ?> Ads:</td><td><?php echo $savedrows ?></td></tr>
			<tr class="sabrinatrlight"><td colspan="2">If you have reached the maximum saved ads, you will need to open and delete one before saving a new one.</td></tr>
			<form action="postads.php" method="post">
			<tr class="sabrinatrlight"><td colspan="2">Saved <?php echo $showadtype ?> Campaigns: </td></tr>
			<tr class="sabrinatrlight"><td colspan="2" align="center"><select name="solosavedchoice" id="solosavedchoice" onchange="changeSoloHiddenInput(this)">
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
			</select>&nbsp;&nbsp;<input type="hidden" name="deleteid" id="deleteid" value=""><input type="hidden" name="adtype" value="<?php echo $adtype ?>"><input type="hidden" name="action" value="delete"><input type="submit" value="Delete Saved"  class="sendit" style="font-size: 10px;"></td></tr></form>
			</table>
			</td></tr>
			<?php		
			} # if ($savedrows > 0)
			############################################# END SAVED SOLOS

			$id = $adrowz["id"];
			$userid = $adrowz["userid"];
			$subject = $adrowz["subject"];
			$subject = stripslashes($subject);
			$subject = str_replace('\\', '', $subject);
			$adbody = $adrowz["adbody"];
			$adbody = stripslashes($adbody);
			$adbody = str_replace('\\', '', $adbody);
			$url = $adrowz["url"];
?> 
<tr class="sabrinatrlight">
<td align="center" colspan="2">
<?php
$query = "select * from pages where name='Solo Ad Message Rules'";		
$result = mysql_query ($query) or die(mysql_error());
while ($line = mysql_fetch_array($result)) {
	$htmlcode = $line["htmlcode"];
	if ($htmlcode != "")
	{
	$adbody = $htmlcode . "<br><br>" . $adbody;
	}
}
?>
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
<tr class="sabrinatrlight"><td align="center">
<table width="600" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<form method="post" name="theform" id="theform" action="postads.php">
<tr class="sabrinatrdark"><td align="center" colspan="2">Post <?php echo $showadtype ?> Ad</td></tr>
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
<tr class="sabrinatrlight"><td align="center">Subject:</td><td><input type="text" name="subject" id="subject" maxlength="255" size="82" value="<?php echo $subject ?>"></td></tr>
<tr class="sabrinatrlight"><td align="center">URL:</td><td><input type="text" name="url" id="url" maxlength="255" size="82" value="<?php echo $url ?>"></td></tr>
<tr class="sabrinatrlight"><td align="center" valign="top">Ad Body:</td><td><textarea name="adbody" id="adbody" rows="20" cols="65"><?php echo $adbody ?></textarea></td></tr>
<?php
if ($solosaveads > 0)
{
?>
<tr class="sabrinatrlight"><td>Save Ad</td><td><input type="checkbox" name="save" id="save" value="1"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight">
<td align="center" colspan="2">
<input type="hidden" name="saveid" id="saveid" value="">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="action" value="send">
<input type="submit" value="SUBMIT" class="sendit">
</form>
</td>
</tr>
</table>
</td></tr>
<?php
			} # if ($nextpostrows > 0)
		} # if ($adtype == "solos")
####################################################
		if (($adtype == "banners") or ($adtype == "buttons"))
		{
			if ($adtype == "banners")
			{
			$maxsaveads = $bannersaveads;
			$windowwidth = "500";
			$windowheight = "75";
			}
			if ($adtype != "banners")
			{
			$maxsaveads = $buttonsaveads;
			$windowwidth = "150";
			$windowheight = "125";
			}
			############################################# START SAVED BANNERS / BUTTONS
			$savedq = "select * from $adtype_saved where userid=\"$userid\"";
			$savedr = mysql_query($savedq);
			$savedrows = mysql_num_rows($savedr);
			if ($savedrows > 0)
			{
			?>
			<tr class="sabrinatrlight"><td align="center">
			<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable">
			<tr class="sabrinatrlight"><td align="center" colspan="2">Your Saved <?php echo $showadtype ?> Ads</td></tr>
			<tr class="sabrinatrlight"><td colspan="2">Select an ad campaign from the ones you've saved below, or enter a new one.</td></tr>
			<tr class="sabrinatrlight"><td>Saved <?php echo $showadtype ?> Ads Allowed:</td><td><?php echo $maxsaveads ?></td></tr>
			<tr class="sabrinatrlight"><td>Your Saved <?php echo $showadtype ?> Ads:</td><td><?php echo $savedrows ?></td></tr>
			<tr class="sabrinatrlight"><td colspan="2">If you have reached the maximum saved ads, you will need to open and delete one before saving a new one.</td></tr>
			<form action="postads.php" method="post">
			<tr class="sabrinatrlight"><td colspan="2">Saved <?php echo $showadtype ?> Campaigns: </td></tr>
			<tr class="sabrinatrlight"><td colspan="2" align="center"><select name="bannersavedchoice" id="bannersavedchoice" onchange="changeBannerHiddenInput(this)">
			<option value=""> - Select Saved Ad - </option>
			<?php
			while ($savedrowz = mysql_fetch_array($savedr))
				{
				$savedid = $savedrowz["id"];
				$savedname = $savedrowz["name"];
				$savedname = stripslashes($savedname);
				$savedname = str_replace('\\', '', $savedname); 
				$savedbannerurl = $savedrowz["bannerurl"];
				$savedtargeturl = $savedrowz["targeturl"];
			?>
			<option value="<?php echo $savedid ?>||<?php echo $savedname ?>||<?php echo $savedbannerurl ?>||<?php echo $savedtargeturl ?>"><?php echo $savedname ?></option>
			<?php
				}
			?>
			</select>&nbsp;&nbsp;<input type="hidden" name="deleteid" id="deleteid" value=""><input type="hidden" name="adtype" value="<?php echo $adtype ?>"><input type="hidden" name="action" value="delete"><input type="submit" value="Delete Saved" class="sendit" style="font-size: 10px;"></td></tr></form>
			</table>
			</td></tr>
			<?php		
			} # if ($savedrows > 0)
			############################################# END SAVED BANNERS / BUTTONS

		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$name = $adrowz["name"];
		$name = stripslashes($name);
		$bannerurl = $adrowz["bannerurl"];
		$targeturl = $adrowz["targeturl"];
?>
<tr class="sabrinatrlight"><td align="center">
<table width="600" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<form method="post" name="theform" id="theform" action="postads.php">
<tr class="sabrinatrlight"><td align="center" colspan="2">Post <?php echo $showadtype ?> Ad</td></tr>
<form action="postads.php" method="post">
<tr class="sabrinatrlight"><td><?php echo $showadtype ?>&nbsp;Name:</td><td><input type="text" name="name" id="name" maxlength="255" size="78" value="<?php echo $name ?>"></td></tr>
<tr class="sabrinatrlight"><td><?php echo $showadtype ?>&nbsp;URL:</td><td><input type="text" name="bannerurl" id="bannerurl" maxlength="255" size="78" value="<?php echo $bannerurl ?>"></td></tr>
<tr class="sabrinatrlight"><td>Target&nbsp;URL:</td><td><input type="text" name="targeturl" id="targeturl" maxlength="255" size="78" value="<?php echo $targeturl ?>"></td></tr>
<?php
if ($maxsaveads > 0)
{
?>
<tr class="sabrinatrlight"><td>Save Ad</td><td><input type="checkbox" name="save" id="save" value="1"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight">
<td align="center" colspan="2">
<script language="JavaScript">
function previewad(bannerurl,targeturl)
{
var win
win = window.open("", "win", "height=<?php echo $windowheight ?>,width=<?php echo $windowwidth ?>,toolbar=no,directories=no,menubar=no,scrollbars=yes,resizable=yes,dependent=yes'");
win.document.clear();
win.document.write('<a href="'+targeturl+'"><img src="'+bannerurl+'" border="0"></a>');
win.focus();
win.document.close();
}
</script>
<input type="button" value="PREVIEW" onclick="previewad(bannerurl.value, targeturl.value)" class="sendit">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="saveid" id="saveid" value="">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="send">
<input type="submit" name="submit" value="SUBMIT" class="sendit">
</form>	
</td>
</tr>
</table>
</td></tr>
<?php
		} # if ($adtype == "banners")
####################################################
		if ($adtype == "textads")
		{	
			############################################# START SAVED TEXT ADS
			$savedq = "select * from textads_saved where userid=\"$userid\"";
			$savedr = mysql_query($savedq);
			$savedrows = mysql_num_rows($savedr);
			if ($savedrows > 0)
			{
			?>
			<tr class="sabrinatrlight"><td align="center">
			<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable">
			<tr class="sabrinatrlight"><td align="center" colspan="2">Your Saved <?php echo $showadtype ?> Ads</td></tr>
			<tr class="sabrinatrlight"><td colspan="2">Select an ad campaign from the ones you've saved below, or enter a new one.</td></tr>
			<tr class="sabrinatrlight"><td>Saved <?php echo $showadtype ?> Ads Allowed:</td><td><?php echo $textadsaveads ?></td></tr>
			<tr class="sabrinatrlight"><td>Your Saved <?php echo $showadtype ?> Ads:</td><td><?php echo $savedrows ?></td></tr>
			<tr class="sabrinatrlight"><td colspan="2">If you have reached the maximum saved ads, you will need to open and delete one before saving a new one.</td></tr>
			<form action="postads.php" method="post">
			<tr class="sabrinatrlight"><td colspan="2">Saved <?php echo $showadtype ?> Campaigns: </td></tr>
			<tr class="sabrinatrlight"><td colspan="2" align="center"><select name="textadsavedchoice" id="textadsavedchoice" onchange="changeTextAdHiddenInput(this)">
			<option value=""> - Select Saved Ad - </option>
			<?php
			while ($savedrowz = mysql_fetch_array($savedr))
				{
				$savedid = $savedrowz["id"];
				$savedheading = $savedrowz["heading"];
				$savedheading = stripslashes($savedheading);
				$savedheading = str_replace('\\', '', $savedheading);
				$savedurl = $savedrowz["url"];
				$saveddescription = $savedrowz["description"];
				$saveddescription = stripslashes($saveddescription);
				$saveddescription = str_replace('\\', '', $saveddescription);
			?>
			<option value="<?php echo $savedid ?>||<?php echo $savedheading ?>||<?php echo $savedurl ?>||<?php echo $saveddescription ?>"><?php echo $savedheading ?></option>
			<?php
				}
			?>
			</select>&nbsp;&nbsp;<input type="hidden" name="deleteid" id="deleteid" value=""><input type="hidden" name="adtype" value="<?php echo $adtype ?>"><input type="hidden" name="action" value="delete"><input type="submit" value="Delete Saved" class="sendit" style="font-size: 10px;"></td></tr></form>
			</table>
			</td></tr>
			<?php		
			} # if ($savedrows > 0)
			############################################# END SAVED TEXT ADS
			
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$heading = $adrowz["heading"];
		$heading = stripslashes($heading);
		$heading = str_replace('\\', '', $heading);
		$url = $adrowz["url"];
		$description = $adrowz["description"];
		$description = stripslashes($description);
		$description = str_replace('\\', '', $description);
?>
<tr class="sabrinatrlight"><td align="center">
<table width="600" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<form method="post" name="theform" id="theform" action="postads.php">
<tr class="sabrinatrlight"><td align="center" colspan="2">Post <?php echo $showadtype ?> Ad</td></tr>
<tr class="sabrinatrlight"><td align="center" colspan="2">No ADULT, Offensive Or Illegal Ads (Including PYRAMID Schemes And Chainletters)</td></tr>
<tr class="sabrinatrlight"><td align="center">Heading:</td><td><input type="text" name="heading" id="heading" maxlength="255" size="82" value="<?php echo $heading ?>"></td></tr>
<tr class="sabrinatrlight"><td align="center">URL:</td><td><input type="text" name="url" id="url" maxlength="255" size="82" value="<?php echo $url ?>"></td></tr>
<tr class="sabrinatrlight"><td align="center">Description (no URLs):</td><td><input type="text" name="description" id="description" maxlength="255" size="82" value="<?php echo $description ?>"></td></tr>
<?php
if ($textadsaveads > 0)
{
?>
<tr class="sabrinatrlight"><td>Save Ad</td><td><input type="checkbox" name="save" id="save" value="1"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight">
<td align="center" colspan="2">
<input type="button" value="PREVIEW" onclick="javascript:window.open(url.value);" class="sendit">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="saveid" id="saveid" value="">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="send">
<input type="submit" name="submit" value="SUBMIT" class="sendit">
</form>	
</td>
</tr>
</table>
</td></tr>
<?php
		} # if ($adtype == "textads")
####################################################
		if ($adtype == "fullloginads")
		{
			############################################# START SAVED FULL PAGE LOGIN ADS
			$savedq = "select * from $adtype_saved where userid=\"$userid\"";
			$savedr = mysql_query($savedq);
			$savedrows = mysql_num_rows($savedr);
			if ($savedrows > 0)
			{
			$saveads = $fullloginadsaveads;
			?>
			<tr class="sabrinatrdark"><td align="center">
			<table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable">
			<tr class="sabrinatrlight"><td align="center" colspan="2">Your Saved <?php echo $showadtype ?> Ads</td></tr>
			<tr class="sabrinatrlight"><td colspan="2">Select an ad campaign from the ones you've saved below, or enter a new one.</td></tr>
			<tr class="sabrinatrlight"><td>Saved <?php echo $showadtype ?> Ads Allowed:</td><td><?php echo $saveads ?></td></tr>
			<tr class="sabrinatrlight"><td>Your Saved <?php echo $showadtype ?> Ads:</td><td><?php echo $savedrows ?></td></tr>
			<tr class="sabrinatrlight"><td colspan="2">If you have reached the maximum saved ads, you will need to open and delete one before saving a new one.</td></tr>
			<form action="postads.php" method="post">
			<tr class="sabrinatrlight"><td colspan="2">Saved <?php echo $showadtype ?> Campaigns: </td></tr>
			<tr class="sabrinatrlight"><td colspan="2" align="center"><select name="hotlinksavedchoice" id="hotlinksavedchoice" onchange="changeHotLinkHiddenInput(this)">
			<option value=""> - Select Saved Ad - </option>
			<?php
			while ($savedrowz = mysql_fetch_array($savedr))
				{
				$savedid = $savedrowz["id"];
				$savedsubject = $savedrowz["subject"];
				$savedsubject = stripslashes($savedsubject);
				$savedsubject = str_replace('\\', '', $savedsubject);
				$savedurl = $savedrowz["url"];
			?>
			<option value="<?php echo $savedid ?>||<?php echo $savedsubject ?>||<?php echo $savedurl ?>"><?php echo $savedsubject ?></option>
			<?php
				}
			?>
			</select>&nbsp;&nbsp;<input type="hidden" name="deleteid" id="deleteid" value=""><input type="hidden" name="adtype" value="<?php echo $adtype ?>"><input type="hidden" name="action" value="delete"><input type="submit" value="Delete Saved" class="sendit" style="font-size: 10px;"></td></tr></form>
			</table>
			</td></tr>
			<?php		
			} # if ($savedrows > 0)
			############################################# END SAVED FULL PAGE LOGIN ADS
			
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$url = $adrowz["url"];
?>
<tr class="sabrinatrdark"><td align="center">
<table width="600" cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable">
<form method="post" name="theform" id="theform" action="postads.php">
<tr class="sabrinatrlight"><td align="center" colspan="2">Post <?php echo $showadtype ?> Ad</td></tr>
<tr class="sabrinatrlight"><td align="center" colspan="2">No ADULT, Offensive Or Illegal Ads (Including PYRAMID Schemes And Chainletters)</td></tr>
<tr class="sabrinatrlight"><td align="center">Subject:</td><td><input type="text" name="subject" id="subject" maxlength="255" size="82" value="<?php echo $subject ?>"></td></tr>
<tr class="sabrinatrlight"><td align="center">URL:</td><td><input type="text" name="url" id="url" maxlength="255" size="82" value="<?php echo $url ?>"></td></tr>
<?php
if ($saveads > 0)
{
?>
<tr class="sabrinatrlight"><td>Save Ad</td><td><input type="checkbox" name="save" id="save" value="1"></td></tr>
<?php
}
?>
<tr class="sabrinatrdark">
<td align="center" colspan="2">
<input type="button" value="PREVIEW" onclick="javascript:window.open(url.value);" class="sendit">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="saveid" id="saveid" value="">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="send">
<input type="submit" name="submit" value="SUBMIT" class="sendit">
</form>	
</td>
</tr>
</table>
</td></tr>
<?php
		} # if ($adtype == "fullloginads")



	} # while ($adrowz = mysql_fetch_array($adr))
?>
</table>
</td></tr>
<?php
	} # if ($adrows > 0)
} # if ($adtype != "")
?>
</table>
<br><br><br><br>
<?php
include "footer.php";
exit;
?>