<?php

namespace Vorien\HeroCSheet\Controller\Component;

use Cake\Controller\Component;


/*
 * CakePHP PXMLComponent
 * @author Michael
*/ 
class PXMLComponent extends Component {

	public $skipemptynodes = '/node()[not(self::text()[not(normalize-space())])]';
	public $skipempty = '[not(self::text()[not(normalize-space())])]';

	public function moveEnhancers(&$cxml) {
		$skillsnode = $cxml->getElementsByTagName('SKILLS')->item(0);
		$enhancersnode = $cxml->createElement('SKILL_ENHANCERS');
		$i = $skillsnode->childNodes->length - 1;
		while ($i > -1) {
			$skillnode = $skillsnode->childNodes->item($i);
			if ($skillnode->nodeName != 'SKILL' && $skillnode->nodeName != '#text') {
				if (stripos($skillnode->nodeName, 'HYKERU') === false) {
					$newnode = $this->getRenamedNode($skillnode, 'ENHANCER', $skillnode->nodeName);
					$appnode = $enhancersnode->ownerDocument->importNode($newnode, true);
					$enhancersnode->appendchild($appnode);
				}
				$skillnode->parentNode->removeChild($skillnode);
			}
			$i--;
		}
		$cxml->appendChild($enhancersnode);
	}

	function removeEmptyTags(&$xml) {
		$xpath = new \DOMXPath($xml);
		while (($nodelist = $xpath->query('//*[not(*) and not(@*) and not(text()[normalize-space()])]')) && $nodelist->length) {
			foreach ($nodelist as $node) {
				$node->parentNode->removeChild($node);
			}
		}
	}

	/**
	 * Rename an Element
	 *
	 * @param DOMElement $node
	 * @param string $name
	 * @param string | null | false $xmlid (=== false removes @XMLID attribute)
	 * @return DOMElement renamed node
	 */
	function renameElement(\DOMElement $node, $name, $xmlid = null) {
		$renamed = $node->ownerDocument->createElement($name);

		foreach ($node->attributes as $attribute) {
			if ($xmlid !== false || $attribute->nodeName !== 'XMLID')
				$renamed->setAttribute($attribute->nodeName, $attribute->nodeValue);
		}
		if ($xmlid) {
			$renamed->setAttribute('XMLID', $xmlid);
		}
		while ($node->firstChild) {
			$renamed->appendChild($node->firstChild);
		}
		return $node->parentNode->replaceChild($renamed, $node);
	}

	function getRenamedNode($oldnode, $newnodeName, $tag = []) {
		$document = $oldnode->ownerDocument;
		$newnode = $document->createElement($newnodeName);
		if ($tag) {
			$newnode->setAttribute($tag[0], $tag[1]);
		}
		foreach ($oldnode->attributes as $attribute) {
			$newnode->setAttribute($attribute->name, $attribute->value);
		}
		foreach (iterator_to_array($oldnode->childNodes) as $child) {
			$newnode->appendChild($oldnode->removeChild($child));
		}
		return $newnode;
	}

	function getNodeList($xpath, &$gpath) {
		$nodequery = $xpath . $this->skipemptynodes;
		$nodelist = $gpath->query($nodequery);
		return $nodelist;
	}

	function templateNodesToTag($nodelist, $name) {
		foreach ($nodelist as $node) {
			if ($node->nodeName != $name) {
				$this->renameElement($node, $name, $node->nodeName);
			}
		}
	}

	function templateNodesToXmlid($nodelist, $name) {
		foreach ($nodelist as $node) {
			if ($node->nodeName == $name) {
				$this->renameElement($node, $node->getAttribute('XMLID'), false);
			}
		}
	}

	function templateXmlidToDisplay($nodelist, $name) {
		foreach ($nodelist as $node) {
			if ($node->nodeName == $name) {
				$node->setAttribute('XMLID', $this->cleanForXmlid($node->getAttribute('DISPLAY')));
			}
		}
	}

	function cleanForXmlid($string){
		return strtoupper(str_replace(' ', '_', $string));
	}
	
	function standardizeTemplate(&$gpath) {
		$update = [
			'PERKS' => 'PERK',
			'TALENTS' => 'TALENT',
			'SKILLS' => 'SKILL',
			'DISADVANTAGES' => 'DISAD',
			'POWERS' => 'POWER'
		];
		foreach ($update as $ukey => $uvalue) {
			$nodelist = $this->getNodeList("/HEROCSHEET/$ukey", $gpath);
			$this->templateNodesToTag($nodelist, $uvalue);
		}
		$nodelist = $this->getNodeList('/HEROCSHEET/MARTIAL_ARTS',$gpath);
		$this->templateXmlidToDisplay($nodelist, 'MANEUVER');
	}

	function cleanNodePath(&$node) {
		return preg_replace('/\[[0-9]+\]/', '', $node->getNodePath());
	}

	function mergeNodes($xpath) {
		$cnodequery = $xpath . $this->skipemptynodes;
//		debug($cnodequery);
		$cnodelist = $this->cpath->query($cnodequery);
		foreach ($cnodelist as $cnode) {
			$nodequery = $this->cleanNodePath($cnode) . "[@XMLID = '" . $cnode->getAttribute('XMLID') . "']";
//			debug($nodequery);
//			debug($mnodequery);
			$mnodelist = $this->mpath->query($nodequery);
			if ($mnodelist->length != 1) {
				foreach ($mnodelist as $mnode) {
					debug($mnode->getNodePath());
				}
				die("Incorrect number of nodes found via $mnodequery");
			} else {
				$mnode = $mnodelist->item(0);
			}
			$tnodelist = $this->tpath->query($nodequery);
			if ($tnodelist->length > 1) {
				die("Incorrect number of nodes found via $tnodequery");
			} else {
				$tnode = $tnodelist->item(0);
			}

//			debug($cnode->getNodePath());
//			debug($cnode->nodeName . " -> " . $cnode->getAttribute('XMLID'));
			$cattributes = $this->getAttributeArray($cnode);
			$mattributes = $this->getAttributeArray($mnode);
			$tattributes = $this->getAttributeArray($tnode);
//			debug($cattributes);
//			debug($mattributes);
//			debug($tattributes);
			$merged = array_replace($mattributes, $tattributes, $cattributes);
			debug($merged);
			if ($cnode->hasChildNodes()) {
				$this->mergeNodes($cnode->getNodePath());
//				$snodequery = $nodequery . $this->skipemptynodes;
//				$snodelist = $this->cpath->query($snodequery);
//				if ($snodelist->length) {
//					foreach ($snodelist as $snode) {
//						debug($snode->nodeName);
//						$smnodequery = $this->cleanNodePath($snode) . "[@XMLID = '" . $snode->getAttribute('XMLID') . "']";
//						$smnodelist = $this->mpath->query($smnodequery);
//						if ($smnodelist->length != 1) {
//							die("Incorrect number of nodes found via $smnodequery");
//						} else {
//							$smnode = $smnodelist->item(0);
//						}
//					}
//				}
			}
		}
	}

	function getAttributeArray(&$element) {
		$attributes = [];
		if ($element) {
			foreach ($element->attributes as $attribute_name => $attribute_node) {
				$attributes[$attribute_name] = $attribute_node->nodeValue;
			}
		}
		return $attributes;
	}


	 
}
