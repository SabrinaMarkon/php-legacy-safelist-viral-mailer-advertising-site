<?php
include "control.php";
include "header.php";
include "banners.php";
?>
<table width="600" border="0" cellpadding="2" cellspacing="2"  align="center">
<tr><td align="center" colspan="2"><div class="heading"><?php echo $sitename ?>&nbsp;Text&nbsp;Ads</div><br>&nbsp;</td></tr>
<tr><td align="center" colspan="2">
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Members Area Text Ads Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>

<?php
$taq = "select * from textads where hits<max and approved=1 order by rand() limit 3";
$tar = mysql_query($taq) or die(mysql_error());
$tarows = mysql_num_rows($tar);
if ($tarows > 0)
{
?>
<tr><td align="center" colspan="2">
<table align="center" cellpadding="4" cellspacing="2" border="0" height="100%" class="sabrinatable">
<tr bgcolor="#ffffff"><td align="center"></td></tr>
<?php
	while ($tarowz = mysql_fetch_array($tar))
	{
	$taid = $tarowz["id"];
	$taurl = $tarowz["url"];
	$taheading = $tarowz["heading"];
	$taheading = stripslashes($taheading);
	$taheading = str_replace('\\', '', $taheading);
	$tadescription = $tarowz["description"];
	$tadescription = stripslashes($tadescription);
	$tadescription = str_replace('\\', '', $tadescription);
	$taq2 = "update textads set hits=hits+1 where id=".$taid;
	$tar2 = mysql_query($taq2) or die(mysql_error());
		if ($enablecreditssystem == "yes")
		{
		$clickhere = "Click Here for " . $textadscredits . " Bonus Credits!";
		}
		if ($enablecreditssystem != "yes")
		{
		$clickhere = "Click here to visit!";
		}
	$clickurl = $domain . "/click1.php?userid=".$userid."&id=".$taid."&type=textads";
	?>
	<tr class="sabrinatrdark"><td align="center"><a href="<?php echo $clickurl ?>" target="_blank"><?php echo $taheading ?></a></td></tr>
	<tr class="sabrinatrlight"><td align="center"><div align="left" style="font-size:10px;color:#ffffff;"><?php echo $tadescription ?></div></td></tr>
	<tr class="sabrinatrdark"><td align="center"><a href="<?php echo $clickurl ?>" target="_blank"><?php echo $clickhere ?></a></td></tr>
	<tr bgcolor="#ffffff"><td align="center"></td></tr>
	<?php
	} # while ($tarowz = mysql_fetch_array($tar))
?>
</table>
</td></tr>
<?php
}
if ($tarows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">There are currently no Text Ads in the system.</td></tr>
<?php
}
?>
</table>
<br><br>
<?php
include "footer.php";
?>
