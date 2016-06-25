<script type="text/javascript">

	var ajax_root = "<?php echo $ajax_root; ?>";
console.log(ajax_root);

	var character = <?php echo $json_characterinfo; ?>;
	var weapons = <?php echo $json_weapons; ?>;
	var uaweaponid = <?php echo $starting_weapon_id; ?>;
	var attackweaponid = defenseweaponid = uaweaponid;
	var attackweapon = defenseweapon = weapons[uaweaponid];
	var tgtlocation = null;
	var maneuver = null;
	var armor = <?php echo $json_armorlocationinfo; ?>;
	var locations = <?php echo $json_locationinfo; ?>;
	var targets = <?php echo $json_targetinfo; ?>;
	var levels = <?php echo $json_leveltracking ?>;

//	console.log(filterByWeapon(filterByType(levels,"dmg"),3));
//	console.log(weapons[defenseweaponid]);

//	console.log(armor);
//	console.log(locations);
//	console.log(character);

	$(function () {
		$("select[id^='weapon-select']").val(uaweaponid);
		maneuver = $("#Strike.maneuver-select");
		tgtlocation = $("#General");
		$("#weapon-selection-wrapper").show();
		$("#main-tab-wrapper").css("visibility", "visible");
		displayWeapons("page load");
		populateCharacterData("page load");
		populateManeuverData("page load");
		populatePenaltyData("page load");
		initializeSliders("page load");

//		initializeSliders();
//		getlevels("page load");
//		populateCurrentValues("page load");
//		console.log(getLevels(undefined, "max"));
//		console.log(getLevels(undefined, "min"));
//		console.log(getLevels(undefined, "count"));
//		setClaim(8, 'defense');
//		console.log(getLevelsByWeapon());
//		console.log(getLevelsByOwner("attack"));


		$("body").on("change", "select[id$='str-used']", function () {
			populateMaxRange("#str-used change");
			updateSliders("str-used: change: " + $(this).attr("id"));
		});

		$("body").on("change", $("#rng-penalty"), function () {
			populatePenaltyData("rng-penalty change");
			updateSliders("rng-penalty: change: " + $(this).attr("id"));
		});

		$(".targetlocation").click(function () {
			tgtlocation = $(this);
//			console.log($(this).data("penalty"));
			$("#tgt-penalty").val($(this).data("penalty"));
			console.log($("#tgt-penalty").val());
			populatePenaltyData(".targetlocation click");
			updateSliders(".targetlocation click");
			$('#maintabs a:first').tab('show');
		});

		$("body").on("change", "select[id^='weapon-select']", function () {
			clearAllClaims();
			if ($(this).attr('id') == 'weapon-select-attack') {
				attackweaponid = getValueFromText($("#weapon-select-attack").val());
				attackweapon = weapons[attackweaponid];
			} else {
				defenseweaponid = getValueFromText($("#weapon-select-defense").val());
				defenseweapon = weapons[defenseweaponid];
			}
			displayWeapons("weapon change");
			populateMartialManeuvers();
			maneuver = $("#Strike.maneuver-select");
			updateSliders("weapon change");
		});

		$('#two-hands').change(function () {
			populateStrSelect("two-hands change");
			updateSliders("two hands change");
		});

		$("body").on("click", ".maneuver-select", function () {
			maneuver = $(this);
//			console.log(maneuver);
			var actions = [maneuver.data("ocv_action"), maneuver.data("dcv_action"), maneuver.data("dmg_action"), maneuver.data("str_action")];
//			console.log(actions);
			if (actions.indexOf("target") !== -1) {
				$("#var-action").html("Targets").css("visibility", "visible").attr("data-action", "target");
				$("#input-action").css("visibility", "visible").attr("data-action", "target");
			}
			else if (actions.indexOf("dc") !== -1) {
				$("#var-action").html("DC Qty").css("visibility", "visible").attr("").attr("data-action", "dc");
				$("#input-action").css("visibility", "visible").attr("data-action", "dc");
			}
			else if (actions.indexOf("velocity") !== -1) {
				$("#var-action").html("Velocity").css("visibility", "visible").attr("data-action", "velocity");
				$("#input-action").css("visibility", "visible").attr("data-action", "velocity");
			}
			else {
				$("#var-action").html("").css("visibility", "hidden").attr("data-action", "");
				$("#input-action").css("visibility", "hidden").val(0).attr("data-action", "");
			}
			populateWeaponData(".maneuver-select");
			populateManeuverData(".maneuver-select")
			updateSliders(".maneuver-select");
			$('#maintabs a:first').tab('show');
		});

		$("body").on("change", "#input-action", function () {
			updateSliders("#input-action");
		});


		$("#test-save-levels").click(function () {
			console.log("clicked");
			$('#main-ocv div').each(function (index, element) {
				console.log(index);
				console.log($(this).data('clevel'));
				console.log(element);
			});
		});

	});


</script>
<?php
//debug($armorlocationinfo);
//echo($json_characterinfo);
?>


<?php
$this->SectionBuild->buildTopSection();
//$this->SectionBuild->buildTabs();
?>

