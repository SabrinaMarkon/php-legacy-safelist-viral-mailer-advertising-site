<?php
include "control.php";
include "header.php";
include "banners.php";
$page = $_POST["page"];
$advertisingquantity = $_POST["advertisingquantity"];
$showadvertisingquantity = $_POST["advertisingquantity"];
$adtype = $_POST["adtype"];
$adpackid = $_POST["adpackid"];
$advertisingid = $_POST["advertisingid"];
$paymentmethod = $_POST["paymentmethod"];

if ($adtype != "credits")
{
	if ($adtype == "adpack")
	{
		$adprice = $adpackprice;
		if ($accounttype == "PAID")
		{
		$creditstrade = $adpackcreditstradepaid;
		}
		if ($accounttype != "PAID")
		{
		$creditstrade = $adpackcreditstradefree;
		}
	}
	elseif ($adtype == "solos")
	{
		$adprice = $soloprice;
		if ($accounttype == "PAID")
		{
		$creditstrade = $soloscreditstradepaid;
		}
		if ($accounttype != "PAID")
		{
		$creditstrade = $soloscreditstradefree;
		}
	}
	elseif ($adtype == "banners")
	{
		$adprice = $bannerprice;
		if ($accounttype == "PAID")
		{
		$creditstrade = $bannerscreditstradepaid;
		}
		if ($accounttype != "PAID")
		{
		$creditstrade = $bannerscreditstradefree;
		}
	}
	elseif ($adtype == "buttons")
	{
		$adprice = $buttonprice;
		if ($accounttype == "PAID")
		{
		$creditstrade = $buttonscreditstradepaid;
		}
		if ($accounttype != "PAID")
		{
		$creditstrade = $buttonscreditstradefree;
		}
	}
	elseif ($adtype == "textads")
	{
		$adprice = $textadprice;
		if ($accounttype == "PAID")
		{
		$creditstrade = $textadscreditstradepaid;
		}
		if ($accounttype != "PAID")
		{
		$creditstrade = $textadscreditstradefree;
		}
	}
	elseif ($adtype == "fullloginads")
	{
		$adprice = $fullloginadprice;
		if ($accounttype == "PAID")
		{
		$creditstrade = $fullloginadscreditstradepaid;
		}
		if ($accounttype != "PAID")
		{
		$creditstrade = $fullloginadscreditstradefree;
		}
	}
	else
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
$totalcost = $adprice*$advertisingquantity;
} # if ($adtype != "credits")

if ($adtype == "credits")
{
$howmanycreditlots = $advertisingquantity/$creditshowmanyperlot;
$adprice = $creditspriceperlot*$howmanycreditlots;
$totalcost = $adprice;
}

$totalcost = sprintf("%.2f", $totalcost);
$totalcreditcost = $creditstrade*$advertisingquantity;
$today = date('Y-m-d',strtotime("now"));

