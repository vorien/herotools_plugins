var dc = [];
dc['body'] = {'start': 0, 'remaining': 0, 'status': 'normal'};
dc['stun'] = {'start': 0, 'remaining': 0, 'status': 'normal'};
dc['end'] = {'start': 0, 'remaining': 0, 'status': 'normal'};
dc['recovery'] = 0;
dc['con'] = 0;
dc['armor'] = {'rpd': 0, 'red': 0};
dc['character'] = {'npd': 0, 'ned': 0, 'rpd': 0, 'red': 0};
dc['location'] = 0;
dc['calc'] = {'body': 0, 'stun': 0, 'type': 0, 'effect': 0};
dc['damage'] = {'body': 0, 'stun': 0};

function setDCBaseValues() {
	dc.body.start = getParseOrZero($("#dcalc-bodystart").html());
	dc.body.remaining = getParseOrZero($("#dcalc-bodyremaining").html());
	dc.stun.start = getParseOrZero($("#dcalc-stunstart").html());
	dc.stun.remaining = getParseOrZero($("#dcalc-stunremaining").html());
	dc.end.start = getParseOrZero($("#dcalc-endstart").html());
	dc.end.remaining = getParseOrZero($("#dcalc-endremaining").html());
	dc.recovery = getParseOrZero($("#dcalc-recovery").html());
	dc.con = getParseOrZero($("#dcalc-con").html());
}

function setDCCharacterValues() {
	dc.character.npd = getParseOrZero(character.n_pd);
	dc.character.ned = getParseOrZero(character.n_ed);
	dc.character.rpd = getParseOrZero(character.r_pd);
	dc.character.red = getParseOrZero(character.r_ed);
}

function setDCArmorValues() {
	dc.location = getParseOrZero($("#dcalc-location").val());
	dc.armor.rpd = getParseOrZero(armor[dc.location]['r_pd']);
	dc.armor.red = getParseOrZero(armor[dc.location]['r_ed']);
}

function setAllDCValues() {
	setDCBaseValues();
	setDCCharacterValues();
	setDCArmorValues();
}

function setDCDamageValues() {
	dc.damage.body = getParseOrZero($("#dcalc-bodytaken").html());
	dc.damage.stun = getParseOrZero($("#dcalc-stuntaken").html());
	dc.damage.end = getParseOrZero($(".end-current").html());
}

function updateStatDisplays() {
//		setDCBaseValues();
	$("#dcalc-bodyremaining").html(dc.body.remaining);
	$("#dcalc-stunremaining").html(dc.stun.remaining);
	$("#dcalc-endremaining").html(dc.end.remaining);
	$("#dcalc-bodyremaining").removeClass();
	$("#dcalc-stunremaining").removeClass();
	$("#dcalc-endremaining").removeClass();
	$("#dcalc-bodyremaining").addClass('dc-body-' + dc.body.status);
	$("#dcalc-stunremaining").addClass('dc-stun-' + dc.stun.status);
	$("#dcalc-endremaining").addClass('dc-end-' + dc.end.status);

//	switch (dc.body.remaining <= 0) {
//		$("#dcalc-bodyremaining").addClass('negative-stat');
//	} else if (dc.body.remaining < dc.body.start) {
//		$("#dcalc-bodyremaining").addClass('reduced-stat');
//	} else {
//		$("#dcalc-bodyremaining").addClass('full-stat');
//	}
//	if (dc.end.remaining <= 0) {
//		if (dc.end.remaining < 0) {
//			alert("You take " + Math.ceil(0 - dc.end.remaining / 2) + "d6 of Normal Damage");
//			dc.end.remaining = 0;
//		}
//		$("#dcalc-endremaining").addClass('negative-stat');
//	} else if (dc.end.remaining < dc.end.start) {
//		$("#dcalc-endremaining").addClass('reduced-stat');
//	} else {
//		$("#dcalc-endremaining").addClass('full-stat');
//	}
//
//	if (dc.stun.remaining <= 0) {
//		dc.end.remaining = 0;
//		$("#dcalc-stunremaining").addClass('negative-stat');
//	} else if (dc.stun.remaining < dc.stun.start) {
//		$("#dcalc-stunremaining").addClass('reduced-stat');
//	} else {
//		$("#dcalc-stunremaining").addClass('full-stat');
//	}
//			$("#dcalc-stunremaining").removeClass();
//			$("#dcalc-stunremaining").addClass('stunned-stat');
//	$("#dcalc-bodyremaining").html(dc.body.remaining);
//	$("#dcalc-stunremaining").html(dc.stun.remaining);
//	$("#dcalc-endremaining").html(dc.end.remaining);
}

function setDCCalculationValues() {
	dc.calc.body = getParseOrZero($("#dcalc-body").val());
	dc.calc.stun = getParseOrZero($("#dcalc-stun").val());
	dc.calc.type = $("#dcalc-type").val();
	dc.calc.effect = $("#dcalc-effect").val();
}

function getParseOrZero(val) {
	return parseInt(val) || 0;
}

function setDCBodyStatus(damage) {
	damage = damage || false;
	if (dc.body.remaining == 0) {
		dc.body.status = 'dazed';
	} else if (dc.body.remaining < 0 && damage) {
		dc.body.status = 'bleeding';
	} else if (dc.body.remaining < (-1 * dc.body.start)) {
		dc.body.status = 'dead';
	} else if (dc.body.remaining < 0) {
		dc.body.status = 'dying';
	} else {
		dc.body.status = 'normal';
	}
}

