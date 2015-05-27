<?php
include "control.php";
include "../header.php";
$action = $_POST["action"];
$show = "";
$today = date('Y-m-d',strtotime("now"));
####################################################################################################
if ($action == "addoffer")
{
$offerquantity = $_POST['offerquantity'];
$userid = $_POST['offeruserid'];
$offertogive = $_POST['offertogive'];
$givecommission = $_POST['givecommission'];
for($k=1;$k<=$offerquantity;$k++)
{
	$apackq = "select * from offerpages where id=\"$offertogive\"";
	$apackr = mysql_query($apackq);
	$apackrows = mysql_num_rows($apackr);
	if ($apackrows > 0)
	{
	$name = mysql_result($apackr,0,"name");
	$commissionfree = mysql_result($apackr,0,"commissionfree");
	$commissionpaid = mysql_result($apackr,0,"commissionpaid");
	$upgrade = mysql_result($apackr,0,"upgrade");
	$credits = mysql_result($apackr,0,"credits");
	$solo_num = mysql_result($apackr,0,"solo_num");
	$banner_num = mysql_result($apackr,0,"banner_num");
	$banner_views = mysql_result($apackr,0,"banner_views");
	$button_num = mysql_result($apackr,0,"button_num");
	$button_views = mysql_result($apackr,0,"button_views");
	$textad_num = mysql_result($apackr,0,"textad_num");
	$textad_views = mysql_result($apackr,0,"textad_views");
	$fullloginad_num = mysql_result($apackr,0,"fullloginad_num");
	$fullloginad_views = mysql_result($apackr,0,"fullloginad_views");
	if ($enablecreditssystem != "yes")
		{
		$credits = 0;
		}
	########################################################
	$acctq = "select * from members where userid=\"$userid\"";
	$acctr = mysql_query($acctq);
	$acctrows = mysql_num_rows($acctr);
	if ($acctrows > 0)
		{
		$accounttype = mysql_result($acctr,0,"accounttype");
		$referid = mysql_result($acctr,0,"referid");
		}
	if (($upgrade == "yes") and ($accounttype == "FREE"))
		{
			$eq = "update members set accounttype=\"PAID\",membershiplastpaid=\"$today\" where userid=\"$userid\"";
			$er = mysql_query($eq);
			#### START SIGNUP BONUSES ####
			$bonusq = "select * from bonuses where enable=\"yes\" and bonuspaid=\"yes\" and bonustype=\"Sign-Up\" order by id";
			$bonusr = mysql_query($bonusq);
			$bonusrows = mysql_num_rows($bonusr);
			if ($bonusrows > 0)
				{
				while ($bonusrowz = mysql_fetch_array($bonusr))
					{
					$bonusid = $bonusrowz["id"];
					$bonusname = $bonusrowz["bonusname"];
					$bonustype = $bonusrowz["bonustype"];
					$bonuscredits = $bonusrowz["credits"];
					$bonussolo_num = $bonusrowz["solo_num"];
					$bonusbanner_num = $bonusrowz["banner_num"];
					$bonusbanner_views = $bonusrowz["banner_views"];
					$bonusbutton_num = $bonusrowz["button_num"];
					$bonusbutton_views = $bonusrowz["button_views"];
					$bonustextad_num = $bonusrowz["textad_num"];
					$bonustextad_views = $bonusrowz["textad_views"];
					$bonusfullloginad_num = $bonusrowz["fullloginad_num"];
					$bonusfullloginad_views = $bonusrowz["fullloginad_views"];
					##############################
					if ($enablecreditssystem != "yes")
						{
						$bonuscredits = 0;
						}
					if ($bonuscredits > 0)
						{
							mysql_query("update members set credits=credits+".$bonuscredits." where userid=\"$userid\"");
						}
					if ($bonussolo_num > 0)
						{
							$count = $bonussolo_num;
							while($count > 0) {
								mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
								$count--;
							}
						}
					if (($bonusbanner_num > 0) and ($bonusbanner_views > 0)) 
						{
							$count = $bonusbanner_num;
							while($count > 0)
							{
							mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$bonusbanner_views."','".time()."')");
							$count--;
							}
						}
					if (($bonusbutton_num > 0) and ($bonusbutton_views > 0)) 
						{
							$count = $bonusbutton_num;
							while($count > 0)
							{
							mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$bonusbutton_views."','".time()."')");
							$count--;
							}
						}
					if (($bonustextad_num > 0) and ($bonustextad_views > 0)) 
						{
							$count = $bonustextad_num;
							while($count > 0)
							{
							mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$bonustextad_views."','".time()."')");
							$count--;
							}
						}
					if (($bonusfullloginad_num > 0) and ($bonusfullloginad_views > 0)) 
						{
							$count = $bonusfullloginad_num;
							while($count > 0)
							{
							mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$bonusfullloginad_views."','".time()."')");
							$count--;
							}
						}
					$bonusq2 = "update bonuses set howmanytimesgiven=howmanytimesgiven+1 where id=\"$bonusid\"";
					$bonusr2 = mysql_query($bonusq2);
					mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','New PAID Member Bonus','" . $bonusname . " " . $bonustype . " Bonus',NOW(),'0.00')");
					} # while ($bonusrowz = mysql_fetch_array($bonusr))
				} # if ($bonusrows > 0)
			#### END SIGNUP BONUSES ####
		} # if (($upgrade == "yes") and ($accounttype == "FREE"))
	if ($credits > 0)
		{
			mysql_query("update members set credits=credits+".$credits." where userid=\"$userid\"");
		}
	if ($solo_num > 0)
		{
			$count = $solo_num;
			while($count > 0) {
				mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
				$count--;
			}
		}
	if (($banner_num > 0) and ($banner_views > 0)) 
		{
			$count = $banner_num;
			while($count > 0)
			{
			mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$banner_views."','".time()."')");
			$count--;
			}
		}
	if (($button_num > 0) and ($button_views > 0)) 
		{
			$count = $button_num;
			while($count > 0)
			{
			mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$button_views."','".time()."')");
			$count--;
			}
		}
	if (($textad_num > 0) and ($textad_views > 0)) 
		{
			$count = $textad_num;
			while($count > 0)
			{
			mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$textad_views."','".time()."')");
			$count--;
			}
		}
	if (($fullloginad_num > 0) and ($fullloginad_views > 0)) 
		{
			$count = $fullloginad_num;
			while($count > 0)
			{
			mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$fullloginad_views."','".time()."')");
			$count--;
			}
		}

	if ($givecommission == "yes")
		{
		$refq = "select * from members where userid=\"$referid\"";
		$refr = mysql_query($refq);
		$refrows = mysql_num_rows($refr);
		if ($refrows > 0)
			{
			$refaccounttype = mysql_result($refr,0,"accounttype");
			if ($refaccounttype == "PAID")
				{
				$sponsorcommission = $commissionpaid;
				}
			if ($refaccounttype != "PAID")
				{
				$sponsorcommission = $commissionfree;
				}
			if ($sponsorcommission > 0)
				{
				$ewalletq = "update members set ewallet=ewallet+" . $sponsorcommission . " where userid=\"$referid\"";
				$ewalletr = mysql_query($ewalletq);
				$refq3 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$sponsorcommission\",NOW(),\"Admin Added Special Offer Page Sponsor Payment for Referral $userid\")";
				$refr3 = mysql_query($refq3);
				}
			} # if ($refrows > 0)
		} # if ($givecommission == "yes")

	} # if ($apackrows > 0)
	mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Admin Added','Admin Added Special Offer Package',NOW(),'0.00')");
} # for($k=1;$k<=$offerquantity;$k++)
$show = $offerquantity . " " . $sitename . " Special Offer Package(s) were given to UserID " . $userid;
} # if ($action == "addoffer")
####################################################################################################
if ($action == "update")
{
if ($_POST['name'] == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Name field was left blank.</td></tr>
<tr><td colspan="2" align="center"><br><a href="offerpages_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if (($_POST['price'] == "") or ($_POST['price'] <= 0.01))
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Please enter a price for your Special Offer Package.</td></tr>
<tr><td colspan="2" align="center"><br><a href="offerpages_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
$htmlcode = $_POST["htmlcode"];
$htmlcode = stripslashes($htmlcode);
$htmlcode = str_replace('\\', '', $htmlcode); 
$htmlcode = mysql_real_escape_string($htmlcode);

mysql_query("update offerpages set name = '".$_POST['name']."', price = '".$_POST['price']."', commissionfree = '".$_POST['commissionfree']."', commissionpaid = '".$_POST['commissionpaid']."', showwhen = '".$_POST['showwhen']."', howmanytimestoshow = '".$_POST['howmanytimestoshow']."', credits = '".$_POST['credits']."', solo_num = '".$_POST['solo_num']."', banner_num = '".$_POST['banner_num']."', banner_views = '".$_POST['banner_views']."', button_num = '".$_POST['button_num']."', button_views = '".$_POST['button_views']."', textad_num = '".$_POST['textad_num']."', textad_views = '".$_POST['textad_views']."', fullloginad_num = '".$_POST['fullloginad_num']."', fullloginad_views = '".$_POST['fullloginad_views']."', enable = '".$_POST['enable']."', upgrade = '".$_POST['upgrade']."', htmlcode='$htmlcode' where id='".$_POST['id']."'") or die(mysql_error());
$show = "Your " . $sitename . " Special Offer was saved!";
} # if ($action == "update")
####################################################################################################
if ($action == "add")
{
if ($_POST['name'] == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Name field was left blank.</td></tr>
<tr><td colspan="2" align="center"><br><a href="offerpages_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if (($_POST['price'] == "") or ($_POST['price'] <= 0.01))
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Please enter a price for your Special Offer Package.</td></tr>
<tr><td colspan="2" align="center"><br><a href="offerpages_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
$htmlcode = $_POST["htmlcode"];
$htmlcode = stripslashes($htmlcode);
$htmlcode = str_replace('\\', '', $htmlcode); 
$htmlcode = mysql_real_escape_string($htmlcode);

mysql_query("insert into offerpages set name = '".$_POST['name']."', price = '".$_POST['price']."', commissionfree = '".$_POST['commissionfree']."', commissionpaid = '".$_POST['commissionpaid']."', showwhen = '".$_POST['showwhen']."', howmanytimestoshow = '".$_POST['howmanytimestoshow']."', credits = '".$_POST['credits']."', solo_num = '".$_POST['solo_num']."', banner_num = '".$_POST['banner_num']."', banner_views = '".$_POST['banner_views']."', button_num = '".$_POST['button_num']."', button_views = '".$_POST['button_views']."', textad_num = '".$_POST['textad_num']."', textad_views = '".$_POST['textad_views']."', fullloginad_num = '".$_POST['fullloginad_num']."', fullloginad_views = '".$_POST['fullloginad_views']."', enable = '".$_POST['enable']."', upgrade = '".$_POST['upgrade']."', htmlcode='$htmlcode'") or die(mysql_error());
$show = "New " . $sitename . " Special Offer was added!";
} # if ($action == "add")
####################################################################################################
if ($action == "delete")
{
mysql_query("delete from offerpages where id='".$_POST['id']."'");
$show = "The " . $sitename . " Special Offer was deleted!";
} # if ($action == "delete")
####################################################################################################
if ($action == "edit")
{
$editq = "select * from offerpages where id='".$_POST['id']."'";
$editr = mysql_query($editq);
$editrows = mysql_num_rows($editr);
if ($editrows > 0)
{
$offer = mysql_fetch_array($editr);
$pagehtmlcode = $offer["htmlcode"];
$pagehtmlcode = stripslashes($pagehtmlcode);
$pagehtmlcode = str_replace('\\', '', $pagehtmlcode);
$pagehtmlcode = htmlentities($pagehtmlcode, ENT_COMPAT, "ISO-8859-1");
?>
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
theme : "advanced",
mode : "textareas",
//save_callback : "customSave",
content_css : "../jscripts/tiny_mce/advanced.css",
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
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2">Edit <?php echo $sitename ?> Special Offer</td></tr>
<form method="POST" action="offerpages_admin.php">
<input type="hidden" name="id" value="<? echo $offer['id']; ?>">
<input type="hidden" name="action" value="update">
<tr class="sabrinatrlight"><td>Enabled:</td><td><select name="enable">
<option value="yes" <?php if ($offer["enable"] == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($offer["enable"] != "yes") { echo "selected"; } ?>>NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Name:</td><td><input type="text" class="typein" name="name" maxlength="255" size="65" value="<? echo $offer["name"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Price:</td><td><input type="text" class="typein" name="price" maxlength="12" size="6" value="<? echo $offer["price"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Sponsors:</td><td><input type="text" class="typein" name="commissionfree" maxlength="12" size="6" value="<? echo $offer["commissionfree"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Sponsors:</td><td><input type="text" class="typein" name="commissionpaid" maxlength="12" size="6" value="<? echo $offer["commissionpaid"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>When to Show Members:</td><td><select name="showwhen">
<option value="After Login" <?php if ($offer["showwhen"] == "After Login") { echo "selected"; } ?>>After Login</option>
<option value="After Verification" <?php if ($offer["showwhen"] == "After Verification") { echo "selected"; } ?>>After Verification</option>
<option value="After Logout" <?php if ($offer["showwhen"] == "After Logout") { echo "selected"; } ?>>After Logout</option>
</td></tr>
<tr class="sabrinatrlight"><td>How Often to Show Members:</td><td><select name="howmanytimestoshow">
<option value="Always" <?php if ($offer["howmanytimestoshow"] == "Always") { echo "selected"; } ?>>Always</option>
<option value="Once Only" <?php if ($offer["howmanytimestoshow"] == "Once Only") { echo "selected"; } ?>>Once Only</option>
</td></tr>
<tr class="sabrinatrlight"><td>Upgrade:</td><td>
<select name="upgrade">
<option value="no" <?php if ($offer['upgrade'] != "yes") { echo "selected"; } ?>>NO</option>
<option value="yes" <?php if ($offer['upgrade'] == "yes") { echo "selected"; } ?>>YES</option>
</select>
</td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td>Credits to add:</td><td><input type="text" class="typein" name="credits" value="<? echo $offer["credits"]; ?>"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight"><td>Solo Ads to add:</td><td><input type="text" class="typein" name="solo_num" value="<? echo $offer["solo_num"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Banner Ads to add:</td><td><input type="text" class="typein" name="banner_num" value="<? echo $offer['banner_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Banner Ad:</td><td><input type="text" class="typein" name="banner_views" value="<? echo $offer['banner_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Button Ads to add:</td><td><input type="text" class="typein" name="button_num" value="<? echo $offer['button_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Button Ad:</td><td><input type="text" class="typein" name="button_views" value="<? echo $offer['button_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Text Ads to add:</td><td><input type="text" class="typein" name="textad_num" value="<? echo $offer['textad_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Text Ad:</td><td><input type="text" class="typein" name="textad_views" value="<? echo $offer['textad_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Full Page Login Ads to add:</td><td><input type="text" class="typein" name="fullloginad_num" value="<? echo $offer['fullloginad_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Full Page Login Ad:</td><td><input type="text" class="typein" name="fullloginad_views" value="<? echo $offer['fullloginad_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td valign="top">Special Offer Page HTML:</td><td><textarea name="htmlcode" id="htmlcode" rows="20" cols="65"><?php echo $pagehtmlcode ?></textarea></td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2"><input type="submit" value="UPDATE" class="sendit">&nbsp;&nbsp;<input type="button" value="CANCEL" onclick="window.location='offerpages_admin.php'" class="sendit"></td></tr>
</table>
</form>
</td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if ($editrows < 1)
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>That Special Offer Package was not found in the system.</td></tr>
<tr><td colspan="2" align="center"><br><a href="offerpages_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
} # if ($action == "edit")
####################################################################################################
$q = "select * from offerpages order by id";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td colspan="2" align="center"><br><div class="heading"><?php echo $sitename ?> Special Offer Packages</div></td></tr>
<tr><td align="center" colspan="2" style="height: 15px;"></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<?php
if ($rows > 0)
{
?>
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrlight"><td align="center" colspan="9">Available Special Offer Packages</td></tr>
<tr class="sabrinatrdark"><td align="center">Name (click to show details)</td><td align="center">Price</td><td align="center"><?php echo $level1name ?> Sponsor Commission</td><td align="center"><?php echo $level2name ?> Sponsor Commission</td><td align="center">Enabled</td><td align="center">When to Show Members</td><td align="center">How Often to Show Each Member</td><td align="center">Edit</td><td align="center">Delete</td></tr>
<?php
	while ($rowz = mysql_fetch_array($r))
	{
	$details = "";
	$id = $rowz["id"];
	$name = $rowz["name"];
	$price = $rowz["price"];
	$commissionfree = $rowz["commissionfree"];
	$commissionpaid = $rowz["commissionpaid"];
	$enable = $rowz["enable"];
	$showwhen = $rowz["showwhen"];
	$howmanytimestoshow = $rowz["howmanytimestoshow"];
	$upgrade = $rowz["upgrade"];
	$credits = $rowz["credits"];
	$solo_num = $rowz["solo_num"];
	$banner_num = $rowz["banner_num"];
	$banner_views = $rowz["banner_views"];
	$button_num = $rowz["button_num"];
	$button_views = $rowz["button_views"];
	$textad_num = $rowz["textad_num"];
	$textad_views = $rowz["textad_views"];
	$fullloginad_num = $rowz["fullloginad_num"];
	$fullloginad_views = $rowz["fullloginad_views"];
	if ($enablecreditssystem != "yes")
		{
		$credits = 0;
		}
	if ($upgrade == "yes")
		{
		$details .= "<span>Membership Upgrade</span><br>";
		}
	if ($credits > 0)
		{
		$details .= "<span>$credits Credits</span><br>";
		}
	if ($solo_num > 0)
		{
		$details .= "<span>$solo_num Solo Ads</span><br>";
		}
	if (($banner_num > 0) and ($banner_views > 0))
		{
		$details .= "<span>$banner_num Banner Ads with $banner_views Impressions</span><br>";
		}
	if (($button_num > 0) and ($button_views > 0))
		{
		$details .= "<span>$button_num Button Ads with $button_views Impressions</span><br>";
		}
	if (($textad_num > 0) and ($textad_views > 0))
		{
		$details .= "<span>$textad_num Text Ads with $textad_views Impressions</span><br>";
		}
	if (($fullloginad_num > 0) and ($fullloginad_views > 0))
		{
		$details .= "<span>$fullloginad_num Full Page Login Ads with $fullloginad_views Impressions</span><br>";
		}
?>
<tr class="sabrinatrlight"><td align="center">
<a href="javascript:;" onclick="document.getElementById('showoffer').innerHTML='<?php echo $details ?>';"><?php echo $name ?></a></td><td align="center">$<?php echo $price ?></td><td align="center">$<?php echo $commissionfree ?></td><td align="center">$<?php echo $commissionpaid ?></td><td align="center"><?php echo $enable ?></td><td align="center"><?php echo $showwhen ?></td><td align="center"><?php echo $howmanytimestoshow ?></td>
<form method="POST" action="offerpages_admin.php">
<td align="center">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="submit" value="EDIT" class="sendit">
</form>
</td>
<form method="POST" action="offerpages_admin.php">
<td align="center">
<input type="hidden" name="action" value="delete">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="submit" value="DELETE" class="sendit">
</form>
</td>
</tr>
<?php
	} # while ($rowz = mysql_fetch_array($r))
?>
<tr class="sabrinatrlight"><td colspan="9" align="center">
<div id="showoffer"></div>
</td></tr>
</table></td></tr>
<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>
<?php
} # if ($rows > 0)
?>
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" class="sabrinatable" style="width: 400px;">
<tr class="sabrinatrdark"><td align="center" colspan="2">Give <?php echo $sitename ?> Special Offer Package To A Member</td></tr>
<?php
$uq = "select * from members order by userid";
$ur = mysql_query($uq);
$urows = mysql_num_rows($ur);
if ($urows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">There are no members yet.</td></tr>
<?php
}
if ($urows > 0)
{
	$adpackq = "select * from offerpages where enable=\"yes\" order by id";
	$adpackr = mysql_query($adpackq);
	$adpackrows = mysql_num_rows($adpackr);
	if ($adpackrows < 1)
	{
	?>
	<tr class="sabrinatrlight"><td align="center" colspan="2">There are no Special Offers available yet.</td></tr>
	<?php
	}
	if ($adpackrows > 0)
	{
	?>
	<form action="offerpages_admin.php" method="post">
	<tr class="sabrinatrlight"><td>Give To Member: </td><td>
	<select name="offeruserid" class="pickone">
	<?php
	while ($urowz = mysql_fetch_array($ur))
	{
	$userid = $urowz["userid"];
	echo "<option value=\"" . $userid . "\">" . $userid . "</option>";
	}
	?>
	</select>
	</td></tr>
	<tr class="sabrinatrlight"><td>Select Special Offer Package: </td><td><select name="offertogive">
	<?php
		while ($adpackrowz = mysql_fetch_array($adpackr))
			{
			$offerid = $adpackrowz["id"];
			$offername = $adpackrowz["name"];
	?>
	<option value="<?php echo $offerid ?>"><?php echo $offername ?></option>
	<?php
			}
	?>
	</select></td></tr>
	<tr class="sabrinatrlight"><td>How Many To Give: </td><td><select name="offerquantity" class="pickone">
	<?php
	for ($i=1;$i<=100;$i++)
	{
	?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php
	}
	?>
	</select></td></tr>
	<tr class="sabrinatrlight"><td>Should the Member's Sponsor Receive Commission?: </td><td><select name="givecommission" class="pickone">
	<option value="yes">YES</option>
	<option value="no">NO</option>
	</select>
	</td></tr>
	<tr class="sabrinatrdark"><td colspan="2" align="center">
	<input type="hidden" name="action" value="addoffer"><input type="submit" value="ADD" class="sendit" class="sendit"></form></td></tr>
	<?php
	} # if ($adpackrows > 0)
} # if ($urows > 0)
?>
</table>
</td></tr>
<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>
<tr><td colspan="2" align="center">
<!-- tinyMCE -->
<script language="javascript" type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript">
tinyMCE.init({
theme : "advanced",
mode : "textareas",
//save_callback : "customSave",
content_css : "../jscripts/tiny_mce/advanced.css",
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
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrlight"><td align="center" colspan="2">Create <?php echo $sitename ?> Special Offer Packages</td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2">If there are multiple Special Offers that occur at the same time (ie. more than one that shows after login), they will be rotated.
<br><br><font color="#ff0000" style="background:#ffff00;">IMPORTANT:</font> Do NOT include payment button code right in your HTML. Write ~PAYMENT_BUTTONS~ instead (exactly as shown) exactly where on the page you would like the payment buttons to appear. If you include payment buttons you've made yourself on the page, they will not be hooked up to the IPN system and the script program, then you would need to watch for and manually add the offers the members purchase.
</td></tr>
<form method="POST" action="offerpages_admin.php">
<input type="hidden" name="action" value="add">
<tr class="sabrinatrlight"><td>Enabled:</td><td><select name="enable">
<option value="yes">YES</option>
<option value="no">NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Name:</td><td><input type="text" class="typein" name="name" maxlength="255" size="65"></td></tr>
<tr class="sabrinatrlight"><td>Price:</td><td><input type="text" class="typein" name="price" maxlength="12" size="6" value="0.00"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level1name ?> Sponsors:</td><td><input type="text" class="typein" name="commissionfree" maxlength="12" size="6" value="0.00"></td></tr>
<tr class="sabrinatrlight"><td>Commission for <?php echo $level2name ?> Sponsors:</td><td><input type="text" class="typein" name="commissionpaid" maxlength="12" size="6" value="0.00"></td></tr>
<tr class="sabrinatrlight"><td>When to Show Members:</td><td><select name="showwhen">
<option value="After Login">After Login</option>
<option value="After Verification">After Verification</option>
<option value="After Logout">After Logout</option>
</td></tr>
<tr class="sabrinatrlight"><td>How Often to Show Members:</td><td><select name="howmanytimestoshow">
<option value="Always">Always</option>
<option value="Once Only">Once Only</option>
</td></tr>
<tr class="sabrinatrlight"><td>Upgrade:</td><td>
<select name="upgrade">
<option value="no">NO</option>
<option value="yes">YES</option>
</select>
</td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td>Credits to add:</td><td><input type="text" class="typein" name="credits" value="0"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight"><td>Solo Ads to add:</td><td><input type="text" class="typein" name="solo_num" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Banner Ads to add:</td><td><input type="text" class="typein" name="banner_num" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Views per Banner Ad:</td><td><input type="text" class="typein" name="banner_views" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Button Ads to add:</td><td><input type="text" class="typein" name="button_num" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Views per Button Ad:</td><td><input type="text" class="typein" name="button_views" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Text Ads to add:</td><td><input type="text" class="typein" name="textad_num" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Views per Text Ad:</td><td><input type="text" class="typein" name="textad_views" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Full Page Login Ads to add:</td><td><input type="text" class="typein" name="fullloginad_num" value="0"></td></tr>
<tr class="sabrinatrlight"><td>Views per Full Page Login Ad:</td><td><input type="text" class="typein" name="fullloginad_views" value="0"></td></tr>
<tr class="sabrinatrlight"><td valign="top">Special Offer Page HTML:</td><td><textarea name="htmlcode" id="htmlcode" rows="20" cols="65"></textarea></td></tr>
<tr class="sabrinatrdark"><td colspan="2" align="center"><input type="submit" value="ADD" class="sendit"></td></tr>
</table>
</form>
</td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
?>
