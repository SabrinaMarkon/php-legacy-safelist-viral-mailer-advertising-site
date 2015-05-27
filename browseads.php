<?php
include "control.php";
include "header.php";
include "banners.php";
$action = $_POST['action'];
$show = "";
$adtype = $_REQUEST["adtype"];
if ($accounttype == "PAID")
{
$adminemailscredits = $adminemailscreditspaid;
$soloscredits = $soloscreditspaid;
$bannerscredits = $bannerscreditspaid;
$buttonscredits = $buttonscreditspaid;
$textadscredits = $textadscreditspaid;
$fullloginadscredits = $fullloginadscreditspaid;
}
if ($accounttype != "PAID")
{
$adminemailscredits = $adminemailscreditsfree;
$soloscredits = $soloscreditsfree;
$bannerscredits = $bannerscreditsfree;
$buttonscredits = $buttonscreditsfree;
$textadscredits = $textadscreditsfree;
$fullloginadscredits = $fullloginadscreditsfree;
}
if ($adtype == "adminemails")
{
$showadtype = "Admin Email";
$adq = "select h.* from adminemails h where sent=1 order by datesent desc";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "solos")
{
$showadtype = "Solo";
$adq = "select h.* from solos h where h.approved=1 and sent=1 and h.id NOT IN (select adid from solos_viewed where userid = '$userid') order by rand()";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "banners")
{
$showadtype = "Banner";
$adq = "select h.* from banners h where h.approved=1 and h.max > h.hits and h.id NOT IN (select blid from bannerviews where userid = '$userid') order by rand()";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "buttons")
{
$showadtype = "Button";
$adq = "select h.* from buttons h where h.approved=1 and h.max > h.hits and h.id NOT IN (select blid from buttonviews where userid = '$userid') order by rand()";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "textads")
{
$showadtype = "Text";
$adq = "select h.* from textads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from textadviews where userid = '$userid') order by rand()";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
elseif ($adtype == "fullloginads")
{
$showadtype = "Full Page Login";
$adq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid = '$userid') order by rand()";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
}
else
{
$showadtype = "";
$adrows = 0;
}
################################################################################################
$adminemailq = "select h.* from adminemails h where sent=1 order by datesent desc";
$adminemailr = mysql_query($adminemailq);
$adminemailrows = mysql_num_rows($adminemailr);

$soloq = "select h.* from solos h where h.approved=1 and sent=1 and h.id NOT IN (select adid from solos_viewed where userid = '$userid') order by rand()";
$solor = mysql_query($soloq);
$solorows = mysql_num_rows($solor);

$bannerq = "select h.* from banners h where h.approved=1 and h.max > h.hits and h.id NOT IN (select blid from bannerviews where userid = '$userid') order by rand()";
$bannerr = mysql_query($bannerq);
$bannerrows = mysql_num_rows($bannerr);

$buttonq = "select h.* from buttons h where h.approved=1 and h.max > h.hits and h.id NOT IN (select blid from buttonviews where userid = '$userid') order by rand()";
$buttonr = mysql_query($buttonq);
$buttonrows = mysql_num_rows($buttonr);

$textadq = "select h.* from textads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from textadviews where userid = '$userid') order by rand()";
$textadr = mysql_query($textadq);
$textadrows = mysql_num_rows($textadr);

$fullloginadq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid = '$userid') order by rand()";
$fullloginadr = mysql_query($fullloginadq);
$fullloginadrows = mysql_num_rows($fullloginadr);
################################################################################################
?>
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatable" align="center">
<tr class="sabrinatrdark"><td align="center" colspan="2">Browse&nbsp;<?php echo $sitename ?>&nbsp;Ads</td></tr>
<form action="browseads.php" method="post" name="viewform" id="viewform">
<tr class="sabrinatrlight"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" align="center" class="sabrinatable">
<tr class="sabrinatrlight"><td>Total Admin Emails To View:</td><td align="center"><?php echo $adminemailrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Solo Ads To View:</td><td align="center"><?php echo $solorows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Banner Ads To View:</td><td align="center"><?php echo $bannerrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Button Ads To View:</td><td align="center"><?php echo $buttonrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Text Ads To View:</td><td align="center"><?php echo $textadrows ?></td></tr>
<tr class="sabrinatrlight"><td>Total Full Page Login Ads To View:</td><td align="center"><?php echo $fullloginadrows ?></td></tr>
</table>
</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<select name="adtype" id="adtype" onchange="this.form.submit();">
<option value="" <?php if ($adtype == "") { echo "selected"; } ?>> - Select Ad Type - </option>
<option value="adminemails" <?php if ($adtype == "adminemails") { echo "selected"; } ?>>Admin Emails</option>
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
<tr class="sabrinatrdark"><td align="center" colspan="2">View <?php echo $showadtype ?> Ads</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">
<table width="600" border="0" cellpadding="2" cellspacing="2" class="sabrinatrdark" align="center">
<?php
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
			if ($enablecreditssystem == "yes")
			{
			$clickhere = "Click Here for " . $adminemailscredits . " Bonus Credits!";
			}
			if ($enablecreditssystem != "yes")
			{
			$clickhere = "Click here to visit!";
			}
		$clickurl = "<a href=\"" . $domain . "/click1.php?userid=".$userid."&id=".$id."&type=".$adtype."\" target=\"_blank\">" . $clickhere . "</a>";
