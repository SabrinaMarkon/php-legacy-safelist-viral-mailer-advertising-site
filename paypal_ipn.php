<?php
include "db.php";
### Copyright 2013 SABRINA MARKON PearlsOfWealth.com Sunshinehosting.net sabrina@sunshinehosting.net UPDATED PAYPAL CALLBACK SYSTEM. Copying without license from Sabrina Markon (50.00 one time per cpanel website fully installed)
### is prohibited.
### Theft of my work will result in your host and their data center warehouse receiving a DHMC takedown notice for any content and/or a careless remote removal of stolen material (I do not need cpanel
### access to messily delete and hack my own work someone has stolen, obviously)

// STEP 1: Read POST data

// reading posted data from directly from $_POST causes serialization 
// issues with array data in POST
// reading raw POST data from input stream instead. 
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
  $keyval = explode ('=', $keyval);
  if (count($keyval) == 2)
     $myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
   $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
   } else {
        $value = urlencode($value);
   }
   $req .= "&$key=$value";
}

// STEP 2: Post IPN data back to paypal to validate
 
$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
// In wamp like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path 
// of the certificate as shown below.
// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');

if( !($res = curl_exec($ch)) ) {
    error_log("Got " . curl_error($ch) . " when processing IPN data");
    curl_close($ch);
    exit;
}
curl_close($ch);

// STEP 3: Inspect IPN validation result and act accordingly
 
if (strcmp ($res, "VERIFIED") == 0) {
echo "VERIFIED";

$payment_status = $_POST['payment_status'];
$amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = $_POST['receiver_email'];
$paypal = $_POST['payer_email'];
$quantity = $_POST['quantity'];
$userid = $_POST['option_selection1'];
$amountwithoutfee = $_POST["option_selection2"];
$specialofferid = $_POST["option_selection3"];
$item = $_POST['item_name'];

if ($payment_status == "Completed")
{
$query = "select * from members where userid='".$userid."'";
$result = mysql_query ($query) or die (mysql_error());
$numrows = @ mysql_num_rows($result);
if ($numrows == 1) 
{	
$user = mysql_fetch_array($result);
$referid = $user["referid"];
$egopay = $user["egopay"];
$payza = $user["payza"];
$perfectmoney = $user["perfectmoney"];
$okpay = $user["okpay"];
$solidtrustpay = $user["solidtrustpay"];
$paypal = $user["paypal"];
$paychoice = "Paypal";
$transaction = $txn_id;
$today = date('Y-m-d',strtotime("now"));

	if ($item == $sitename." - ".$ewalletname." - ".$userid)
		{
				$paychoice = "Paypal";
				$q = "update members set ewallet=ewallet+" . $amountwithoutfee . " where userid='$userid'";
				$r = mysql_query($q);
				$q2 = "insert into transactions (userid,transaction,description,paymentdate,amountreceived) values (\"$userid\",\"$txn_id\",\"$paychoice payment - Add to $ewalletname\",NOW(),\"$amountwithoutfee\")";
				$r2 = mysql_query($q2);
		}
	if($item == $sitename." - Special Offer - ".$userid)
		{
			$q = "select * from offerpages where id=\"$specialofferid\"";
			$r = mysql_query($q);
			$rows = mysql_num_rows($r);
			if ($rows > 0)
			{
			$name = mysql_result($r,0,"name");
			$commissionfree = mysql_result($r,0,"commissionfree");
			$commissionpaid = mysql_result($r,0,"commissionpaid");
			$upgrade = mysql_result($r,0,"upgrade");
			$credits = mysql_result($r,0,"credits");
			$solo_num = mysql_result($r,0,"solo_num");
			$banner_num = mysql_result($r,0,"banner_num");
			$banner_views = mysql_result($r,0,"banner_views");
			$button_num = mysql_result($r,0,"button_num");
			$button_views = mysql_result($r,0,"button_views");
			$textad_num = mysql_result($r,0,"textad_num");
			$textad_views = mysql_result($r,0,"textad_views");
			$fullloginad_num = mysql_result($r,0,"fullloginad_num");
			$fullloginad_views = mysql_result($r,0,"fullloginad_views");
			if ($enablecreditssystem != "yes")
				{
				$credits = 0;
				}
			########################################################
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
					$refq = "select * from members where userid=\"$referid\"";
					$refr = mysql_query($refq);
					$refrows = mysql_num_rows($refr);
					if ($refrows > 0)
						{
						$refaccounttype = mysql_result($refr,0,"accounttype");
						if ($refaccounttype == "PAID")
							{
							$sponsorcommission = $commissionpaid;
							}
						if ($refaccounttype != "PAID")
							{
							$sponsorcommission = $commissionfree;
							}
						if ($sponsorcommission > 0)
							{
							$ewalletq = "update members set ewallet=ewallet+" . $sponsorcommission . " where userid=\"$referid\"";
							$ewalletr = mysql_query($ewalletq);
							$refq3 = "insert into payouts (userid,paid,datepaid,description) values (\"$referid\",\"$sponsorcommission\",NOW(),\"Sponsor Payment - Special Offer Purchase - " . $name . " by Referral $userid\")";
							$refr3 = mysql_query($refq3);
							}
						} # if ($refrows > 0)
			} # if ($rows > 0)		
			mysql_query("INSERT INTO transactions (userid,transaction,description,paymentdate,amountreceived) VALUES ('".$userid."','".$transaction."','$paychoice payment - Special Offer Purchase - " . $name . "','".time()."','".$amountwithoutfee."')");
		} # if($item == $sitename." - Special Offer - ".$userid)

} # if ($numrows == 1) 
} # if ($payment_status == "Completed")

} else if (strcmp ($res, "INVALID") == 0) {
echo "INVALID";
}
?>