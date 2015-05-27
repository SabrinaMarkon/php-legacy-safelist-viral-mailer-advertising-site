<?php
include "control.php";
require('EgoPaySci.php');
include "header.php";
include "banners.php";
$fundamount = $_REQUEST["fundamount"];
if ($fundamount > 0)
{
$fundamount = sprintf("%.2f", $fundamount);
$efeecost = ($paymentprocessorfeetoadd*$fundamount)/100;
$efeecost = sprintf("%.2f", $efeecost);
$fundamountplusfee = $efeecost+$fundamount;
$fundamountplusfee = sprintf("%.2f", $fundamountplusfee);
} # if ($fundamount > 0)
else
{
$fundamount = $ewalletfundingincrement;
$defaultamount = $ewalletfundingincrement;
$defaultamount = sprintf("%.2f", $defaultamount);
$efeecost = ($paymentprocessorfeetoadd*$defaultamount)/100;
$efeecost = sprintf("%.2f", $efeecost);
$fundamountplusfee = $efeecost+$defaultamount;
$fundamountplusfee = sprintf("%.2f", $fundamountplusfee);
}

$maxfundingoption = $ewalletfundingincrement*$ewalletfundinghowmanyincrements;
$fundingoptions = "";
for ($f=1;$f<=$ewalletfundinghowmanyincrements;$f++)
{
$howmuchfunding = $ewalletfundingincrement*$f;
$howmuchfunding = sprintf("%.2f", $howmuchfunding);
$fundingoptions .= "<option value=\"" . $howmuchfunding . "\"";
	if ($fundamount == $howmuchfunding)
	{ 
	$fundingoptions .= "selected";
	}
$fundingoptions .= ">" . $howmuchfunding . "</option>";
}
########################################## START PROMO CODE HANDLING
$action = $_POST["action"];
if ($action == "redeemcode")
{
$code = $_POST["code"];
$codeq = "select * from promocodes where code=\"$code\" and enable=\"yes\"";
$coder = mysql_query($codeq);
$coderows = mysql_num_rows($coder);
if ($coderows < 1)
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td colspan="2" align="center"><br>The Promo Code you entered was not found in the system.</td></tr>
	<tr><td colspan="2" align="center"><br><a href="orderads.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}
if ($coderows > 0)
	{
	$codeid = mysql_result($coder,0,"id");
	$codename = mysql_result($coder,0,"name");
	$codemaximum = mysql_result($coder,0,"maximum");
	$codehowmanytimesclaimed = mysql_result($coder,0,"howmanytimesclaimed");
	$codepromocodefree = mysql_result($coder,0,"promocodefree");
	$codepromocodepaid = mysql_result($coder,0,"promocodepaid");
	$upgrade = mysql_result($coder,0,"upgrade");
	$credits = mysql_result($coder,0,"credits");
	$solo_num = mysql_result($coder,0,"solo_num");
	$banner_num = mysql_result($coder,0,"banner_num");
	$banner_views = mysql_result($coder,0,"banner_views");
	$button_num = mysql_result($coder,0,"button_num");
	$button_views = mysql_result($coder,0,"button_views");
	$textad_num = mysql_result($coder,0,"textad_num");
	$textad_views = mysql_result($coder,0,"textad_views");
	$fullloginad_num = mysql_result($coder,0,"fullloginad_num");
	$fullloginad_views = mysql_result($coder,0,"fullloginad_views");
	#####################################	
	
	$alreadyq = "select * from promocodes_used where userid=\"$userid\" and promocode=\"$code\"";
	$alreadyr = mysql_query($alreadyq);
	$alreadyrows = mysql_num_rows($alreadyr);
	if ($alreadyrows > 0)
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2" align="center"><br>You have already used Promo Code <?php echo $code ?>.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="orderads.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		}

	if ($codehowmanytimesclaimed >= $codemaximum)
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2" align="center"><br>The Promo Code you entered has reached the maximum allowed number of claims.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="orderads.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		} # if ($codehowmanytimesclaimed >= $codemaximum)
		if ($accounttype == "PAID")
		{
		$codepromocode = $codepromocodepaid;
		}
		if ($accounttype != "PAID")
		{
		$codepromocode = $codepromocodefree;
		}
		if ($codepromocode != "yes")
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2" align="center"><br>The Promo Code you entered is not available to your membership level.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="orderads.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		} # if ($codepromocode != "yes")
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
	$codeq2 = "update promocodes set howmanytimesclaimed=howmanytimesclaimed+1 where id=\"$codeid\"";
	$coder2 = mysql_query($codeq2);
	$codeq3 = "insert into promocodes_used (userid,promocode) values (\"$userid\",\"$code\")";
	$coder3 = mysql_query($codeq3);
	mysql_query("insert into transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','Promo Code Claim:','" . $codename . " - Code: " . $code . "',NOW(),'0.00')");
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Success!</div></td></tr>
	<tr><td colspan="2" align="center"><br>You've successfully redeemed the <?php echo $codename ?> Promo Code with Code <?php echo $code ?>. Your advertising has been added to your account!</td></tr>
	<tr><td colspan="2" align="center"><br><a href="orderads.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	} # if ($coderows > 0)
} # if ($action == "redeemcode")
########################################## END PROMO CODE HANDLING
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600">
<tr><td>
<?php
$q = "select * from pages where name='Members Area Advertising Order Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;

$defaultadpackq = "select * from adpacks where enable=\"yes\" order by id limit 1";
$defaultadpackr = mysql_query($defaultadpackq);
$defaultadpackrows = mysql_num_rows($defaultadpackr);
if ($defaultadpackrows > 0)
{
	$adpackdefaultid = mysql_result($defaultadpackr,0,"id");
}
?>
</td></tr>
</table>
</td></tr>

<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" width="80%" class="sabrinatable">

