<?php
include "control.php";
include "../header.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
$action = $_POST['action'];
$show = "";
$error = "";
$adtype = $_REQUEST["adtype"];
################################################################################################
if ($action == "delete")
{
$id = $_POST['id'];
	if ($adtype == "adminemails")
	{
		$showadtype = "Admin Email";
		mysql_query("delete from adminemails where id='$id'");
		mysql_query("delete from adminemails_viewed where adid='$id'");
	}
	if (($adtype == "solos") or ($adtype == "solosall") or ($adtype == "solosneedtomail"))
	{
		$showadtype = "Solo";
		mysql_query("delete from solos where id='$id'");
		mysql_query("delete from solos_viewed where adid='$id'");
	}
	if (($adtype == "banners") or ($adtype == "bannersall"))
	{
		$showadtype = "Banner";
		mysql_query("delete from banners where id='$id'");
		mysql_query("delete from bannerviews where blid='$id'");
	}
	if (($adtype == "buttons") or ($adtype == "buttonsall"))
	{
		$showadtype = "Button";
		mysql_query("delete from buttons where id='$id'");
		mysql_query("delete from buttonviews where blid='$id'");
	}
	if (($adtype == "textads") or ($adtype == "textadsall"))
	{
		$showadtype = "Text";
		mysql_query("delete from textads where id='$id'");
		mysql_query("delete from textadviews where adid='$id'");
	}
	if (($adtype == "fullloginads") or ($adtype == "fullloginadsall"))
	{
		$showadtype = "Full Page Login";
		mysql_query("delete from fullloginads where id='$id'");
		mysql_query("delete from fullloginadviews where adid='$id'");
	}
$show = "The " . $showadtype . " Ad was deleted.";
} # if ($action == "delete")
################################################################################################
if ($adtype == "adminemails")
{
$showadtype = "Admin Email";
$adq = "select * from adminemails order by id desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "solos")
{
$showadtype = "Solo";
$adq = "select * from solos where approved=1 and userid!='admin' order by sent,datesent desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "solosall")
{
$showadtype = "Solo";
$adq = "select * from solos where userid!='admin' order by approved desc,datesent desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "solosneedtomail")
{
$showadtype = "Solo";
$adq = "select * from solos where userid!='admin' and approved=1 and sent=0 order by approved";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "banners")
{
$showadtype = "Banner";
$adq = "select * from banners where approved=1 order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "bannersall")
{
$showadtype = "Banner";
$adq = "select * from banners order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "buttons")
{
$showadtype = "Button";
$adq = "select * from buttons where approved=1 order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "buttonsall")
{
$showadtype = "Button";
$adq = "select * from buttons order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "textads")
{
$showadtype = "Text";
$adq = "select * from textads where approved=1 order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "textadsall")
{
$showadtype = "Text";
$adq = "select * from textads order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "fullloginads")
{
$showadtype = "Full Page Login";
$adq = "select * from fullloginads where approved=1 order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "fullloginadsall")
{
$showadtype = "Full Page Login";
$adq = "select * from fullloginads order by approved desc,purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
else
{
$showadtype = "";
$adrows = 0;
}
################################################################################################
$adminemailq = "select * from adminemails order by id desc";
$adminemailr = mysql_query($adminemailq);
$adminemailrows = mysql_num_rows($adminemailr);

$soloq = "select * from solos order by purchase desc";
$solor = mysql_query($soloq);
$solorows = mysql_num_rows($solor);

$bannerq = "select * from banners order by purchase desc";
$bannerr = mysql_query($bannerq);
$bannerrows = mysql_num_rows($bannerr);

$buttonq = "select * from buttons order by purchase desc";
$buttonr = mysql_query($buttonq);
$buttonrows = mysql_num_rows($buttonr);

$textadq = "select * from textads order by purchase desc";
$textadr = mysql_query($textadq);
$textadrows = mysql_num_rows($textadr);

$fullloginadq = "select * from fullloginads order by purchase desc";
$fullloginadr = mysql_query($fullloginadq);
$fullloginadrows = mysql_num_rows($fullloginadr);
################################################################################################
?>
<table cellpadding="4" cellspacing="4" border="0" align="center">
<tr><td align="center" colspan="2"><div class="heading">View&nbsp;Ads</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2"><br>
<form action="viewads.php" method="post" name="viewform" id="viewform">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrlight"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrlight"><td>Total Admin Emails:</td><td align="center"><?php echo $adminemailrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Solo Ads:</td><td align="center"><?php echo $solorows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Banner Ads:</td><td align="center"><?php echo $bannerrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Button Ads:</td><td align="center"><?php echo $buttonrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Text Ads:</td><td align="center"><?php echo $textadrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Full Page Login Ads:</td><td align="center"><?php echo $fullloginadrows ?></td></tr>
</table>
</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<select name="adtype" id="adtype" onchange="this.form.submit();">
<option value="" <?php if ($adtype == "") { echo "selected"; } ?>> - Select Ad Type - </option>
<option value="adminemails" <?php if ($adtype == "adminemails") { echo "selected"; } ?>>Admin Emails</option>
<option value="solos" <?php if ($adtype == "solos") { echo "selected"; } ?>>Solo Ads - Approved</option>
<option value="solosneedtomail" <?php if ($adtype == "solosneedtomail") { echo "selected"; } ?>>Solo Ads - Waiting in Queue to Mail Out</option>
<option value="solosall" <?php if ($adtype == "solosall") { echo "selected"; } ?>>Solo Ads - All</option>
<option value="banners" <?php if ($adtype == "banners") { echo "selected"; } ?>>Banner Ads - Approved</option>
<option value="bannersall" <?php if ($adtype == "bannersall") { echo "selected"; } ?>>Banner Ads - All</option>
<option value="buttons" <?php if ($adtype == "buttons") { echo "selected"; } ?>>Button Ads - Approved</option>
<option value="buttonsall" <?php if ($adtype == "buttonsall") { echo "selected"; } ?>>Button Ads - All</option>
<option value="textads" <?php if ($adtype == "textads") { echo "selected"; } ?>>Text Ads - Approved</option>
<option value="textadsall" <?php if ($adtype == "textadsall") { echo "selected"; } ?>>Text Ads - All</option>
<option value="fullloginads" <?php if ($adtype == "fullloginads") { echo "selected"; } ?>>Full Page Login Ads - Approved</option>
<option value="fullloginadsall" <?php if ($adtype == "fullloginadsall") { echo "selected"; } ?>>Full Page Login Ads - All</option>
</select></form></td></tr>
<?php
if ($adtype != "")
{
if ($adrows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">No <?php echo $showadtype ?> Ads</td></tr>
<?php
}
if ($adrows > 0)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">View <?php echo $showadtype ?> Ads</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<?php
if ($adtype == "adminemails")
{
?>
<tr class="sabrinatrdark">
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Ad Body</td>
<td align="center">Sent</td>
<td align="center">Date Sent</td>
<td align="center">Total Clicks</td>
<td align="center">Delete</td>
</tr>
<?php
}
if (($adtype == "solos") or ($adtype == "solosall") or ($adtype == "solosneedtomail"))
{
?>
<tr class="sabrinatrdark">
<td align="center">UserID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Ad Body</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Sent</td>
<td align="center">Date Sent</td>
<td align="center">Clicks</td>
<td align="center">Contact Member</td>
<td align="center">Delete</td>
</tr>
<?php
}
if (($adtype == "banners") or ($adtype == "bannersall"))
{
?>
<tr class="sabrinatrdark">
<td align="center">UserID</td>
<td align="center">Banner</td>
<td align="center">Name</td>
<td align="center">Banner URL</td>
<td align="center">Target URL</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Clicks</td>
<td align="center">Contact Member</td>
<td align="center">Delete</td>
</tr>
<?php
}
if (($adtype == "buttons") or ($adtype == "buttonsall"))
{
?>
<tr class="sabrinatrdark">
<td align="center">UserID</td>
<td align="center">Button</td>
<td align="center">Name</td>
<td align="center">Button URL</td>
<td align="center">Target URL</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Clicks</td>
<td align="center">Contact Member</td>
<td align="center">Delete</td>
</tr>
<?php
}
if (($adtype == "textads") or ($adtype == "textadsall"))
{
?>
<tr class="sabrinatrdark">
<td align="center">UserID</td>
<td align="center">Text Ad</td>
<td align="center">Heading</td>
<td align="center">URL</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Clicks</td>
<td align="center">Contact Member</td>
<td align="center">Delete</td>
</tr>
<?php
}
if (($adtype == "fullloginads") or ($adtype == "fullloginadsall"))
{
?>
<tr class="sabrinatrdark">
<td align="center">UserID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Contact Member</td>
<td align="center">Delete</td>
</tr>
<?php
}
while ($adrowz = mysql_fetch_array($adr))
	{
		if ($adtype == "adminemails")
		{
		$id = $adrowz["id"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$adbody = $adrowz["adbody"];
		$adbody = stripslashes($adbody);
		$adbody = str_replace('\\', '', $adbody);
		$url = $adrowz["url"];
		$sent = $adrowz["sent"];
		$datesent = $adrowz["datesent"];
		if ($sent == 1)
			{
			$showsent = "YES";
			$showdatesent = date("M d Y", $datesent);
			}
		if ($sent != 1)
			{
			$showsent = "NO";
			$showdatesent = "N/A";
			}
		$clicks = $adrowz["clicks"];
?>
<form action="viewads.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $subject ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><div style="width: 400px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td>
<td align="center"><?php echo $showsent ?></td>
<td align="center"><?php echo $showdatesent ?></td>
<td align="center"><?php echo $clicks ?></td>
<td align="center">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" name="submit" value="DELETE">
</form>	
</td>
</tr>
<?php
		}
		if (($adtype == "solos") or ($adtype == "solosall") or ($adtype == "solosneedtomail"))
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$adbody = $adrowz["adbody"];
		$adbody = stripslashes($adbody);
		$adbody = str_replace('\\', '', $adbody);
		$url = $adrowz["url"];
		$added = $adrowz["added"];
		if ($added == 1)
			{
			$showadded = "YES";
			}
		if ($added != 1)
			{
			$showadded = "NO";
			}
		$approved = $adrowz["approved"];
		if ($approved == 1)
			{
			$showapproved = "YES";
			}
		if ($approved != 1)
			{
			$showapproved = "NO";
			}
		$sent = $adrowz["sent"];
		$datesent = $adrowz["datesent"];
		if ($sent == 1)
			{
			$showsent = "YES";
			$showdatesent = date("M d Y", $datesent);
			}
		if ($sent != 1)
			{
			$showsent = "NO";
			$showdatesent = "N/A";
			}
		$clicks = $adrowz["clicks"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
		$emailq = "select * from members where userid=\"$userid\"";
		$emailr = mysql_query($emailq);
		$emailrows = mysql_num_rows($emailr);
		if ($emailrows > 0)
			{
			$memberemail = mysql_result($emailr,0,"email");
			}
?>
<form action="viewads.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $userid ?></td>
<td align="center"><?php echo $subject ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><div style="width: 400px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $showsent ?></td>
<td align="center"><?php echo $showdatesent ?></td>
<td align="center"><?php echo $clicks ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
<td align="center">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" name="submit" value="DELETE">
</form>	
</td>
</tr>
<?php
		} # if (($adtype == "solos") or ($adtype == "solosall") or ($adtype == "solosneedtomail"))
		if (($adtype == "banners") or ($adtype == "bannersall") or ($adtype == "buttons") or ($adtype == "buttonsall"))
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$name = $adrowz["name"];
		$name = stripslashes($name);
		$bannerurl = $adrowz["bannerurl"];
		$targeturl = $adrowz["targeturl"];
		$max = $adrowz["max"];
		$added = $adrowz["added"];
		$orderedfrom = $adrowz["orderedfrom"];
		if ($added == 1)
			{
			$showadded = "YES";
			}
		if ($added != 1)
			{
			$showadded = "NO";
			}
		$approved = $adrowz["approved"];
		if ($approved == 1)
			{
			$showapproved = "YES";
			}
		if ($approved != 1)
			{
			$showapproved = "NO";
			}
		$hits = $adrowz["hits"];
		$clicks = $adrowz["clicks"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
		$emailq = "select * from members where userid=\"$userid\"";
		$emailr = mysql_query($emailq);
		$emailrows = mysql_num_rows($emailr);
		if ($emailrows > 0)
			{
			$memberemail = mysql_result($emailr,0,"email");
			}
		if ($adtype == "banners")
			{
			$showwidth = "200";
			}
		if ($adtype != "banners")
			{
			$showwidth = "75";
			}
?>
<form action="viewads.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $userid ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $targeturl ?>" target="_blank"><img src="<?php echo $bannerurl ?>" border="0" alt="<?php echo $name ?>" width="<?php echo $showwidth ?>"></a></td>
<td align="center"><?php echo $name ?></td>
<td align="center"><?php echo $bannerurl ?></td>
<td align="center"><?php echo $targeturl ?></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $hits ?></td>
<td align="center"><?php echo $clicks ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
<td align="center">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" name="submit" value="DELETE">
</form>	
</td>
</tr>
<?php
		} # if (($adtype == "banners") or ($adtype == "bannersall") or ($adtype == "buttons") or ($adtype == "buttonsall"))
		if (($adtype == "textads") or ($adtype == "textadsall"))
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$heading = $adrowz["heading"];
		$heading = stripslashes($heading);
		$description = $adrowz["description"];
		$description = stripslashes($description);
		$description = str_replace('\\', '', $description);
		$url = $adrowz["url"];
		$max = $adrowz["max"];
		$added = $adrowz["added"];
		if ($added == 1)
			{
			$showadded = "YES";
			}
		if ($added != 1)
			{
			$showadded = "NO";
			}
		$approved = $adrowz["approved"];
		if ($approved == 1)
			{
			$showapproved = "YES";
			}
		if ($approved != 1)
			{
			$showapproved = "NO";
			}
		$hits = $adrowz["hits"];
		$clicks = $adrowz["clicks"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
?>
<form action="viewads.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $userid ?></td>
<td align="center"><div style="width: 262px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><a href="<?php echo $url ?>" target="_blank"><?php echo $heading ?></a><br><br><?php echo $description ?></div></td>
<td align="center"><?php echo $heading ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $hits ?></td>
<td align="center"><?php echo $clicks ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
<td align="center">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" name="submit" value="DELETE">
</form>	
</td>
</tr>
<?php
		} # if (($adtype == "textads") or ($adtype == "textadsall"))
		if (($adtype == "fullloginads") or ($adtype == "fullloginadsall"))
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$url = $adrowz["url"];
		$max = $adrowz["max"];
		$added = $adrowz["added"];
		if ($added == 1)
			{
			$showadded = "YES";
			}
		if ($added != 1)
			{
			$showadded = "NO";
			}
		$approved = $adrowz["approved"];
		if ($approved == 1)
			{
			$showapproved = "YES";
			}
		if ($approved != 1)
			{
			$showapproved = "NO";
			}
		$hits = $adrowz["hits"];
		$clicks = $adrowz["clicks"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
?>
<form action="viewads.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $userid ?></td>
<td align="center"><?php echo $subject ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $hits ?></td>
<td align="center"><a href="contactmembers.php?userid=<?php echo $userid ?>">Email</a></td>
<td align="center">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" name="submit" value="DELETE">
</form>	
</td>
</tr>
<?php
		} # if (($adtype == "fullloginads") or ($adtype == "fullloginadsall"))
	} # while ($adrowz = mysql_fetch_array($adr))
?>
</table>
</td></tr>
<?php
	} # if ($adrows > 0)
} # if ($adtype != "")
?>
</table><br><br>
</td></tr></table>

<?php
include "../footer.php";
exit;
?>