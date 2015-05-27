<?php
include "control.php";
include "header.php";
include "banners.php";
$action = $_POST["action"];
$show = "";
if ($action == "addtestimonial")
{
$tname = $_POST["tname"];
$tcompany = $_POST["tcompany"];
$turl = $_POST["turl"];
$tphoto = $_POST["tphoto"];
$tphoto_name = $_FILES['tphoto']['name'];
$tphoto_type = $_FILES['tphoto']['type'];
$trating = $_POST["trating"];
$theading = $_POST["theading"];
$tbody = $_POST["tbody"];
	if(!$tname)
	{
	$error .= "<div>Please return and enter your name.</div>";
	}
	if(!$theading)
	{
	$error .= "<div>Please return and enter a heading for your testimonial.</div>";
	}
	if(!$tbody)
	{
	$error .= "<div>Please return and enter a message for your testimonial.</div>";
	}

	if(!$error == "")
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td colspan="2" align="center"><br><?php echo $error ?></td></tr>
	<tr><td colspan="2" align="center"><br><a href="testimonialsadd.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

if ($tphoto_name != "")
{
$type = $tphoto_type;

	if(($type != "image/gif") and ($type != "image/bmp") and ($type != "image/png") and ($type != "image/jpg") and ($type != "image/pjpeg") and ($type != "image/jpeg"))
	{
	?>
	<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
	<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
	<tr><td colspan="2" align="center"><br>Your photo file is of a type not permitted for upload (only upload jpeg, jpg, pjpeg, gif, png, or bmp).</td></tr>
	<tr><td colspan="2" align="center"><br><a href="testimonialsadd.php">RETURN</a></td></tr>
	</table>
	<br><br>
	<?php
	include "footer.php";
	exit;
	}

function findexts ($filename)
{
$filename = strtolower($filename) ;
$exts = split("[/\\.]", $filename) ;
$n = count($exts)-1;
$exts = $exts[$n];
return $exts;
}
$ext = findexts($_FILES['tphoto']['name']);
$newfilename = $userid . "." . $ext;
$temp = $testimonialphotopath . $newfilename;
	if (@file_exists($temp))
	{
	# delete old one before uploading new one.
	@unlink($temp);
	}
	if(@move_uploaded_file($_FILES['tphoto']['tmp_name'], $temp)) 
	{
		list($width, $height, $type, $attr) = getimagesize($temp);
		if ($width>160 || $height>160)
		{
		?>
		<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
		<tr><td align="center" colspan="2"><div class="heading">Error</div></td></tr>
		<tr><td colspan="2"><br>Your photo file must be 100 x 100 in dimensions. The width of the file you wanted to upload was <?php echo $width ?>pixels, and the height was <?php echo $height ?> pixels.</td></tr>
		<tr><td colspan="2" align="center"><br><a href="profile.php">RETURN</a></td></tr>
		</table>
		<br><br>
		<?php
		include "footer.php";
		exit;
		@unlink($temp);
		}
		else
		{
		@chmod($temp, 0777);
		}
	}
} # if ($tphoto_name != "")

$q = "insert into testimonials (userid,name,photo,company,url,heading,body,rating,dateadded,approved,views) values ('$userid','$tname','$newfilename','$tcompany','$turl','$theading','$tbody','$trating',NOW(),'0','0')";
$r = mysql_query($q);

$headers = "From: $sitename<$adminemail>\n";
$headers .= "Reply-To: <$adminemail>\n";
$headers .= "X-Sender: <$adminemail>\n";
$headers .= "X-Mailer: PHP4\n";
$headers .= "X-Priority: 3\n";
$headers .= "Return-Path: <$adminemail>\n";
$to = $adminemail;
$subject = $sitename . " New Testimonial From UserID $userid";
$body = "UserID: $userid\nName: $tname\nCompany: $tcompany\nURL: $turl\nPhoto Uploaded: $newfilename\nRating: $trating/10\n\nTestimonial Heading: $theading\n\nTestimonial Message:\n\n$tbody\n\n
This testimonial will not show on the website until you login to the admin area \"Member Testimonials\" and approve it.\n\n";
@mail($to, $subject, wordwrap(stripslashes($body)),$headers, "-f$adminemail");
$show = "Your Testimonial was submitted successfully! Thank you!";
} # if ($action == "addtestimonial")
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Add Your Testimonial</div></td></tr>
<?php
if ($show != "")
{
?>
<tr><td align="center" colspan="2"><br><?php echo $show ?></td></tr>
<?php
}
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600">
<tr><td>
<div style="text-align: center;">
<?php
$q = "select * from pages where name='Members Area Add Testimonial Page'";
$r = mysql_query($q);
$rowz = mysql_fetch_array($r);
$htmlcode = $rowz["htmlcode"];
echo $htmlcode;
?>
</div>
</td></tr>
</table>
</td></tr>

<form action="testimonialsadd.php" method="post" enctype="multipart/form-data">
<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600" class="sabrinatable" class="sabrinatable">
<tr class="sabrinatrlight"><td align="right">Name: </td><td><input type="text" name="tname" size="55" maxlength="255" class="typein"></td></tr>
<tr class="sabrinatrlight"><td align="right">Company (optional): </td><td><input type="text" name="tcompany" size="55" maxlength="255" class="typein"></td></tr>
<tr class="sabrinatrlight"><td align="right">URL (optional): </td><td><input type="text" name="turl" size="55" maxlength="255" class="typein"></td></tr>
<tr class="sabrinatrlight"><td align="right">Photo (optional - 100x100): </td><td><input type="file" name="tphoto" size="35" class="typein"></td></tr>
<tr class="sabrinatrlight"><td align="right">Rating: </td><td><select name="trating" class="pickone">
<option value="10">10 Excellent</option>
<option value="9">9/10</option>
<option value="8">8/10</option>
<option value="7">7/10</option>
<option value="6">6/10</option>
<option value="5">5 Acceptable</option>
<option value="4">4/10</option>
<option value="3">3/10</option>
<option value="2">2/10</option>
<option value="1">1 Very Bad</option>
</select>
</td></tr>
<tr class="sabrinatrlight"><td align="right">Testimonial Heading: </td><td><input type="text" name="theading" size="55" maxlength="255" class="typein"></td></tr>
<tr class="sabrinatrlight"><td align="right" valign="top">Testimonial Message: </td><td><textarea rows="15" cols="52" name="tbody" style="background-color:#fff;border:solid 1px #000;font-family:Tahoma,Arial,Helvetica;color:#000;"></textarea></td></tr>
<tr class="sabrinatrdark"><td colspan="2" align="center"><input type="hidden" name="action" value="addtestimonial"><input type="submit" value="SUBMIT" class="sendit"></td></tr></form>
</table>

</td></tr>
</table>
<br><br>
<?php
include "footer.php";
exit;
?>