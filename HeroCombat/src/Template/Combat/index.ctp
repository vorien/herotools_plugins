<?php
echo $this->PageBuild->makeDiv("", "character-info");
echo $this->PageBuild->openRow("top-section");

echo $this->PageBuild->makeDiv("&nbsp;", "col-xs-1");

echo $this->PageBuild->openDiv("col-xs-5");
$this->SectionBuild->showWeaponList('attack');
$this->SectionBuild->showWeaponList('defense');
$this->SectionBuild->showUsageDetails();
echo $this->PageBuild->closeDiv();

echo $this->PageBuild->makeDiv(null, "col-xs-1");

echo $this->PageBuild->openDiv("col-xs-4");
$this->SectionBuild->showCalculatedValues();
echo $this->PageBuild->closeDiv();

echo $this->PageBuild->makeDiv(null, "col-xs-1");

echo $this->PageBuild->openDiv("col-xs-5");
$this->SectionBuild->showDamageStatusDisplay();
echo $this->PageBuild->closeDiv();

echo $this->PageBuild->openDiv("col-xs-7");
$this->SectionBuild->showDamageStatusCalculations();
echo $this->PageBuild->closeDiv();

echo $this->PageBuild->closeRow();

$this->SectionBuild->buildTabs();
?>

<script type="text/javascript">

	var ajax_root = "<?php echo $ajax_root; ?>";
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

	$(function () {
		$("select[id^='weapon-select']").val(uaweaponid);
		maneuver = $("#Strike.maneuver-select");
		tgtlocation = $("#General");
		$("#weapon-selection-wrapper").show();
		$("#main-tab-wrapper").css("visibility", "visible");
		displayWeapons();
		populateCharacterData();
		populateManeuverData();
		populatePenaltyData();
		initializeSliders();

		$("body").on("change", "select[id$='str-used']", function () {
			populateMaxRange("#str-used change");
			updateSliders("str-used: change: " + $(this).attr("id"));
		});

		$("body").on("change", $("#rng-penalty"), function () {
			populatePenaltyData();
			updateSliders();
		});

		$(".targetlocation").click(function () {
			tgtlocation = $(this);
//			console.log($(this).data("penalty"));
			$("#tgt-penalty").val($(this).data("penalty"));
			console.log($("#tgt-penalty").val());
			populatePenaltyData();
			updateSliders();
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
			updateSliders();
		});

		$('#two-hands').change(function () {
			populateStrSelect("two-hands change");
			updateSliders();
		});

		$("body").on("click", ".maneuver-select", function () {
			maneuver = $(this);
//			console.log(maneuver);
			var actions = [maneuver.data("ocv_action"), maneuver.data("dcv_action"), maneuver.data("dmg_action"), maneuver.data("str_action")];
//			console.log(actions);
			if (actions.indexOf("target") !== -1) {
				$("#var-action").html("Targets").css("visibility", "visible").attr("data-action", "target");
				$("#input-action").css("visibility", "visible").attr("data-action", "target");
			} else if (actions.indexOf("dc") !== -1) {
				$("#var-action").html("DC Qty").css("visibility", "visible").attr("").attr("data-action", "dc");
				$("#input-action").css("visibility", "visible").attr("data-action", "dc");
			} else if (actions.indexOf("velocity") !== -1) {
				$("#var-action").html("Velocity").css("visibility", "visible").attr("data-action", "velocity");
				$("#input-action").css("visibility", "visible").attr("data-action", "velocity");
			} else {
				$("#var-action").html("").css("visibility", "hidden").attr("data-action", "");
				$("#input-action").css("visibility", "hidden").val(0).attr("data-action", "");
			}
			populateWeaponData();
			populateManeuverData()
			updateSliders();
			$('#maintabs a:first').tab('show');
		});

		$("body").on("change", "#input-action", function () {
			updateSliders();
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

