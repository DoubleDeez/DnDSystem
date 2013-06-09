<?php
include("../../include/vars.php");
include("../../include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

$result = mysql_query("SELECT * FROM users") or die(mysql_error());

?>
<table cellpadding="0" cellspacing="0" style="width:75%;border-width: 1px; border-style: solid; text-align: left;">
	<tr style="border-width: 1px; border-style: solid; text-align: left;">
		<th>ID</th>
		<th>Name</th>
		<th>Rank</th>
		<th>Character Count</th>
		<th>Token</th>
	</tr>
	<?php
	$rowBG = 0;
	while ($row = mysql_fetch_array($result)) {
		$rowBG++;
		if (($rowBG % 2) == 1) {
			$rowColour = "#D1D1D1";
		} else {
			$rowColour = "#F3F3F3";
		}
		
		$charCount = mysql_result(mysql_query("SELECT COUNT(*) FROM characters WHERE userid='".$row['id']."'"),0);
		
		echo "<tr style=\"border-width: 1px; border-style: solid; text-align: left; background-color:".$rowColour.";\"><td>";
		echo $row['id'];
		echo "</td><td>";
		echo $row['name'];
		echo "</td><td>";
		echo $row['rank'];
		echo "</td><td>";
		echo $charCount;
		echo "</td><td>";
		echo $row['token'];
		echo "</td></tr>";
	}
	?>
</table>