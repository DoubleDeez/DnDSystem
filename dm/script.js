var dnd = {
	inventory: new Array(),
	init: function() {
		$("#addChar").hide();
		$("#editChar").hide();
		$("#addEnemies").hide();
		$("#editEnemies").hide();
		$("#infoBtn").click(function() {
			$("#info").show();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
		});
		$("#addCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").show();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
		});
		$("#editCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").show();
			$("#editCharList").load("calls/charList.php");
			$("#addEnemies").hide();
			$("#editEnemies").hide();
		});
		$("#addEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").show();
			$("#editEnemies").hide();
		});
		$("#editEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").show();
			$("#editEnemyList").load("calls/enemyList.php");
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
		$("#addEnemyAction").click(function() {
			var dataD = {
				name: $("#addEname").val(),
				type: $("#addEtype").val(),
				hp: $("#addEmaxhp").val(),
				hide: $("#addEhide").is(":checked"),
				mask: $("#addEmaskDmg").is(":checked")
			};
			$("#addEnemyAction").attr("disabled", "disabled");
			$.post("calls/addEnemy.php", JSON.stringify(dataD), function(data, status) {
				alert(data);
				$("#addEnemyAction").removeAttr("disabled");
			});
		});
		$("#editEnemyAction").click(function() {
			var dataD = {
				id: $("#editEid").val(),
				name: $("#editEname").val(),
				type: $("#editEtype").val(),
				maxhp: $("#editEmaxhp").val(),
				hp: $("#editEhp").val(),
				hide: $("#editEhide").is(":checked"),
				mask: $("#editEmaskDmg").is(":checked"),
				disable: $("#editEdisable").is(":checked")
			};
			$("#editEnemyAction").attr("disabled", "disabled");
			$.post("calls/editEnemy.php", JSON.stringify(dataD), function(data, status) {
				$("#editEnemyList").load("calls/enemyList.php");
				
				alert(data);
				$("#editEnemyAction").removeAttr("disabled");
			});
		});
	}
};