if (($totalcost < 0) or ($advertisingquantity < 1))
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
################################################################## PAY WITH CREDIT BALANCE
if (($paymentmethod == "creditpayment") and ($enablecreditssystem == "yes"))
{
if ($totalcreditcost < 1)
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
if ($credits >= $totalcreditcost)
	{
		if ($adtype == "adpack")
		{
		$apq = "select * from adpacks where id=\"$adpackid\"";
		$apr = mysql_query($apq);
		$aprows = mysql_num_rows($apr);
		if ($aprows > 0)
			{
			$description = mysql_result($apr,0,"description");
			$upgrade = mysql_result($apr,0,"upgrade");
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

				while($advertisingquantity > 0)
				{
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

				$advertisingquantity--;
				}
			}
		$showadtype = $description . " Ad Pack(s)";
		mysql_query("INSERT INTO transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $totalcreditcost . " Credits - $advertisingquantity ". $description . " Ad Pack(s)',NOW(),'0.00')");
		# no sponsor commission because member paid with credits only.
		}
		################
		if ($adtype == "admin_advertising")
		{
			if ($advertisingid != "")
			{
				$q = "select * from advertisingforsale where id=\"$advertisingid\"";
				$r = mysql_query($q);
				$rows = mysql_num_rows($r);
				if ($rows > 0)
					{
					$adid = mysql_result($r,0,"id");
					$description = mysql_result($r,0,"description");
					$type = mysql_result($r,0,"type");
					$howmany = mysql_result($r,0,"howmany");
					$max = mysql_result($r,0,"max");
					$price = mysql_result($r,0,"price");
					$creditprice = mysql_result($r,0,"creditprice");

						if ($type == "Credits")
						 {
						mysql_query("update members set credits=credits+".$howmany." where userid = '".$userid."'");
						 } # if ($type == "Credits")

						if ($type == "Solos")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Solos")

						if ($type == "Banners")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Banners")

						if ($type == "Buttons")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Buttons")

						if ($type == "Text Ads")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Text Ads")

						if ($type == "Full Page Login Ads")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Full Page Login Ads")

					$showadtype = $type;
					if ($type == "Credits")
						{
						mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $creditprice . " Credits - ".$howmany." ".$type."',NOW(),'0.00')");
						}
					else
						{
						mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $creditprice . " Credits - ".$advertisingquantity." ".$type."',NOW(),'0.00')");
						}
					} # if ($rows > 0)
			} # if ($advertisingid != "")
		} # if ($adtype == "admin_advertising")
		################
		if ($adtype == "solos")
		{
			$showadtype = "Solo Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $totalcreditcost . " Credits - $advertisingquantity Solo Ad(s)',NOW(),'0.00')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
				$advertisingquantity--;
				}
		}
		if ($adtype == "banners")
		{
			$showadtype = "Banner Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $totalcreditcost . " Credits - $advertisingquantity Banner Ad(s)',NOW(),'0.00')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$bannermaxviews."','".time()."')");
				$advertisingquantity--;
				}
		}
		if ($adtype == "buttons")
		{
			$showadtype = "Button Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $totalcreditcost . " Credits - $advertisingquantity Button Ad(s)',NOW(),'0.00')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$buttonmaxviews."','".time()."')");
				$advertisingquantity--;
				}
		}
		if ($adtype == "textads")
		{
			$showadtype = "Text Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $totalcreditcost . " Credits - $advertisingquantity Text Ad(s)',NOW(),'0.00')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$textadmaxviews."','".time()."')");
				$advertisingquantity--;
				}
		}
		if ($adtype == "fullloginads")
		{
			$showadtype = "Full Page Login Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Credit Purchase','Traded " . $totalcreditcost . " Credits -  - $advertisingquantity Full Page Login Ad(s)',NOW(),'".$totalcost."')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$fullloginadmaxviews."','".time()."')");
				$advertisingquantity--;
				}
		}
		$eq = "update members set credits=credits-" . $totalcreditcost . " where userid=\"$userid\"";
		$er = mysql_query($eq);
	?>
	<br>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
	<tr><td align="center" colspan="2"><?php echo $showadvertisingquantity ?> <?php echo $showadtype ?> added to your account!</td></tr>
	<tr><td align="center" colspan="2"><br><a href="<?php echo $page ?>">Return</a></td></tr>
	</table><br><br>
	<?php
		include "footer.php";
		exit;
	} # if ($credits >= $totalcreditcost)
