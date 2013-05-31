<?php
include("../../include/vars.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

$result = mysql_query("SELECT * FROM characters") or die(mysql_error());
?>
<table cellpadding="0" cellspacing="0" style="width:50%;border-width: 1px; border-style: solid; text-align: left;">
	<tr style="border-width: 1px; border-style: solid; text-align: left;">
		<th>ID</th>
		<th>Class</th>
		<th>Name</th>
		<th>HP</th>
		<th>AC</th>
		<th>Fortitude</th>
		<th>Reflex</th>
		<th>Will</th>
		<th>EXP</th>
		<th>edit</th>
	</tr>
<?php
while ($row = mysql_fetch_array($result)) {
	echo "<tr style=\"border-width: 1px; border-style: solid; text-align: left;\"><td>";
	echo $row['id'];
	echo "</td><td>";
	echo $row['class'];
	echo "</td><td>";
	echo $row['name'];
	echo "</td><td>";
	echo $row['hp'] . "/" . $row['maxhp'];
	echo "</td><td>";
	echo $row['ac'];
	echo "</td><td>";
	echo $row['fortitude'];
	echo "</td><td>";
	echo $row['reflex'];
	echo "</td><td>";
	echo $row['will'];
	echo "</td><td>";
	echo $row['exp'];
	echo "</td><td>";
	echo "<a href=\"#\" id=\"edit".$row['id']."\">Edit</a>";
	echo "</td></tr>";
	?>
	<script>
		$("#edit<?php echo $row['id']; ?>").click(function() {
			$("#editname").val("<?php echo $row['name']; ?>");
			$("#editclass").val("<?php echo $row['class']; ?>");
			$("#edithp").val("<?php echo $row['hp']; ?>");
			$("#editmaxhp").val("<?php echo $row['maxhp']; ?>");
			$("#editac").val("<?php echo $row['ac']; ?>");
			$("#editfort").val("<?php echo $row['fortitude']; ?>");
			$("#editreflex").val("<?php echo $row['reflex']; ?>");
			$("#editwill").val("<?php echo $row['will']; ?>");
			$("#editexp").val("<?php echo $row['exp']; ?>");
		});
	</script>
	<?php
}
?>
</table>