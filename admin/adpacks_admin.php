<?php
include "control.php";
include "../header.php";
$action = $_POST["action"];
$show = "";
$today = date('Y-m-d',strtotime("now"));
####################################################################################################
if ($action == "addadpack")
{
$apquantity = $_POST['apquantity'];
$userid = $_POST['adpackuserid'];
$adpacktogive = $_POST['adpacktogive'];
for($k=1;$k<=$apquantity;$k++)
{
	$apackq = "select * from adpacks where id=\"$adpacktogive\"";
	$apackr = mysql_query($apackq);
	$apackrows = mysql_num_rows($apackr);
	if ($apackrows > 0)
	{
	$description = mysql_result($apackr,0,"description");
	$upgrade = mysql_result($apackr,0,"upgrade");
	$credits = mysql_result($apackr,0,"credits");
	$solo_num = mysql_result($apackr,0,"solo_num");
	$banner_num = mysql_result($apackr,0,"banner_num");
	$banner_views = mysql_result($apackr,0,"banner_views");
	$textad_num = mysql_result($apackr,0,"textad_num");
	$textad_views = mysql_result($apackr,0,"textad_views");
	$fullloginad_num = mysql_result($apackr,0,"fullloginad_num");
	$fullloginad_views = mysql_result($apackr,0,"fullloginad_views");
	########################################################
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
					if ($enablecreditssystem != "yes")
						{
						$bonuscredits = 0;
						}
					##############################
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
					mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','New " . $level2name . " Member Bonus','" . $bonusname . " " . $bonustype . " Bonus',NOW(),'0.00')");
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
				mysql_query("insert into solos (`id` ,`userid` ,`approved` ,`subject` ,`adbody` ,`added` , `sent`, `purchase`) VALUES (NULL , '".$userid."', '0', '', '', '0', '0','".time()."')");
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
	} # if ($apackrows > 0)
$hmq = "update adpacks set howmanytimeschosen=howmanytimeschosen+1 where id=\"$adpacktogive\"";
$hmr = mysql_query($hmq);
} # for($k=1;$k<=$apquantity;$k++)
$show = $apquantity . " " . $sitename . " AdPack(s) were given to UserID " . $adpackuserid;
} # if ($action == "addadpack")
####################################################################################################
if ($action == "update")
{
if ($_POST['description'] == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Description field was left blank.</td></tr>
<tr><td colspan="2" align="center"><br><a href="adpacks_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
mysql_query("update adpacks set description = '".$_POST['description']."', credits = '".$_POST['credits']."', solo_num = '".$_POST['solo_num']."', banner_num = '".$_POST['banner_num']."', banner_views = '".$_POST['banner_views']."', button_num = '".$_POST['button_num']."', button_views = '".$_POST['button_views']."', textad_num = '".$_POST['textad_num']."', textad_views = '".$_POST['textad_views']."', fullloginad_num = '".$_POST['fullloginad_num']."', fullloginad_views = '".$_POST['fullloginad_views']."', enable = '".$_POST['enable']."', upgrade = '".$_POST['upgrade']."' where id='".$_POST['id']."'") or die(mysql_error());
$show = "Your " . $sitename . " AdPack was saved!";
} # if ($action == "update")
####################################################################################################
if ($action == "add")
{
if ($_POST['description'] == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Description field was left blank.</td></tr>
<tr><td colspan="2" align="center"><br><a href="adpacks_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
mysql_query("insert into adpacks set description = '".$_POST['description']."', credits = '".$_POST['credits']."', solo_num = '".$_POST['solo_num']."', banner_num = '".$_POST['banner_num']."', banner_views = '".$_POST['banner_views']."', button_num = '".$_POST['button_num']."', button_views = '".$_POST['button_views']."', textad_num = '".$_POST['textad_num']."', textad_views = '".$_POST['textad_views']."', fullloginad_num = '".$_POST['fullloginad_num']."', fullloginad_views = '".$_POST['fullloginad_views']."', enable = '".$_POST['enable']."', upgrade = '".$_POST['upgrade']."'") or die(mysql_error());
$show = "New " . $sitename . " AdPack was added!";
} # if ($action == "add")
####################################################################################################
if ($action == "delete")
{
mysql_query("delete from adpacks where id='".$_POST['id']."'");
$show = "The " . $sitename . " AdPack was deleted!";
} # if ($action == "delete")
####################################################################################################
if ($action == "edit")
{
$editq = "select * from adpacks where id='".$_POST['id']."'";
$editr = mysql_query($editq);
$editrows = mysql_num_rows($editr);
if ($editrows > 0)
{
$offer = mysql_fetch_array($editr);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">AdPacks</div></td></tr>
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">Edit <?php echo $sitename ?> AdPack</div></td></tr>
<form method="POST" action="adpacks_admin.php">
<input type="hidden" name="id" value="<? echo $offer['id']; ?>">
<input type="hidden" name="action" value="update">
<tr class="sabrinatrlight"><td>Enabled:</td><td><select name="enable">
<option value="yes" <?php if ($offer["enable"] == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($offer["enable"] != "yes") { echo "selected"; } ?>>NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Description:</td><td><input type="text" class="typein" name="description" maxlength="255" size="65" value="<? echo $offer["description"]; ?>"></td></tr>
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
<tr class="sabrinatrdark"><td align="center" colspan="2"><input type="submit" value="UPDATE" class="sendit">&nbsp;&nbsp;<input type="button" value="CANCEL" onclick="window.location='adpacks_admin.php'" class="sendit"></td></tr>
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
<tr><td align="center" colspan="2"><br>That AdPack was not found.</td></tr>
<tr><td colspan="2" align="center"><br><a href="adpacks_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
} # if ($action == "edit")
####################################################################################################
$q = "select * from adpacks order by id";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">AdPacks For Sale</div></td></tr>
<tr><td colspan="2"><br>AdPacks exist for the purpose of enticing members to upgrade to <?php echo $level2name ?> level. Upgrading to <?php echo $level2name ?> membership also gets an AdPack for a member (their choice out of the ones you create). Members who are already <?php echo $level2name ?> level members may order additional AdPacks if they would like to (but are not upgraded since they are already <?php echo $level2name ?> members).</td></tr>
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
<tr class="sabrinatrdark"><td align="center" colspan="5"><div class="heading"><?php echo $sitename ?> AdPacks</div></td></tr>
<tr class="sabrinatrlight"><td align="center">Description</td><td align="center">Enabled</td><td align="center">How Many Times Chosen</td><td align="center">Edit</td><td align="center">Delete</td></tr>
<?php
	while ($rowz = mysql_fetch_array($r))
	{
	$details = "";
	$id = $rowz["id"];
	$description = $rowz["description"];
	$howmanytimeschosen = $rowz["howmanytimeschosen"];
	$enable = $rowz["enable"];
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
	if ($upgrade == "yes")
		{
		$details .= "<span>Membership Upgrade</span><br>";
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
<a href="javascript:;" onclick="document.getElementById('showadpack').innerHTML='<?php echo $details ?>';"><?php echo $description ?></a></td><td align="center"><?php echo $enable ?></td><td align="center"><?php echo $howmanytimeschosen ?></td>
<form method="POST" action="adpacks_admin.php">
<td align="center">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="submit" value="EDIT" class="sendit">
</form>
</td>
<form method="POST" action="adpacks_admin.php">
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
<tr class="sabrinatrlight"><td colspan="5" align="center">
<div id="showadpack"></div>
</td></tr>
</table></td></tr>
<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>
<?php
} # if ($rows > 0)
?>
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" class="sabrinatable" style="width: 300px;">
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">Give <?php echo $sitename ?> AdPack To A Member</div></td></tr>
<?php
$uq = "select * from members order by userid";
$ur = mysql_query($uq);
$urows = mysql_num_rows($ur);
if ($urows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">There are no members yet to give AdPacks to.</td></tr>
<?php
}
if ($urows > 0)
{
	$adpackq = "select * from adpacks where enable=\"yes\" order by id";
	$adpackr = mysql_query($adpackq);
	$adpackrows = mysql_num_rows($adpackr);
	if ($adpackrows < 1)
	{
	?>
	<tr class="sabrinatrlight"><td align="center" colspan="2">There are no AdPacks available yet. Please create some below.</td></tr>
	<?php
	}
	if ($adpackrows > 0)
	{
	?>
	<form action="adpacks_admin.php" method="post">
	<tr class="sabrinatrlight"><td>Give To Member: </td><td>
	<select name="adpackuserid" class="pickone">
	<?php
	while ($urowz = mysql_fetch_array($ur))
	{
	$userid = $urowz["userid"];
	echo "<option value=\"" . $userid . "\">" . $userid . "</option>";
	}
	?>
	</select>
	</td></tr>
	<tr class="sabrinatrlight"><td>Select AdPack: </td><td><select name="adpacktogive">
	<?php
		while ($adpackrowz = mysql_fetch_array($adpackr))
			{
			$adpackid = $adpackrowz["id"];
			$adpackdescription = $adpackrowz["description"];
	?>
	<option value="<?php echo $adpackid ?>"><?php echo $adpackdescription ?></option>
	<?php
			}
	?>
	</select></td></tr>
	<tr class="sabrinatrlight"><td align="right">How Many To Give: </td><td><select name="apquantity" class="pickone">
	<?php
	for ($i=1;$i<=100;$i++)
	{
	?>
	<option value="<?php echo $i ?>"><?php echo $i ?></option>
	<?php
	}
	?>
	</select></td></tr>
	<tr class="sabrinatrdark"><td colspan="2" align="center">
	<input type="hidden" name="action" value="addadpack"><input type="submit" value="ADD" class="sendit" class="sendit"></form></td></tr>
	<?php
	} # if ($adpackrows > 0)
} # if ($urows > 0)
?>
</table>
</td></tr>
<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>
<tr><td colspan="2" align="center">
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">Create <?php echo $sitename ?> AdPacks</div></td></tr>
<form method="POST" action="adpacks_admin.php">
<input type="hidden" name="action" value="add">
<tr class="sabrinatrlight"><td>Enabled:</td><td><select name="enable">
<option value="yes">YES</option>
<option value="no">NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Description:</td><td><input type="text" class="typein" name="description" maxlength="255" size="65"></td></tr>
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
