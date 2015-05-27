<?php
include "control.php";
include "../header.php";
$action = $_POST["action"];
$show = "";
####################################################################################################
if ($action == "addbonus")
{
$bonusquantity = $_POST['bonusquantity'];
$userid = $_POST['bonususerid'];
$bonustogive = $_POST['bonustogive'];
for($k=1;$k<=$bonusquantity;$k++)
{
	$apackq = "select * from bonuses where id=\"$bonustogive\"";
	$apackr = mysql_query($apackq);
	$apackrows = mysql_num_rows($apackr);
	if ($apackrows > 0)
	{
	$bonusname = mysql_result($apackr,0,"bonusname");
	$bonustype = mysql_result($apackr,0,"bonustype");
	$solo_num = mysql_result($apackr,0,"solo_num");
	$credits = mysql_result($apackr,0,"credits");
	$banner_num = mysql_result($apackr,0,"banner_num");
	$banner_views = mysql_result($apackr,0,"banner_views");
	$button_num = mysql_result($apackr,0,"button_num");
	$button_views = mysql_result($apackr,0,"button_views");
	$textad_num = mysql_result($apackr,0,"textad_num");
	$textad_views = mysql_result($apackr,0,"textad_views");
	$fullloginad_num = mysql_result($apackr,0,"fullloginad_num");
	$fullloginad_views = mysql_result($apackr,0,"fullloginad_views");
	########################################################
	if ($enablecreditssystem != "yes")
		{
		$credits = 0;
		}
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
	mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Admin Added','Admin Added " . $bonusname . " " . $bonustype . " Bonus',NOW(),'0.00')");
} # for($k=1;$k<=$bonusquantity;$k++)
$bonusq = "update bonuses set howmanytimesgiven=howmanytimesgiven+" . $bonusquantity . " where id=\"$bonustogive\"";
$bonusr = mysql_query($bonusq);
$show = $bonusquantity . " " . $sitename . " " . $bonusname . " " . $bonustype . " Bonus(es) were given to UserID " . $userid;
} # if ($action == "addbonus")
####################################################################################################
if ($action == "update")
{
if ($_POST['bonusname'] == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Name field was left blank.</td></tr>
<tr><td colspan="2" align="center"><br><a href="bonuses_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if (($_POST['bonusfree'] != "yes") and ($_POST['bonuspaid'] != "yes"))
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Please select at least one membership level to receive the bonus.</td></tr>
<tr><td colspan="2" align="center"><br><a href="bonuses_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
mysql_query("update bonuses set enable = '".$_POST['enable']."', bonusname = '".$_POST['bonusname']."', bonustype = '".$_POST['bonustype']."', bonusfree = '".$_POST['bonusfree']."', bonuspaid = '".$_POST['bonuspaid']."', credits = '".$_POST['credits']."', solo_num = '".$_POST['solo_num']."', banner_num = '".$_POST['banner_num']."', banner_views = '".$_POST['banner_views']."', button_num = '".$_POST['button_num']."', button_views = '".$_POST['button_views']."', textad_num = '".$_POST['textad_num']."', textad_views = '".$_POST['textad_views']."', fullloginad_num = '".$_POST['fullloginad_num']."', fullloginad_views = '".$_POST['fullloginad_views']."' where id='".$_POST['id']."'") or die(mysql_error());
$show = "Your " . $sitename . " Bonus was saved!";
} # if ($action == "update")
####################################################################################################
if ($action == "add")
{
if ($_POST['bonusname'] == "")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Name field was left blank.</td></tr>
<tr><td colspan="2" align="center"><br><a href="bonuses_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
if (($_POST['bonusfree'] != "yes") and ($_POST['bonuspaid'] != "yes"))
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td align="center" colspan="2"><br>Please select at least one membership level to receive the bonus.</td></tr>
<tr><td colspan="2" align="center"><br><a href="bonuses_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
mysql_query("insert into bonuses set enable = '".$_POST['enable']."', bonusname = '".$_POST['bonusname']."', bonustype = '".$_POST['bonustype']."', bonusfree = '".$_POST['bonusfree']."', bonuspaid = '".$_POST['bonuspaid']."', credits = '".$_POST['credits']."', solo_num = '".$_POST['solo_num']."', banner_num = '".$_POST['banner_num']."', banner_views = '".$_POST['banner_views']."', button_num = '".$_POST['button_num']."', button_views = '".$_POST['button_views']."', textad_num = '".$_POST['textad_num']."', textad_views = '".$_POST['textad_views']."', fullloginad_num = '".$_POST['fullloginad_num']."', fullloginad_views = '".$_POST['fullloginad_views']."'") or die(mysql_error());
$show = "New " . $sitename . " Bonus was added!";
} # if ($action == "add")
####################################################################################################
if ($action == "delete")
{
mysql_query("delete from bonuses where id='".$_POST['id']."'");
$show = "The " . $sitename . " Bonus was deleted!";
} # if ($action == "delete")
####################################################################################################
if ($action == "edit")
{
$editq = "select * from bonuses where id='".$_POST['id']."'";
$editr = mysql_query($editq);
$editrows = mysql_num_rows($editr);
if ($editrows > 0)
{
$bonus = mysql_fetch_array($editr);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">Edit <?php echo $sitename ?> Bonus</div></td></tr>
<form method="POST" action="bonuses_admin.php">
<input type="hidden" name="id" value="<? echo $bonus['id']; ?>">
<input type="hidden" name="action" value="update">
<tr class="sabrinatrlight"><td>Enabled:</td><td><select name="enable">
<option value="yes" <?php if ($bonus["enable"] == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($bonus["enable"] != "yes") { echo "selected"; } ?>>NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Name:</td><td><input type="text" class="typein" name="bonusname" maxlength="255" size="65" value="<? echo $bonus["bonusname"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Type of Bonus:</td><td><select name="bonustype">
<option value="Sign-Up" <?php if ($bonus["bonustype"] == "Sign-Up") { echo "selected"; } ?>>Sign-Up</option>
<option value="Monthly" <?php if ($bonus["bonustype"] == "Monthly") { echo "selected"; } ?>>Monthly</option>
</td></tr>
<tr class="sabrinatrlight"><td>Give to <?php echo $level1name ?> Members:</td><td><select name="bonusfree">
<option value="yes" <?php if ($bonus["bonusfree"] == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($bonus["bonusfree"] != "yes") { echo "selected"; } ?>>NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Give to <?php echo $level2name ?> Members:</td><td><select name="bonuspaid">
<option value="yes" <?php if ($bonus["bonuspaid"] == "yes") { echo "selected"; } ?>>YES</option>
<option value="no" <?php if ($bonus["bonuspaid"] != "yes") { echo "selected"; } ?>>NO</option>
</td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td>Credits to add:</td><td><input type="text" class="typein" name="credits" value="<? echo $bonus["credits"]; ?>"></td></tr>
<?php
}
?>
<tr class="sabrinatrlight"><td>Solo Ads to add:</td><td><input type="text" class="typein" name="solo_num" value="<? echo $bonus["solo_num"]; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Banner Ads to add:</td><td><input type="text" class="typein" name="banner_num" value="<? echo $bonus['banner_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Banner Ad:</td><td><input type="text" class="typein" name="banner_views" value="<? echo $bonus['banner_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Button Ads to add:</td><td><input type="text" class="typein" name="button_num" value="<? echo $bonus['button_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Button Ad:</td><td><input type="text" class="typein" name="button_views" value="<? echo $bonus['button_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Text Ads to add:</td><td><input type="text" class="typein" name="textad_num" value="<? echo $bonus['textad_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Text Ad:</td><td><input type="text" class="typein" name="textad_views" value="<? echo $bonus['textad_views']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Full Page Login Ads to add:</td><td><input type="text" class="typein" name="fullloginad_num" value="<? echo $bonus['fullloginad_num']; ?>"></td></tr>
<tr class="sabrinatrlight"><td>Views per Full Page Login Ad:</td><td><input type="text" class="typein" name="fullloginad_views" value="<? echo $bonus['fullloginad_views']; ?>"></td></tr>
<tr class="sabrinatrdark"><td align="center" colspan="2"><input type="submit" value="UPDATE" class="sendit">&nbsp;&nbsp;<input type="button" value="CANCEL" onclick="window.location='bonuses_admin.php'" class="sendit"></td></tr>
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
<tr><td align="center" colspan="2"><br>That Bonus was not found in the system.</td></tr>
<tr><td colspan="2" align="center"><br><a href="bonuses_admin.php">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "../footer.php";
exit;
}
} # if ($action == "edit")
####################################################################################################
$q = "select * from bonuses order by id";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
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
<tr class="sabrinatrdark"><td align="center" colspan="8"><div class="heading"><?php echo $sitename ?> Member Bonuses</div></td></tr>
<tr class="sabrinatrlight"><td align="center">Name (click to show details)</td><td align="center">Type of Bonus</td><td align="center">Enabled</td><td align="center"><?php echo $level1name ?> Members Receive</td><td align="center"><?php echo $level2name ?> Members Receive</td><td align="center">How Many Times Given So Far</td><td align="center">Edit</td><td align="center">Delete</td></tr>
<?php
	while ($rowz = mysql_fetch_array($r))
	{
	$details = "";
	$id = $rowz["id"];
	$bonusname =$rowz["bonusname"];
	$bonustype = $rowz["bonustype"];
	$bonusfree = $rowz["bonusfree"];
	$bonuspaid = $rowz["bonuspaid"];
	$enable = $rowz["enable"];
	$howmanytimesgiven = $rowz["howmanytimesgiven"];
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
<tr class="sabrinatrlight">
<td align="center"><a href="javascript:;" onclick="document.getElementById('showbonus').innerHTML='<?php echo $details ?>';"><?php echo $bonusname ?></a></td>
<td align="center"><?php echo $bonustype ?></td>
<td align="center"><?php echo $enable ?></td>
<td align="center"><?php echo $bonusfree ?></td>
<td align="center"><?php echo $bonuspaid ?></td>
<td align="center"><?php echo $howmanytimesgiven ?></td>
<form method="POST" action="bonuses_admin.php">
<td align="center">
<input type="hidden" name="action" value="edit">
<input type="hidden" name="id" value="<?php echo $id ?>">
<input type="submit" value="EDIT" class="sendit">
</form>
</td>
<form method="POST" action="bonuses_admin.php">
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
<tr class="sabrinatrlight"><td colspan="8" align="center">
<div id="showbonus"></div>
</td></tr>
</table></td></tr>
<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>
<?php
} # if ($rows > 0)
?>
<tr><td colspan="2" align="center"><br>
<table cellpadding="0" cellspacing="2" border="0" align="center" class="sabrinatable" style="width: 300px;">
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">Give <?php echo $sitename ?> Bonus To A Member</div></td></tr>
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
	$adpackq = "select * from bonuses where enable=\"yes\" order by id";
	$adpackr = mysql_query($adpackq);
	$adpackrows = mysql_num_rows($adpackr);
	if ($adpackrows < 1)
	{
	?>
	<tr class="sabrinatrlight"><td align="center" colspan="2">There are no Bonuses available yet. Please create some below.</td></tr>
	<?php
	}
	if ($adpackrows > 0)
	{
	?>
	<form action="bonuses_admin.php" method="post">
	<tr class="sabrinatrlight"><td>Give To Member: </td><td>
	<select name="bonususerid" class="pickone">
	<?php
	while ($urowz = mysql_fetch_array($ur))
	{
	$userid = $urowz["userid"];
	echo "<option value=\"" . $userid . "\">" . $userid . "</option>";
	}
	?>
	</select>
	</td></tr>
	<tr class="sabrinatrlight"><td>Bonus Package: </td><td><select name="bonustogive">
	<?php
		while ($adpackrowz = mysql_fetch_array($adpackr))
			{
			$bonusid = $adpackrowz["id"];
			$bonusname = $adpackrowz["bonusname"];
			$bonustype = $adpackrowz["bonustype"];
	?>
	<option value="<?php echo $bonusid ?>"><?php echo $bonusname ?> <?php echo $bonustype ?> Bonus</option>
	<?php
			}
	?>
	</select></td></tr>
	<tr class="sabrinatrlight"><td>How Many To Give: </td><td><select name="bonusquantity" class="pickone">
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
	<input type="hidden" name="action" value="addbonus"><input type="submit" value="ADD" class="sendit" class="sendit"></form></td></tr>
	<?php
	} # if ($adpackrows > 0)
} # if ($urows > 0)
?>
</table>
</td></tr>

<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>

<tr><td colspan="2" align="center">
<table cellpadding="0" cellspacing="2" border="0" align="center" width="600" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">Create <?php echo $sitename ?> Member Bonuses</div></td></tr>
<form method="POST" action="bonuses_admin.php">
<input type="hidden" name="action" value="add">
<tr class="sabrinatrlight"><td>Enabled:</td><td><select name="enable">
<option value="yes">YES</option>
<option value="no">NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Name:</td><td><input type="text" class="typein" name="bonusname" maxlength="255" size="65"></td></tr>
<tr class="sabrinatrlight"><td>Type of Bonus:</td><td><select name="bonustype">
<option value="Sign-Up">Sign-Up</option>
<option value="Monthly">Monthly</option>
</td></tr>
<tr class="sabrinatrlight"><td>Give to <?php echo $level1name ?> Members:</td><td><select name="bonusfree">
<option value="yes">YES</option>
<option value="no">NO</option>
</td></tr>
<tr class="sabrinatrlight"><td>Give to <?php echo $level2name ?> Members:</td><td><select name="bonuspaid">
<option value="yes">YES</option>
<option value="no">NO</option>
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