<script type="text/javascript">
function changeAPHiddenInput (objDropDown)
{
	var adpackdata=objDropDown.value.split("||");
	var adpackid=adpackdata[0];
	if (adpackid)
	{
	var adpackdetails=adpackdata[1];
	var objAPadpack = document.getElementById("adpackid");
	objAPadpack.value = adpackid;
	document.getElementById("apdetails").innerHTML = adpackdetails + "<br><br>";
	document.getElementById("apdetails").visibility = "visible";
	document.getElementById("apdetails").display = "block";
	}
	else
	{
	var objAPadpack = document.getElementById("adpackid");
	objAPadpack.value = "<?php echo $adpackdefaultid ?>";
	var objapdetails = document.getElementById("apdetails");
	document.getElementById("apdetails").innerHTML = "";
	document.getElementById("apdetails").visibility = "hidden";
	document.getElementById("apdetails").display = "none";
	}
}
</script>

<tr class="sabrinatrlight"><td colspan="2" align="center"><br>Your Affiliate URL: <a href="<?php echo $domain ?>/index.php?referid=<?php echo $userid ?>" target="_blank"><?php echo $domain ?>/index.php?referid=<?php echo $userid ?></a><br>&nbsp;</td></tr>

<form action="orderads.php" method="post">
<tr class="sabrinatrlight"><td>&nbsp;&nbsp;Redeem Promo Code:</td><td><input type="text" name="code" maxlength="255" size="16">&nbsp;<input type="hidden" name="action" value="redeemcode"><input type="submit" value="SUBMIT"></form></td></tr>