function setDCStunStatus(damage){
	damage = damage || false;
	if (dc.stun.remaining <= 0) {
		dc.end.remaining = dc.stun.remaining;
		var negstun = (-1 * (dc.stun.remaining + 1)) % dc.recovery;
		switch (negstun) {
			case 0:
				dc.stun.status = 'unconcious';
				break;
			case 1:
			case 2:
				dc.stun.status = 'out';
				break;
			default:
				dc.stun.status = 'unrevivable';
				break;
		}
	} else if (dc.damage.stun > dc.con && damage) {
		dc.stun.status = 'stunned';
	} else {
		dc.stun.status = 'normal';
	}
}
$(function () {

	$("#dcalc-calc").click(function () {
//		console.log("dcalc-calc executing");
		setAllDCValues();
		setDCCalculationValues();
		if (dc.location < 3 || dc.location > 18) {
			alert('Location value must be a number between 3 and 18');
			return 0;
		}
		if (dc.calc.body == 0) {
			alert('Body damage value must be a number');
			return 0;
		}
		if (dc.calc.stun == 0) {
			dcnk = "Killing";
		} else {
			dcnk = "Normal"
		}
		switch (dc.calc.type) {
			case "Physical":
				rdef = dc.armor.rpd + dc.character.rpd;
				ndef = dc.armor.rpd + dc.character.npd;
				break;
			case "Energy":
				rdef = dc.armor.red + dc.character.red;
				ndef = dc.armor.red + dc.character.ned;
				break;
			default:
				alert('Type must be Physical or Energy');
				return 0;
				break;
		}
		switch (dc.calc.effect) {
			case "None":
				break;
			case "AP":
				rdef = Math.round(rdef / 2);
				ndef = Math.round(ndef / 2);
				break;
			case "AP2":
				rdef = Math.round(rdef / 4);
				ndef = Math.round(ndef / 4);
				break;
			case "NND":
				rdef = 0;
				ndef = 0;
				break;
			default:
				break;
		}
		switch (dcnk) {
			case "Killing":
				bodybase = Math.max(0, dc.calc.body - rdef);
				stunbase = dc.calc.body * locations[dc.location].target['stunx'];
				kdamage = Math.max(0, Math.floor(bodybase * locations[dc.location].target['bodyx']));
				ndamage = Math.max(kdamage, stunbase - ndef);
				break;
			case "Normal":
				bodybase = Math.max(0, dc.calc.body - rdef);
				stunbase = Math.max(0, dc.calc.stun - ndef);
				kdamage = Math.max(0, Math.floor(bodybase * locations[dc.location].target['bodyx']));
				ndamage = Math.max(kdamage, Math.floor(stunbase * locations[dc.location].target['nstun']));
				break;
			default:
				alert('Leave Stun Damage empty for Killing attacks');
				return 0;
				break;
		}
		$("#dcalc-bodytaken").html(kdamage);
		$("#dcalc-stuntaken").html(ndamage);

	});


	$("#dcalc-apply").click(function () {
		setDCBaseValues();
		setDCDamageValues();
		dc.body.remaining = dc.body.remaining - dc.damage.body;
		setDCBodyStatus(true);
		dc.stun.remaining = dc.stun.remaining - dc.damage.stun;
		setDCStunStatus(true);
		updateStatDisplays();
	});

	$("#dcalc-execute").click(function () {
//		console.log("dcalc-execute executing");
		setDCBaseValues();
		setDCDamageValues();
		dc.end.remaining = dc.end.remaining - dc.damage.end;
		updateStatDisplays();
	});

	$("#dcalc-heal").click(function () {
//		console.log("dcalc-heal executing");
		setDCBaseValues();
		dc.body.remaining = Math.min(dc.body.start, dc.body.remaining + 1);
		dc.stun.remaining = Math.min(dc.stun.start, dc.stun.remaining + 1);
		setDCBodyStatus(false);
		setDCStunStatus();
		updateStatDisplays();
	});

	$("#dcalc-reset").click(function () {
//		console.log("dcalc-reset executing");
		dc.body.remaining = dc.body.start;
		dc.stun.remaining = dc.stun.start;
		dc.end.remaining = dc.end.start;
		setDCBodyStatus(false);
		setDCStunStatus();
		updateStatDisplays();
	});

	$("#dcalc-clear").click(function () {
//		console.log("dcalc-clear executing");
		$("#dcalc-body").val(null);
		$("#dcalc-stun").val(null);
		$("#dcalc-type").val("Physical");
		$("#dcalc-effect").val("None");
		$("#dcalc-bodytaken").html("");
		$("#dcalc-stuntaken").html("");
	});

	$("#dcalc-recover").click(function () {
//		console.log("dcalc-recover executing")
		setDCBaseValues();
		
		if (dc.stun.status == 'stunned') {
			setDCStunStatus();
		} else {
			dc.stun.remaining = Math.min(dc.stun.start, dc.stun.remaining + dc.recovery);
			dc.end.remaining = Math.min(dc.end.start, dc.end.remaining + dc.recovery);
			setDCStunStatus();
		}
		updateStatDisplays();
	});


//	$("#dcalc-bodyremaining").click(function () {
//		dc.body.remaining = getParseOrZero($("#dcalc-bodyremaining").html());
//		$("#dcalc-bodyremaining").removeClass();
//		if (dc.body.remaining <= 0) {
////				console.log('stun negative-stat');
//			$("#dcalc-bodyremaining").addClass('negative-stat');
//		}
//	});
//
//	$("#dcalc-stunremaining").click(function () {
//		dc.stun.remaining = getParseOrZero($("#dcalc-stunremaining").html());
//		$("#dcalc-stunremaining").removeClass();
//		if (dc.stun.remaining <= 0) {
////				console.log('stun negative-stat');
//			$("#dcalc-stunremaining").addClass('negative-stat');
//		}
//	});




});