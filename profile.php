<?php
include "control.php";
include "header.php";
include "banners.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
$today = date('Y-m-d',strtotime("now"));
$unixtimestamp = time();
$action = $_POST["action"];
$show = "";
if ($action == "update")
{
$password = $_POST["password"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$oldemail = $_POST["oldemail"];
$country = $_POST["country"];
$egopay = $_POST["egopay"];
$payza = $_POST["payza"];
$perfectmoney = $_POST["perfectmoney"];
$okpay = $_POST["okpay"];
$solidtrustpay = $_POST["solidtrustpay"];
$paypal = $_POST["paypal"];
$vacation = $_POST["vacation"];
$oldvacation = $_POST["oldvacation"];
	if (!$password)
	{
	$error .= "<div>Please return and enter a valid password.</div>";
	}
	if(!$firstname)
	{
	$error .= "<div>Please return and enter your first name.</div>";
	}
	if(!$lastname)
	{
	$error .= "<div>Please return and type in your last name.</div>";
	}
	if(!$email)
	{
	$error .= "<div>Please return and enter your email address.</div>";
	}
	
	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Update Error</div></td></tr>
	<tr><td colspan="2" align="center"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="profile.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

$q = "update members set password=\"$password\",firstname=\"$firstname\",lastname=\"$lastname\",email=\"$email\",country=\"$country\",egopay=\"$egopay\",payza=\"$payza\",perfectmoney=\"$perfectmoney\",okpay=\"$okpay\",solidtrustpay=\"$solidtrustpay\",paypal=\"$paypal\",vacation=\"$vacation\" where userid=\"$userid\"";
$r = mysql_query($q);

$show = "Your profile was updated!";

if ($oldemail != $email)
	{
	$verifyq = "update member set verified=\"no\",verifieddate=\"0\",verifycode=\"$unixtimestamp\" where userid=\"$userid\"";
	$verifyr = mysql_query($verifyq);
	$tomember = $email;
	$headersmember = "From: $sitename<$bounceemail>\n";
	$headersmember .= "Reply-To: <$bounceemail>\n";
	$headersmember .= "X-Sender: <$bounceemail>\n";
	$headersmember .= "X-Mailer: PHP5 - PHPSiteScripts\n";
	$headersmember .= "X-Priority: 3\n";
	$headersmember .= "Return-Path: <$bounceemail>\n";
	$subjectmember = $sitename . " Email Address Re-Verification";
	$messagemember = "Please re-verify your email address by clicking this link ".$domain."/verify.php?userid=".$userid."&code=".$unixtimestamp."\n\n"
	."Thank you!\n\n\n"
	.$sitename." Admin\n"
	.$adminemail."\n\n\n\n";
	@mail($tomember, $subjectmember, wordwrap(stripslashes($messagemember)),$headersmember, "-f$bounceemail");
	$show .= "<br>You changed your email address and need to re-verify it to be able to use the website. A verification email has been sent to your new email address.";
	}
if ($oldvacation != $vacation)
	{
	$q2 = "update members set vacationdate=NOW() where userid=\"$userid\"";
	$r2 = mysql_query($q2);
	if ($vacation == "no")
		{
		$show .= "<br>You turned vacation mode off, so will need to wait for 24 hours before being able to post advertising (prevents cheating).";
		}
	}
} # if ($action == "update")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Your Account Profile</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Members Area Profile Page'";
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
<table cellpadding="2" cellspacing="2" border="0" align="center" width="100%" class="sabrinatable">
<tr class="sabrinatrlight"><td align="right">UserID:</td><td><?php echo $userid ?></td></tr>
<tr class="sabrinatrlight"><td align="right">Membership Level:</td><td><?php echo $accounttypename ?>
<?php
if ($accounttype != "PAID")
{
?>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="upgrade.php">Click Here to Enjoy the Benefits of Upgraded Membership!</a>
<?php
}
?>
</td></tr>
<?php
if (($accounttype == "PAID") and ($joinpriceinterval != "One Time"))
{
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
	?>
	<form action="orderupgraderenewal.php" method="post">
	<tr class="sabrinatrlight"><td align="right">Next Membership Payment ($<?php echo $joinprice ?> Funded by <?php echo $ewalletname ?>) Due:</td><td><?php echo $nextdue ?> <font color="#ff0000" style="background:#ffff00;">OVERDUE:</font> Renew Membership: $<?php echo sprintf("%.2f", $joinprice); ?> <?php echo $joinpriceinterval ?>
	</td></tr>
	<tr class="sabrinatrlight"><td align="right">RENEW YOUR MEMBERSHIP:&nbsp;&nbsp;</td><td>
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
			$apcredits = $adpackrowz["credits"];
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
				$apcredits = 0;
				}
			if ($upgrade == "yes")
				{
				$details .= "<span>Membership Upgrade</span><br>";
				}
			if ($apcredits > 0)
				{
				$details .= "<span>$apcredits Credits</span><br>";
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
	</select>&nbsp;&nbsp;
	<?php
		}
	?>
	<input type="hidden" name="page" value="members.php"><input type="hidden" name="adpackid" id="adpackid" value=""><input type="submit" value="RENEW" class="sendit" style="color:#ff0000;font-weight:bold;background:#ffffff;border:2px #ff0000 outset;"></form>
	</td></tr>
	<?php
	}