<?php
if ($accounttype == "PAID")
{
$adpackq = "select * from adpacks where enable=\"yes\" order by id";
$adpackr = mysql_query($adpackq);
$adpackrows = mysql_num_rows($adpackr);
if ($adpackrows > 0)
	{
?>
<tr class="sabrinatrdark"><td align="center" colspan="2">ADVERTISING ADPACKS</td></tr>
<?php
	}
?>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br>Your <?php echo $ewalletname ?> Balance: $<?php echo $ewallet ?>
<?php
if ($enablecreditssystem == "yes")
	{
?>
<br>Your Credit Balance: <?php echo $credits ?>
<?php
	}
?>
<br>&nbsp;</td></tr>
<?php
if ($adpackrows > 0)
	{
?>
<tr class="sabrinatrdark"><td colspan="2" align="center"><br><br>
<form action="orderadvertising.php" method="post">
Order ($<?php echo sprintf("%.2f", $adpackprice); ?>
<?php
if (($enablecreditssystem == "yes") and ($adcreditsprice > 0))
{
echo " or " . $adpackscreditstrade . " Credits";
}
?>
/AdPack):&nbsp;
<select name="selectadpack" id="selectadpack" class="pickone" onchange="changeAPHiddenInput(this)">
<option value=""> - Select Your AdPack! - </option>
<?php
	while ($adpackrowz = mysql_fetch_array($adpackr))
		{
		$details = "";
		$adpackid = $adpackrowz["id"];
		$adpackdescription = $adpackrowz["description"];
		$howmanytimeschosen = $adpackrowz["howmanytimeschosen"];
		$enable = $adpackrowz["enable"];
		$upgrade = $adpackrowz["upgrade"];
		$credits = $adpackrowz["credits"];
		$solo_num = $adpackrowz["solo_num"];
		$banner_num = $adpackrowz["banner_num"];
		$banner_views = $adpackrowz["banner_views"];
		$button_num = $adpackrowz["button_num"];
		$button_views = $adpackrowz["button_views"];
		$textad_num = $adpackrowz["textad_num"];
		$textad_views = $adpackrowz["textad_views"];
		$fullloginad_num = $adpackrowz["fullloginad_num"];
		$fullloginad_views = $adpackrowz["fullloginad_views"];
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
		$details = htmlentities($details, ENT_COMPAT, "ISO-8859-1");
?>
<option value="<?php echo $adpackid ?>||<?php echo $details ?>"><?php echo $adpackdescription ?></option>
<?php
		}
?>
</select>
&nbsp;&nbsp;
Quantity:&nbsp;<select name="advertisingquantity" class="pickone">
<?php
for ($i=1;$i<=20;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
&nbsp;&nbsp;
<?php
if ($enablecreditssystem == "yes")
{
?>
<select name="paymentmethod">
<option value="ewalletpayment"><?php echo $ewalletname ?></option>
<?php
	if (($credits >= $adpackscreditstrade) and ($credits > 0) and ($adpackscreditstrade > 0))
	{
	?>
	<option value="creditpayment">Credit Balance</option>
	<?php
	}
?>
</select>
<?php
}
?>
&nbsp;&nbsp;
<input type="hidden" name="adtype" value="adpack">
<input type="hidden" name="page" value="orderads.php">
<input type="hidden" name="adpackid" id="adpackid" value="">
<input type="submit" value="Order" class="sendit"></form>
<br>
<div id="apdetails" name="apdetails"></div>
</td></tr>
<?php
	} # if ($adpackrows > 0)
} # if ($accounttype == "PAID")
############################
############################
if ($accounttype != "PAID")
{
?>
<tr class="sabrinatrdark"><td align="center" colspan="2"><div class="heading">UPGRADE</div></td></tr>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><?php echo $ewalletname ?> Balance: $<?php echo $ewallet ?>
<?php
if ($enablecreditssystem == "yes")
	{
?>
<br>Your Credit Balance: <?php echo $credits ?>
<?php
	}
?>
<br>&nbsp;</td></tr>
<tr class="sabrinatrdark"><td colspan="2" align="center"><br><br>
<form action="orderupgrade.php" method="post">
Order Upgrade $<?php echo sprintf("%.2f", $joinprice); ?> <?php echo $joinpriceinterval ?>
&nbsp;&nbsp;
<?php
$adpackq = "select * from adpacks where enable=\"yes\" order by id";
$adpackr = mysql_query($adpackq);
$adpackrows = mysql_num_rows($adpackr);
if ($adpackrows > 0)
	{
?>
Select AdPack: <select name="selectadpack" id="selectadpack" class="pickone" onchange="changeAPHiddenInput(this)">
<option value=""> - Select Bonus AdPack - </option>
<?php
	while ($adpackrowz = mysql_fetch_array($adpackr))
		{
		$details = "";
		$adpackid = $adpackrowz["id"];
		$adpackdescription = $adpackrowz["description"];
		$howmanytimeschosen = $adpackrowz["howmanytimeschosen"];
		$enable = $adpackrowz["enable"];
		$upgrade = $adpackrowz["upgrade"];
		$credits = $adpackrowz["credits"];
		$solo_num = $adpackrowz["solo_num"];
		$banner_num = $adpackrowz["banner_num"];
		$banner_views = $adpackrowz["banner_views"];
		$button_num = $adpackrowz["button_num"];
		$button_views = $adpackrowz["button_views"];
		$textad_num = $adpackrowz["textad_num"];
		$textad_views = $adpackrowz["textad_views"];
		$fullloginad_num = $adpackrowz["fullloginad_num"];
		$fullloginad_views = $adpackrowz["fullloginad_views"];
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
		$details = htmlentities($details, ENT_COMPAT, "ISO-8859-1");
?>
<option value="<?php echo $adpackid ?>||<?php echo $details ?>"><?php echo $adpackdescription ?></option>
<?php
		}
?>
</select>
<?php
	}
?>
&nbsp;&nbsp;
<input type="hidden" name="page" value="orderads.php"><input type="hidden" name="adpackid" id="adpackid" value=""><input type="hidden" name="totalcost" value="<?php echo $joinprice ?>"><input type="submit" value="Order" class="sendit"></form>
<br>
<div id="apdetails" name="apdetails"></div>
</td></tr>
<?php
} # if ($accounttype != "PAID")

##########################
if (($egopay_store_id!="") and ($egopay_store_password!=""))
{
try {
        
    $oEgopay = new EgoPaySci(array(
        'store_id'          => $egopay_store_id,
        'store_password'    => $egopay_store_password
    ));
    
    $sPaymentHash = $oEgopay->createHash(array(
	/*
	 * Payment amount with two decimal places 
	 */
        'amount'    => $fundamountplusfee,
	/*
	 * Payment currency, USD/EUR
	 */
        'currency'  => 'USD',
	/*
	 * Description of the payment, limited to 120 chars
	 */
        'description' => $sitename . ' - ' . $ewalletname . ' - ' . $userid,
	
	/*
	 * Optional fields
	 */
	'fail_url'	=> $domain. '/orderads.php',
	'success_url'	=> $domain. '/thankyou_ewallet.php',
	
	/*
	 * 8 Custom fields, hidden from users, limited to 100 chars.
	 * You can retrieve them only from your callback file.
	 */
	'cf_1' => $userid,
	'cf_2' => $sitename . ' - ' . $ewalletname . ' - ' . $userid,
	'cf_3' => $fundamount,
	//'cf_4' => '',
	//'cf_5' => '',
	//'cf_6' => '',
	//'cf_7' => '',
	//'cf_8' => '',
    ));
    
} catch (EgoPayException $e) {
    die($e->getMessage());
}
?>
<form>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><br><br>Fund <?php echo $ewalletname ?> Balance Amount:&nbsp;&nbsp;
$&nbsp;<select name="fundamount" id="fundamount" onchange="this.form.submit()" class="pickone">
<?php
echo $fundingoptions;
?>
</select>
<?php
if ($paymentprocessorfeetoadd > 0)
		{
		echo " + " . $paymentprocessorfeetoadd . "% payment processor fee of \$" . $efeecost . "(Total Cost: \$" . $fundamountplusfee . ")<br>";
		}
?>
</form>
After you've made your payment, please be sure to click the link on EgoPay to return back to the website!<br><br>
<form action="<?php echo EgoPaySci::EGOPAY_PAYMENT_URL; ?>" method="post">
<input type="hidden" name="hash" value="<?php echo $sPaymentHash ?>">
<input type="image" src="<?php echo $domain ?>/images/egopay.png" border="0">
</form>
<br><br>&nbsp;</td></tr>
<?php
} # if (($egopay_store_id!="") and ($egopay_store_password!=""))

if ($adminpaypal != "")
{
?>
<form>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><br><br>Fund <?php echo $ewalletname ?> Balance Amount:&nbsp;&nbsp;
$&nbsp;<select name="fundamount" id="fundamount" onchange="this.form.submit()" class="pickone">
<?php
echo $fundingoptions;
?>
</select>
<?php
if ($paymentprocessorfeetoadd > 0)
		{
		echo " + " . $paymentprocessorfeetoadd . "% payment processor fee of \$" . $efeecost . "(Total Cost: \$" . $fundamountplusfee . ")<br>";
		}
?>
</form>
After you've made your payment, please be sure to click the link on Paypal to return back to the website!<br><br>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="amount" id="amount" value="<?php echo $fundamountplusfee ?>">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="<?php echo $adminpaypal ?>">
<input type="hidden" name="item_name" value="<?php echo $sitename ?> - <?php echo $ewalletname ?> - <?php echo $userid ?>">
<input type="hidden" name="page_style" value="PayPal">
<input type="hidden" name="no_shipping" value="1">
<input type="hidden" name="return" value="<?php echo $domain ?>/thankyou_ewallet.php">
<input type="hidden" name="cancel" value="<?php echo $domain ?>/orderads.php">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="bn" value="PP-BuyNowBF">
<input type="hidden" name="on0" value="User ID">
<input type="hidden" name="os0" value="<?php echo $userid ?>">
<input type="hidden" name="on1" value="Before Fee">
<input type="hidden" name="os1" value="<?php echo $fundamount ?>">
<input type="hidden" name="notify_url" value="<?php echo $domain ?>/paypal_ipn.php">
<input type="image" src="<?php echo $domain ?>/images/paypal.jpg" border="0" name="submit">
</form>
<br>&nbsp;</td></tr>
<?php
} # if ($adminpaypal != "")

if ($adminpayza != "")
{
?>
<form>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><br><br>Fund <?php echo $ewalletname ?> Balance Amount:&nbsp;&nbsp;
$&nbsp;<select name="fundamount" id="fundamount" onchange="this.form.submit()" class="pickone">
<?php
echo $fundingoptions;
?>
</select>
<?php
if ($paymentprocessorfeetoadd > 0)
		{
		echo " + " . $paymentprocessorfeetoadd . "% payment processor fee of \$" . $efeecost . "(Total Cost: \$" . $fundamountplusfee . ")<br>";
		}
?>
</form>
After you've made your payment, please be sure to click the link on Payza to return back to the website!<br>
<form action="https://secure.payza.com/checkout" method="post">
<input type="hidden" name="ap_amount" value="<?php echo $fundamountplusfee ?>">
<input type="hidden" name="ap_purchasetype" value="item-goods">
<input type="hidden" name="ap_merchant" value="<?php echo $adminpayza ?>">    
<input type="hidden" name="ap_itemname" value="<?php echo $sitename ?> - <?php echo $ewalletname ?> - <?php echo $userid ?>">
<input type="hidden" name="ap_returnurl" value="<?php echo $domain ?>/thankyou_ewallet.php">
<input type="hidden" name="ap_cancelurl" value="<?php echo $domain ?>/orderads.php">
<input type="hidden" name="apc_1" value="<?php echo $userid ?>">
<input type="hidden" name="apc_2" value="<?php echo $fundamount ?>">
<input type="hidden" name="ap_currency" value="USD"><br> 
<input type="image" name="ap_image" src="<?php echo $domain ?>/images/payza.gif" border="0">
</form> 
<br>&nbsp;</td></tr>
<?php
} # if ($adminpayza != "")

if ($adminperfectmoney != "")
{
?>
<form>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><br><br>Fund <?php echo $ewalletname ?> Balance Amount:&nbsp;&nbsp;
$&nbsp;<select name="fundamount" id="fundamount" onchange="this.form.submit()" class="pickone">
<?php
echo $fundingoptions;
?>
</select>
<?php
if ($paymentprocessorfeetoadd > 0)
		{
		echo " + " . $paymentprocessorfeetoadd . "% payment processor fee of \$" . $efeecost . "(Total Cost: \$" . $fundamountplusfee . ")<br>";
		}

#$V2_HASH = strtoupper(md5($adminperfectmoneyalternatepassphrase));
?>
</form>
After you've made your payment, please be sure to click the link on Perfect Money to return back to the website!<br><br>
<form action="https://perfectmoney.com/api/step1.asp" method="POST">
<input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $adminperfectmoney ?>">
<input type="hidden" name="PAYEE_NAME" value="<?php echo $adminname ?>">
<input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $fundamountplusfee ?>">
<input type="hidden" name="PAYMENT_UNITS" value="USD">
<input type="hidden" name="STATUS_URL" value="<?php echo $domain ?>/<?php echo $domain ?>/perfectmoney_ipn.php">
<input type="hidden" name="PAYMENT_URL" value="<?php echo $domain ?>/thankyou_ewallet.php">
<input type="hidden" name="NOPAYMENT_URL" value="<?php echo $domain ?>/orderads.php">
<input type="hidden" name="BAGGAGE_FIELDS" value="userid amountwithoutfee fundamountplusfee item">
<input type="hidden" name="userid" value="<?php echo $userid ?>">
<input type="hidden" name="amountwithoutfee" value="<?php echo $fundamount ?>">
<input type="hidden" name="fundamountplusfee" value="<?php echo $fundamountplusfee ?>">
<input type="hidden" name="item" value="<?php echo $sitename ?> - <?php echo $ewalletname ?> - <?php echo $userid ?>">
<!--<input type="hidden" name="V2_HASH" value="<?php echo $V2_HASH ?>">-->
<input type="image" name="PAYMENT_METHOD" value="PerfectMoney account" src="<?php echo $domain ?>/images/perfectmoney.gif" border="0">
</form>
<br>&nbsp;</td></tr>
<?php
} # if ($adminperfectmoney != "")

if ($adminokpay != "")
{
?>
<form>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><br><br>Fund <?php echo $ewalletname ?> Balance Amount:&nbsp;&nbsp;
$&nbsp;<select name="fundamount" id="fundamount" onchange="this.form.submit()" class="pickone">
<?php
echo $fundingoptions;
?>
</select>
<?php
if ($paymentprocessorfeetoadd > 0)
		{
		echo " + " . $paymentprocessorfeetoadd . "% payment processor fee of \$" . $efeecost . "(Total Cost: \$" . $fundamountplusfee . ")<br>";
		}
?>
</form>
After you've made your payment, please be sure to click the link on OKPay to return back to the website!<br><br>
<form  method="post" action="https://www.okpay.com/process.html">
<input type="hidden" name="ok_receiver" value="<?php echo $adminokpay ?>">
<input type="hidden" name="ok_item_1_name" value="<?php echo $sitename ?> - <?php echo $ewalletname ?> - <?php echo $userid ?>">
<input type="hidden" name="ok_currency" value="usd">
<input type="hidden" name="ok_item_1_type" value="service">
<input type="hidden" name="ok_item_1_price" value="<?php echo $fundamountplusfee ?>">
<input type="hidden" name="ok_item_1_custom_1_title" value="userid">
<input type="hidden" name="ok_item_1_custom_1_value" value="<?php echo $userid ?>">
<input type="hidden" name="ok_item_1_custom_2_title" value="amountwithoutfee">
<input type="hidden" name="ok_item_1_custom_2_value" value="<?php echo $fundamount ?>">
<input type="hidden" name="ok_return_success" value="<?php echo $domain ?>/thankyou_ewallet.php">
<input type="hidden" name="ok_return_fail" value="<?php echo $domain ?>/orderads.php">
<input type="hidden" name="ok_ipn" value="<?php echo $domain ?>/okpay_ipn.php">
<input type="image" name="submit" src="<?php echo $domain ?>/images/okpay.gif" border="0">
</form>
<br>&nbsp;</td></tr>
<?php
} # if ($adminokpay != "")

if ($adminsolidtrustpay != "")
		{
?>
<form>
<tr class="sabrinatrlight"><td colspan="2" align="center"><br><br><br>Fund <?php echo $ewalletname ?> Balance Amount:&nbsp;&nbsp;
$&nbsp;<select name="fundamount" id="fundamount" onchange="this.form.submit()" class="pickone">
<?php
echo $fundingoptions;
?>
</select>
<?php
if ($paymentprocessorfeetoadd > 0)
		{
		echo " + " . $paymentprocessorfeetoadd . "% payment processor fee of \$" . $efeecost . "(Total Cost: \$" . $fundamountplusfee . ")<br>";
		}
?>
</form>
After you've made your payment, please be sure to click the link on Solid Trust Pay to return back to the website!<br><br>
<form action="https://solidtrustpay.com/handle.php" method="post">
<input type="hidden" name="merchantAccount" value="<?php echo $adminsolidtrustpay ?>">
<input type="hidden" name="sci_name" value="your_sci_name">
<input type="hidden" name="amount" value="<?php echo $fundamountplusfee ?>">
<input type="hidden" name="currency" value="USD">
<input type="hidden" name="user1" value="<?php echo $userid ?>">
<input type="hidden" name="user2" value="<?php echo $fundamount ?>">
<input type="hidden" name="notify_url" value="<?php echo $domain ?>/solidtrustpay_ipn.php">
<input type="hidden" name="return_url" value="<?php echo $domain ?>/thankyou_ewallet.php">
<input type="hidden" name="cancel_url"  value="<?php echo $domain ?>/orderads.php">
<input type="hidden" name="item_id" value="<?php echo $sitename ?> - <?php echo $ewalletname ?> - <?php echo $userid ?>">
<input type="image" name="cartImage" src="<?php echo $domain ?>/images/solidtrustpay.gif" alt="Solid Trust Pay" border="0">
</form>
<br>&nbsp;</td></tr>
<?php
	} # if ($adminsolidtrustpay != "")
?>

<!-- ADS -->
<?php
if ($accounttype == "PAID")
{
$soloscreditstrade = $soloscreditstradepaid;
$bannerscreditstrade = $bannerscreditstradepaid;
$buttonscreditstrade = $buttonscreditstradepaid;
$textadscreditstrade = $textadscreditstradepaid;
$fullloginadscreditstrade = $fullloginadscreditstradepaid;
}
if ($accounttype != "PAID")
{
$soloscreditstrade = $soloscreditstradefree;
$bannerscreditstrade = $bannerscreditstradefree;
$buttonscreditstrade = $buttonscreditstradefree;
$textadscreditstrade = $textadscreditstradefree;
$fullloginadscreditstrade = $fullloginadscreditstradefree;
}

$adq1 = "select * from advertisingforsale where type=\"Credits\" order by id";
$adr1 = mysql_query($adq1);
$adrows1 = mysql_num_rows($adr1);
if (($enablecreditssystem == "yes") and (($adrows1 > 0) or (($creditspriceperlot > 0) and ($creditshowmanyperlot > 0) and ($creditshowmanylots > 0))))
{
?>
<tr><td align="center" colspan="2" class="sabrinatrlight">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="3">BUY ADVERTISING CREDITS</td></tr>
<tr class="sabrinatrlight"><td align="center">Number of Credits</td><td align="center">Price (Deducted from <?php echo $ewalletname ?>)</td><td align="center">Submit Order</td></tr>
<?php
	$totalcreditlotsforsalesofar = 1;
	while ($totalcreditlotsforsalesofar <= $creditshowmanylots)
	{
	$creditsforsale = $creditshowmanyperlot*$totalcreditlotsforsalesofar;
	$creditsprice = $creditspriceperlot*$totalcreditlotsforsalesofar;
	?>
	<form action="orderadvertising.php" method="post">
	<tr class="sabrinatrlight"><td align="center"><?php echo $creditsforsale ?></td><td align="center">$<?php echo sprintf("%.2f", $creditsprice); ?></td>
	<td align="center">
	<input type="hidden" name="page" value="orderads.php">
	<input type="hidden" name="adtype" value="credits">
	<input type="hidden" name="advertisingquantity" value="<?php echo $creditsforsale ?>">
	<input type="submit" class="sendit" value="ORDER">
	</form></td></tr>
	<?php
	$totalcreditlotsforsalesofar = $totalcreditlotsforsalesofar+1;
	}
# Additional CREDIT purchases - Created by Admin
$adq = "select * from advertisingforsale where type=\"Credits\" order by id";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
if ($adrows > 0)
{
	while ($adrowz = mysql_fetch_array($adr))
	{
		$adid = $adrowz["id"];
		$adtype = $adrowz["type"];
		$adhowmany = $adrowz["howmany"];
		$admax = $adrowz["max"];
		$adprice = $adrowz["price"];
		$adcreditsprice = $adrowz["creditsprice"];
		$addescription = $adrowz["description"];
		$addescription = stripslashes($addescription);
		?>
		<form action="orderadvertising.php" method="post">
		<tr class="sabrinatrlight"><td align="center"><?php echo $adhowmany ?></td><td align="center">$<?php echo sprintf("%.2f", $adprice); ?></td>
		<td align="center">
		<input type="hidden" name="page" value="orderads.php">
		<input type="hidden" name="advertisingid" value="<?php echo $adid ?>">
		<input type="hidden" name="adtype" value="admin_advertising">
		<input type="submit" class="sendit" value="ORDER">
		</form></td></tr>
		<?php
	} # while ($adrowz = mysql_fetch_array($adr))
} # if ($adrows > 0)
?>
</table>
</td></tr>
<?php
} # if (($enablecreditssystem == "yes") and (($adrows1 > 0) or (($creditspriceperlot > 0) and ($creditshowmanyperlot > 0) and ($creditshowmanylots > 0))))

if ($enablecreditssystem == "yes")
{
$cols = 6;
}
if ($enablecreditssystem != "yes")
{
$cols = 5;
}
?>
<tr><td align="center" colspan="2" class="sabrinatrlight">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%" class="sabrinatable">
<tr class="sabrinatrdark"><td align="center" colspan="<?php echo $cols ?>">ADVERTISING</td></tr>
<tr class="sabrinatrlight"><td align="center">Type</td><td align="center">Price Per Ad (Deducted from <?php echo $ewalletname ?>
<?php
if ($enablecreditssystem == "yes")
{
echo " or Credit Balance";
}
?>
)
</td><td align="center">Impressions or Clicks</td><td align="center">Choose Quantity</td>
<?php
if ($enablecreditssystem == "yes")
{
?>
<td align="center">Payment Method</td>
<?php
}
?>
<td align="center">Submit Order</td></tr>


<form action="orderadvertising.php" method="post">
<tr class="sabrinatrlight"><td align="center">Solo Ad</td><td align="center">$<?php echo sprintf("%.2f", $soloprice); ?>
<?php
if (($enablecreditssystem == "yes") and ($soloscreditstrade > 0))
{
echo " or " . $soloscreditstrade . " Credits";
}
?>
</td><td align="center">Unlimited</td>
<td align="center">
<select name="advertisingquantity" class="pickone">
<?php
for ($i=1;$i<=20;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</td>
<?php
if ($enablecreditssystem == "yes")
{
?>
<td align="center">
<select name="paymentmethod">
<option value="ewalletpayment"><?php echo $ewalletname ?></option>
<?php
	if (($credits >= $soloscreditstrade) and ($credits > 0) and ($soloscreditstrade > 0))
	{
	?>
	<option value="creditpayment">Credit Balance</option>
	<?php
	}
?>
</select>
</td>
<?php
}
?>
<td align="center">
<input type="hidden" name="page" value="orderads.php">
<input type="hidden" name="adtype" value="solos">
<input type="submit" class="sendit" value="ORDER">
</form></td></tr>
<?php
# Additional SOLO Advertising - Created by Admin
$adq = "select * from advertisingforsale where type=\"Solos\" order by id";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
if ($adrows > 0)
{
	while ($adrowz = mysql_fetch_array($adr))
	{
		$adid = $adrowz["id"];
		$adtype = $adrowz["type"];
		$adhowmany = $adrowz["howmany"];
		$admax = $adrowz["max"];
		$adprice = $adrowz["price"];
		$adcreditsprice = $adrowz["creditsprice"];
		$addescription = $adrowz["description"];
		$addescription = stripslashes($addescription);
		?>
		<form action="orderadvertising.php" method="post">
		<tr class="sabrinatrlight"><td align="center">Solo Ad</td><td align="center">$<?php echo sprintf("%.2f", $adprice); ?>
		<?php
		if (($enablecreditssystem == "yes") and ($adcreditsprice > 0))
		{
		echo " or " . $adcreditsprice . " Credits";
		}
		?>	
		</td><td align="center">Unlimited</td>
		<td align="center">
		<select name="advertisingquantity" class="pickone">
		<?php
		for ($i=1;$i<=20;$i++)
		{
		?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php
		}
		?>
		</select>
		</td>
		<?php
		if ($enablecreditssystem == "yes")
		{
		?>
		<td align="center">
		<select name="paymentmethod">
		<option value="ewalletpayment"><?php echo $ewalletname ?></option>
		<?php
			if (($credits >= $adcreditsprice) and ($credits > 0) and ($adcreditsprice > 0))
			{
			?>
			<option value="creditpayment">Credit Balance</option>
			<?php
			}
		?>
		</select>
		</td>
		<?php
		}
		?>
		<td align="center">
		<input type="hidden" name="page" value="orderads.php">
		<input type="hidden" name="advertisingid" value="<?php echo $adid ?>">
		<input type="hidden" name="adtype" value="admin_advertising">
		<input type="submit" class="sendit" value="ORDER">
		</form></td></tr>
		<?php
	} # while ($adrowz = mysql_fetch_array($adr))
} # if ($adrows > 0)
?>


<form action="orderadvertising.php" method="post">
<tr class="sabrinatrlight"><td align="center">Banner Ad</td><td align="center">$<?php echo sprintf("%.2f", $bannerprice); ?>
<?php
if (($enablecreditssystem == "yes") and ($bannerscreditstrade > 0))
{
echo " or " . $bannerscreditstrade . " Credits";
}
?>
</td><td align="center"><?php echo $bannermaxviews ?> Impressions</td>
<td align="center">
<select name="advertisingquantity" class="pickone">
<?php
for ($i=1;$i<=20;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</td>
<?php
if ($enablecreditssystem == "yes")
{
?>
<td align="center">
<select name="paymentmethod">
<option value="ewalletpayment"><?php echo $ewalletname ?></option>
<?php
	if (($credits >= $bannerscreditstrade) and ($credits > 0) and ($bannerscreditstrade > 0))
	{
	?>
	<option value="creditpayment">Credit Balance</option>
	<?php
	}
?>
</select>
</td>
<?php
}
?>
<td align="center">
<input type="hidden" name="page" value="orderads.php">
<input type="hidden" name="adtype" value="banners">
<input type="submit" class="sendit" value="ORDER">
</form></td></tr>
<?php
# Additional BANNER Advertising - Created by Admin
$adq = "select * from advertisingforsale where type=\"Banners\" order by id";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
if ($adrows > 0)
{
	while ($adrowz = mysql_fetch_array($adr))
	{
		$adid = $adrowz["id"];
		$adtype = $adrowz["type"];
		$adhowmany = $adrowz["howmany"];
		$admax = $adrowz["max"];
		$adprice = $adrowz["price"];
		$adcreditsprice = $adrowz["creditsprice"];
		$addescription = $adrowz["description"];
		$addescription = stripslashes($addescription);
		?>
		<form action="orderadvertising.php" method="post">
		<tr class="sabrinatrlight"><td align="center">Banner Ad</td><td align="center">$<?php echo sprintf("%.2f", $adprice); ?>
		<?php
		if (($enablecreditssystem == "yes") and ($adcreditsprice > 0))
		{
		echo " or " . $adcreditsprice . " Credits";
		}
		?>			
		</td><td align="center"><?php echo $admax ?> Impressions</td>
		<td align="center">
		<select name="advertisingquantity" class="pickone">
		<?php
		for ($i=1;$i<=20;$i++)
		{
		?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php
		}
		?>
		</select>
		</td>
		<?php
		if ($enablecreditssystem == "yes")
		{
		?>
		<td align="center">
		<select name="paymentmethod">
		<option value="ewalletpayment"><?php echo $ewalletname ?></option>
		<?php
			if (($credits >= $adcreditsprice) and ($credits > 0) and ($adcreditsprice > 0))
			{
			?>
			<option value="creditpayment">Credit Balance</option>
			<?php
			}
		?>
		</select>
		</td>
		<?php
		}
		?>
		<td align="center">
		<input type="hidden" name="page" value="orderads.php">
		<input type="hidden" name="advertisingid" value="<?php echo $adid ?>">
		<input type="hidden" name="adtype" value="admin_advertising">
		<input type="submit" class="sendit" value="ORDER">
		</form></td></tr>
		<?php
	} # while ($adrowz = mysql_fetch_array($adr))
} # if ($adrows > 0)
?>


<form action="orderadvertising.php" method="post">
<tr class="sabrinatrlight"><td align="center">Button Ad</td><td align="center">$<?php echo sprintf("%.2f", $buttonprice); ?>
<?php
if (($enablecreditssystem == "yes") and ($buttonscreditstrade > 0))
{
echo " or " . $buttonscreditstrade . " Credits";
}
?>
</td><td align="center"><?php echo $buttonmaxviews ?> Impressions</td>
<td align="center">
<select name="advertisingquantity" class="pickone">
<?php
for ($i=1;$i<=20;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</td>
<?php
if ($enablecreditssystem == "yes")
{
?>
<td align="center">
<select name="paymentmethod">
<option value="ewalletpayment"><?php echo $ewalletname ?></option>
<?php
	if (($credits >= $buttonscreditstrade) and ($credits > 0) and ($buttonscreditstrade > 0))
	{
	?>
	<option value="creditpayment">Credit Balance</option>
	<?php
	}
?>
</select>
</td>
<?php
}
?>
<td align="center">
<input type="hidden" name="page" value="orderads.php">
<input type="hidden" name="adtype" value="buttons">
<input type="submit" class="sendit" value="ORDER">
</form></td></tr>
<?php
# Additional BUTTON Advertising - Created by Admin
$adq = "select * from advertisingforsale where type=\"Buttons\" order by id";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
if ($adrows > 0)
{
	while ($adrowz = mysql_fetch_array($adr))
	{
		$adid = $adrowz["id"];
		$adtype = $adrowz["type"];
		$adhowmany = $adrowz["howmany"];
		$admax = $adrowz["max"];
		$adprice = $adrowz["price"];
		$adcreditsprice = $adrowz["creditsprice"];
		$addescription = $adrowz["description"];
		$addescription = stripslashes($addescription);
		?>
		<form action="orderadvertising.php" method="post">
		<tr class="sabrinatrlight"><td align="center">Button Ad</td><td align="center">$<?php echo sprintf("%.2f", $adprice); ?>
		<?php
		if (($enablecreditssystem == "yes") and ($adcreditsprice > 0))
		{
		echo " or " . $adcreditsprice . " Credits";
		}
		?>			
		</td><td align="center"><?php echo $admax ?> Impressions</td>
		<td align="center">
		<select name="advertisingquantity" class="pickone">
		<?php
		for ($i=1;$i<=20;$i++)
		{
		?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php
		}
		?>
		</select>
		</td>
		<?php
		if ($enablecreditssystem == "yes")
		{
		?>
		<td align="center">
		<select name="paymentmethod">
		<option value="ewalletpayment"><?php echo $ewalletname ?></option>
		<?php
			if (($credits >= $adcreditsprice) and ($credits > 0) and ($adcreditsprice > 0))
			{
			?>
			<option value="creditpayment">Credit Balance</option>
			<?php
			}
		?>
		</select>
		</td>
		<?php
		}
		?>
		<td align="center">
		<input type="hidden" name="page" value="orderads.php">
		<input type="hidden" name="advertisingid" value="<?php echo $adid ?>">
		<input type="hidden" name="adtype" value="admin_advertising">
		<input type="submit" class="sendit" value="ORDER">
		</form></td></tr>
		<?php
	} # while ($adrowz = mysql_fetch_array($adr))
} # if ($adrows > 0)
?>


<form action="orderadvertising.php" method="post">
<tr class="sabrinatrlight"><td align="center">Text Ad</td><td align="center">$<?php echo sprintf("%.2f", $textadprice); ?>
<?php
if (($enablecreditssystem == "yes") and ($textadscreditstrade > 0))
{
echo " or " . $textadscreditstrade . " Credits";
}
?>
</td><td align="center"><?php echo $textadmaxviews ?> Impressions</td>
<td align="center">
<select name="advertisingquantity" class="pickone">
<?php
for ($i=1;$i<=20;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</td>
<?php
if ($enablecreditssystem == "yes")
{
?>
<td align="center">
<select name="paymentmethod">
<option value="ewalletpayment"><?php echo $ewalletname ?></option>
<?php
	if (($credits >= $textadscreditstrade) and ($credits > 0) and ($textadscreditstrade > 0))
	{
	?>
	<option value="creditpayment">Credit Balance</option>
	<?php
	}
?>
</select>
</td>
<?php
}
?>
<td align="center">
<input type="hidden" name="page" value="orderads.php">
<input type="hidden" name="adtype" value="textads">
<input type="submit" class="sendit" value="ORDER">
</form></td></tr>
<?php
# Additional TEXT AD Advertising - Created by Admin
$adq = "select * from advertisingforsale where type=\"Text Ads\" order by id";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
if ($adrows > 0)
{
	while ($adrowz = mysql_fetch_array($adr))
	{
		$adid = $adrowz["id"];
		$adtype = $adrowz["type"];
		$adhowmany = $adrowz["howmany"];
		$admax = $adrowz["max"];
		$adprice = $adrowz["price"];
		$adcreditsprice = $adrowz["creditsprice"];
		$addescription = $adrowz["description"];
		$addescription = stripslashes($addescription);
		?>
		<form action="orderadvertising.php" method="post">
		<tr class="sabrinatrlight"><td align="center">Text Ad</td><td align="center">$<?php echo sprintf("%.2f", $adprice); ?>
		<?php
		if (($enablecreditssystem == "yes") and ($adcreditsprice > 0))
		{
		echo " or " . $adcreditsprice . " Credits";
		}
		?>			
		</td><td align="center"><?php echo $admax ?> Impressions</td>
		<td align="center">
		<select name="advertisingquantity" class="pickone">
		<?php
		for ($i=1;$i<=20;$i++)
		{
		?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php
		}
		?>
		</select>
		</td>
		<?php
		if ($enablecreditssystem == "yes")
		{
		?>
		<td align="center">
		<select name="paymentmethod">
		<option value="ewalletpayment"><?php echo $ewalletname ?></option>
		<?php
			if (($credits >= $adcreditsprice) and ($credits > 0) and ($adcreditsprice > 0))
			{
			?>
			<option value="creditpayment">Credit Balance</option>
			<?php
			}
		?>
		</select>
		</td>
		<?php
		}
		?>
		<td align="center">
		<input type="hidden" name="page" value="orderads.php">
		<input type="hidden" name="advertisingid" value="<?php echo $adid ?>">
		<input type="hidden" name="adtype" value="admin_advertising">
		<input type="submit" class="sendit" value="ORDER">
		</form></td></tr>
		<?php
	} # while ($adrowz = mysql_fetch_array($adr))
} # if ($adrows > 0)
?>


<form action="orderadvertising.php" method="post">
<tr class="sabrinatrlight"><td align="center">Full Page Login Ad</td><td align="center">$<?php echo sprintf("%.2f", $fullloginadprice); ?>
<?php
if (($enablecreditssystem == "yes") and ($fullloginadscreditstrade > 0))
{
echo " or " . $fullloginadscreditstrade . " Credits";
}
?>
</td><td align="center"><?php echo $fullloginadmaxviews ?> Impressions</td>
<td align="center">
<select name="advertisingquantity" class="pickone">
<?php
for ($i=1;$i<=20;$i++)
{
?>
<option value="<?php echo $i ?>"><?php echo $i ?></option>
<?php
}
?>
</select>
</td>
<?php
if ($enablecreditssystem == "yes")
{
?>
<td align="center">
<select name="paymentmethod">
<option value="ewalletpayment"><?php echo $ewalletname ?></option>
<?php
	if (($credits >= $fullloginadscreditstrade) and ($credits > 0) and ($fullloginadscreditstrade > 0))
	{
	?>
	<option value="creditpayment">Credit Balance</option>
	<?php
	}
?>
</select>
</td>
<?php
}
?>
<td align="center">
<input type="hidden" name="page" value="orderads.php">
<input type="hidden" name="adtype" value="fullloginads">
<input type="submit" class="sendit" value="ORDER">
</form></td></tr>
<?php
# Additional FULL PAGE LOGIN AD Advertising - Created by Admin
$adq = "select * from advertisingforsale where type=\"Full Page Login Ads\" order by id";
$adr = mysql_query($adq);
$adrows = mysql_num_rows($adr);
if ($adrows > 0)
{
	while ($adrowz = mysql_fetch_array($adr))
	{
		$adid = $adrowz["id"];
		$adtype = $adrowz["type"];
		$adhowmany = $adrowz["howmany"];
		$admax = $adrowz["max"];
		$adprice = $adrowz["price"];
		$adcreditsprice = $adrowz["creditsprice"];
		$addescription = $adrowz["description"];
		$addescription = stripslashes($addescription);
		?>
		<form action="orderadvertising.php" method="post">
		<tr class="sabrinatrlight"><td align="center">Full Page Login Ad</td><td align="center">$<?php echo sprintf("%.2f", $adprice); ?>
		<?php
		if (($enablecreditssystem == "yes") and ($adcreditsprice > 0))
		{
		echo " or " . $adcreditsprice . " Credits";
		}
		?>			
		</td><td align="center"><?php echo $admax ?> Impressions</td>
		<td align="center">
		<select name="advertisingquantity" class="pickone">
		<?php
		for ($i=1;$i<=20;$i++)
		{
		?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
		<?php
		}
		?>
		</select>
		</td>
		<?php
		if ($enablecreditssystem == "yes")
		{
		?>
		<td align="center">
		<select name="paymentmethod">
		<option value="ewalletpayment"><?php echo $ewalletname ?></option>
		<?php
			if (($credits >= $adcreditsprice) and ($credits > 0) and ($adcreditsprice > 0))
			{
			?>
			<option value="creditpayment">Credit Balance</option>
			<?php
			}
		?>
		</select>
		</td>
		<?php
		}
		?>
		<td align="center">
		<input type="hidden" name="page" value="orderads.php">
		<input type="hidden" name="advertisingid" value="<?php echo $adid ?>">
		<input type="hidden" name="adtype" value="admin_advertising">
		<input type="submit" class="sendit" value="ORDER">
		</form></td></tr>
		<?php
	} # while ($adrowz = mysql_fetch_array($adr))
} # if ($adrows > 0)
?>




</table>
</td></tr>


</table>
</td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
?>