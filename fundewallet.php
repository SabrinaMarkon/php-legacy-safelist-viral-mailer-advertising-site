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
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="100%">

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600">
<tr><td>
<?php
$q = "select * from pages where name='Members Area Fund E-Wallet Order Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
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
<input type="hidden" name="STATUS_URL" value="<?php echo $domain ?>/perfectmoney_ipn.php">
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
</table>
</td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
?>