else
	{
	?>
	<tr class="sabrinatrlight"><td align="right">Next Membership Payment ($<?php echo $joinprice ?> Funded by <?php echo $ewalletname ?>) Due:</td><td><?php echo $nextdue ?></td></tr>
	<?php
	}
}
?>
<tr class="sabrinatrlight"><td align="right">Your <?php echo $ewalletname ?> Balance:</td><td>$<?php echo $ewallet ?></td></tr>
<?php
if ($enablecreditssystem == "yes")
{
?>
<tr class="sabrinatrlight"><td align="right">Your Credit Balance:</td><td><?php echo $credits ?></td></tr>
<?php
}
?>
<form action="profile.php" method="post" target="_top">
<tr class="sabrinatrlight"><td align="right">Password:</td><td><input type="text" name="password" class="typein" maxlength="255" size="55" value="<?php echo $password ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">First Name:</td><td><input type="text" name="firstname" class="typein" maxlength="255" size="55" value="<?php echo $firstname ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">Last Name:</td><td><input type="text" name="lastname" class="typein" maxlength="255" size="55" value="<?php echo $lastname ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">Email:</td><td><input type="text" name="email" class="typein" maxlength="255" size="55" value="<?php echo $email ?>"></td></tr>
<?php
$cq = "select * from countries order by country_id";
$cr = mysql_query($cq);
$crows = mysql_num_rows($cr);
if ($crows > 0)
{
?>
<tr class="sabrinatrlight"><td align="right">Country:</td><td><select name="country" style="width: 140px;" class="pickone">
<?php
	while ($crowz = mysql_fetch_array($cr))
	{
	$country_name = $crowz["country_name"];
?>
<option value="<?php echo $country_name ?>" <?php if ($country == $country_name) { echo "selected"; } ?>><?php echo $country_name ?></option>
<?php
	}
?>
</select>
<?php
}
?>
</td></tr>
<tr class="sabrinatrlight"><td align="right">EgoPay:</td><td><input type="text" name="egopay" class="typein" maxlength="255" size="55" value="<?php echo $egopay ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">Payza:</td><td><input type="text" name="payza" class="typein" maxlength="255" size="55" value="<?php echo $payza ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">Perfect Money:</td><td><input type="text" name="perfectmoney" class="typein" maxlength="255" size="55" value="<?php echo $perfectmoney ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">OK Pay:</td><td><input type="text" name="okpay" class="typein" maxlength="255" size="55" value="<?php echo $okpay ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">Solid Trust Pay:</td><td><input type="text" name="solidtrustpay" class="typein" maxlength="255" size="55" value="<?php echo $solidtrustpay ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">PayPal:</td><td><input type="text" name="paypal" class="typein" maxlength="255" size="55" value="<?php echo $paypal ?>"></td></tr>
<tr class="sabrinatrlight"><td align="right">On Vacation:</td><td><select name="vacation" class="pickone">
<option value="no" <?php if ($vacation != "yes") { echo "selected"; } ?>>NO</option>
<option value="yes" <?php if ($vacation == "yes") { echo "selected"; } ?>>YES</option>
</select>
</td></tr>
<tr class="sabrinatrdark"><td colspan="2" align="center">
<input type="hidden" name="oldemail" value="<?php echo $email ?>">
<input type="hidden" name="oldvacation" value="<?php echo $vacation ?>">
<input type="hidden" name="action" value="update">
<input type="submit" value="SAVE" class="sendit">
</td></tr></form>

</table>
</td></tr>

</table>
<br><br>
<?php
include "footer.php";
exit;
?>