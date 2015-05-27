<?php
include "control.php";
include "header.php";
include "banners.php";
$page = $_POST["page"];
$adpackid = $_POST["adpackid"];
$today = date('Y-m-d',strtotime("now"));
if ($joinprice < 0)
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
if ($joinpriceinterval == "One Time")
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Payment for <?php echo $level2name ?> Membership is One Time Only</div></td></tr>
<tr><td colspan="2" align="center"><br><a href="<?php echo $page ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}

	if ($membershiplastpaid != "")
	{
		if ($joinpriceinterval == "Annually")
		{
		$nextdue = date('Y-m-d', strtotime("+1 years", strtotime($membershiplastpaid)));
		}
		if ($joinpriceinterval != "Annually")
		{
		$nextdue = date('Y-m-d', strtotime("+1 months", strtotime($membershiplastpaid)));
		}
	}
	if ($membershiplastpaid == "")
	{
		$lastdue = date('Y-m-d', strtotime("-1 months", strtotime("now")));
		$mq = "update members set membershiplastpaid=\"$lastdue\" where userid=\"$userid\"";
		$mr = mysql_query($mq);
		$nextdue = $today;
		$membershiplastpaid = $lastdue;
	}

if (($nextdue < $today) and ($membershiplastpaid < $nextdue))
	{
	if ($ewallet >= $joinprice)
		{
		mysql_query("INSERT INTO transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - " . $level2name . " Membership Renewal',NOW(),'".$joinprice."')");
		$eq = "update members set ewallet=ewallet-" . $joinprice . ",membershiplastpaid=\"$nextdue\",accounttype=\"PAID\" where userid=\"$userid\"";
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
			$refq3 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$adpackcommission\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Paid For Membership Renewal\")";
			$refr3 = mysql_query($refq3);
			}
	?>
	<br>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
	<tr><td align="center" colspan="2">Your <?php echo $level2name ?> Membership Was Renewed!</td></tr>
	<tr><td align="center" colspan="2"><br><a href="<?php echo $page ?>">Return</a></td></tr>
	</table><br><br>
	<?php
		include "footer.php";
		exit;
		} # if ($ewallet >= $joinprice)
	else
		{
		?>
		<br>
		<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
		<tr><td align="center" colspan="2">You do not have enough funds in your <?php echo $ewalletname ?> balance to cover your purchase.<br>You have $<?php echo $ewallet ?> and the total cost of your purchase is $<?php echo $joinprice ?>.<br>Please <a href="fundewallet.php">add funds to your <?php echo $ewalletname ?> account</a> and try again.</td></tr>
		<tr><td align="center" colspan="2"><br><a href="<?php echo $page ?>">Return</a></td></tr>
		</table><br><br>
		<?php
		include "footer.php";
		exit;
		} # else
	} # if (($nextdue < $today) and ($membershiplastpaid < $nextdue))
else
{
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
<tr><td colspan="2" align="center"><br>Your Membership fee isn't due until <?php echo $nextdue ?></td></tr>
<tr><td colspan="2" align="center"><br><a href="<?php echo $page ?>">RETURN</a></td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
}
?>
