<?php
include("../../include/vars.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

$result = mysql_query("SELECT * FROM enemies WHERE disable='0' ORDER BY id DESC") or die(mysql_error());
?>
<table cellpadding="0" cellspacing="0" style="width:75%;border-width: 1px; border-style: solid; text-align: left;">
	<tr style="border-width: 1px; border-style: solid; text-align: left;">
		<th>ID</th>
		<th>Name</th>
		<th>Type</th>
		<th>HP</th>
		<th>HP Mask</th>
		<th>Hidden</th>
		<th>edit</th>
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
		echo "<tr style=\"border-width: 1px; border-style: solid; text-align: left; background-color:".$rowColour.";\"><td>";
		echo $row['id'];
		echo "</td><td>";
		echo $row['name'];
		echo "</td><td>";
		echo $row['type'];
		echo "</td><td>";
		echo $row['hp'] . "/" . $row['maxhp'];
		echo "</td><td>";
		echo ($row['mask'] == 1) ? "Masked" : "Displayed";
		echo "</td><td>";
		echo ($row['hide'] == 1) ? "Hidden" : "Visible";
		echo "</td><td>";
		echo "<a href=\"#\" id=\"editE" . $row['id'] . "\">Edit</a>";
		echo "</td></tr>";
		?>
		<script>
			$("#editE<?php echo $row['id']; ?>").click(function() {
				$("#editEid").val("<?php echo $row['id']; ?>");
				$("#editEname").val("<?php echo $row['name']; ?>");
				$("#editEtype").val("<?php echo $row['type']; ?>");
				$("#editEhp").val("<?php echo $row['hp']; ?>");
				$("#editEtemphp").val("<?php echo $row['temphp']; ?>");
				$("#editEmaxhp").val("<?php echo $row['maxhp']; ?>");
				$("#editEinitroll").val("<?php echo $row['initroll']; ?>");
				$("#editEmaskDmg").prop("checked", <?php echo ($row['mask'] == 1) ? "true" : "false"; ?>);
				$("#editEhide").prop("checked", <?php echo ($row['hide'] == 1) ? "true" : "false"; ?>);
				$("#editEdisable").prop("checked", <?php echo ($row['disable'] == 1) ? "true" : "false"; ?>);
			});
		</script>
		<?php
	}
	?>
</table>