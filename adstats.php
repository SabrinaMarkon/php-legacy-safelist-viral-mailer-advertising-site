<?php
include "control.php";
include "header.php";
include "banners.php";
$action = $_POST['action'];
$show = "";
$adtype = $_REQUEST["adtype"];
##############################
if ($action == "delete")
{
$id = $_POST["id"];
$delq = "delete from $adtype where id=\"$id\"";
$delr = mysql_query($delq);
	if ($adtype == "solos")
	{
	$delq2 = "delete from solos_viewed where adid=\"$id\"";
	$delr2 = mysql_query($delq2);
	}
	if ($adtype == "banners")
	{
	$delq2 = "delete from bannerviews where blid=\"$id\"";
	$delr2 = mysql_query($delq2);
	}
	if ($adtype == "buttons")
	{
	$delq2 = "delete from buttonviews where blid=\"$id\"";
	$delr2 = mysql_query($delq2);
	}
	if ($adtype == "textads")
	{
	$delq2 = "delete from textadviews where adid=\"$id\"";
	$delr2 = mysql_query($delq2);
	}
	if ($adtype == "fullloginads")
	{
	$delq2 = "delete from fullloginadviews where adid=\"$id\"";
	$delr2 = mysql_query($delq2);
	}
$show = "The ad was deleted.";
} # if ($action == "delete")
##############################
if ($adtype == "banners")
{
$showadtype = "Banner";
$adq = "select * from banners where userid='$userid' and added=1 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "buttons")
{
$showadtype = "Button";
$adq = "select * from buttons where userid='$userid' and added=1 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "textads")
{
$showadtype = "Text Ad";
$adq = "select * from textads where userid='$userid' and added=1 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "solos")
{
$showadtype = "Solo";
$adq = "select * from solos where userid='$userid' and added=1 order by datesent desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "fullloginads")
{
$showadtype = "Full Page Login";
$adq = "select * from fullloginads where userid='$userid' and added=1 order by purchase desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
else
{
$showadtype = "";
$adrows = 0;
}
################################################################################################
$bannerq = "select * from banners where userid='$userid' and added=1 order by purchase desc";
$bannerr = mysql_query($bannerq);
$bannerrows = mysql_num_rows($bannerr);

$buttonq = "select * from buttons where userid='$userid' and added=1 order by purchase desc";
$buttonr = mysql_query($buttonq);
$buttonrows = mysql_num_rows($buttonr);

$textadq = "select * from textads where userid='$userid' and added=1 order by purchase desc";
$textadr = mysql_query($textadq);
$textadrows = mysql_num_rows($textadr);

$soloq = "select * from solos where userid='$userid' and added=1 order by datesent desc";
$solor = mysql_query($soloq);
$solorows = mysql_num_rows($solor);

$fullloginadq = "select * from fullloginads where userid='$userid' and added=1 order by purchase desc";
$fullloginadr = mysql_query($fullloginadq);
$fullloginadrows = mysql_num_rows($fullloginadr);
################################################################################################
?>
<table cellpadding="4" cellspacing="4" border="0" align="center">

<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Members Area Ad Stats Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2">
<form action="adstats.php" method="post" name="viewform" id="viewform">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrdark"><td align="center" colspan="2">Your&nbsp;<?php echo $sitename ?>&nbsp;Ad&nbsp;Stats</td></tr>
<tr class="sabrinatrlight"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrlight"><td>Your Total Active Solo Ads:</td><td align="center"><?php echo $solorows ?></td></tr>
<tr class="sabrinatrlight"><td>Your Total Active Banner Ads:</td><td align="center"><?php echo $bannerrows ?></td></tr>
<tr class="sabrinatrlight"><td>Your Total Active Button Ads:</td><td align="center"><?php echo $buttonrows ?></td></tr>
<tr class="sabrinatrlight"><td>Your Total Active Text Ads:</td><td align="center"><?php echo $textadrows ?></td></tr>
<tr class="sabrinatrlight"><td>Your Total Active Full Page Login Ads:</td><td align="center"><?php echo $fullloginadrows ?></td></tr>
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
<tr class="sabrinatrlight"><td align="center" colspan="2">No <?php echo $showadtype ?> Ads</td></tr>
<?php
}
if ($adrows > 0)
{
?>
<tr class="sabrinatrdark"><td align="center" colspan="2">View <?php echo $showadtype ?> Ad Stats</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" bgcolor="gold" align="center">
<?php
if ($adtype == "solos")
{
?>
<tr class="sabrinatrdark">
<td align="center">ID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Ad Body</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Sent</td>
<td align="center">Date Sent</td>
<td align="center">Clicks</td>
<td align="center">Delete</td>
</tr>
<?php
}
if ($adtype == "banners")
{
?>
<tr class="sabrinatrdark">
<td align="center">ID</td>
<td align="center">Banner</td>
<td align="center">Name</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Clicks</td>
<td align="center">Delete</td>
</tr>
<?php
}
if ($adtype == "buttons")
{
?>
<tr class="sabrinatrdark">
<td align="center">ID</td>
<td align="center">Button</td>
<td align="center">Name</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Clicks</td>
<td align="center">Delete</td>
</tr>
<?php
}
if ($adtype == "textads")
{
?>
<tr class="sabrinatrdark">
<td align="center">ID</td>
<td align="center">Text Ad</td>
<td align="center">Heading</td>
<td align="center">URL</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Clicks</td>
<td align="center">Delete</td>
</tr>
<?php
}
if ($adtype == "fullloginads")
{
?>
<tr class="sabrinatrdark">
<td align="center">ID</td>
<td align="center">Subject</td>
<td align="center">URL</td>
<td align="center">Date Ordered</td>
<td align="center">Added</td>
<td align="center">Approved</td>
<td align="center">Maximum Hits</td>
<td align="center">Hits</td>
<td align="center">Delete</td>
</tr>
<?php
}
while ($adrowz = mysql_fetch_array($adr))
	{
		if ($adtype == "solos")
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
			$showdatesent = "NO";
			}
		$clicks = $adrowz["clicks"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
?>
<form action="adstats.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $id ?></td>
<td align="center"<?php echo $subject ?></td>
<td align="center"><a href="<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><div style="width: 400px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #eeeeee; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
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
		} # if ($adtype == "solos")
		if (($adtype == "banners") or ($adtype == "buttons"))
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$name = $adrowz["name"];
		$name = stripslashes($name);
		$bannerurl = $adrowz["bannerurl"];
		$targeturl = $adrowz["targeturl"];
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
		if ($adtype == "banners")
			{
			$showwidth = "200";
			}
		if ($adtype != "banners")
			{
			$showwidth = "75";
			}
?>
<form action="adstats.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $id ?></td>
<td align="center"><a href="<?php echo $targeturl ?>" target="_blank"><img src="<?php echo $bannerurl ?>" border="0" alt="<?php echo $name ?>" width="<?php echo $showwidth ?>"></a></td>
<td align="center"><?php echo $name ?></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $hits ?></td>
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
		} # if (($adtype == "banners") or ($adtype == "buttons"))
		if ($adtype == "textads")
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
<form action="adstats.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $id ?></td>
<td align="center"><div style="width: 262px; height: 200px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #eeeeee; background: #ffffff; color: #000000;"><br><a href="<?php echo $url ?>" target="_blank"><?php echo $heading ?></a><br><br><?php echo $description ?></div></td>
<td align="center"><?php echo $heading ?></td>
<td align="center"><a href="sitecheck.php?url=<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $hits ?></td>
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
		} # if ($adtype == "textads")
		if ($adtype == "fullloginads")
		{
		$id = $adrowz["id"];
		$userid = $adrowz["userid"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
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
		$hits = $adrowz["hits"];
		$max = $adrowz["max"];
		$purchase = $adrowz["purchase"];
		$purchase = date("M d Y", $purchase);
?>
<form action="adstats.php" method="post">
<tr class="sabrinatrlight">
<td align="center"><?php echo $id ?></td>
<td align="center"><?php echo $subject ?></td>
<td align="center"><a href="<?php echo $url ?>" target="_blank"><?php echo $url ?></a></td>
<td align="center"><?php echo $purchase ?></td>
<td align="center"><?php echo $showadded ?></td>
<td align="center"><?php echo $showapproved ?></td>
<td align="center"><?php echo $max ?></td>
<td align="center"><?php echo $hits ?></td>
<td align="center">
<input type="hidden" name="adtype" value="<?php echo $adtype ?>">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="hidden" name="action" value="delete">
<input type="submit" name="submit" value="DELETE">
</form>	
</td>
</tr>
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
</table><br><br>
</td></tr>

</table>
<br><br><br><br>
<?php
include "footer.php";
exit;
?>