var dnd = {
	inventory: new Array(),
	feats: new Array(),
	actions: new Array(),
	init: function() {
		$("#info").load("pages/info.php", function() {
			$("#info").show();
		});
		$("#addChar").hide();
		$("#editChar").hide();
		$("#addEnemies").hide();
		$("#editEnemies").hide();
		$("#userList").hide();
		$("#dmTools").hide();
		$("#infoBtn").click(function() {
			$("#info").load("pages/info.php", function() {
				$("#info").show();
			});
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#addCharBtn").click(function() {
			$("#info").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
			$("#addChar").load("pages/addChar.php?id=" + id + "&r=" + rank, function() {
				$("#addChar").show();

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
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#addCharAction").removeAttr("disabled");
					});
				});
			});
		});
		$("#editCharBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").load("pages/editChar.php", function() {
				$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
					$("#editChar").show();
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
							actemp: $("#editactemp").val(),
							forttemp: $("#editforttemp").val(),
							willtemp: $("#editwilltemp").val(),
							reflextemp: $("#editreflextemp").val(),
							exp: $("#editexp").val(),
							maxweight: $("#editmaxweight").val(),
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
							languages: $("#editlanguages").val(),
							vul: $("#editvul").val(),
							resist: $("#editresist").val(),
							align: $("#editalign").val(),
							diet: $("#editdiet").val(),
							avatar: $("#editavatar").val(),
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
						$("#editCharAction").attr("disabled", "disabled");
						$.post("calls/editChar.php", JSON.stringify(dataD), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#editid").val()).trigger("click");
							});
							$("#editCharMessage").html(data);
							$("#editCharMessage").fadeOut(0);
							$("#editCharMessage").fadeIn();
							window.setTimeout(function() {
								$("#editCharMessage").fadeOut(null, function() {
									$("#editCharMessage").html("");
									$("#editCharMessage").fadeIn();
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
							qty: $("#invAddQty").val(),
							weight: $("#invAddWeight").val()
						};
						$("#addInvAction").attr("disabled", "disabled");
						$.post("calls/addInv.php", JSON.stringify(dataD), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#invAddCharID").val()).trigger("click");
							});

							$("#addInvMessage").html(data);
							$("#addInvMessage").fadeOut(0);
							$("#addInvMessage").fadeIn();
							window.setTimeout(function() {
								$("#addInvMessage").fadeOut(null, function() {
									$("#addInvMessage").html("");
									$("#addInvMessage").fadeIn();
								});
							}, 10000);
							$("#addInvAction").removeAttr("disabled");
						});
					});
					$("#addFeatAction").click(function() {
						var dataD = {
							charID: $("#featAddCharID").val(),
							name: $("#featAddName").val(),
							desc: $("#featAddDesc").val()
						};
						$("#addFeatAction").attr("disabled", "disabled");
						$.post("calls/addFeat.php", JSON.stringify(dataD), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#featAddCharID").val()).trigger("click");
							});

							$("#addFeatMessage").html(data);
							$("#addFeatMessage").fadeOut(0);
							$("#addFeatMessage").fadeIn();
							window.setTimeout(function() {
								$("#addFeatMessage").fadeOut(null, function() {
									$("#addFeatMessage").html("");
									$("#addFeatMessage").fadeIn();
								});
							}, 10000);
							$("#addFeatAction").removeAttr("disabled");
						});
					});
					$("#editInvAction").click(function() {
						for (var i = 0; i < dnd.inventory.length; i++) {
							var item = dnd.inventory[i];
							item.name = $("#invName" + item.id).val();
							item.desc = $("#invDesc" + item.id).val();
							item.quantity = $("#invQuantity" + item.id).val();
							item.weight = $("#invWeight" + item.id).val();
							dnd.inventory[i] = item;
						}
						$("#editInvAction").attr("disabled", "disabled");
						$.post("calls/editInv.php", JSON.stringify(dnd.inventory), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#invAddCharID").val()).trigger("click");
							});

							$("#editInvMessage").html(data);
							$("#editInvMessage").fadeOut(0);
							$("#editInvMessage").fadeIn();
							window.setTimeout(function() {
								$("#editInvMessage").fadeOut(null, function() {
									$("#editInvMessage").html("");
									$("#editInvMessage").fadeIn();
								});
							}, 10000);
							$("#editInvAction").removeAttr("disabled");
						});
					});
					$("#editFeatAction").click(function() {
						for (var i = 0; i < dnd.feats.length; i++) {
							var feat = dnd.feats[i];
							feat.name = $("#featName" + feat.id).val();
							feat.desc = $("#featDesc" + feat.id).val();
							dnd.feats[i] = feat;
						}
						$("#editFeatAction").attr("disabled", "disabled");
						$.post("calls/editFeat.php", JSON.stringify(dnd.feats), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#featAddCharID").val()).trigger("click");
							});

							$("#editFeatMessage").html(data);
							$("#editFeatMessage").fadeOut(0);
							$("#editFeatMessage").fadeIn();
							window.setTimeout(function() {
								$("#editFeatMessage").fadeOut(null, function() {
									$("#editFeatMessage").html("");
									$("#editFeatMessage").fadeIn();
								});
							}, 10000);
							$("#editFeatAction").removeAttr("disabled");
						});
					});
					$("#addActionAction").click(function() {
						var dataD = {
							id: $("#actionAddCharID").val(),
							name: $("#actionAddName").val(),
							type: $("#actionAddType").val(),
							desc: $("#actionAddDesc").val(),
							freq: $("#actionAddFrequency").val(),
							power: $("#actionAddPower").val(),
							class: $("#actionAddClass").val(),
							range: $("#actionAddRange").val(),
							target: $("#actionAddTarget").val(),
							hit: $("#actionAddHit").val(),
							miss: $("#actionAddMiss").val(),
							attack: $("#actionAddAttack").val(),
							special: $("#actionAddSpecial").val()
						};
						$("#addActionAction").attr("disabled", "disabled");
						$.post("calls/addAction.php", JSON.stringify(dataD), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#actionAddCharID").val()).trigger("click");
							});
							$("#addActionMessage").html(data);
							$("#addActionMessage").fadeOut(0);
							$("#addActionMessage").fadeIn();
							window.setTimeout(function() {
								$("#addActionMessage").fadeOut(null, function() {
									$("#addActionMessage").html("");
									$("#addActionMessage").fadeIn();
								});
							}, 10000);
							$("#addActionAction").removeAttr("disabled");
						});
					});
					$("#editActionAction").click(function() {
						for (var i = 0; i < dnd.actions.length; i++) {
							var action = dnd.actions[i];
							action.name = $("#actionName" + action.id).val();
							action.desc = $("#actionDesc" + action.id).val();
							action.freq = $("#actionFreq" + action.id).val();
							action.power = $("#actionPower" + action.id).val();
							action.type = $("#actionType" + action.id).val();
							action.class = $("#actionClass" + action.id).val();
							action.range = $("#actionRange" + action.id).val();
							action.target = $("#actionTarget" + action.id).val();
							action.hit = $("#actionHit" + action.id).val();
							action.miss = $("#actionMiss" + action.id).val();
							action.attack = $("#actionAttack" + action.id).val();
							action.special = $("#actionSpecial" + action.id).val();
							dnd.actions[i] = action;
						}
						$("#editActionAction").attr("disabled", "disabled");
						$.post("calls/editAction.php", JSON.stringify(dnd.actions), function(data, status) {
							$("#editCharList").load("calls/charList.php?id=" + id + "&r=" + rank, function() {
								$("#edit" + $("#actionAddCharID").val()).trigger("click");
							});

							$("#editActionMessage").html(data);
							$("#editActionMessage").fadeOut(0);
							$("#editActionMessage").fadeIn();
							window.setTimeout(function() {
								$("#editActionMessage").fadeOut(null, function() {
									$("#editActionMessage").html("");
									$("#editActionMessage").fadeIn();
								});
							}, 10000);
							$("#editActionAction").removeAttr("disabled");
						});
					});
					$(".editChar").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#editCharAction').trigger('click');
						}
					});
					$(".addInv").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#addInvAction').trigger('click');
						}
					});
					$(".addFeat").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#addFeatAction').trigger('click');
						}
					});
					$(".addAction").keydown(function(e) {
						if (e.keyCode === 13) {
							$('#addActionAction').trigger('click');
						}
					});
					$("#editChar").keydown(function(e) {
						if ($("#editid").val() === "0") {
							alert("Click edit to load a character first!");
						}
					});
				});
			});
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#addEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").hide();
			$("#addEnemies").load("pages/addEnemies.php", function() {
				$("#addEnemies").show();
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
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#addEnemyAction").removeAttr("disabled");
					});
				});
			});
		});
		$("#editEnemiesBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").load("pages/editEnemies.php", function() {
				$("#editEnemyList").load("calls/enemyList.php", function() {
					$("#editEnemies").show();
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
							$("#message").fadeOut(0);
							$("#message").fadeIn();
							window.setTimeout(function() {
								$("#message").fadeOut(null, function() {
									$("#message").html("");
									$("#message").fadeIn();
								});
							}, 10000);
							$("#editEnemyAction").removeAttr("disabled");
						});
					});
				});
			});
			$("#userList").hide();
			$("#dmTools").hide();
		});
		$("#userListBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#dmTools").hide();
			$("#userList").load("pages/userList.php", function() {
				$("#userListTable").load("calls/userList.php", function() {
					$("#userList").show();
					$("#addUserAction").click(function() {
						var dataD = {
							name: $("#username").val(),
							rank: $("#userrank").val(),
							pass: $("#userpass").val(),
							pass2: $("#userpass2").val()
						};
						$("#addUserAction").attr("disabled", "disabled");
						$.post("calls/addUser.php", JSON.stringify(dataD), function(data, status) {
							$("#message").html(data);
							$("#userListTable").load("calls/userList.php");
							$("#message").fadeOut(0);
							$("#message").fadeIn();
							window.setTimeout(function() {
								$("#message").fadeOut(null, function() {
									$("#message").html("");
									$("#message").fadeIn();
								});
							}, 10000);
							$("#addUserAction").removeAttr("disabled");
						});
					});
				});
			});
		});
		$("#dmToolsBtn").click(function() {
			$("#info").hide();
			$("#addChar").hide();
			$("#editChar").hide();
			$("#addEnemies").hide();
			$("#editEnemies").hide();
			$("#userList").hide();
			$("#dmTools").load("pages/dmTools.php", function() {
				$("#dmTools").show();
				$("#dmEXPAction").click(function() {
					var dataD = {
						exp: $("#dmEXP").val()
					};
					$("#dmEXPActioon").attr("disabled", "disabled");
					$.post("calls/addEXP.php", JSON.stringify(dataD), function(data, status) {
						$("#message").html(data);
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#dmEXPAction").removeAttr("disabled");
					});
				});
				$("#dmInitAction").click(function() {
					$("#dmInitAction").attr("disabled", "disabled");
					$.post("calls/resetInit.php", null, function(data, status) {
						$("#message").html(data);
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#dmInitAction").removeAttr("disabled");
					});
				});
				$("#dmOwnerAction").click(function() {
					var dataD = {
						ownerid: $("#dmOwner").val(),
						charid: $("#dmChar").val()
					};
					$("#dmOwnerAction").attr("disabled", "disabled");
					$.post("calls/changeOwner.php", JSON.stringify(dataD), function(data, status) {
						$("#message").html(data);
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#dmOwnerAction").removeAttr("disabled");
					});
				});
				$("#dmSetTime").click(function() {
					var dataD = {
						hour: $("#dmSetHour").val(),
						min: $("#dmSetMin").val(),
						sec: $("#dmSetSec").val()
					};
					$("#dmSetTime").attr("disabled", "disabled");
					$.post("calls/setTime.php", JSON.stringify(dataD), function(data, status) {
						$("#message").html(data);
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						$("#dmToolsBtn").trigger("click");
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#dmSetTime").removeAttr("disabled");
					});
				});
				$("#dmAddTime").click(function() {
					var dataD = {
						hour: $("#dmAddHour").val(),
						min: $("#dmAddMin").val(),
						sec: $("#dmAddSec").val()
					};
					$("#dmAddTime").attr("disabled", "disabled");
					$.post("calls/addTime.php", JSON.stringify(dataD), function(data, status) {
						$("#message").html(data);
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						$("#dmToolsBtn").trigger("click");
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#dmAddTime").removeAttr("disabled");
					});
				});
				$("#dmSettings").click(function() {
					var dataD = {
						init: $("#dmInit").is(":checked")
					};
					$("#dmSettings").attr("disabled", "disabled");
					$.post("calls/dmSettings.php", JSON.stringify(dataD), function(data, status) {
						$("#message").html(data);
						$("#message").fadeOut(0);
						$("#message").fadeIn();
						$("#dmToolsBtn").trigger("click");
						window.setTimeout(function() {
							$("#message").fadeOut(null, function() {
								$("#message").html("");
								$("#message").fadeIn();
							});
						}, 10000);
						$("#dmSettings").removeAttr("disabled");
					});
				});
			});
		});
		$("#logoutBtn").click(function() {
			window.location.replace("logout.php");
		});
	}
};