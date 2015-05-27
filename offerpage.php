<?php
include "control.php";
require('EgoPaySci.php');
$id = $_REQUEST["id"];
$paymentbuttons = "";
$showwhen = $_REQUEST["showwhen"];

	if ($showwhen == "After Logout")
	{
	$whatdoing = "logout.";
	}
	else
	{
	$whatdoing = "members area.";
	}

$q = "select * from offerpages where id=\"$id\"";
$r = mysql_query($q);
$rows = mysql_num_rows($r);
if ($rows < 1)
{
	if ($showwhen == "After Logout")
	{
	@header("Location: index.php");
	}
	else
	{
	$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
	$fplar = mysql_query($fplaq);
	$fplarows = mysql_num_rows($fplar);
	if ($fplarows > 0)
		{
		@header("Location: fullloginad.php");
		}
	else
		{
		@header("Location: members.php?newlogin=1");
		}
	}
exit;
}
if ($rows > 0)
{
# if this is a one-time only offerpage, make sure member hasn't already seen it.
$howmanytimestoshow = mysql_result($r,0,"howmanytimestoshow");
if ($howmanytimestoshow == "Once Only")
	{
		$offerviewedq = "select * from offerpages_viewed where offerpageid=\"$id\" and userid=\"$userid\"";
		$offerviewedr = mysql_query($offerviewedq);
		$offerviewedrows = mysql_num_rows($offerviewedr);
			if ($offerviewedrows < 1)
			{
			# the member hasn't seen this one-time view offerpage so show it, and update db to show that the member has already seen it.
					
					$viewedq = "insert into offerpages_viewed (offerpageid,userid) values (\"$id\",\"$userid\")";
					$viewedr = mysql_query($viewedq);

					$price = mysql_result($r,0,"price");
					$htmlcode = mysql_result($r,0,"htmlcode");
					$htmlcode = stripslashes($htmlcode);
					$htmlcode = str_replace('\\', '', $htmlcode);

					$feecost = ($paymentprocessorfeetoadd*$price)/100;
					$feecost = sprintf("%.2f", $feecost);
					$fundamountplusfee = $feecost+$price;
					$fundamountplusfee = sprintf("%.2f", $fundamountplusfee);

						if ($showwhen == "After Logout")
						{
						$cancelpaymenturl = $domain;
						}
						else
						{
						$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
						$fplar = mysql_query($fplaq);
						$fplarows = mysql_num_rows($fplar);
						if ($fplarows > 0)
							{
							$cancelpaymenturl = "fullloginad.php";
							}
						else
							{
							$cancelpaymenturl = "members.php?newlogin=1";
							}
						}

					$paymentbuttons .= "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"700\">";

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
									'description' => $sitename . ' - Special Offer - ' . $userid,
								
								/*
								 * Optional fields
								 */
								'fail_url'	=> $cancelpaymenturl,
								'success_url'	=> $domain. '/thankyou_specialoffer.php',
								
								/*
								 * 8 Custom fields, hidden from users, limited to 100 chars.
								 * You can retrieve them only from your callback file.
								 */
								'cf_1' => $userid,
								'cf_2' => $sitename . ' - Special Offer - ' . $userid,
								'cf_3' => $price,
								'cf_4' => $id,
								//'cf_5' => '',
								//'cf_6' => '',
								//'cf_7' => '',
								//'cf_8' => '',
								));
								
							} catch (EgoPayException $e) {
								die($e->getMessage());
							}
							$egopaypaymenturl = EgoPaySci::EGOPAY_PAYMENT_URL;

					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on EgoPay to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"" . $egopaypaymenturl . "\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"hash\" value=\"" . $sPaymentHash . "\">";
					$paymentbuttons .= "<input type=\"image\" src=\"" . $domain . "/images/egopay.png\" border=\"0\">";
					$paymentbuttons .= "</form><br></td></tr>";

					} # if (($egopay_store_id!="") and ($egopay_store_password!=""))

					if ($adminpaypal != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Paypal to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amount\" id=\"amount\" value=\"". $fundamountplusfee."\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"business\" value=\"". $adminpaypal . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item_name\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"page_style\" value=\"PayPal\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"no_shipping\" value=\"1\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"return\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cancel\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"currency_code\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"lc\" value=\"US\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on0\" value=\"User ID\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os0\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on1\" value=\"Before Fee\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os1\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on2\" value=\"Special Offer ID\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os2\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"notify_url\" value=\"" . $domain . "/paypal_ipn.php\">";
					$paymentbuttons .= "<input type=\"image\" src=\"" . $domain . "/images/paypal.jpg\" border=\"0\" name=\"submit\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminpaypal != "")

					if ($adminpayza != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Payza to return back to the website!<br>";
					$paymentbuttons .= "<form action=\"https://secure.payza.com/checkout\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_amount\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_purchasetype\" value=\"item-goods\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_merchant\" value=\"" . $adminpayza . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_itemname\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_returnurl\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_cancelurl\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_1\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_2\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_3\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_currency\" value=\"USD\"><br>";
					$paymentbuttons .= "<input type=\"image\" name=\"ap_image\" src=\"" . $domain . "/images/payza.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminpayza != "")

					if ($adminperfectmoney != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Perfect Money to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://perfectmoney.com/api/step1.asp\" method=\"POST\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYEE_ACCOUNT\" value=\"" . $adminperfectmoney . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYEE_NAME\" value=\"" . $adminname . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_AMOUNT\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_UNITS\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"STATUS_URL\" value=\"" . $domain . "/perfectmoney_ipn.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_URL\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"NOPAYMENT_URL\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"BAGGAGE_FIELDS\" value=\"userid amountwithoutfee fundamountplusfee item id\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"userid\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amountwithoutfee\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"fundamountplusfee\" value=\"" . $fundamountplusfee  . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"id\" value=\"<?php echo $id ?>\">";
					$paymentbuttons .= "<input type=\"image\" name=\"PAYMENT_METHOD\" value=\"PerfectMoney account\" src=\"" . $domain . "/images/perfectmoney.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminperfectmoney != "")

					if ($adminokpay != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on OKPay to return back to the website!<br><br>";
					$paymentbuttons .= "<form  method=\"post\" action=\"https://www.okpay.com/process.html\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_receiver\" value=\"" . $adminokpay . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_name\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_currency\" value=\"usd\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_type\" value=\"service\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_price\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_1_title\" value=\"userid\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_1_value\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_2_title\" value=\"amountwithoutfee\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_2_value\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_3_title\" value=\"id\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_3_value\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_return_success\" value=\"". $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_return_fail\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_ipn\" value=\"" . $domain . "/okpay_ipn.php\">";
					$paymentbuttons .= "<input type=\"image\" name=\"submit\" src=\"" . $domain . "/images/okpay.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminokpay != "")

					if ($adminsolidtrustpay != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Solid Trust Pay to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://solidtrustpay.com/handle.php\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"merchantAccount\" value=\"" . $adminsolidtrustpay . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"sci_name\" value=\"your_sci_name\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amount\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"currency\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user1\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user2\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user3\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"notify_url\" value=\"" . $domain . "/solidtrustpay_ipn.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"return_url\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cancel_url\"  value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item_id\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"image\" name=\"cartImage\" src=\"" . $domain . "/images/solidtrustpay.gif\" alt=\"Solid Trust Pay\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminsolidtrustpay != "")

					$paymentbuttons .= "</table></td></tr>";
					$paymentbuttons .= "<tr><td align=\"center\"><br><br><a href=\"" . $cancelpaymenturl . "\">No thanks.";

						if ($howmanytimestoshow == "Once Only")
						{
						$paymentbuttons .= " I understand this opportunity will only be available to me ONCE. Continue to " . $whatdoing;
						}
						else
						{
						$paymentbuttons .= " Continue to " . $whatdoing;
						}

					$paymentbuttons .= "</a></td></tr></table>";
					
					$htmlcode = str_replace("~PAYMENT_BUTTONS~",$paymentbuttons,$htmlcode);
					echo $htmlcode;
					exit;
			} # if ($offerviewedrows < 1)
			#################
			if ($offerviewedrows > 0)
			{
			# the member has already seen this one-time view offerpage. Get an always-view offerpage.
			$offerq2 = "select * from offerpages where showwhen=\"$showwhen\" and enable=\"yes\" and howmanytimestoshow!=\"Once Only\" order by rand() limit 1";
			$offerr2 = mysql_query($offerq2);
			$offerrows2 = mysql_num_rows($offerr2);
				if ($offerrows2 < 1)
					{
					# there are no offerpages to show the member after login. Just go to members' area or home page if this is a logout.
					if ($showwhen == "After Logout")
					{
					@header("Location: index.php");
					}
					else
					{
					$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
					$fplar = mysql_query($fplaq);
					$fplarows = mysql_num_rows($fplar);
					if ($fplarows > 0)
						{
						@header("Location: fullloginad.php");
						}
					else
						{
						@header("Location: members.php?newlogin=1");
						}
					}
					exit;
					}
				if ($offerrows2 > 0)
					{
					# there is an always-view offerpage to show the member. Show this one.
					$id = mysql_result($offerr2,0,"id");

					$price = mysql_result($offerr2,0,"price");
					$htmlcode = mysql_result($offerr2,0,"htmlcode");
					$htmlcode = stripslashes($htmlcode);
					$htmlcode = str_replace('\\', '', $htmlcode);

					$feecost = ($paymentprocessorfeetoadd*$price)/100;
					$feecost = sprintf("%.2f", $feecost);
					$fundamountplusfee = $feecost+$price;
					$fundamountplusfee = sprintf("%.2f", $fundamountplusfee);

						if ($showwhen == "After Logout")
						{
						$cancelpaymenturl = $domain;
						}
						else
						{
						$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
						$fplar = mysql_query($fplaq);
						$fplarows = mysql_num_rows($fplar);
						if ($fplarows > 0)
							{
							$cancelpaymenturl = "fullloginad.php";
							}
						else
							{
							$cancelpaymenturl = "members.php?newlogin=1";
							}
						}

					$paymentbuttons .= "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"700\">";

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
									'description' => $sitename . ' - Special Offer - ' . $userid,
								
								/*
								 * Optional fields
								 */
								'fail_url'	=> $cancelpaymenturl,
								'success_url'	=> $domain. '/thankyou_specialoffer.php',
								
								/*
								 * 8 Custom fields, hidden from users, limited to 100 chars.
								 * You can retrieve them only from your callback file.
								 */
								'cf_1' => $userid,
								'cf_2' => $sitename . ' - Special Offer - ' . $userid,
								'cf_3' => $price,
								'cf_4' => $id,
								//'cf_5' => '',
								//'cf_6' => '',
								//'cf_7' => '',
								//'cf_8' => '',
								));
								
							} catch (EgoPayException $e) {
								die($e->getMessage());
							}
							$egopaypaymenturl = EgoPaySci::EGOPAY_PAYMENT_URL;

					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on EgoPay to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"" . $egopaypaymenturl . "\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"hash\" value=\"" . $sPaymentHash . "\">";
					$paymentbuttons .= "<input type=\"image\" src=\"" . $domain . "/images/egopay.png\" border=\"0\">";
					$paymentbuttons .= "</form><br></td></tr>";

					} # if (($egopay_store_id!="") and ($egopay_store_password!=""))

					if ($adminpaypal != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Paypal to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amount\" id=\"amount\" value=\"". $fundamountplusfee."\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"business\" value=\"". $adminpaypal . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item_name\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"page_style\" value=\"PayPal\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"no_shipping\" value=\"1\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"return\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cancel\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"currency_code\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"lc\" value=\"US\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on0\" value=\"User ID\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os0\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on1\" value=\"Before Fee\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os1\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on2\" value=\"Special Offer ID\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os2\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"notify_url\" value=\"" . $domain . "/paypal_ipn.php\">";
					$paymentbuttons .= "<input type=\"image\" src=\"" . $domain . "/images/paypal.jpg\" border=\"0\" name=\"submit\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminpaypal != "")

					if ($adminpayza != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Payza to return back to the website!<br>";
					$paymentbuttons .= "<form action=\"https://secure.payza.com/checkout\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_amount\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_purchasetype\" value=\"item-goods\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_merchant\" value=\"" . $adminpayza . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_itemname\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_returnurl\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_cancelurl\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_1\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_2\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_3\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_currency\" value=\"USD\"><br>";
					$paymentbuttons .= "<input type=\"image\" name=\"ap_image\" src=\"" . $domain . "/images/payza.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminpayza != "")

					if ($adminperfectmoney != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Perfect Money to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://perfectmoney.com/api/step1.asp\" method=\"POST\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYEE_ACCOUNT\" value=\"" . $adminperfectmoney . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYEE_NAME\" value=\"" . $adminname . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_AMOUNT\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_UNITS\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"STATUS_URL\" value=\"" . $domain . "/perfectmoney_ipn.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_URL\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"NOPAYMENT_URL\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"BAGGAGE_FIELDS\" value=\"userid amountwithoutfee fundamountplusfee item id\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"userid\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amountwithoutfee\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"fundamountplusfee\" value=\"" . $fundamountplusfee  . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"id\" value=\"<?php echo $id ?>\">";
					$paymentbuttons .= "<input type=\"image\" name=\"PAYMENT_METHOD\" value=\"PerfectMoney account\" src=\"" . $domain . "/images/perfectmoney.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminperfectmoney != "")

					if ($adminokpay != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on OKPay to return back to the website!<br><br>";
					$paymentbuttons .= "<form  method=\"post\" action=\"https://www.okpay.com/process.html\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_receiver\" value=\"" . $adminokpay . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_name\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_currency\" value=\"usd\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_type\" value=\"service\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_price\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_1_title\" value=\"userid\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_1_value\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_2_title\" value=\"amountwithoutfee\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_2_value\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_3_title\" value=\"id\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_3_value\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_return_success\" value=\"". $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_return_fail\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_ipn\" value=\"" . $domain . "/okpay_ipn.php\">";
					$paymentbuttons .= "<input type=\"image\" name=\"submit\" src=\"" . $domain . "/images/okpay.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminokpay != "")

					if ($adminsolidtrustpay != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Solid Trust Pay to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://solidtrustpay.com/handle.php\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"merchantAccount\" value=\"" . $adminsolidtrustpay . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"sci_name\" value=\"your_sci_name\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amount\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"currency\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user1\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user2\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user3\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"notify_url\" value=\"" . $domain . "/solidtrustpay_ipn.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"return_url\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cancel_url\"  value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item_id\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"image\" name=\"cartImage\" src=\"" . $domain . "/images/solidtrustpay.gif\" alt=\"Solid Trust Pay\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminsolidtrustpay != "")

					$paymentbuttons .= "</table></td></tr>";
					$paymentbuttons .= "<tr><td align=\"center\"><br><br><a href=\"" . $cancelpaymenturl . "\">No thanks.";

						if ($howmanytimestoshow == "Once Only")
						{
						$paymentbuttons .= " I understand this opportunity will only be available to me ONCE. Continue to " . $whatdoing;
						}
						else
						{
						$paymentbuttons .= " Continue to " . $whatdoing;
						}

					$paymentbuttons .= "</a></td></tr></table>";
					
					$htmlcode = str_replace("~PAYMENT_BUTTONS~",$paymentbuttons,$htmlcode);
					echo $htmlcode;
					exit;

					} # if ($offerrows2 > 0)

			} # if ($offerviewedrows > 0)

	} # if ($howmanytimestoshow == "Once Only")
###############################################
if ($howmanytimestoshow != "Once Only")
{
					$price = mysql_result($r,0,"price");
					$htmlcode = mysql_result($r,0,"htmlcode");
					$htmlcode = stripslashes($htmlcode);
					$htmlcode = str_replace('\\', '', $htmlcode);

					$feecost = ($paymentprocessorfeetoadd*$price)/100;
					$feecost = sprintf("%.2f", $feecost);
					$fundamountplusfee = $feecost+$price;
					$fundamountplusfee = sprintf("%.2f", $fundamountplusfee);

						if ($showwhen == "After Logout")
						{
						$cancelpaymenturl = $domain;
						}
						else
						{
						$fplaq = "select h.* from fullloginads h where h.approved=1 and h.max > h.hits and h.id NOT IN (select adid from fullloginadviews where userid=\"$userid\") order by rand() limit 1";
						$fplar = mysql_query($fplaq);
						$fplarows = mysql_num_rows($fplar);
						if ($fplarows > 0)
							{
							$cancelpaymenturl = "fullloginad.php";
							}
						else
							{
							$cancelpaymenturl = "members.php?newlogin=1";
							}
						}

					$paymentbuttons .= "<table cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\" width=\"700\">";

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
									'description' => $sitename . ' - Special Offer - ' . $userid,
								
								/*
								 * Optional fields
								 */
								'fail_url'	=> $cancelpaymenturl,
								'success_url'	=> $domain. '/thankyou_specialoffer.php',
								
								/*
								 * 8 Custom fields, hidden from users, limited to 100 chars.
								 * You can retrieve them only from your callback file.
								 */
								'cf_1' => $userid,
								'cf_2' => $sitename . ' - Special Offer - ' . $userid,
								'cf_3' => $price,
								'cf_4' => $id,
								//'cf_5' => '',
								//'cf_6' => '',
								//'cf_7' => '',
								//'cf_8' => '',
								));
								
							} catch (EgoPayException $e) {
								die($e->getMessage());
							}
							$egopaypaymenturl = EgoPaySci::EGOPAY_PAYMENT_URL;

					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on EgoPay to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"" . $egopaypaymenturl . "\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"hash\" value=\"" . $sPaymentHash . "\">";
					$paymentbuttons .= "<input type=\"image\" src=\"" . $domain . "/images/egopay.png\" border=\"0\">";
					$paymentbuttons .= "</form><br></td></tr>";

					} # if (($egopay_store_id!="") and ($egopay_store_password!=""))

					if ($adminpaypal != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Paypal to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://www.paypal.com/cgi-bin/webscr\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amount\" id=\"amount\" value=\"". $fundamountplusfee."\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cmd\" value=\"_xclick\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"business\" value=\"". $adminpaypal . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item_name\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"page_style\" value=\"PayPal\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"no_shipping\" value=\"1\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"return\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cancel\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"currency_code\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"lc\" value=\"US\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on0\" value=\"User ID\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os0\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on1\" value=\"Before Fee\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os1\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"on2\" value=\"Special Offer ID\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"os2\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"notify_url\" value=\"" . $domain . "/paypal_ipn.php\">";
					$paymentbuttons .= "<input type=\"image\" src=\"" . $domain . "/images/paypal.jpg\" border=\"0\" name=\"submit\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminpaypal != "")

					if ($adminpayza != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Payza to return back to the website!<br>";
					$paymentbuttons .= "<form action=\"https://secure.payza.com/checkout\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_amount\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_purchasetype\" value=\"item-goods\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_merchant\" value=\"" . $adminpayza . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_itemname\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_returnurl\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_cancelurl\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_1\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_2\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"apc_3\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ap_currency\" value=\"USD\"><br>";
					$paymentbuttons .= "<input type=\"image\" name=\"ap_image\" src=\"" . $domain . "/images/payza.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminpayza != "")

					if ($adminperfectmoney != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Perfect Money to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://perfectmoney.com/api/step1.asp\" method=\"POST\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYEE_ACCOUNT\" value=\"" . $adminperfectmoney . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYEE_NAME\" value=\"" . $adminname . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_AMOUNT\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_UNITS\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"STATUS_URL\" value=\"" . $domain . "/perfectmoney_ipn.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"PAYMENT_URL\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"NOPAYMENT_URL\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"BAGGAGE_FIELDS\" value=\"userid amountwithoutfee fundamountplusfee item id\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"userid\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amountwithoutfee\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"fundamountplusfee\" value=\"" . $fundamountplusfee  . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"id\" value=\"<?php echo $id ?>\">";
					$paymentbuttons .= "<input type=\"image\" name=\"PAYMENT_METHOD\" value=\"PerfectMoney account\" src=\"" . $domain . "/images/perfectmoney.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminperfectmoney != "")

					if ($adminokpay != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on OKPay to return back to the website!<br><br>";
					$paymentbuttons .= "<form  method=\"post\" action=\"https://www.okpay.com/process.html\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_receiver\" value=\"" . $adminokpay . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_name\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_currency\" value=\"usd\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_type\" value=\"service\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_price\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_1_title\" value=\"userid\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_1_value\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_2_title\" value=\"amountwithoutfee\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_2_value\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_3_title\" value=\"id\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_item_1_custom_3_value\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_return_success\" value=\"". $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_return_fail\" value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"ok_ipn\" value=\"" . $domain . "/okpay_ipn.php\">";
					$paymentbuttons .= "<input type=\"image\" name=\"submit\" src=\"" . $domain . "/images/okpay.gif\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminokpay != "")

					if ($adminsolidtrustpay != "")
					{
					$paymentbuttons .= "<tr><td align=\"center\"><br>After you've made your payment, please be sure to click the link on Solid Trust Pay to return back to the website!<br><br>";
					$paymentbuttons .= "<form action=\"https://solidtrustpay.com/handle.php\" method=\"post\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"merchantAccount\" value=\"" . $adminsolidtrustpay . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"sci_name\" value=\"your_sci_name\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"amount\" value=\"" . $fundamountplusfee . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"currency\" value=\"USD\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user1\" value=\"" . $userid . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user2\" value=\"" . $price . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"user3\" value=\"" . $id . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"notify_url\" value=\"" . $domain . "/solidtrustpay_ipn.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"return_url\" value=\"" . $domain . "/thankyou_specialoffer.php\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"cancel_url\"  value=\"" . $cancelpaymenturl . "\">";
					$paymentbuttons .= "<input type=\"hidden\" name=\"item_id\" value=\"" . $sitename . " - Special Offer - " . $userid . "\">";
					$paymentbuttons .= "<input type=\"image\" name=\"cartImage\" src=\"" . $domain . "/images/solidtrustpay.gif\" alt=\"Solid Trust Pay\" border=\"0\">";
					$paymentbuttons .= "</form>";
					$paymentbuttons .= "</td></tr>";
					} # if ($adminsolidtrustpay != "")

					$paymentbuttons .= "</table></td></tr>";
					$paymentbuttons .= "<tr><td align=\"center\"><br><br><a href=\"" . $cancelpaymenturl . "\">No thanks.";

						if ($howmanytimestoshow == "Once Only")
						{
						$paymentbuttons .= " I understand this opportunity will only be available to me ONCE. Continue to " . $whatdoing;
						}
						else
						{
						$paymentbuttons .= " Continue to " . $whatdoing;
						}

					$paymentbuttons .= "</a></td></tr></table>";
					
					$htmlcode = str_replace("~PAYMENT_BUTTONS~",$paymentbuttons,$htmlcode);
					echo $htmlcode;
					exit;

} # if ($howmanytimestoshow != "Once Only")

} # if ($rows > 0)
?>