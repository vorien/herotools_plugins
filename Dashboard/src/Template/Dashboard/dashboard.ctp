<?php
$btnclass = array('class' => 'btn btn-default btn-xs');
$btndivclass = 'col-xs-3 btndiv';

echo $this->PageBuild->openRow("", "");
//$this->Sidebar->buildSidebar($this->request->params['controller'], $this->request->params['action'], "Dashboard");
echo $this->PageBuild->openDiv('col-xs-24');
echo "<h2>" . $username . "</h2>";
echo $this->PageBuild->openRow();
echo $this->PageBuild->openDiv('col-xs-12');
echo "<h3>Your Characters</h3>";
foreach ($owncharacters as $character) {
	$btnid = array(
		'characterid' => $character['id'],
		'charactername' => $character['name']
	);
	echo $this->PageBuild->openRow('clearfix display-line', 'owncharacters');
	echo $this->PageBuild->makeDiv($character['name'], 'col-xs-7 character-name');
	echo $this->PageBuild->makeDiv($this->Html->link(__('View'), array('controller' => 'characters', 'action' => 'view', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->makeDiv($this->Html->link(__('Edit'), array('controller' => 'characters', 'action' => 'edit', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->makeDiv($this->Html->link(__('Combat'), array('plugin' => 'Vorien/HeroCombat', 'controller' => 'combat', 'action' => 'index', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->makeDiv($this->Html->link(__('Charactersheet'), array('plugin' => 'Vorien/Charactersheet', 'controller' => 'charactersheet', 'action' => 'index', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->closeRow();
}
//echo $this->PageBuild->openRow();
//echo $this->PageBuild->makeDiv("&nbsp;", 'col-xs-15');
//echo $this->PageBuild->closeRow();
//echo $this->PageBuild->openRow();
//echo $this->PageBuild->makeDiv($this->Html->link('Character Sheets', "/charactersheet/select", array('target' => '_blank')), 'col-xs-15');
//echo $this->PageBuild->closeRow();

echo $this->PageBuild->closeDiv();
echo $this->PageBuild->openDiv('col-xs-12');
echo "<h3>Your Players</h3>";
foreach ($gmcharacters as $character) {
	$btnid = array(
		'characterid' => $character['id'],
		'charactername' => $character['name']
	);
	echo $this->PageBuild->openRow('clearfix display-line', 'gmcharacters');
	echo $this->PageBuild->makeDiv($character['name'], 'col-xs-6 character-name');
	echo $this->PageBuild->makeDiv($this->Html->link(__('View'), array('controller' => 'characters', 'action' => 'view', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->makeDiv($this->Html->link(__('Edit'), array('controller' => 'characters', 'action' => 'edit', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->makeDiv($this->Html->link(__('Combat'), array('plugin' => 'Vorien/HeroCombat', 'controller' => 'combat', 'action' => 'index', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->makeDiv($this->Html->link(__('Charactersheet'), array('plugin' => 'Vorien/Charactersheet', 'controller' => 'charactersheet', 'action' => 'index', $character['id']), $btnclass), $btndivclass, null, $btnid);
	echo $this->PageBuild->closeRow();
}
echo $this->PageBuild->closeDiv();
echo $this->PageBuild->closeRow();
echo $this->PageBuild->closeDiv();
echo $this->PageBuild->closeRow();
?>


<?php
//pr($this->Session->read('Auth.User')); 
//pr($owncharacters);
//pr($gmcharacters);
?>

<script>
//	$(function() {
//		$("#owncharacters .btndiv, #gmcharacters .btndiv").click(function(e) {
////			e.preventDefault();
//			console.log("div clicked");
//			var call_url = "<?php //echo $this->webroot; ?>dashboard/setActiveCharacter/" + $(this).data('characterid');
//			console.log(call_url);
//			console.log(call_url);
//			$.ajax({
//				url: call_url,
//			}).done(function(data) {
//				console.log(data);
//				if (status == "error") {
//					var msg = "Sorry but there was an error: ";
//					console.log(msg + xhr.status + " " + xhr.statusText);
//				}
//			});
//		});
//	});

</script>

