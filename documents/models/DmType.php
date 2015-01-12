<?php
class DmType {
	
	private $name;
	private $definition;
	private $parent_types = array();
	private $mandatory_aspects = array();
	
	function __construct($name,$definition) {
		$this->name = $name;
		$this->definition = $definition;	
		
		// walk up the inheritance chain to fill the list of parent types
		$parent_type = defaultVal($definition['parent'],null);
		while (!empty($parent_type)) {
			$pdef = Config::get('documents.types.'.$parent_type);
			if (!empty($pdef)) {
				$parent = new DmType($parent_type, $pdef);
				$this->parent_types[$parent_type] = $parent;
				$parent_type = $parent->isA();
			} else {
				throw new RuntimeException("Documents: error in configuration of type ".$name." parent type '".$parent_type."' does not exist.");
			}
		}
		
		// get ALL aspects including the inherited ones
		
	}
	
	function getTitle() {
		return defaultVal($this->definition['title'],null);
	}
	
	function getComment() {
		return defaultVal($this->definition['comment'],null);
	}
	
	function hasAttachments() {
		return defaultVal($this->definition['has_attachments'],false);
	}
	
	function hasComments() {
		return defaultVal($this->definition['has_comments'],false);
	}
	
	/**
	 * if test is null then returns the name of the parent type,
	 * otherwise checks if test is equal to the parent type ... going
	 * up the inheritance chain!
	 * 
	 * @param string $test
	 */
	function isA($test=null) {
		if (empty($test)) {
			return defaultVal($this->definition['parent'],null);
		}
	}
}