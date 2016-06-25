var cdata = [];
var pdata = [];
var wdata = [];
var odata = [];
var mdata = [];

function toConsole(item) {
//	console.log(item);
}

function displayWeapons() {
	switch (getValueFromText(attackweapon.Weapon.hands)) {
		case 2:
			$("#two-hands").prop("checked", true);
			$("#two-hands-wrapper").hide();
			break;
		case 1.5:
			$("#two-hands").prop("checked", false);
			$("#two-hands-wrapper").show();
			break;
		default:
			$("#two-hands").prop("checked", false);
			$("#two-hands-wrapper").hide();
			break;
	}
	if (
			attackweapon.Weapon.type == "Shields"
			|| $("#two-hands").is(":checked")
			) {
		$("#weapon-select-defense").val(uaweaponid);
		defenseweaponid = uaweaponid;
		defenseweapon = weapons[defenseweaponid];
		$("#weapon-choice-defense").hide();
	} else {
		$("#weapon-choice-defense").show();
	}
	populateStrSelect("displayWeapons");
	populateWeaponData("displayWeapons");
	populateMartialManeuvers("displayWeapons");
	populateMaxRange("displayWeapons");
	makeTwoHandAdjustments("displayWeapons");
}

function populateStrSelect() {
	char_str = getValueFromText(character.Character.str);
	$("#str-used-wrapper").html("");
	$("#rng-penalty").val("");
	str_required = getValueFromText(attackweapon.Weapon.str_min);
	strHTML = "<select id='str-used'>";
	if (getValueFromText(attackweapon.Weapon.str_adds_damage) == 1) {
		if (getValueFromText(attackweapon.Weapon.hands) == 1.5 && $("#two-hands").is(":checked")) {
			str_required -= 2;
		}
		str_overage = getValueFromText(attackweapon.Weapon.str_overage);
		for (i = -5; i < 10; i++) {
			strlist = Math.ceil(str_required + (str_overage * i));
			if (strlist >= 1) {
				strHTML += "<option ";
				if (strlist <= char_str && strlist + str_overage >= char_str) {
					strHTML += "SELECTED ";
				}
				strHTML += "value='" + i + "'>" + strlist + "</option>";
			}
		}
	} else {
		strHTML += "<option SELECTED value='" + 0 + "'>" + str_required + "</option>";
	}
	strHTML += "</select>";
	$("#str-used-wrapper").html(strHTML);
	populateMaxRange();
}

function populateMaxRange() {
	str_used_val = getValueFromText($("#str-used option:selected").text());
	if (wdata.weap_max_range) {
		if (wdata.weap_max_range == "RBS") {
			rng_max = Math.floor(4 * (cdata.char_str - str_used_val - getStrFromMass(wdata.weap_mass)) / 5);
		} else {
			rng_max = wdata.weap_max_range;
		}
	} else {
		rng_max = 0;
	}
	$("#rng-max").html(rng_max);
}
function populateMartialManeuvers() {
	call_url = webroot + "combat/getmartialmaneuvers/" + character.Character.id + "/" + attackweaponid;
//	console.log(call_url);
	$("#maneuvers-martial").load(call_url, function () {
	});
}

function populateCharacterData() {
	cdata.char_ocv = getValueFromText(character.Character.ocv);
	cdata.char_dcv = getValueFromText(character.Character.dcv);
	cdata.char_str = getValueFromText(character.Character.str);
	cdata.char_dc = getValueFromText(character.Character.ma_dc);
}

function populateDefenseData() {
	wdata.weap_ocv = getValueFromText(defenseweapon.Characterweapon.ocv_modifier) + getValueFromText(defenseweapon.Weapon.ocv);
	wdata.weap_dcv = getValueFromText(defenseweapon.Characterweapon.dcv_modifier) + getValueFromText(defenseweapon.Weapon.dcv);
}

