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
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#addCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").show();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#editCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").show();
			$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank);
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#addEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").show();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#editEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").show();
			$("#editEnemyList").load("calls/enemyList.php");
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#userListBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").show();
			$("#dmTools").hide();
			$("#userList").load("calls/userList.php");
		});
		$("#dmToolsBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").show();
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
				reflex: $("#reflex").val(),
				userid: $("#userid").val()
			};
			$("#addCharAction").attr("disabled", "disabled");
			$.post("calls/addChar.php", JSON.stringify(dataD), function(data, status) {
				$("#message").html(data);
				window.setTimeout(function() {
					$("#message").fadeOut(null, function() {
						$("#message").html("");
						$("#message").fadeIn();
					});
				}, 10000);
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
				exp: $("#editexp").val(),
				speed: $("#editspeed").val(),
				temphp: $("#edittemphp").val(),
				vision: $("#editvision").val(),
				ap: $("#editap").val(),
				initiative: $("#editinit").val(),
				initroll: $("#editinitroll").val(),
				str: $("#editstr").val(),
				strMod: $("#editstrMod").val(),
				con: $("#editcon").val(),
				conMod: $("#editconMod").val(),
				dex: $("#editdex").val(),
				dexMod: $("#editdexMod").val(),
				int: $("#editint").val(),
				intMod: $("#editintMod").val(),
				wis: $("#editwis").val(),
				wisMod: $("#editwisMod").val(),
				cha: $("#editcha").val(),
				chaMod: $("#editchaMod").val(),
				acr: $("#editacr").val(),
				arc: $("#editarc").val(),
				ath: $("#editath").val(),
				blu: $("#editblu").val(),
				dip: $("#editdip").val(),
				dun: $("#editdun").val(),
				end: $("#editend").val(),
				hea: $("#edithea").val(),
				his: $("#edithis").val(),
				ins: $("#editins").val(),
				itd: $("#edititd").val(),
				nat: $("#editnat").val(),
				per: $("#editper").val(),
				rel: $("#editrel").val(),
				ste: $("#editste").val(),
				stw: $("#editstw").val(),
				thi: $("#editthi").val(),
				hsval: $("#edithsval").val(),
				hsdaily: $("#edithsdaily").val(),
				hsleft: $("#edithsleft").val(),
				hswind: $("#edithswind").is(":checked"),
				disable: $("#editdisable").is(":checked")
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
				$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank);
				$("#message").html(data);
				window.setTimeout(function() {
					$("#message").fadeOut(null, function() {
						$("#message").html("");
						$("#message").fadeIn();
					});
				}, 10000);
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
				$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
					$("#edit" + $("#invAddCharID").val()).trigger("click");
				});
				
				$("#message").html(data);
				window.setTimeout(function() {
					$("#message").fadeOut(null, function() {
						$("#message").html("");
						$("#message").fadeIn();
					});
				}, 10000);
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
				$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
					$("#edit" + $("#invAddCharID").val()).trigger("click");
				});
				
				$("#message").html(data);
				window.setTimeout(function() {
					$("#message").fadeOut(null, function() {
						$("#message").html("");
						$("#message").fadeIn();
					});
				}, 10000);
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
				
				$("#message").html(data);
				window.setTimeout(function() {
					$("#message").fadeOut(null, function() {
						$("#message").html("");
						$("#message").fadeIn();
					});
				}, 10000);
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
				initroll: $("#editEinitroll").val(),
				temphp: $("#editEtemphp").val(),
				hide: $("#editEhide").is(":checked"),
				mask: $("#editEmaskDmg").is(":checked"),
				disable: $("#editEdisable").is(":checked")
			};
			
			$("#editEnemyAction").attr("disabled", "disabled");
			$.post("calls/editEnemy.php", JSON.stringify(dataD), function(data, status) {
				$("#editEnemyList").load("calls/enemyList.php");
				
				$("#message").html(data);
				window.setTimeout(function() {
					$("#message").fadeOut(null, function() {
						$("#message").html("");
						$("#message").fadeIn();
					});
				}, 10000);
				$("#editEnemyAction").removeAttr("disabled");
			});
		});
	}
};