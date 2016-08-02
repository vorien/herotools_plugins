<?php

/*
 * Class XMLFunctions
 * @author Michael Coury
 */

class XMLFunctions {

	private $skipemptynodes = '/node()';
	public $skipempty = ['not(self::text()[not(normalize-space())])'];
	public $emptynottext = ['not(*) and not(@*) and not(text()[normalize-space()])'];
	public $empty = ['not(*) and not(@*)'];
	public $documentelementid = 'ID';

	function __construct($params = []) {
		if (isset($params['SkipEmptyNodes'])) {
			$this->setSkipEmptyNodes($params['SkipEmptyNodes']);
		}
		if (isset($params['DocumentElementID'])) {
			$this->setDocumentElementID($params['DocumentElementID']);
		}
	}

	function setSkipEmptyNodes($skip = true) {
		$this->skipempty = $skip ? ['not(self::text()[not(normalize-space())])'] : [];
		$this->skipemptynodes = $skip ? '/node()' : '';
	}

	function buildOptions($selectarray = []){
		if ($selectarray) {
			$built = '[' . implode(' and ', $selectarray) . ']';
		}
		return $built ?: '';
	}

	function buildSkipEmpty($selectarray = []) {
		$parameters = array_merge($selectarray, $this->skipempty);
		if ($parameters) {
			$built = '[' . implode(' and ', $parameters) . ']';
		}
		return $built ?: '';
	}

	function buildSkipEmptyNodes($selectarray = []) {
		return '/node()' . $this->buildSkipEmpty($selectarray);
	}

