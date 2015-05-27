<?php
include "control.php";
$action = $_POST["action"];
####################################################################################################
include "../header.php";
?>
<?php
$action = $_POST["action"];
$show = "";
#########################################################################################
if ($action == "save")
{
$username = $_POST["username"];
$egopay = $_POST["egopay"];
$payza = $_POST["payza"];
$perfectmoney = $_POST["perfectmoney"];
$okpay = $_POST["okpay"];
$solidtrustpay = $_POST["solidtrustpay"];
$paypal = $_POST["paypal"];
$ewallet = $_POST["ewallet"];
$q = "update members set egopay=\"$egopay\",payza=\"$payza\",perfectmoney=\"$perfectmoney\",okpay=\"$okpay\",solidtrustpay=\"$solidtrustpay\",paypal=\"$paypal\",ewallet=\"$ewallet\" where userid=\"$username\"";
$r = mysql_query($q) or die(mysql_error());
$show = "<p align=\"center\">Changes saved for username " . $username . "</p>";
} # if ($action == "save")
#########################################################################################
if ($action == "markpaid")
{
$username = $_POST["username"];
$payewallet = $_POST["payewallet"];
$q = "update members set ewallet=ewallet+" . $payewallet . ",ewalletlastpaid=NOW() where userid=\"$username\"";
$r = mysql_query($q);
$q2 = "insert into payouts (userid,paid,datepaid,description) values (\"$username\",\"$payewallet\",NOW(),\"$ewalletname Cash Payout\")";
$r2 = mysql_query($q2);
$show = "<p align=\"center\">Username " . $username . "'s " . $ewalletname . " was marked paid out \$" . $payewallet . ". This was deducted from their " . $ewalletname . ". You should login to the payment company now to send them these funds if you haven't already done so.</p>";
} # if ($action == "markpaid")
#########################################################################################
if ($show != "")
{
echo $show;
}
?>
<br>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="90%">

<!-- START EWALLET DATA -->
<tr><td align="center" colspan="2"><br>
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr><td align="center" colspan="2"><div class="heading">Member <?php echo $ewalletname ?> Accounts</div></td></tr>
<tr><td colspan="2" align="center"><br>To make a payment, please login to your payment processor to pay, then enter and save the amount you have paid for the person here.</td></tr>
<?php
$q = "select * from members order by id";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
?>
<tr><td align="center" colspan="2"><br>There are no members yet.</td></tr>
<?php
}
if ($rows > 0)
{
?>
<tr><td align="center" colspan="2"><br><br>
<table cellpadding="4" cellspacing="2" border="0" align="center" class="sabrinatable" width="600">
<tr class="sabrinatrdark">
<td align="center"><b>Username</b></td>
<td align="center"><b>EgoPay Account</b></td>
<td align="center"><b>Payza Account</b></td>
<td align="center"><b>Perfect Money Account</b></td>
<td align="center"><b>OKPay Account</b></td>
<td align="center"><b>Solid Trust Pay Account</b></td>
<td align="center"><b>PayPal Account</b></td>
<td align="center"><b>Total&nbsp;Cash&nbsp;Owed</b></td>
<td align="center"><b>Save</b></td>
<td align="center"><b>Mark&nbsp;Paid</b></td>
</tr>
<?php
	while ($rowz = mysql_fetch_array($r))
	{
	$username = $rowz["userid"];
	$egopay = $rowz["egopay"];
	$payza = $rowz["payza"];
	$perfectmoney = $rowz["perfectmoney"];
	$okpay = $rowz["okpay"];
	$solidtrustpay = $rowz["solidtrustpay"];
	$paypal = $rowz["paypal"];
	$ewallet = $rowz["ewallet"];
	?>
	<form action="ewalletcontrol.php" method="post">
	<tr class="sabrinatrlight">
	<td align="center"><?php echo $username ?></td>
	<td align="center"><input type="text" class="typein" size="15" maxlength="255" name="egopay" value="<?php echo $egopay ?>"></td>
	<td align="center"><input type="text" class="typein" size="15" maxlength="255" name="payza" value="<?php echo $payza ?>"></td>
	<td align="center"><input type="text" class="typein" size="15" maxlength="255" name="perfectmoney" value="<?php echo $perfectmoney ?>"></td>
	<td align="center"><input type="text" class="typein" size="15" maxlength="255" name="okpay" value="<?php echo $okpay ?>"></td>
	<td align="center"><input type="text" class="typein" size="15" maxlength="255" name="solidtrustpay" value="<?php echo $solidtrustpay ?>"></td>
	<td align="center"><input type="text" class="typein" size="15" maxlength="255" name="paypal" value="<?php echo $paypal ?>"></td>
	<td align="center"><input type="text" class="typein" size="6" maxlength="12" name="ewallet" value="<?php echo $ewallet ?>"></td>
	<form action="ewalletcontrol.php" method="post">
	<td align="center">
	<input type="hidden" name="username" value="<?php echo $username ?>">
	<input type="hidden" name="action" value="save">
	<input type="submit" class="sendit" value="SAVE" style="width: 75px;">
	</form>
	</td>
	<form action="ewalletcontrol.php" method="post">
	<td align="center">
	Set&nbsp;Amount&nbsp;As&nbsp;Paid:&nbsp;<input type="text" class="typein" size="6" maxlength="12" name="payewallet" value="<?php echo $ewallet ?>">&nbsp;&nbsp;<input type="hidden" name="username" value="<?php echo $username ?>"><input type="hidden" name="action" value="markpaid"><input type="submit" class="sendit" value="SET PAID" style="width: 98%;">
	</form>
	</td>
	<?php
	} # while ($rowz = mysql_fetch_array($r))
?>
</table></td></tr>
<?php
} # if ($rows > 0)
?>
</table></td></tr>
<!-- END EWALLET DATA -->

<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>

</table>
<?php
include "../footer.php";
exit;
?>