function getRangePenalty(distance) {
	var penalty = 0;
	if (distance > 8) {
		penalty = Math.round(2 * Math.log(distance / 8) / Math.log(2));
	}
	return penalty;
}

function getStrFromMass(mass) {
	var str;
	str = Math.round(5 * Math.log(mass / 25) / Math.log(2));
	return str;
}

function getMassFromStr(str) {
	var mass;
	mass = Math.round(25 * Math.pow(2, str / 5));
	return mass;
}

function getDamageDice(cl, type) {
	cl /= 2;
	roll = "";
	switch (type) {
		case "Killing":
			dice = Math.floor(cl / 3);
			switch (cl - (dice * 3)) {
				case 0:
				case .5:
					roll = dice;
					break;
				case 1:
				case 1.5:
					roll = dice + "+1";
					break;
				case 2:
					roll = dice + " 1/2";
					break;
				case 2.5:
					roll = (dice + 1) + "-1";
					break;
			}
			break;
		case "Normal":
			dice = Math.floor(cl);
			if (cl - (dice) == 1) {
				roll = dice + " 1/2";
			} else {
				roll = dice;
			}
			break;
	}

	roll += " " + type.substr(0, 1);
	return roll;
}

function getDamageDescription(cl, type, effect) {
	roll = "";
	switch (type) {
		case "Killing":
			dice = Math.floor(cl / 3);
			switch (cl - (dice * 3)) {
				case 0:
				case .5:
					roll = dice + "d6";
					break;
				case 1:
				case 1.5:
					roll = dice + "d6 + 1";
					break;
				case 2:
					roll = dice + " 1/2d6";
					break;
				case 2.5:
					roll = (dice + 1) + "d6 - 1";
					break;
			}
			break;
		case "Normal":
			dice = Math.floor(cl);
			if (cl - (dice) == 1) {
				roll = dice + " 1/2d6";
			} else {
				roll = dice + "d6";
			}
			break;
	}

	roll += " " + type.substr(0, 1) + " " + (effect ? effect : "");
	return roll;
}

function getValueFromText(htmlvalue) {
	if (typeof htmlvalue === "undefined") {
//		console.log("undefined");
		nval = 0;
	} else {
		if ((htmlvalue == "&nbsp;")) {
//		console.log("nbsp;");
			nval = 0;
		} else {
			if ((htmlvalue)) {
				if (htmlvalue == true) {
					nval = 1;
				} else {
//		console.log("htmlvalue");
					nval = parseFloat(htmlvalue);
//		console.log("parseFloat");
					if (nval == "NaN") {
//		console.log("NaN");
						nval = 0;
					} else {
//		console.log("not NaN");
					}
				}
			} else {
				nval = 0;
			}
		}
	}
	return nval;
}

//function getShieldInfo(weapon) {
//	if (weapon.Weapon.type == 'Shields') {
//		shielddcv = getValueFromText(weapon.Characterweapon.dcv_modifier) + getValueFromText(weapon.Weapon.dcv);
//	}
//	else {
//		shielddcv = 0;
//	}
//	return shielddcv;
//}
//

function getBaseRangePenalty() {
	/*
	 * Calculate Range Penalty.
	 */
	rng_distance_penalty = getRangePenalty(pdata.rng_distance);
	return Math.max(rng_distance_penalty - wdata.weap_rng, 0);
}

function getBaseStrength() {
	/*
	 * Calculate effective strength based on selected maneuver.
	 */

	return getValueFromText($("#str-used option:selected").text());

}

function getBaseDamage() {
	/*
	 * Compare strength required to strength used to set damage.
	 */

	str_dmg = Math.floor((getBaseStrength() - wdata.weap_str_min) / wdata.weap_str_overage);
	ma_dc = (wdata.weap_element == 1 && cdata.char_dc > 0 && mdata.man_type == "Martial") ? cdata.char_dc : 0;
	return wdata.weap_dmg + str_dmg + ma_dc;
}

function makeShieldBlockAdjustments() {
	/* 
	 * if blocking with a shield (in the attack hand)
	 * set weapon ocv to shield dcv, set weapon dcv to 0.
	 */
	if (
			wdata.weap_type == 'Shields'
			&& (mdata.man_name == "Block" || mdata.man_name == "Martial Block")
			) {
		wdata.weap_ocv = wdata.weap_dcv;
		wdata.weap_dcv = 0;
	}
}

function makeTwoHandAdjustments() {
	if (wdata.weap_hands == 1.5 && $("#two-hands").is(":checked")) {
		wdata.weap_str_min -= 2;
	}

}

function getBaseTargetPenalty() {
	return pdata.tgt_penalty;
}

function getBaseDCV() {
	/*
	 * Calculate DCV
	 */
	return cdata.char_dcv + wdata.weap_dcv;

}

function getBaseDef() {
//	console.log(odata.weap_type);
	if (odata.weap_type == 'Shields') {
		baseDef = odata.weap_dcv;
	} else {
		baseDef = odata.weap_oh_defense;
	}
//	console.log(baseDef);
	return baseDef;
}

function getBaseOCV() {
	return cdata.char_ocv + wdata.weap_ocv + Math.min(getBaseStrength() - wdata.weap_str_min, 0);
}