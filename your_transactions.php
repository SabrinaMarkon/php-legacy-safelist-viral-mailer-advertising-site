<?php
include "control.php";
include "header.php";
include "banners.php";
function formatDate($val) {
	$arr = explode("-", $val);
	return date("M d Y", mktime(0,0,0, $arr[1], $arr[2], $arr[0]));
}
?>
<table cellpadding="4" cellspacing="4" border="0" align="center" width="600">
<tr><td align="center" colspan="2"><div class="heading">Your <?php echo $sitename ?> Transaction Records</div></td></tr>
<tr><td colspan="2">
<div style="text-align: center;">
<?php
$query = "select * from pages where name='Members Area Transaction History Page'";
$result = mysql_query ($query)
or die ("Query failed");
while ($line = mysql_fetch_array($result))
{
$htmlcode = $line["htmlcode"];
echo $htmlcode;
}
#############################
?>
</div> 
</td></tr>

<tr><td align="center" colspan="2"><br>
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="600">
<tr class="sabrinatrdark"><td align="center" colspan="2">Your Order/Purchase History</td></tr>

<?php
$pnquery = "select * from transactions where userid=\"$userid\" order by id desc";
$pnresult = mysql_query($pnquery);
$pnrows = mysql_num_rows($pnresult);
if ($pnrows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">You don't have any order history yet.</td></tr>
<?php
}
if ($pnrows > 0)
{
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600">
<tr class="sabrinatrlight">
<td align="center">Description</td>
<!--<td align="center">Transaction ID</td>-->
<td align="center">Amount</td>
<td align="center">Date</td>
</tr>
<?php
	while ($pnrowz = mysql_fetch_array($pnresult))
	{
	$transaction = $pnrowz["transaction"];
	$description = $pnrowz["description"];
	$amountreceived = $pnrowz["amountreceived"];
	$paymentdate = $pnrowz["paymentdate"];
	$paymentdate = formatDate($paymentdate);
	?>
	<tr class="sabrinatrdark">
	<td align="center"><?php echo $description ?></td>
	<!--<td align="center"><?php echo $transaction ?></td>-->
	<td align="center">$<?php echo $amountreceived ?></td>
	<td align="center"><?php echo $paymentdate ?></td>
	</tr>
	<?php
	} # while ($pnrowz = mysql_fetch_array($pnresult))
?>
</table></td></tr>
<?php
} # if ($pnrows > 0)
?>
</table></td></tr>

<tr><td colspan="2" align="center"><br>&nbsp;</td></tr>

<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" class="sabrinatable" width="600">
<tr class="sabrinatrdark"><td align="center" colspan="2">Your Payout History</td></tr>

<?php
$poquery = "select * from payouts where userid=\"$userid\" order by id desc";
$poresult = mysql_query($poquery);
$porows = mysql_num_rows($poresult);
if ($porows < 1)
{
?>
<tr class="sabrinatrlight"><td align="center" colspan="2">You don't have any payout history yet.</td></tr>
<?php
}
if ($porows > 0)
{
?>
<tr><td align="center" colspan="2">
<table cellpadding="2" cellspacing="2" border="0" align="center" width="600">
<tr class="sabrinatrlight">
<td align="center">Description</td>
<td align="center">Amount</td>
<td align="center">Date</td>
</tr>
<?php
	while ($porowz = mysql_fetch_array($poresult))
	{
	$description = $porowz["description"];
	$paid = $porowz["paid"];
	$datepaid = $porowz["datepaid"];
	$datepaid = formatDate($datepaid);
	?>
	<tr class="sabrinatrdark">
	<td align="center"><?php echo $description ?></td>
	<td align="center">$<?php echo $paid ?></td>
	<td align="center"><?php echo $datepaid ?></td>
	</tr>
	<?php
	} # while ($porowz = mysql_fetch_array($poresult))
?>
</table></td></tr>
<?php
} # if ($porows > 0)
?>
</table></td></tr>

</table>
<?php
include "footer.php";
exit;
?>