function populateWeaponData() {
	wdata.weap_ocv = getValueFromText(attackweapon.Characterweapon.ocv_modifier) + getValueFromText(attackweapon.Weapon.ocv);
	wdata.weap_dcv = getValueFromText(attackweapon.Characterweapon.dcv_modifier) + getValueFromText(attackweapon.Weapon.dcv);
	wdata.weap_dmg = getValueFromText(attackweapon.Characterweapon.damage_classes_modifier) + getValueFromText(attackweapon.Weapon.damage_classes);
	wdata.weap_rng = getValueFromText(attackweapon.Characterweapon.range_modifier) + getValueFromText(attackweapon.Weapon.rmod);
	wdata.weap_dmg_type = attackweapon.Weapon.damage_type;
	wdata.weap_dmg_effect = attackweapon.Weapon.damage_effect;
	wdata.weap_oh_offset = getValueFromText(attackweapon.Characterweapon.offhand_offset);
	wdata.weap_oh_defense = getValueFromText(attackweapon.Characterweapon.offhand_defense);
	wdata.weap_ma_offset = getValueFromText(attackweapon.Characterweapon.multi_attack_offset);
	wdata.weap_element = getValueFromText(attackweapon.Characterweapon.weapon_element);
	wdata.weap_type = attackweapon.Weapon.type.trim();
	wdata.weap_hands = getValueFromText(attackweapon.Weapon.hands);
	wdata.weap_str_overage = getValueFromText(attackweapon.Weapon.str_overage);
	wdata.weap_str_min = getValueFromText(attackweapon.Characterweapon.str_min_modifier) + getValueFromText(attackweapon.Weapon.str_min);
	wdata.weap_max_range = getValueFromText(attackweapon.Characterweapon.max_range_modifier) + getValueFromText(attackweapon.Weapon.max_range);
	wdata.weap_mass = attackweapon.Weapon.mass;

	odata.weap_ocv = getValueFromText(defenseweapon.Characterweapon.ocv_modifier) + getValueFromText(defenseweapon.Weapon.ocv);
	odata.weap_dcv = getValueFromText(defenseweapon.Characterweapon.dcv_modifier) + getValueFromText(defenseweapon.Weapon.dcv);
	odata.weap_dmg = getValueFromText(defenseweapon.Characterweapon.damage_classes_modifier) + getValueFromText(defenseweapon.Weapon.damage_classes);
	odata.weap_rng = getValueFromText(defenseweapon.Characterweapon.range_modifier) + getValueFromText(defenseweapon.Weapon.rmod);
	odata.weap_dmg_type = defenseweapon.Weapon.damage_type;
	odata.weap_dmg_effect = defenseweapon.Weapon.damage_effect;
	odata.weap_oh_offset = getValueFromText(defenseweapon.Characterweapon.offhand_offset);
	odata.weap_oh_defense = getValueFromText(defenseweapon.Characterweapon.offhand_defense);
	odata.weap_ma_offset = getValueFromText(defenseweapon.Characterweapon.multi_attack_offset);
	odata.weap_element = getValueFromText(defenseweapon.Characterweapon.weapon_element);
	odata.weap_type = defenseweapon.Weapon.type.trim();
	odata.weap_hands = getValueFromText(defenseweapon.Weapon.hands);
	odata.weap_str_overage = getValueFromText(defenseweapon.Weapon.str_overage);
	odata.weap_str_min = getValueFromText(defenseweapon.Characterweapon.str_min_modifier) + getValueFromText(defenseweapon.Weapon.str_min);
	odata.weap_max_range = getValueFromText(defenseweapon.Characterweapon.max_range_modifier) + getValueFromText(defenseweapon.Weapon.max_range);
	odata.weap_mass = defenseweapon.Weapon.mass;
}

function populateManeuverData() {
	mdata.man_data_var = $("#var-action").attr("data-action");
	mdata.man_data_value = getValueFromText($("#input-action").val());
	mdata.man_type = maneuver.data("type").trim();
	mdata.man_name = maneuver.data("maneuver").trim();
	mdata.man_ocv_action = maneuver.data("ocv_action").trim();
	mdata.man_dcv_action = maneuver.data("dcv_action").trim();
	mdata.man_str_action = maneuver.data("str_action").trim();
	mdata.man_dmg_action = maneuver.data("dmg_action").trim();
	mdata.man_rng_action = maneuver.data("rng_action").trim();
	mdata.man_ocv = getValueFromText(maneuver.data("ocv_amt"));
	mdata.man_dcv = getValueFromText(maneuver.data("dcv_amt"));
	mdata.man_str = getValueFromText(maneuver.data("str_amt"));
	mdata.man_dmg = getValueFromText(maneuver.data("dmg_amt"));
	mdata.man_rng = getValueFromText(maneuver.data("rng_amt"));
	makeShieldBlockAdjustments("populateWeaponData");
}

function populatePenaltyData() {
	pdata.rng_distance = getValueFromText($("#rng-distance").val());
	pdata.rng_penalty = getRangePenalty(pdata.rng_distance);
	pdata.tgt_penalty = getValueFromText($("#tgt-penalty").val());
//	console.log(pdata);
}

