<?php

/*
 * Class XMLFunctions
 * @author Michael Coury
 */

class XMLFunctions {

	public $skipemptynodes = '/node()[not(self::text()[not(normalize-space())])]';
	public $skipempty = '[not(self::text()[not(normalize-space())])]';
	public $notempty = '[not(*) and not(@*) and not(text()[normalize-space()])]';
	public $documentelementid = 'ID';

	function __construct($params) {
		if (isset($params['SkipEmptyNodes'])) {
			$this->setSkipEmptyNodes($params['SkipEmptyNodes']);
		}
		if (isset($params['DocumentElementID'])) {
			$this->setDocumentElementID($params['DocumentElementID']);
		}
	}

	function setSkipEmptyNodes($skip = true) {
		$this->skipemptynodes = $skip ? '/node()[not(self::text()[not(normalize-space())])]' : '';
		$this->skipempty = $skip ? '[not(self::text()[not(normalize-space())])]' : '';
	}

	function setDocumentElementID($id = null) {
		$this->documentelementid = $id ? : 'ID';
	}

	function removeNamedTags(&$domdocument, $namearray = []) {
		$domxpath = getDOMXPathFromDOMDocument($domdocument);
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
		$query .= '/*' . $this->notempty;
		$this->removeTags($domdocument, $query);
		return true;
	}

	function checkPathExists(&$domdocument, $domxpath) {
		$element = $domdocument->query($domxpath);
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
			if ($domdocumentid !== false || $attribute->nodeName !== 'XMLID')
				$renamed->setAttribute($attribute->nodeName, $attribute->nodeValue);
		}
		if ($domdocumentid) {
			$renamed->setAttribute($this->documentelementid, $newid);
		}
		while ($element->firstChild) {
			$renamed->appendChild($element->firstChild);
		}
		return $element->parentNode->replaceChild($renamed, $element);
	}

	function removeTags(&$domdocument, $query) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		while (($nodelist = $domxpath->query($query)) && $nodelist->length) {
			foreach ($nodelist as $element) {
				$element->parentNode->removeChild($element);
			}
		}
	}

	function getDOMXPathFromDOMDocument(&$domdocument) {
		return new DOMXPath($domdocument);
	}

	function getNodeList(&$domdocument, $query) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		$nodelist = $domxpath->query($query . $this->skipemptynodes);
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

	function attachElement($parent, $elementname) {
		$newelement = $parent->createElement($elementName);
		$newchild = $parent->appendChild($newelement);
		return $newchild;
	}

	function findOrCreateElementPath(&$domdocument, $elementpath) {
		$domxpath = $this->getDOMXPathFromDOMDocument($domdocument);
		$checkpath = $this->checkPathExists($domdocument, $elementpath);
		if ($checkpath === null) {
			return null;
		}
		if ($checkpath === true) {
			return $domxpath->query($elementpath)->item(0);
		}
		$knownpath = '';
		$toarray = explode('/', $elementpath);
		while (count($toarray) > 0) {
			$knownpath .= '/' . $toarray[0];
			$pathcheck = $this->checkPathExists($domdocument, $knownpath);
			if ($pathcheck === null) {
				return false;
			}
			if ($pathcheck === true) {
				array_shift($toarray);
			} else {
				exit;
			}
		}
		if (!$toarray) {
			// This shoudn't happen since it means that the whole path was found
			return null;
		}
		$parentelement = $domxpath->query($knownpath)->item(0);
		foreach ($toarray as $element) {
			$parentelement = $this->attachElement($parentelement, $element);
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

	public function moveNodes(&$domdocument, $fromelement, $topath, $excludetagarray = [], $excludetagstring = []) {
		$toelement = $this->findOrCreateElementPath($domdocument, $topath);
		if ($toelement === null) {
			return null;
		}
		$i = $fromelement->childNodes->length - 1;
		while ($i > -1) {
			$node = $skillsnode->childNodes->item($i);
			if ($excludetagarray && in_array($node->nodeName, $excludetagarray)) {
				continue;
			}
			if ($excludetagstring) {
				foreach ($excludetagstring as $substring) {
					if (stripos($node->nodeName, $substring) === false) {
						continue 2;
					}
				}
			}
			$clone = $node->cloneNode(true);
			$movednode = $domdocument->importNode($clone, true);
			$toelement->appendchild($modednode);
			$node->parentNode->removeChild($node);
			$i--;
		}
	}
	

}
