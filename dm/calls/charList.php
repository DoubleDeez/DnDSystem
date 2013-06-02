<?php
include("../../include/vars.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());

$result = mysql_query("SELECT * FROM characters") or die(mysql_error());
?>
<table cellpadding="0" cellspacing="0" style="width:75%;border-width: 1px; border-style: solid; text-align: left;">
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
		echo "<a href=\"#\" id=\"edit" . $row['id'] . "\">Edit</a>";
		echo "</td></tr>";
		?>
		<script>
			$("#edit<?php echo $row['id']; ?>").click(function() {
				$("#editid").val("<?php echo $row['id']; ?>");
				$("#invAddCharID").val("<?php echo $row['id']; ?>");
				$("#editname").val("<?php echo $row['name']; ?>");
				$("#editclass").val("<?php echo $row['class']; ?>");
				$("#edithp").val("<?php echo $row['hp']; ?>");
				$("#editmaxhp").val("<?php echo $row['maxhp']; ?>");
				$("#editac").val("<?php echo $row['ac']; ?>");
				$("#editfort").val("<?php echo $row['fortitude']; ?>");
				$("#editreflex").val("<?php echo $row['reflex']; ?>");
				$("#editwill").val("<?php echo $row['will']; ?>");
				$("#editexp").val("<?php echo $row['exp']; ?>");
				$("#edittemphp").val("<?php echo $row['temphp']; ?>");
				$("#editap").val("<?php echo $row['ap']; ?>");
				$("#editspeed").val("<?php echo $row['speed']; ?>");
				$("#editinit").val("<?php echo $row['initiative']; ?>");
				$("#editvision").val("<?php echo $row['vision']; ?>");
				$("#editstr").val("<?php echo $row['str']; ?>");
				$("#editstrMod").val("<?php echo $row['strMod']; ?>");
				$("#editcon").val("<?php echo $row['con']; ?>");
				$("#editconMod").val("<?php echo $row['conMod']; ?>");
				$("#editdex").val("<?php echo $row['dex']; ?>");
				$("#editdexMod").val("<?php echo $row['dexMod']; ?>");
				$("#editint").val("<?php echo $row['int']; ?>");
				$("#editintMod").val("<?php echo $row['intMod']; ?>");
				$("#editwis").val("<?php echo $row['wis']; ?>");
				$("#editwisMod").val("<?php echo $row['wisMod']; ?>");
				$("#editcha").val("<?php echo $row['cha']; ?>");
				$("#editchaMod").val("<?php echo $row['chaMod']; ?>");
				$("#inventoryList").html("");
				dnd.inventory = new Array();
	<?php
	$invresult = mysql_query("SELECT * FROM inventory WHERE charid='" . $row['id'] . "'") or die(mysql_error());
	?>

	<?php
	while ($invrow = mysql_fetch_array($invresult)) {
		?>
					$("#inventoryList").append("<input type=\"text\" id=\"invName<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['name']; ?>\" >&nbsp;");
					$("#inventoryList").append("<input type=\"text\" id=\"invDesc<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['desc']; ?>\" >&nbsp;");
					$("#inventoryList").append("<input type=\"text\" id=\"invQuantity<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['qty']; ?>\" ><br />");

					dnd.inventory.push({
						"id": "<?php echo $invrow['id']; ?>",
						"name": "<?php echo $invrow['name']; ?>",
						"desc": "<?php echo $invrow['desc']; ?>",
						"quantity": "<?php echo $invrow['quantity']; ?>"
					});
		<?php
	}
	?>
			});
		</script>
		<?php
	}
	?>
</table>