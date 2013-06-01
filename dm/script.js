var dnd = {
	inventory: new Array(),
	init: function() {
		$("#addChar").hide();
		$("#editChar").hide();
		$("#manageEnemies").hide();
		$("#infoBtn").click(function() {
			$("#info").show();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#manageEnemies").hide();
		});
		$("#addCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").show();
			$("#editChar").hide();
			$("#manageEnemies").hide();
		});
		$("#editCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").show();
			$("#editCharList").load("calls/charList.php");
			$("#manageEnemies").hide();
		});
		$("#manageEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#manageEnemies").show();
		});
		$("#logoutBtn").click(function() {
			window.location.replace("logout.php");
		});
		$("#addCharAction").click(function() {
			var dataD = {
				name: $("#name").val(),
				class: $("#class").val(),
				hp: $("#maxhp").val(),
				ac: $("#ac").val(),
				fort: $("#fort").val(),
				will: $("#will").val(),
				reflex: $("#reflex").val()
			};
			$("#addCharAction").attr("disabled", "disabled");
			$.post("calls/addChar.php", JSON.stringify(dataD), function(data, status) {
				alert(data);
				$("#addCharAction").removeAttr("disabled");
			});
		});
		$("#editCharAction").click(function() {
			var dataD = {
				id: $("#editid").val(),
				name: $("#editname").val(),
				class: $("#editclass").val(),
				maxhp: $("#editmaxhp").val(),
				hp: $("#edithp").val(),
				ac: $("#editac").val(),
				fort: $("#editfort").val(),
				will: $("#editwill").val(),
				reflex: $("#editreflex").val(),
				exp: $("#editexp").val()
			};
			for (var i = 0; i < dnd.inventory.length; i++) {
				var item = dnd.inventory[i];
				item.name = $("#invName"+item.id).val();
				item.desc = $("#invDesc"+item.id).val();
				item.quantity = $("#invQuantity"+item.id).val();
				dnd.inventory[i] = item;
			}
			$("#editCharAction").attr("disabled", "disabled");
			$.post("calls/editChar.php", JSON.stringify(dataD), function(data, status) {
				$("#editCharList").load("calls/charList.php");
				alert(data);
				$("#editCharAction").removeAttr("disabled");
			});
		});
		$("#addInvAction").click(function() {
			var dataD = {
				charID: $("#invAddCharID").val(),
				name: $("#invAddName").val(),
				desc: $("#invAddDesc").val(),
				qty: $("#invAddQty").val()
			};
			$("#addInvAction").attr("disabled", "disabled");
			$.post("calls/addInv.php", JSON.stringify(dataD), function(data, status) {
				$("#editCharList").load("calls/charList.php", function() {
					$("#edit" + $("#invAddCharID").val()).trigger("click");
				});
				
				alert(data);
				$("#addInvAction").removeAttr("disabled");
			});
		});
		$("#editInvAction").click(function() {
			for (var i = 0; i < dnd.inventory.length; i++) {
				var item = dnd.inventory[i];
				item.name = $("#invName"+item.id).val();
				item.desc = $("#invDesc"+item.id).val();
				item.quantity = $("#invQuantity"+item.id).val();
				dnd.inventory[i] = item;
			}
			$("#editInvAction").attr("disabled", "disabled");
			$.post("calls/editInv.php", JSON.stringify(dnd.inventory), function(data, status) {
				$("#editCharList").load("calls/charList.php", function() {
					$("#edit" + $("#invAddCharID").val()).trigger("click");
				});
				
				alert(data);
				$("#editInvAction").removeAttr("disabled");
			});
		});
	}
};