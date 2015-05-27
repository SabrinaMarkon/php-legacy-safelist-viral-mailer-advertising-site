<?php
include "control.php";
include "header.php";
include "banners.php";
$page = $_POST["page"];
$totalcost = $_POST["totalcost"];
$adpackid = $_POST["adpackid"];
$today = date('Y-m-d',strtotime("now"));
if ($accounttype == "PAID")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td colspan="2" align="center"><br>You are already a <?php echo $level2name ?> <?php echo $sitename ?> Member!</td></tr>
<tr><td colspan="2" align="center"><br><a href="<?php echo $page ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}

$totalcost = sprintf("%.2f", $totalcost);
if ($totalcost < 0)
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Submission Error</div></td></tr>
<tr><td colspan="2" align="center"><br><a href="<?php echo $page ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}
	if ($ewallet >= $totalcost)
		{
		mysql_query("INSERT INTO transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - Member " . $level2name . " Upgrade',NOW(),'".$totalcost."')");
		$eq = "update members set ewallet=ewallet-" . $totalcost . ",membershiplastpaid=\"$today\",accounttype=\"PAID\" where userid=\"$userid\"";
		$er = mysql_query($eq);

		# bonus adpack
		$apq = "select * from adpacks where id=\"$adpackid\"";
		$apr = mysql_query($apq);
		$aprows = mysql_num_rows($apr);
		if ($aprows > 0)
			{
			$description = mysql_result($apr,0,"description");
			$credits = mysql_result($apr,0,"credits");
			$solo_num = mysql_result($apr,0,"solo_num");
			$banner_num = mysql_result($apr,0,"banner_num");
			$banner_views = mysql_result($apr,0,"banner_views");
			$button_num = mysql_result($apr,0,"button_num");
			$button_views = mysql_result($apr,0,"button_views");
			$textad_num = mysql_result($apr,0,"textad_num");
			$textad_views = mysql_result($apr,0,"textad_views");
			$fullloginad_num = mysql_result($apr,0,"fullloginad_num");
			$fullloginad_views = mysql_result($apr,0,"fullloginad_views");
			$countq = "update adpacks set howmanytimeschosen=howmanytimeschosen+1 where id=\"$adpackid\"";
			$countr = mysql_query($countq);
			if ($enablecreditssystem != "yes")
				{
				$credits = 0;
				}

					if ($credits > 0)
					{
						mysql_query("update members set credits=credits+".$credits." where userid=\"$userid\"");
					}

					$solo_count = $solo_num;
					while($solo_count > 0)
					{
					mysql_query("insert into solos (`userid` ,`approved` ,`subject` ,`adbody` ,`added` , `sent`, `purchase`) VALUES ('".$userid."', '0', '', '', '0', '0','".time()."')");
					$solo_count--;
					}

					$banner_count = $banner_num;
					while($banner_count > 0)
					{
					mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$banner_views."','".time()."')");
					$banner_count--;
					}

					$button_count = $button_num;
					while($button_count > 0)
					{
					mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$button_views."','".time()."')");
					$button_count--;
					}

					$textad_count = $textad_num;
					while($textad_count > 0)
					{
					mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$textad_views."','".time()."')");
					$textad_count--;
					}

					$fullloginad_count = $fullloginad_num;
					while($fullloginad_count > 0)
					{
					mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$fullloginad_views."','".time()."')");
					$fullloginad_count--;
					}

			} # if ($aprows > 0)

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

		# sponsor commission
		$refq = "select * from members where userid=\"$referid\"";
		$refr = mysql_query($refq);
		$refrows = mysql_num_rows($refr);
		if ($refrows > 0)
			{
			$refaccounttype = mysql_result($refr,0,"accounttype");
			if ($refaccounttype == "PAID")
				{
				$adpackcommission = $adpackcommissionpaid;
				}
			if ($refaccounttype != "PAID")
				{
				$adpackcommission = $adpackcommissionfree;
				}
			$ewalletq = "update members set ewallet=ewallet+" . $adpackcommission . " where userid=\"$referid\"";
			$ewalletr = mysql_query($ewalletq);
			$refq3 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$adpackcommission\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Paid For Membership\")";
			$refr3 = mysql_query($refq3);
			}
	?>
	<br>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
	<tr><td align="center" colspan="2">Your Account Was Upgraded To <?php echo $sitename ?> <?php echo $level2name ?> Membership!</td></tr>
	<tr><td align="center" colspan="2"><br><a href="<?php echo $page ?>">Return</a></td></tr>
	</table><br><br>
	<?php
		include "footer.php";
		exit;
		} # if ($ewallet >= $totalcost)
	else
		{
		?>
		<br>
		<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
		<tr><td align="center" colspan="2">You do not have enough funds in your <?php echo $ewalletname ?> balance to cover your purchase.<br>You have $<?php echo $ewallet ?> and the total cost of your purchase is $<?php echo $totalcost ?>.<br>Please return and add funds to your <?php echo $ewalletname ?> account and try again.</td></tr>
		<tr><td align="center" colspan="2"><br><a href="<?php echo $page ?>">Return</a></td></tr>
		</table><br><br>
		<?php
		include "footer.php";
		exit;
		} # else
?>
