<?php
include("../../include/vars.php");
include("../../include/funcs.php");

mysql_connect("$host", "$user", "$pass") or die(mysql_error());
mysql_select_db("$db") or die(mysql_error());
if ($_GET['r'] >= 10) {
	$result = mysql_query("SELECT * FROM characters") or die(mysql_error());
} else {
	$result = mysql_query("SELECT * FROM characters WHERE userid='" . $_GET['id'] . "'") or die(mysql_error());
}
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
		<th>Status</th>
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
		echo "<tr style=\"border-width: 1px; border-style: solid; text-align: left; background-color:" . $rowColour . ";\"><td>";
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
		echo ($row['disable'] == 0) ? "Active" : "Excluded";
		echo "</td><td>";
		echo "<a href=\"#\" id=\"edit" . $row['id'] . "\">Edit</a>";
		echo "</td></tr>";
		?>
		<script>
			$("#edit<?php echo $row['id']; ?>").click(function() {
				var newAction = "";
				
				$("#editid").val("<?php echo $row['id']; ?>");
				$("#invAddCharID").val("<?php echo $row['id']; ?>");
				$("#featAddCharID").val("<?php echo $row['id']; ?>");
				$("#actionAddCharID").val("<?php echo $row['id']; ?>");
				$("#editname").val("<?php echo $row['name']; ?>");
				$("#editclass").val("<?php echo $row['class']; ?>");
				$("#edithp").val("<?php echo $row['hp']; ?>");
				$("#editmaxhp").val("<?php echo $row['maxhp']; ?>");
				$("#editac").val("<?php echo $row['ac']; ?>");
				$("#editfort").val("<?php echo $row['fortitude']; ?>");
				$("#editreflex").val("<?php echo $row['reflex']; ?>");
				$("#editwill").val("<?php echo $row['will']; ?>");
				$("#editexp").val("<?php echo $row['exp']; ?>");
				$("#editmaxweight").val("<?php echo $row['maxweight']; ?>");
				$("#edittemphp").val("<?php echo $row['temphp']; ?>");
				$("#editap").val("<?php echo $row['ap']; ?>");
				$("#editspeed").val("<?php echo $row['speed']; ?>");
				$("#editinit").val("<?php echo $row['initiative']; ?>");
				$("#editinitroll").val("<?php echo $row['initroll']; ?>");
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
				$("#editlanguages").val("<?php echo $row['languages']; ?>");
				$("#editvul").val("<?php echo $row['vulnerable']; ?>");
				$("#editresist").val("<?php echo $row['resist']; ?>");
				$("#editdiet").val("<?php echo $row['diety']; ?>");
				$("#editalign").val("<?php echo $row['alignment']; ?>");
				$("#editacr").val("<?php echo $row['acr']; ?>");
				$("#editarc").val("<?php echo $row['arc']; ?>");
				$("#editath").val("<?php echo $row['ath']; ?>");
				$("#editblu").val("<?php echo $row['blu']; ?>");
				$("#editdip").val("<?php echo $row['dip']; ?>");
				$("#editdun").val("<?php echo $row['dun']; ?>");
				$("#editend").val("<?php echo $row['end']; ?>");
				$("#edithea").val("<?php echo $row['hea']; ?>");
				$("#edithis").val("<?php echo $row['his']; ?>");
				$("#editins").val("<?php echo $row['ins']; ?>");
				$("#edititd").val("<?php echo $row['itd']; ?>");
				$("#editnat").val("<?php echo $row['nat']; ?>");
				$("#editper").val("<?php echo $row['per']; ?>");
				$("#editrel").val("<?php echo $row['rel']; ?>");
				$("#editste").val("<?php echo $row['ste']; ?>");
				$("#editstw").val("<?php echo $row['stw']; ?>");
				$("#editthi").val("<?php echo $row['thi']; ?>");
				$("#edithsval").val("<?php echo $row['hsval']; ?>");
				$("#edithsdaily").val("<?php echo $row['hsdaily']; ?>");
				$("#edithsleft").val("<?php echo $row['hsleft']; ?>");
				$("#edithswind").prop("checked", <?php echo ($row['hswind'] == 1) ? "true" : "false"; ?>);
				$("#editdisable").prop("checked", <?php echo ($row['disable'] == 1) ? "true" : "false"; ?>);
				$("#inventoryList").html("");
				$("#featList").html("");
				$("#actionList").html("");
				dnd.inventory = new Array();
				dnd.feats = new Array();
				dnd.actions = new Array();
	<?php
	$invresult = mysql_query("SELECT * FROM inventory WHERE charid='" . $row['id'] . "'") or die(mysql_error());
	while ($invrow = mysql_fetch_array($invresult)) {
		?>
					$("#inventoryList").append("<input type=\"text\" class=\"editInv\" id=\"invName<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['name']; ?>\" >&nbsp;");
					$("#inventoryList").append("<input type=\"text\" class=\"editInv\" id=\"invDesc<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['desc']; ?>\" >&nbsp;");
					$("#inventoryList").append("<input type=\"text\" class=\"editInv\" id=\"invQuantity<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['qty']; ?>\" >&nbsp;");
					$("#inventoryList").append("<input type=\"text\" class=\"editInv\" id=\"invWeight<?php echo $invrow['id']; ?>\" value=\"<?php echo $invrow['weight']; ?>\" ><br />");

					dnd.inventory.push({
						"id": "<?php echo $invrow['id']; ?>",
						"name": "<?php echo $invrow['name']; ?>",
						"desc": "<?php echo $invrow['desc']; ?>",
						"quantity": "<?php echo $invrow['quantity']; ?>",
						"weight": "<?php echo $invrow['weight']; ?>"
					});
					$(".editInv").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#editInvAction').trigger('click');
						}
					});
		<?php
	}
	$featresult = mysql_query("SELECT * FROM feats WHERE charid='" . $row['id'] . "'") or die(mysql_error());
	while ($featrow = mysql_fetch_array($featresult)) {
		?>
					$("#featList").append("<input type=\"text\" class=\"editFeat\" id=\"featName<?php echo $featrow['id']; ?>\" value=\"<?php echo $featrow['name']; ?>\" >&nbsp;");
					$("#featList").append("<input type=\"text\" class=\"editFeat\" id=\"featDesc<?php echo $featrow['id']; ?>\" value=\"<?php echo $featrow['description']; ?>\" ><br />");

					dnd.feats.push({
						"id": "<?php echo $featrow['id']; ?>",
						"name": "<?php echo $featrow['name']; ?>",
						"desc": "<?php echo $featrow['description']; ?>"
					});
					$(".editFeat").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#editFeatAction').trigger('click');
						}
					});
		<?php
	}

	$actionresult = mysql_query("SELECT * FROM actions WHERE charid='" . $row['id'] . "'") or die(mysql_error());
	$actionNum = 0;
	while ($actionrow = mysql_fetch_array($actionresult)) {
		$actionMod = $actionNum % 3;
		?>
					var newActionTop = "";
					var newActionBot = "";
					var typeSel0 = "";
					var typeSel1 = "";
					var typeSel2 = "";
					var typeSel3 = "";
					var typeSel4 = "";
					var freqSel0 = "";
					var freqSel1 = "";
					var freqSel2 = "";
					switch (<?php echo $actionMod; ?>) {
						case 0:
							newActionTop = "<tr><td>";
							break;
						case 1:
							newActionTop = "<td>";
							break;
						case 2:
							newActionTop = "<td>";
							break;
					}

					switch (<?php echo $actionMod; ?>) {
						case 0:
							newActionBot = "</td>";
							break;
						case 1:
							newActionBot = "</td>";
							break;
						case 2:
							newActionBot = "</td></tr>";
							break;
					}

					switch (<?php echo $actionrow['actiontype']; ?>) {
						case 0:
							typeSel0 = "selected='selected'";
							break;
						case 1:
							typeSel1 = "selected='selected'";
							break;
						case 2:
							typeSel2 = "selected='selected'";
							break;
						case 3:
							typeSel3 = "selected='selected'";
							break;
						case 4:
							typeSel4 = "selected='selected'";
							break;
					}

					switch (<?php echo $actionrow['frequency']; ?>) {
						case 0:
							freqSel0 = "selected='selected'";
							break;
						case 1:
							freqSel1 = "selected='selected'";
							break;
						case 2:
							freqSel2 = "selected='selected'";
							break;
					}

					newAction = newAction + (newActionTop + "<div style=\"float:left;\"><label for=\"actionName<?php echo $actionrow['id']; ?>\">Name:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionName<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['name']; ?>\" >&nbsp;</div><div style=\"float:right;\"><label for=\"actionDesc<?php echo $actionrow['id']; ?>\">Description:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionDesc<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['description']; ?>\" >&nbsp;</div><br style=\"clear: both;\" /><div style=\"float:left;\"><label for=\"actionFreq<?php echo $actionrow['id']; ?>\">Frequency:</label><br/><select id=\"actionFreq<?php echo $actionrow['id']; ?>\" class=\"addAction\"><option value=\"0\" "+freqSel0+">At-Will</option><option value=\"1\" "+freqSel1+">Encounter</option><option value=\"2\" "+freqSel2+">Daily</option></select>&nbsp;</div><div style=\"float:right;\"><label for=\"actionPower<?php echo $actionrow['id']; ?>\">Action Keywords:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionPower<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['power']; ?>\" >&nbsp;</div><br style=\"clear: both;\" /><div style=\"float:left;\"><label for=\"actionType<?php echo $actionrow['id']; ?>\">Action Type:</label><br/><select id=\"actionType<?php echo $actionrow['id']; ?>\" class=\"addAction\"><option value=\"0\" "+typeSel0+">Standard</option><option value=\"1\" "+typeSel1+">Minor</option><option value=\"2\" "+typeSel2+">Move</option><option value=\"3\" "+typeSel3+">Free</option><option value=\"4\" "+typeSel4+">Interrupt</option></select>&nbsp;</div><div style=\"float:right;\"><label for=\"actionClass<?php echo $actionrow['id']; ?>\">Level and Class:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionClass<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['actionclass']; ?>\" >&nbsp;</div><br style=\"clear: both;\" /><div style=\"float:left;\"><label for=\"actionRange<?php echo $actionrow['id']; ?>\">Action Range:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionRange<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['rangetype']; ?>\" >&nbsp;</div><div style=\"float:right;\"><label for=\"actionTarget<?php echo $actionrow['id']; ?>\">Target:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionTarget<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['target']; ?>\" >&nbsp;</div><br style=\"clear: both;\" /><div style=\"float:left;\"><label for=\"actionHit<?php echo $actionrow['id']; ?>\">Hit / Effect:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionHit<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['hit']; ?>\" >&nbsp;</div><div style=\"float:right;\"><label for=\"actionMiss<?php echo $actionrow['id']; ?>\">Miss:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionMiss<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['miss']; ?>\" >&nbsp;</div><br style=\"clear: both;\" /><div style=\"float:left;\"><label for=\"actionAttack<?php echo $actionrow['id']; ?>\">Attack:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionAttack<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['attack']; ?>\" >&nbsp;</div><div style=\"float:right;\"><label for=\"actionSpecial<?php echo $actionrow['id']; ?>\">Special:</label><br/><input type=\"text\" class=\"editAction\" id=\"actionSpecial<?php echo $actionrow['id']; ?>\" value=\"<?php echo $actionrow['special']; ?>\" >&nbsp;</div><br style=\"clear:both;\" />" + newActionBot);
					
					dnd.actions.push({
						"id": "<?php echo $actionrow['id']; ?>",
						"name": "<?php echo $actionrow['name']; ?>",
						"desc": "<?php echo $actionrow['description']; ?>",
						"freq": "<?php echo $actionrow['frequency']; ?>",
						"power": "<?php echo $actionrow['power']; ?>",
						"type": "<?php echo $actionrow['actiontype']; ?>",
						"class": "<?php echo $actionrow['actionclass']; ?>",
						"range": "<?php echo $actionrow['rangetype']; ?>",
						"target": "<?php echo $actionrow['target']; ?>",
						"hit": "<?php echo $actionrow['hit']; ?>",
						"miss": "<?php echo $actionrow['miss']; ?>",
						"attack": "<?php echo $actionrow['attack']; ?>",
						"special": "<?php echo $actionrow['special']; ?>",
						"charid": "<?php echo $actionrow['charid']; ?>"
					});

		<?php
		$actionNum++;
	}
	?>
				if ("<?php echo $actionMod; ?>" != "2") {
					newAction = newAction + "</tr>";
				}

				$("#actionList").append(newAction);
					
					$(".editAction").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#editActionAction').trigger('click');
						}
					});
			});
		</script>
		<?php
	}
	?>
</table>