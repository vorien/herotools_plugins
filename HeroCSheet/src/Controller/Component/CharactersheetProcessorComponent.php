<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;
use Cake\Core\Plugin;
use Cake\Core\App;

/**
 * CakePHP CharactersheetProcessorComponent
 * @author Michael
 */
class CharactersheetProcessorComponent extends Component {

	private $CharactersheetsTable;
	private $CharactersheetFilePath;
	public $components = ['Vorien/HeroCSheet.MergeTemplates', 'Vorien/HeroCSheet.MergeCharactersheet', 'Vorien/HeroCSheet.LoadCharactersheet'];

	public function initialize(array $config) {
		parent::initialize($config);
		$this->CharactersheetsTable = TableRegistry::get('Vorien/HeroCSheet.Charactersheets');
		$this->CharactersheetFilePath = Plugin::path('Vorien/HeroCSheet') . 'webroot' . DS . 'files/';
	}

	function processCharactersheet($charactersheet_id) {
		$xmlfiles = $this->getXMLFilesForCharacterID($charactersheet_id);

		$template_xml = new \DOMDocument;
		$template_xml->preserveWhiteSpace = false;
		$template_xml->loadXML($xmlfiles['character_sxml']->TEMPLATE->saveXML());
		unset($xmlfiles['character_sxml']->TEMPLATE);
		$rules_xml = new \DOMDocument;
		$rules_xml->preserveWhiteSpace = false;
		$rules_xml->loadXML($xmlfiles['character_sxml']->RULES->saveXML());
		unset($xmlfiles['character_sxml']->RULES);
		$character_xml = dom_import_simplexml($xmlfiles['character_sxml'])->ownerDocument;
		$main_xml = dom_import_simplexml($xmlfiles['main_sxml'])->ownerDocument;

		$this->MergeTemplates->setConfiguration([
			'to_xml' => $main_xml,
			'from_xml' => $template_xml,
			'basequery' => '/HEROCSHEET'
		]);
		$merge_xml = $this->MergeTemplates->mergeTemplates();

debug($merge_xml->saveXML());

		$this->MergeCharactersheet->setConfiguration([
			'character_xml' => $character_xml,
			'merged_xml' => $merge_xml,
			'rules_xml' => $rules_xml,
			'basequery' => '/HEROCSHEET/CHARACTERISTICS'
		]);

		$mergedcharacter_xml = $this->MergeCharactersheet->mergeCharacter();
debug($mergedcharacter_xml->saveXML());

//		$this->LoadCharactersheet->setConfiguration([
//			'character_xml' => $mergedcharacter_xml,
//			'charactersheet_id' => $charactersheet_id
//		]);
//
//		$this->LoadCharactersheet->loadCharactersheet();
		
		debug('Process Complete');
	}

	function getXMLFilesForCharacterID($charactersheet_id) {
		if (empty($charactersheet_id)) {
			$this->Flash->set('No character was selected');
			return $this->redirect(['plugin' => 'Vorien/Dashboard', 'controller' => 'dashboard']);
		}
		$charactersheet = $this->CharactersheetsTable->find('all')->where(['id' => $charactersheet_id])->first();
		if (empty($charactersheet)) {
			$this->Flash->set('There is no entry in the table for that character');
			return $this->redirect(['plugin' => 'Vorien/Dashboard', 'controller' => 'dashboard']);
		}
		if (empty($charactersheet['characterfile'])) {
			$this->Flash->set('There is no character file set for that character');
			return $this->redirect(['plugin' => 'Vorien/HeroCSheet', 'controller' => 'charactersheets', 'action' => 'upload']);
		}
		if (empty($charactersheet['mainfile'])) {
			$this->Flash->set('There is no main file set for that character.<br>Contact your GM for more information.');
			return $this->redirect(['plugin' => 'Vorien/Dashboard', 'controller' => 'dashboard']);
		}

		$characterfile = $this->CharactersheetFilePath . $charactersheet['characterfile'];
		$mainfile = $this->CharactersheetFilePath . $charactersheet['mainfile'];

		$character_sxml = simplexml_load_file($characterfile);
		$main_sxml = simplexml_load_file($mainfile);


		$character_xml = new \DOMDocument();
		$character_xml->preserveWhiteSpace = false;
		$character_xml->load($characterfile);

		$main_xml = new \DOMDocument();
		$main_xml->preserveWhiteSpace = false;
		$main_xml->load($mainfile);

		return compact('character_sxml', 'main_sxml', 'character_xml', 'main_xml');
	}

}
