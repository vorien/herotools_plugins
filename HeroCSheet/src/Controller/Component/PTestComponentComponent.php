<?php
namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * PTestComponent component
 */
class PTestComponentComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
	
	
		/*
		  $nodequery = "//POWER[@XMLID = 'DETECT']";
		  $cnodelist = $this->cpath->query($nodequery);
		  $cnode = $cnodelist->item(0);
		  $cdoc = new \DOMDocument;
		  $child = $cdoc->importNode($cnode, false);
		  $cdoc->appendChild($child);
		  //		debug(Xml::toArray($cdoc));
		  $mnodelist = $this->mpath->query($nodequery);
		  $mnode = $mnodelist->item(0);
		  $mdoc = new \DOMDocument;
		  $child = $mdoc->importNode($mnode, true);
		  $mdoc->appendChild($child);
		  //		debug(Xml::toArray($mdoc));
		  $this->cpath = new \DOMXPath($cdoc);
		  $this->mpath = new \DOMXPath($mdoc);
		  $this->mergeAttributes('/POWER');
		  //		debug(Xml::toArray($cdoc));
		  $cnode = $cdoc->documentElement;
		  if($cnode->hasAttribute('OPTIONID')){
		  $newquery = $nodequery . "/OPTION[@XMLID = '" . $cnode->getAttribute('OPTIONID') . "']";
		  //			debug($newquery);
		  $nnodelist = $this->mpath->query($newquery);
		  //			debug($nnodelist->length);
		  if($nnodelist->length == 1){
		  $nnode = $nnodelist->item(0);
		  $cnode->setAttribute('LVLCOST', $nnode->getAttribute('LVLCOST'));
		  $cnode->setAttribute('LVLVAL', $nnode->getAttribute('LVLVAL'));
		  }else{
		  debug("nnodelist has " . $nnodelist->length . " records");
		  }
		  }
		  debug(Xml::toArray($cdoc));
		  exit;
		
		$nodearray = [];
		$nodelist = $this->mpath->query('//MODIFIER');
		debug($nodelist->length);
		foreach ($nodelist as $node) {
			foreach($node->attributes as $attribute){
				$nodearray[$attribute->name] = null;
			}
		}
		debug($nodearray);
		exit;
 */
		
/*
		$tempdoc = new \DOMDocument();
		$attributes = [
			'REQUIRED',
			'BASECOST', //KEEP
			'LVLCOST', //KEEP
			'LVLVAL', //KEEP
//			'ID', 
//			'ALLOWSOTHERADDERS', 
//			'ALLOWSOTHERMODIFIERS',
			'MINCOST', //Keep?
			'MAXCOST', //Keep?
			'FIXEDVALUE',
			'ALIAS',
			'SHOWALIAS',
			'LVLMULTIPLIER', //KEEP
			'LVLPOWER', //KEEP
			'LEVELSTART', //KEEP
			'LVLSTART', //KEEP
//			'LEVELSLABEL', //Keep?
			'MINVAL', //Keep?
			'MAXVAL', //Keep?
			'DISPLAYINSTRING',
			'ABBREVIATION',
			'WGABBREVIATION',
			'ADDERSEPARATOR', //Keep?
//			'USESEND',
//			'CLIPSLEVEL', //KEEP
//			'CLIPSMULTIPLIER', //KEEP
//			'CLIPSADVANTAGEMULTIPLIER', //KEEP
//			'CLIPSMAXADVANTAGE', //KEEP
//			'RECOVERABLELEVEL', //KEEP
//			'BOOSTABLELEVEL', //KEEP
//			'MULTIPLIER', //KEEP
			'EXCLUSIVE',
//			'DISLAY', //TYPO
//			'SHOWINPUTINPARENS',
//			'SHOWOPTION', //Keep?
//			'SHOWOPTIONINPARENS',
//			'SHOWOPTIONONLY', //Keep?
			'INPUTLABEL',
			'OTHERINPUT',
//			'CONSTANTPOWERWITHACTIVATION', //KEEP
//			'LESSERVALUE', //KEEP
			'OPTIONLABEL',
//			'REQUIRESALL',
//			'EXLUSIVE', //TYPO
//			'ISLIMITATION', //KEEP
			'INCLUDEINBASE', //KEEP
			'WARNSIGN', //KEEP
			'STOPSIGN', //KEEP
			'XMLID',
			'DISPLAY'
		];
		$nodelist = $this->mpath->query('//ADDER');
		debug($nodelist->length);
		foreach ($nodelist as $node) {
			$child = $tempdoc->importNode($node, false);
			$clone = $child->cloneNode();
			foreach ($attributes as $attribute) {
				if ($clone->hasAttribute($attribute)) {
					$clone->removeAttribute($attribute);
				}
			}
			if ($clone->attributes->length) {
				$tempdoc->appendChild($clone);
				debug(Xml::toArray($tempdoc));
			}
//			foreach($node->attributes as $attribute){
//				$anodequery = '//OPTION[@' . $attribute->name . ']';
//				debug($anodequery);
//				$anodelist = $this->mpath->query($anodequery);
//				$marray[$attribute->name] = $anodelist->length;
//			}
		}
//		debug($marray);

		exit;

		$carray = $marray = $tarray = [];
		$nodelist = $this->cpath->query('//*');
		foreach ($nodelist as $node) {
			//$carray[$node->nodeName] = 1;
			foreach ($node->attributes as $attribute) {
				$cnodequery = '//*[@' . $attribute->name . ']';
				debug($cnodequery);
				$cnodelist = $this->cpath->query($cnodequery);
				$carray[$attribute->name] = $cnodelist->length;
			}
		}
		debug($carray);
		exit;
		$nodelist = $this->mpath->query('//*');
		foreach ($nodelist as $node) {
			$marray[$node->nodeName] = 1;
		}
		debug(array_keys($marray));
		$nodelist = $this->tpath->query('//*');
		foreach ($nodelist as $node) {
			$tarray[$node->nodeName] = 1;
		}
		debug(array_keys($tarray));
		exit;

//$query = '/HEROCSHEET/*[not(@XMLID)]';
//$qnodelist = $this->mpath->query($query);
//debug($qnodelist->length);
//foreach($qnodelist as $qnode){
//	debug($qnode->parentNode->parentNode->nodeName);
//	debug($qnode->parentNode->nodeName);
//	debug($qnode->nodeName);
//}
//exit;
//		debug(json_encode(Xml::toArray($character_xml)['HEROCSHEET']['POWERS'], JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));
//		debug(json_encode(Xml::toArray($main_xml)['HEROCSHEET']['POWERS'], JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT));
//		exit;
//		debug(Xml::toArray($main_xml)['HEROCSHEET']['PERKS']);

		$xpath = '/HEROCSHEET/POWERS';
		$this->mergeAttributes($xpath);
//		$this->mergeNodes('/HEROCSHEET/PERKS');
		debug(Xml::toArray($character_xml)['HEROCSHEET']['POWERS']);
//		debug(Xml::toArray($main_xml)['HEROCSHEET']['CHARACTERISTICS']['DEX']);
//		debug(Xml::toArray($template_xml)['HEROCSHEET']['CHARACTERISTICS']['DEX']);
//		$character_array = Xml::toArray($character_xml);
//		debug($this->checkXMLID($character_array, 'ROOT'));
//		$main_array = Xml::toArray($main_xml);
//		debug($this->checkXMLID($main_array, 'ROOT'));
//		$this->compareNodes('/* /node()', $this->mpath, $this->tpath);
//		$this->compareNodes('/TEMPLATE', $this->mpath, $this->tpath);
 */

}