?>
<tr class="sabrinatrlight"><td align="center"><?php echo $subject ?></td></tr>
<tr class="sabrinatrlight"><td align="center"><div style="width: 600px; height: 300px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td></tr>
<tr class="sabrinatrlight"><td align="center"><?php echo $clickurl ?></td></tr>
<tr class="sabrinatable"><td align="center"></td></tr>
<?php
		} # if ($adtype == "adminemails")
		if ($adtype == "solos")
		{
		$id = $adrowz["id"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$adbody = $adrowz["adbody"];
		$adbody = stripslashes($adbody);
		$adbody = str_replace('\\', '', $adbody);
		$url = $adrowz["url"];
			if ($enablecreditssystem == "yes")
			{
			$clickhere = "Click Here for " . $soloscredits . " Bonus Credits!";
			}
			if ($enablecreditssystem != "yes")
			{
			$clickhere = "Click here to visit!";
			}
		$clickurl = "<a href=\"" . $domain . "/click1.php?userid=".$userid."&id=".$id."&type=".$adtype."\" target=\"_blank\">" . $clickhere . "</a>";	
?>
<tr class="sabrinatrlight"><td align="center"><?php echo $subject ?></td></tr>
<tr class="sabrinatrlight"><td align="center"><div style="width: 600px; height: 300px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><?php echo $adbody ?></div></td></tr>
<tr class="sabrinatrlight"><td align="center"><?php echo $clickurl ?></td></tr>
<tr class="sabrinatable"><td align="center"></td></tr>
<?php
		} # if ($adtype == "solos")
		if (($adtype == "banners") or ($adtype == "buttons"))
		{
		$id = $adrowz["id"];
		$name = $adrowz["name"];
		$name = stripslashes($name);
		$bannerurl = $adrowz["bannerurl"];
		$targeturl = $adrowz["targeturl"];
		$bq = "update $adtype set hits=hits+1 where id=".$id;
		$br = mysql_query($bq) or die(mysql_error());
		if ($adtype == "banners")
			{
			$showwidth = "468";
			$showheight = "60";
				if ($enablecreditssystem == "yes")
				{
				$clickhere = "Click Here for " . $bannerscredits . " Bonus Credits!";
				}
				if ($enablecreditssystem != "yes")
				{
				$clickhere = "Click here to visit!";
				}
			}
		if ($adtype != "banners")
			{
			$showwidth = "125";
			$showheight = "125";
				if ($enablecreditssystem == "yes")
				{
				$clickhere = "Click Here for " . $buttonscredits . " Bonus Credits!";
				}
				if ($enablecreditssystem != "yes")
				{
				$clickhere = "Click here to visit!";
				}
			}

		$clickurlplain = $domain . "/click1.php?userid=".$userid."&id=".$id."&type=".$adtype;
		$clickurl = "<a href=\"" . $domain . "/click1.php?userid=".$userid."&id=".$id."&type=".$adtype."\" target=\"_blank\">" . $clickhere . "</a>";
?>
<tr class="sabrinatrlight"><td align="center"><a href="<?php echo $clickurlplain ?>" target="_blank"><img src="<?php echo $bannerurl ?>" border="0" width="<?php echo $showwidth ?>" height="<?php echo $showheight ?>" alt="<?php echo $name ?>"></a></td></tr>
<tr class="sabrinatrlight"><td align="center"><?php echo $clickurl ?></td></tr>
<tr class="sabrinatable"><td align="center"></td></tr>
<?php
		} # if (($adtype == "banners") or ($adtype == "buttons"))
		if ($adtype == "textads")
		{
		$id = $adrowz["id"];
		$heading = $adrowz["heading"];
		$heading = stripslashes($heading);
		$heading = str_replace('\\', '', $heading);
		$description = $adrowz["description"];
		$description = stripslashes($description);
		$description = str_replace('\\', '', $description);
		$url = $adrowz["url"];
			if ($enablecreditssystem == "yes")
			{
			$clickhere = "Click Here for " . $textadscredits . " Bonus Credits!";
			}
			if ($enablecreditssystem != "yes")
			{
			$clickhere = "Click here to visit!";
			}
		$clickurl = "<a href=\"" . $domain . "/click1.php?userid=".$userid."&id=".$id."&type=".$adtype."\" target=\"_blank\">" . $clickhere . "</a>";
?>
<tr class="sabrinatrlight"><td align="center"><?php echo $heading ?></td></tr>
<tr class="sabrinatrlight"><td align="center"><?php echo $description ?></td></tr>
<tr class="sabrinatrlight"><td align="center"><?php echo $clickurl ?></td></tr>

<tr class="sabrinatrlight"><td align="center">
<div style="width: 125px; height: 125px; padding: 4px; overflow:auto; border-style: solid; border-size: 1px; border-color: #000000; background: #ffffff; color: #000000;"><a href="<?php echo $url ?>" target="_blank"><?php echo $heading ?></a><br><br><?php echo $description ?></td>
</td></tr>
<tr class="sabrinatable"><td align="center"></td></tr>
<?php
		} # if ($adtype == "textads")
		if ($adtype == "fullloginads")
		{
		$id = $adrowz["id"];
		$subject = $adrowz["subject"];
		$subject = stripslashes($subject);
		$subject = str_replace('\\', '', $subject);
		$url = $adrowz["url"];
			if ($enablecreditssystem == "yes")
			{
			$clickhere = "Click Here for " . $fullloginadscredits . " Bonus Credits!";
			}
			if ($enablecreditssystem != "yes")
			{
			$clickhere = "Click here to visit!";
			}
		$clickurl = "<a href=\"" . $domain . "/click1.php?userid=".$userid."&id=".$id."&type=".$adtype."\" target=\"_blank\">" . $clickhere . "</a>";
?>
<tr class="sabrinatrlight"><td align="center"><?php echo $subject ?></td></tr>
<tr class="sabrinatrlight"><td align="center"><?php echo $clickurl ?></td></tr>
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