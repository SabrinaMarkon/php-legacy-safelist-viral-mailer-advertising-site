<?php
$database_host = "localhost";
$database_username = "mmdeals_marc";
$database_password = "z0!dX=i@hQxF";
$database_name = "mmdeals_100";
$database_connection = mysql_connect($database_host, $database_username, $database_password) or die(mysql_error());
@mysql_select_db($database_name) or die(mysql_error());
$submittercountq = "select * from hundredsolos_sites where hundredsolossiteactive=\"yes\" and hundredsolossitetype=\"PASTA\" order by rand()";
$submittercountr = mysql_query($submittercountq);
$submittercountrows = mysql_num_rows($submittercountr);
if ($submittercountrows > 0)
{
?>
<br><br>
<center>
<table cellpadding="4" cellspacing="2" align="center" border="0" class="sabrinatable" align="center">	
<tr class="sabrinatrdark"><td align="center" colspan="6">Some of the Live Websites Currently Running the Viral Mailer & Advertising Script</td></tr>
<tr class="sabrinatrlight">
<?php
$numcolumns = 6; # columns
$numcolumnsprinted = 0; # columns so far
while ($submittercountrowz = mysql_fetch_array($submittercountr))
{
$hundredsolossitename = $submittercountrowz["hundredsolossitename"];
$hundredsolossiteurl = $submittercountrowz["hundredsolossiteurl"];
$hundredsolossitethumbnail = $submittercountrowz["hundredsolossitethumbnail"];
	if ($numcolumnsprinted == $numcolumns)
	{
	echo "</tr>\n<tr class=\"sabrinatrlight\">\n";
	$numcolumnsprinted = 0;
	}
?>
<td align="center"><b><?php echo $hundredsolossitename ?><br><a href="<?php echo $hundredsolossiteurl ?>/index.php?referid=<?php echo $referid ?>" target="_blank"><img src="<?php echo $hundredsolossitethumbnail ?>" border="0" alt="<?php echo $hundredsolossitename ?>"  width="150"></a></td>
<?php
$numcolumnsprinted++;
}
$columnstobalancetable = $numcolumns - $numcolumnsprinted;
for ($i=1; $i<=$columnstobalancetable; $i++)
{
echo "<td align=\"center\"></td>\n";
}
?>
</tr>
</table><br><br>
<?php
} # if ($submittercountrows > 0)
?>