function showLevelCalculations() {
//	switch (maneuver.data("effect")) {
//		case "str":
//			disparray = ["ocv", "dcv", "str", "tgt", "end"];
//			break;
//		case "escape":
//			disparray = ["dcv", "str", "end"];
//			break;
//		case "nnd":
//			disparray = ["ocv", "dcv", "dmg", "tgt", "end"];
//			weap_dmg_type = "NND";
//			break;
//		case "block":
//			disparray = ["ocv", "dcv"];
//			break;
//		case "dodge":
//			disparray = ["dcv"];
//			break;
//		case "hold":
//			disparray = ["ocv", "dcv", "dmg", "tgt", "end"];
//			break;
//		case "killing":
//			disparray = ["ocv", "dcv", "dmg", "tgt", "end"];
//			weap_dmg_type = "Killing"
//			break;
//		case "normal":
//			disparray = ["ocv", "dcv", "dmg", "tgt", "end"];
//			weap_dmg_type = "Normal";
//			break;
//		case "stun":
//			disparray = ["ocv", "dcv", "dmg", "tgt", "end"];
//			weap_dmg_type = "Normal";
//			weap_dmg_effect = "(1/2 BODY)";
//			break;
//		default:
//			disparray = ["ocv", "dcv", "dmg", "tgt", "end"];
//			break;
//	}


//	$("div[id^='calcs-']").hide();
	$(".ocv-current").html("");
	$(".ocv-roll").html("");
	$(".dcv-current").html("");
	$(".str-current").html("");
	$(".dmg-current").html("");
	$(".end-current").html("");
	$(".rng-current").html("");
	$(".man-current").html("");
	active_ocv = $("#slider-ocv").slider("value") + $("#slider-rng").slider("value") + $("#slider-tgt").slider("value");
	$(".ocv-current").html(active_ocv);
	$(".ocv-roll").html("( " + (11 + active_ocv) + " - Roll )");
	$(".dcv-current").html($("#slider-dcv").slider("value") + $("#slider-def").slider("value"));
	$(".str-current").html(getBaseStrength());
	$(".dmg-current").html(getDamageDescription($("#slider-dmg").slider("value") / 2, wdata.weap_dmg_type, wdata.weap_dmg_effect));
	$(".end-current").html(Math.ceil(getBaseStrength() / 5));
	$(".tgt-current").html(tgtlocation.data("target") + (tgtlocation.data("roll") ? "  (" + tgtlocation.data("roll") + ")" : ""));
	$(".tgt-penalty").val(tgtlocation.data("penalty"));
	$(".rng-current").html(pdata.rng_penalty);
	$(".man-current").html(mdata.man_name);
//	var index;
//	for (index = 0; index < disparray.length; index++) {
//		$("#calcs-" + disparray[index]).show();
//	}
//
	$("#level-calculations").show();
}

function getAdjustedBase(type) {
	switch (type) {
		case "str":
			switch (mdata.man_str_action) {
				case "add":
					str_delta = mdata.man_str;
					break;
				case "velocity":
					if (mdata.man_data_var == "velocity") {
						str_delta = Math.floor(mdata.man_data_value / mdata.man_str);
					}
					break;
				case "mult":
					strdelta = 0 - Math.floor(getBaseStrength() * mdata.man_str);
					break;
				default:
					break;
			}
			return getBaseStrength() + str_delta;
			break;
		case "dmg":
			switch (mdata.man_dmg_action) {
				case "add":
					dmg_delta = mdata.man_dmg;
					break;
				case "velocity":
					if (man_data_var == "velocity") {
						dmg_delta = Math.floor(mdata.man_data_value / man_dmg);
					}
					break;
				default:
					dmg_delta = 0;
					break;
			}
			return getBaseDamage() + dmg_delta;
			break;
		case "tgt":
			return getBaseTargetPenalty();
			break;
		case "rng":
			switch (mdata.man_rng_action) {
				case "add":
					rng_delta = mdata.man_rng;
					break;
				default:
					rng_delta = 0;
					break;
			}
			return Math.max(pdata.rng_penalty - rng_delta, 0);
			break;
		case "dcv":
			switch (mdata.man_dcv_action) {
				case "add":
					dcv_delta = mdata.man_dcv;
					break;
				case "mult":
					dcv_delta = 0 - (Math.floor(getBaseDCV()) * mdata.man_dcv);
					break;
				default:
					dcv_delta = 0;
					break;
			}
			return getBaseDCV() + dcv_delta;
			break;
		case "ocv":
			switch (mdata.ocv_action) {
				case "add":
					ocv_delta = mdata.man_ocv;
					break;
				case "velocity":
					if (mdata.man_data_var == "velocity") {
						ocv_delta = Math.floor(mdata.man_data_value / mdata.man_ocv);
					}
					break;
				case "dc":
					if (mdata.man_data_var == "dc") {
						ocv_delta = mdata.man_data_value * mdata.man_ocv;
					}
					break;
				case "target":
					if (mdata.man_data_var == "target") {
						ocv_delta = Math.min(Math.floor(mdata.man_data_value - 1) * mdta.man_ocv + wdata.weap_ma_offset, 0);
					}
					break;
				case "set":
					ocv_delta = 0 - getBaseOCV();
					break;
				default:
					ocv_delta = 0;
					break;
			}
			return getBaseOCV() + ocv_delta;
			break;
		case "def":
			return getBaseDef();
			break;
		default:
			return 0;
			break;
	}
}


function checkMaxDamage() {
	/*
	 * Verify that total damage isn't more than the weapon maximum.
	 * If it is, remove levels until it isn't.
	 * If the damage is more than the maximum without any levels, flag the slider
	 */

	/**************************
	 * TODO
	 *************************/
	dmgdiv.droppable();
	if (attackweapon.Weapon.id !== "90" && (current_dmg) >= (2 * weap_dmg)) {
		dmgdiv.droppable("disable");
		if (dmgdiv.hasClass("border-dmg")) {
			dmgdiv.removeClass("border-dmg");
			dmgdiv.addClass("border-disabled");
		}
	} else {
		dmgdiv.droppable("enable");
		if (dmgdiv.hasClass("border-disabled")) {
			dmgdiv.removeClass("border-disabled");
			dmgdiv.addClass("border-dmg");
		}
	}
	/**************************
	 * /TODO
	 *************************/
}
