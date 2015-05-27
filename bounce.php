#!/usr/local/bin/php -q
<?php
include "db.php";
// Reading in the email
$fd = fopen("php://stdin", "r");
while (!feof($fd)) {
  $email .= fread($fd, 1024);
}
fclose($fd);

// Parsing the email
$lines = explode("\n", $email);
$stillheaders=true;
for ($i=0; $i < count($lines); $i++) {
  if ($stillheaders) {
    // this is a header
    $headers .= $lines[$i]."\n";

    // look out for special headers
    if (preg_match("/^Subject: (.*)/", $lines[$i], $matches)) {
      $subject = $matches[1];
    }
    if (preg_match("/^From: (.*)/", $lines[$i], $matches)) {
      $from = $matches[1];
    }
    if (preg_match("/^To: (.*)/", $lines[$i], $matches)) {
      $to = $matches[1];
    }
    if (preg_match("/^X-UserID: (.*)/", $lines[$i], $matches)) {
      $bounceduserid = $matches[1];
    }
    if (preg_match("/^X-Subscribed: (.*)/", $lines[$i], $matches)) {
      $bouncedemail = $matches[1];
    }
    if (preg_match("/^X-Domain: (.*)/", $lines[$i], $matches)) {
      $bounceddomain = $matches[1];
    }
  } else {
    // not a header, but message
    #break;
    #Optionally you can read out the message also, instead of the break:
    $message .= $lines[$i]."\n";
    if (preg_match("/^X-UserID: (.*)/", $lines[$i], $matches)) {
      $bounceduserid = $matches[1];
    }
    if (preg_match("/^X-Subscribed: (.*)/", $lines[$i], $matches)) {
      $bouncedemail = $matches[1];
    }
    if (preg_match("/^X-Domain: (.*)/", $lines[$i], $matches)) {
      $bounceddomain = $matches[1];
    }
  }
  if (trim($lines[$i])=="") {
    // empty line, header section has ended
    $stillheaders = false;
  }
}

$bouncedmessage_array = explode("Message-Id",$message);
$bouncedmessage = $bouncedmessage_array[0];

/*
# remove after testing:
$testheaders = "From: $sitename<$adminemail>\n";
$testheaders .= "Reply-To: <$adminemail>\n";
$testheaders .= "X-Sender: <$adminemail>\n";
$testheaders .= "X-Mailer: PHP4\n";
$testheaders .= "X-Priority: 3\n";
$testheaders .= "Return-Path: <$adminemail>\nContent-type: text/html; charset=iso-8859-1\n";
$testmessage = $bouncedmessage . "<hr><br>" . $bounceduserid . "<br><br>" . $bounceddomain . "<br><br>" . $bouncedemail . "<br><br><hr>" . $q1 . "<br><br>" . $r1 . "<br><br><hr>" . $q3 . "<br><br>" . $r3;
$testsubject = $sitename . " Bounce Script Ran";
@mail("sabrina@sunshinehosting.net", $testsubject, wordwrap(stripslashes($testmessage)),$testheaders, "-f$adminemail");
*/

if (($bounceduserid != "") and ($bouncedemail != "") and ($bounceddomain != ""))
{
	 $bounceinfo = array (
			"userid" => $bounceduserid,
			"email" => $bouncedemail,
			"message" => $bouncedmessage
			);
	 $dataels = array();
	 foreach (array_keys($bounceinfo) as $thiskey) {
			array_push($dataels,urlencode($thiskey) ."=".
							urlencode($bounceinfo[$thiskey]));
			}
	 $data = implode("&",$dataels);

	$posturl = $bounceddomain . "/bounce_curl.php";
	$curl = "";
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $posturl);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	$page = curl_exec($curl);
	curl_close($curl);


} # if (($bounceduserid != "") and ($bouncedemail != "") and ($bounceddomain != ""))

return true;
?>