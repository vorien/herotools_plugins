var sliders = []
//sliders.ocv.levels.push(1);
//console.log(sliders.ocv);

//var lows = {"ocv":0,"dcv":0,"dmg":0,"rng":0,"tgt":0,"def":0};
function initializeSliders() {
	$(".slider").slider({
		orientation: "vertical",
		range: "min",
//		slide: function (event, ui) {
//			if (ui.value < sliders[$(this).data("type")].min || ui.value > sliders[$(this).data("type")].max)
//				return false;
//		}
		start: function (event, ui) {
			if (event.which) {
				$.data(this, "oldvalue", ui.value);
			}
		},
		change: function (event, ui) {
			if (event.which && ui.value != $.data(this, "oldvalue")) {
				adjustSliderLevels($(this).data("type"), ui.value, $.data(this, "oldvalue"));
			}
		}
	});

	sliders['ocv'] = {"cap_min": -8, "cap_max": 13, "min": 0, "max": 0, "levels": new Array()};
	sliders['dcv'] = {"cap_min": 0, "cap_max": 13, "min": 0, "max": 0, "levels": new Array()};
	sliders['def'] = {"cap_min": 0, "cap_max": 13, "min": 0, "max": 0, "levels": new Array()};
	sliders['dmg'] = {"cap_min": 0, "cap_max": 26, "min": 0, "max": 0, "levels": new Array()};
	sliders['tgt'] = {"cap_min": -12, "cap_max": 0, "min": 0, "max": 0, "levels": new Array()};
	sliders['rng'] = {"cap_min": -20, "cap_max": 0, "min": 0, "max": 0, "levels": new Array()};
	updateSliders("initializeSliders");
}

function adjustSliderLevels(type, newvalue, oldvalue) {
	if (newvalue > oldvalue) {
		for (ctr = 0; ctr < newvalue - oldvalue; ctr++) {
//			console.log(getAvailableLevels(attackweaponid, type));
			min_level = getMMCA(getAvailableLevels(attackweaponid, type), "min");
			setClaim(min_level, type);
			sliders[type].levels.push(min_level);
		}
	} else if (oldvalue > newvalue) {
		for (ctr = 0; ctr < oldvalue - newvalue; ctr++) {
//			console.log(getLevelsByOwner(type));
			max_level = getMMCA(getLevelsByOwner(type), "max");
			clearClaim(max_level);
			unclaimLevel(max_level, type);
		}
	}
//	console.log(oldvalue + " to " + newvalue);
//	console.log(levels);
//	console.log(sliders[type]);
	updateSliders();
}

function updateSliders() {
	for (i in sliders) {
		$("#" + i).hide();
		sliders[i].min = getSliderMin(i);
		sliders[i].max = getSliderMax(i);
		$("#slider-" + i).slider("option", "min", sliders[i].min);
		$("#slider-" + i).slider("option", "max", sliders[i].max);
		$("#slider-" + i).slider("value", sliders[i].min + sliders[i].levels.length);
		switch (i) {
			case "dmg":
				if (getDamageDice(sliders[i].max, wdata.weap_dmg_type) != getDamageDice(sliders[i].min, wdata.weap_dmg_type)) {
					$("#" + i).show();
				}
				break;
			default:
				if (sliders[i].max != sliders[i].min) {
					$("#" + i).show();
				}
				break;
		}
	}
	dmgLabelArray = [];
	for (i = sliders.dmg.min; i <= sliders.dmg.max; i++) {
		dmgLabelArray.push(getDamageDice(i, wdata.weap_dmg_type));
	}
//	console.log(sliders.dmg);
//	console.log(dmgLabelArray);
	$(".slider").slider('pips', {first: "label", last: "label", rest: "label"});
	$("#slider-dmg").slider('pips', {rest: "label", labels: dmgLabelArray, step: .5});
//	console.log(sliders);

	showLevelCalculations();
}

function getSliderMin(type) {
	base = getAdjustedBase(type);
	switch (type) {
		case "ocv":
		case "dcv":
		case "def":
			break;
		case "dmg":
			base *= 2;
			break;
		case "tgt":
		case "rng":
//			console.log(type);
//			console.log(base);
			base = 0 - base;
			break;
		default:
			break;
	}
	return Math.max(base, sliders[i].cap_min);
}
function getSliderMax(type) {

//	console.log(type);
//	console.log(available_levels);
	base = sliders[type].min + sliders[type].levels.length + getMMCA(getAvailableLevels(attackweaponid, type), "count");
	switch (type) {
		case "ocv":
		case "dcv":
		case "def":
			break;
		case "tgt":
		case "rng":

//			console.log(type);
//			console.log(base);
//			console.log(sliders[type].min);
//	base = sliders[type].min + sliders[type].levels.length + available_levels.length;
			break;
		case "dmg":
//			console.log(attackweapon);
			if (attackweapon.Weapon.id != 90) {
				base = Math.min(base, wdata.weap_dmg * 4);
			}
			break;
		default:
			break;
	}
	return Math.min(base, sliders[i].cap_max);
}

function unclaimLevel(level_id, type) {
//	console.log(type + ": " + level_id);
//	console.log(sliders[type].levels);
	index = sliders[type].levels.indexOf(level_id);
//	console.log(index);
	if (index !== -1) {
		sliders[type].levels.splice(index, 1);
	}
}