	function removeNamedTags(&$domdocument, $namearray = []) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		foreach ($namearray as $name) {
			$query = '//' . $name;
			$this->removeTags($domdocument, $query);
		}
	}

	function removeEmptyTags(&$domdocument, &$basenode = null) {
		if (!$basenode) {
			$query = '/';
		} else {
			$nodepath = $basenode->getNodePath();
			if ($this->checkPathExists($domdocument, $nodepath)) {
				$query = $nodepath;
			} else {
				// node doesn't exist in domdocument
				//TODO: Throw error
				return false;
			}
		}
		$query .= '/*[not(node())]';
		$this->removeTags($domdocument, $query);
		return true;
	}

	function checkPathExists(&$domdocument, $nodepath) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		$nodelist = $domxpath->query($nodepath);
		switch ($nodelist->length) {
			case 0:
				return false;
				break;
			case 1:
				return true;
				break;
			default:
				//More than one match
				//TODO: Throw error
				return null;
				break;
		}
	}

	/**
	 * Rename an Element
	 *
	 * @param DOMElement $element
	 * @param string $name
	 * @param string | null | false $domdocumentid (=== false removes @XMLID attribute)
	 * @return DOMElement renamed node
	 */
	function renameElement(\DOMElement $element, $name, $newid = null) {
		$renamed = $element->ownerDocument->createElement($name);

		foreach ($element->attributes as $attribute) {
			if ($newid !== false || $attribute->nodeName !== $this->documentelementid)
				$renamed->setAttribute($attribute->nodeName, $attribute->nodeValue);
		}
		if ($newid) {
			$renamed->setAttribute($this->documentelementid, $newid);
		}
		while ($element->firstChild) {
			$renamed->appendChild($element->firstChild);
		}
		return $element->parentNode->replaceChild($renamed, $element);
	}

	function renameElements(&$nodelist, $newname) {
		foreach ($nodelist as $element) {
			if ($element->nodeName != $newname) {
				$this->renameElement($element, $newname);
			}
		}
	}

	function removeTags(&$domdocument, $query) {
		$nodecount = 0;
		while (($nodelist = $this->getNodeList($domdocument, $query)) && $nodelist->length) {
//			debug($nodelist->length);
			foreach ($nodelist as $element) {
				$nodecount += 1;
				$element->parentNode->removeChild($element);
			}
		}
		return $nodecount;
	}

	function getDOMXPathFromDOMDocument(&$domdocument) {
		return new DOMXPath($domdocument);
	}

	function getNodeList(&$domdocument, $query) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		$nodelist = $domxpath->query($query);
		return $nodelist;
	}

	function renameNodesSetIDToTag(&$nodelist, $newname) {
		foreach ($nodelist as $element) {
			if ($element->nodeName != $newname) {
				$this->renameElement($element, $newname, $element->nodeName);
			}
		}
	}

	function tagsToID(&$nodelist, $filter = null) {
		foreach ($nodelist as $element) {
			if (!$filter || $element->nodeName == $filter) {
				$this->renameElement($element, $element->getAttribute($this->documentelementid));
			}
		}
	}

	function setIDToAttribute(&$nodelist, $attribute, $filter = null) {
		foreach ($nodelist as $element) {
			if (!$filter || $element->nodeName == $filter) {
				if ($element->hasAttribute($attribute)) {
					$element->setAttribute($this->documentelementid, $this->cleanStringForID($element->getAttribute($attribute)));
				}
			}
		}
	}

	function copyNode(&$tonode, &$node) {
		$newnode = $tonode->ownerDocument->importNode($node, true);
		$tonode->appendChild($newnode);
	}

	function setParentNodeIDToText($nodelist) {
		foreach ($nodelist as $element) {
			if ($element->nodeType == XML_TEXT_NODE) {
				$element->parentNode->setAttribute($this->documentelementid, $this->cleanStringForID($element->nodeValue));
			}
		}
	}

	function cleanStringForID($string) {
		return strtoupper(str_replace(' ', '_', $string));
	}

	function cleanNodePath(&$element) {
		return preg_replace('/\[[0-9]+\]/', '', $element->getNodePath());
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

	function attachElement(&$node, $elementname) {
		$domdocument = $node->ownerDocument;
		$newelement = $domdocument->createElement($elementname);
		$newchild = $node->appendChild($newelement);
		return $newchild;
	}

	function findOrCreateNodePath(&$domdocument, $nodepath) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		$checkpath = $this->checkPathExists($domdocument, $nodepath);
		if ($checkpath === null) {
			return null;
		}
		if ($checkpath === true) {
			return $domxpath->query($nodepath)->item(0);
		}
		$knownpath = '';
		$toarray = explode('/', $nodepath);
		if (empty($toarray[0])) {
			array_shift($toarray);
		}
		while (count($toarray) > 0) {
			$testpath = $knownpath . '/' . $toarray[0];
			$pathcheck = $this->checkPathExists($domdocument, $testpath);
			if ($pathcheck === null) {
				return null;
			}
			if ($pathcheck === true) {
				$knownpath .= '/' . $toarray[0];
				array_shift($toarray);
			} else {
				break;
			}
		}
		if (!$toarray) {
			// This shoudn't happen since it means that the whole path was found
			return null;
		}
		if (!$knownpath) {
			$knownpath = '/';
		}
		$parentelement = $domxpath->query($knownpath)->item(0);
		foreach ($toarray as $elementname) {
			$parentelement = $this->attachElement($parentelement, $elementname);
		}
		return $parentelement;
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

	/*
	 * $excludetagarray = array of tag names to exclude
	 * $excludetagstring = array of substrings to exclude
	 */

	public function moveNodes(&$domdocument, $topath, &$fromelement, $nodequery) {
		$nodearray = [];
		$toelement = $this->findOrCreateNodePath($domdocument, $topath);
		if ($toelement === null) {
			// findOrCreateNodePath passed an error
			return null;
		}
		$movequery = $fromelement->getNodePath() . $nodequery;
		$nodelist = $this->getNodeList($fromelement->ownerDocument, $movequery);
		foreach ($nodelist as $node) {
			$clone = $node->cloneNode(true);
			$movednode = $domdocument->importNode($clone, true);
			$childnode = $toelement->appendchild($movednode);
			$nodearray[] = $childnode;
			$node->parentNode->removeChild($node);
		}
		return $nodearray ? : false;
	}

	
	//TODO this function needs work
	function getChild(&$node, $childname, $match = 'exact') {
		if (!$node || !$node->hasChildNodes()) {
			return false;
		}
		$query = $node->getNodePath() . '/' . $childname;
		$nodelist = $this->getNodeList($node->ownerDocument, $query);
		if ($nodelist->length == 0) {
			return false;
		}
		if ($match == 'exact') {
			if ($nodelist->length != 1) {
				return null;
			} else {
				return($nodelist->item(0));
			}
		}
		return false;
	}

	function getFirstMatchingChild(&$node, $childname) {
		if (!$node || !$node->hasChildNodes()) {
			return false;
		}
		foreach ($node->childNodes as $childnode) {
			if ($childnode->nodeName == $childname) {
				return $childnode;
			}
		}
		return false;
	}

	function hasChild(&$node, $childname) {
		if (!$node || !$node->hasChildNodes()) {
			return false;
		}
		foreach ($node->childNodes as $childnode) {
			if ($childnode->nodeName == $childname) {
				return true;
			}
		}
		return false;
	}

	function displayNode(\DOMNode $node) {
		switch ($node->nodeType) {
			case XML_TEXT_NODE:
				debug($node->wholeText);
				break;
			default:
				$snode = simplexml_import_dom($node);
				debug($snode);
//				$debug_xml = new \DOMDocument();
//				$child = $debug_xml->importNode($node);
//				$debug_xml->appendChild($child);
//				debug($this->objectToArray($debug_xml));
//				unset($debug_xml);
		}
	}

	function displayNodeList(\DOMNodeList $nodelist) {
		for ($i = 0; $i < $nodelist->length; $i++) {
			debug($nodelist->item($i)->nodeType);
			debug($nodelist->item($i)->getNodePath());
			$this->displayNode($nodelist->item($i));
		}
	}

	//TODO: Not working, not currently used
	function objectToArray($object) {
		if (!is_object($object) && !is_array($object)) {
			return $object;
		}
		return array_map(array($this, 'objectToArray'), (array) $object);
	}

	function getAttributeValue(&$node, $name, $default = null) {
		return $node->getAttribute($name) ? : $default;
	}

	function getAttributesAsArray(&$node) {
		$attributes = [];
		if ($node->attributes) {
			foreach ($node->attributes as $attribute) {
				$attributes[$attribute->name] = $attribute->value;
			}
//		} else {
//			debug('Node has no attributes');
		}
		return $attributes;
	}

	function getSXEAttributesAsArray(&$sxeattributes){
		$attributes = [];
		foreach($sxeattributes as $name => $value){
			$attributes[$name] = $value;
		}
		return $attributes;
	}
	function displayAttributes(&$node, $caller = null) {
		if ($caller) {
			echo '<h3>', $caller, '</h3><br>';
		}
		echo '<b>', $node->nodeName, '</b><br>';
		if ($node->attributes) {
			foreach ($node->attributes as $attribute) {
				echo $attribute->name, ': ', $attribute->value, '<br>';
			}
		} else {
			debug('child has no attributes: ' . $node->nodeName);
		}
	}


}
