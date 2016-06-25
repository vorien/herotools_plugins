//var ocv = ["red", "yellow", "blue", "green", "black"];
//var dcv = def = ["yellow", "blue", "green", "black"];
//var dmg = ["yellow", "blue", "green", "black"];
//var rng = ["orange"];
//var tgt = ["purple"];

var colors = [];
colors["ocv"] = ["red", "yellow", "blue", "green", "black"];
colors["dcv"] = ["yellow", "blue", "green", "black"];
colors["dmg"] = ["yellow", "blue", "green", "black"];
colors["rng"] = ["orange"];
colors["tgt"] = ["purple"];
colors["def"] = ["brown"];
//	toConsole("starting");
//	toConsole(colors["ocv"].toString());

function getAvailableLevels(weapon_id, level_type) {
	return filterByType(filterByWeapon(filterByUnclaimed(levels), weapon_id), level_type);
}

function filterByType(array, level_type) {
	return array.filter(hasColor(level_type));
}

function filterByUnclaimed(array) {
	return array.filter(isNotClaimed);
}

function filterByWeapon(array, weapon_id) {
	if (typeof weapon_id === "undefined") {
		weapon_id = attackweaponid;
	}
	return array.filter(hasWeapon(weapon_id));
}

function getMMCA(array, mmca) {
	switch (mmca) {
		case "max":
			return array.sort(function (a, b) {
				return b.cost - a.cost
			}).shift().id;
			break;
		case "min":
			return array.sort(function (a, b) {
				return a.cost - b.cost
			}).shift().id;
			break;
		case "count":
			return array.length;
			break;
		default:
			return 0;
			break;
	}
}

function hasColor(level_type) {
	return function (element) {
		return colors[level_type].indexOf(element['color'].toLowerCase()) >= 0;
	}
}

function hasWeapon(weapon_id) {
	return function (element) {
		return element['weapons'].indexOf(weapon_id) >= 0;
	}
}

function hasOwner(level_type) {
	return function (element) {
		return element.claimed === level_type;
	}
}

function isClaimed(element) {
	return element.claimed !== false;
}

function isNotClaimed(element) {
	return element.claimed === false;
}




function getLevelsByOwner(level_type) {
	return levels.filter(hasOwner(level_type));
}

function setClaim(level_id, level_type) {
	for (var i = 0; i < levels.length; i++) {
		if (levels[i].id === level_id) {
			levels[i].claimed = level_type;
			break;
		}
	}

}

function clearClaim(level_id) {
	for (var i = 0; i < levels.length; i++) {
		if (levels[i].id === level_id) {
			levels[i].claimed = false;
			break;
		}
	}
}

function getClaim(level_id) {
	for (var i = 0; i < levels.length; i++) {
		if (levels[i].id === level_id) {
			return levels[i].claimed;
			break;
		}
	}
}

function clearClaimsByOwner(level_type) {
	for (var i = 0; i < levels.length; i++) {
		if (levels[i].claimed === level_type) {
			levels[i].claimed = false;
			break;
		}
	}
}

function clearAllClaims() {
	for (var i = 0; i < levels.length; i++) {
		levels[i].claimed = false;
	}
	for(i in sliders){
		sliders[i].levels.length = 0;
	}
}