else
	{
	?>
	<br>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
	<tr><td align="center" colspan="2">You do not have enough credits to cover your purchase.<br>You have a balance of <?php echo $credits ?> credits and the total cost of your purchase is <?php echo $totalcreditcost ?> credits OR $<?php echo $totalcost ?> from your <?php echo $ewalletname?>.<br>Please return and click additional member ads to collect more credits and increase your balance, or add funds to your <?php echo $ewalletname ?> account to try again.</td></tr>
	<tr><td align="center" colspan="2"><br><a href="<?php echo $page ?>">Return</a></td></tr>
	</table><br><br>
	<?php
	include "footer.php";
	exit;
	} # else
} # if (($paymentmethod == "creditpayment") and ($enablecreditssystem == "yes"))
################################################################## PAY WITH E-WALLET FUNDS
else
{
if ($ewallet >= $totalcost)
	{
		if ($adtype == "adpack")
		{
		$apq = "select * from adpacks where id=\"$adpackid\"";
		$apr = mysql_query($apq);
		$aprows = mysql_num_rows($apr);
		if ($aprows > 0)
			{
			$description = mysql_result($apr,0,"description");
			$upgrade = mysql_result($apr,0,"upgrade");
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

				while($advertisingquantity > 0)
				{
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

				$advertisingquantity--;
				}
			}
		$showadtype = $description . " Ad Pack(s)";
		mysql_query("INSERT INTO transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity ". $description . " Ad Pack(s)',NOW(),'".$totalcost."')");
			# sponsor commission
			$refq = "select * from members where userid=\"$referid\"";
			$refr = mysql_query($refq);
			$refrows = mysql_num_rows($refr);
			if ($refrows > 0)
				{
				$refaccounttype = mysql_result($refr,0,"accounttype");
				if ($refaccounttype == "PAID")
					{
					$totaladpackcommission = $adpackcommissionpaid*$advertisingquantity;
					}
				if ($refaccounttype != "PAID")
					{
					$totaladpackcommission = $adpackcommissionfree*$advertisingquantity;
					}
				$ewalletq = "update members set ewallet=ewallet+" . $totaladpackcommission . " where userid=\"$referid\"";
				$ewalletr = mysql_query($ewalletq);
				$refq3 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totaladpackcommission\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity ". $description . " Ad Pack(s)\")";
				$refr3 = mysql_query($refq3);
				}
		}

		################ SPONSOR COMMISSION - INDIVIDUAL AD SALES
		$refq = "select * from members where userid=\"$referid\"";
		$refr = mysql_query($refq);
		$refrows = mysql_num_rows($refr);
		if ($refrows > 0)
			{
			$refaccounttype = mysql_result($refr,0,"accounttype");
			if ($refaccounttype == "PAID")
				{
				if ($adtype == "credits")
					{
					$sponsorcommissions = $creditcommissionpaid;
					}
				if ($adtype == "solos")
					{
					$sponsorcommissions = $solocommissionpaid;
					}
				if ($adtype == "banners")
					{
					$sponsorcommissions = $bannercommissionpaid;
					}
				if ($adtype == "buttons")
					{
					$sponsorcommissions = $buttoncommissionpaid;
					}
				if ($adtype == "textads")
					{
					$sponsorcommissions = $textadcommissionpaid;
					}
				if ($adtype == "fullloginads")
					{
					$sponsorcommissions = $fullloginadcommissionpaid;
					}
				} # if ($refaccounttype == "PAID")
			if ($refaccounttype != "PAID")
				{
				if ($adtype == "credits")
					{
					$sponsorcommissions = $creditcommissionfree;
					}
				if ($adtype == "solos")
					{
					$sponsorcommissions = $solocommissionfree;
					}
				if ($adtype == "banners")
					{
					$sponsorcommissions = $bannercommissionfree;
					}
				if ($adtype == "buttons")
					{
					$sponsorcommissions = $buttoncommissionfree;
					}
				if ($adtype == "textads")
					{
					$sponsorcommissions = $textadcommissionfree;
					}
				if ($adtype == "fullloginads")
					{
					$sponsorcommissions = $fullloginadcommissionfree;
					}
				} # if ($refaccounttype != "PAID")
			$totalsponsorcommissions = $advertisingquantity*$sponsorcommissions;
			} # if ($refrows > 0)
		################
		if ($adtype == "admin_advertising")
		{
			if ($advertisingid != "")
			{
				$q = "select * from advertisingforsale where id=\"$advertisingid\"";
				$r = mysql_query($q);
				$rows = mysql_num_rows($r);
				if ($rows > 0)
					{
					$adid = mysql_result($r,0,"id");
					$description = mysql_result($r,0,"description");
					$type = mysql_result($r,0,"type");
					$howmany = mysql_result($r,0,"howmany");
					$max = mysql_result($r,0,"max");
					$price = mysql_result($r,0,"price");
					$commissionfree = mysql_result($r,0,"commissionfree");
					$commissionpaid = mysql_result($r,0,"commissionpaid");

					# sponsor commissions.
					$referidq = "select * from members where userid=\"$referid\"";
					$referidr = mysql_query($referidq);
					$referidrows = mysql_num_rows($referidr);
					if ($referidrows > 0)
						{
						$refaccounttype = mysql_result($referidr,0,"accounttype");
						if ($refaccounttype == "PAID")
							{
							$totalsponsorcommissions = $commissionpaid;
							}
						if ($refaccounttype != "PAID")
							{
							$totalsponsorcommissions = $commissionfree;
							}
						}

						if ($type == "Credits")
						 {
						mysql_query("update members set credits=credits+".$howmany." where userid = '".$userid."'");
						 } # if ($type == "Credits")

						if ($type == "Solos")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Solos")

						if ($type == "Banners")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Banners")

						if ($type == "Buttons")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Buttons")

						if ($type == "Text Ads")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Text Ads")

						if ($type == "Full Page Login Ads")
						 {
							$count = $howmany;
							while ($count > 0)
							 {
								mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$max."','".time()."')");
								$count--;
							 }
						 } # if ($type == "Full Page Login Ads")

					$showadtype = $type;
					if ($type == "Credits")
						{
						mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - ".$howmany." ".$type."',NOW(),'".$adprice."')");
						}
					else
						{
						mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - ".$advertisingquantity." ".$type."',NOW(),'".$totalcost."')");
						}

					if ($totalsponsorcommissions > 0)
					{
					$sponsorq = "update members set ewallet=ewallet+" . $totalsponsorcommissions . " where userid=\"$referid\"";
					$sponsorr = mysql_query($sponsorq);
					$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totalsponsorcommissions\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity $type\")";
					$sponsorr2 = mysql_query($sponsorq2);
					}
					} # if ($rows > 0)
			} # if ($advertisingid != "")
		} # if ($adtype == "admin_advertising")
		################
		if ($adtype == "credits")
		{
			$showadtype = "Credits";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity Credits',NOW(),'".$adprice."')");
			mysql_query("update members set credits=credits+".$advertisingquantity." where userid=\"$userid\"");
			# since credits are sold in different "lots", sponsor commission is a percent of the sale instead of dollar value.
			if ($totalsponsorcommissions > 0)
			{
			$paysponsor = ($totalsponsorcommissions*$adprice)/100;
			$sponsorq = "update members set ewallet=ewallet+" . $paysponsor . " where userid=\"$referid\"";
			$sponsorr = mysql_query($sponsorq);
			$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$paysponsor\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity Credits\")";
			$sponsorr2 = mysql_query($sponsorq2);
			}
		}
		if ($adtype == "solos")
		{
			$showadtype = "Solo Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity Solo Ad(s)',NOW(),'".$totalcost."')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into solos (userid,purchase) VALUES ('".$userid."','".time()."')");
				$advertisingquantity--;
				}
			if ($totalsponsorcommissions > 0)
			{
			$sponsorq = "update members set ewallet=ewallet+" . $totalsponsorcommissions . " where userid=\"$referid\"";
			$sponsorr = mysql_query($sponsorq);
			$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totalsponsorcommissions\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity Solo Ad(s)\")";
			$sponsorr2 = mysql_query($sponsorq2);
			}
		}
		if ($adtype == "banners")
		{
			$showadtype = "Banner Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity Banner Ad(s)',NOW(),'".$totalcost."')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into banners (userid,max,purchase) VALUES ('".$userid."','".$bannermaxviews."','".time()."')");
				$advertisingquantity--;
				}
			if ($totalsponsorcommissions > 0)
			{
			$sponsorq = "update members set ewallet=ewallet+" . $totalsponsorcommissions . " where userid=\"$referid\"";
			$sponsorr = mysql_query($sponsorq);
			$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totalsponsorcommissions\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity Banner Ad(s)\")";
			$sponsorr2 = mysql_query($sponsorq2);
			}
		}
		if ($adtype == "buttons")
		{
			$showadtype = "Button Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity Button Ad(s)',NOW(),'".$totalcost."')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into buttons (userid,max,purchase) VALUES ('".$userid."','".$buttonmaxviews."','".time()."')");
				$advertisingquantity--;
				}
			if ($totalsponsorcommissions > 0)
			{
			$sponsorq = "update members set ewallet=ewallet+" . $totalsponsorcommissions . " where userid=\"$referid\"";
			$sponsorr = mysql_query($sponsorq);
			$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totalsponsorcommissions\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity Button Ad(s)\")";
			$sponsorr2 = mysql_query($sponsorq2);
			}
		}
		if ($adtype == "textads")
		{
			$showadtype = "Text Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity Text Ad(s)',NOW(),'".$totalcost."')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into textads (userid,max,purchase) VALUES ('".$userid."','".$textadmaxviews."','".time()."')");
				$advertisingquantity--;
				}
			if ($totalsponsorcommissions > 0)
			{
			$sponsorq = "update members set ewallet=ewallet+" . $totalsponsorcommissions . " where userid=\"$referid\"";
			$sponsorr = mysql_query($sponsorq);
			$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totalsponsorcommissions\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity Text Ad(s)\")";
			$sponsorr2 = mysql_query($sponsorq2);
			}
		}
		if ($adtype == "fullloginads")
		{
			$showadtype = "Full Page Login Ad(s)";
			mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$ewalletname."','".$ewalletname." Purchase - $advertisingquantity Full Page Login Ad(s)',NOW(),'".$totalcost."')");
				while($advertisingquantity > 0)
				{
				mysql_query("insert into fullloginads (userid,max,purchase) VALUES ('".$userid."','".$fullloginadmaxviews."','".time()."')");
				$advertisingquantity--;
				}
			if ($totalsponsorcommissions > 0)
			{
			$sponsorq = "update members set ewallet=ewallet+" . $totalsponsorcommissions . " where userid=\"$referid\"";
			$sponsorr = mysql_query($sponsorq);
			$sponsorq2 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$totalsponsorcommissions\",NOW(),\"$ewalletname Sponsor Payment - Referral $userid Purchased $advertisingquantity Full Page Login Ad(s)\")";
			$sponsorr2 = mysql_query($sponsorq2);
			}
		}
		$eq = "update members set ewallet=ewallet-" . $totalcost . " where userid=\"$userid\"";
		$er = mysql_query($eq);
	?>
	<br>
	<table cellpadding="4" cellspacing="0" border="0" width="100%" align="center">
	<tr><td align="center" colspan="2"><?php echo $showadvertisingquantity ?> <?php echo $showadtype ?> added to your account!</td></tr>
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
} # else
?>