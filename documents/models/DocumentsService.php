<?php
class DocumentsService extends DbService {
	
	/**
	 * Returns the names of all registered document types
	 * 
	 * @return array of strings
	 */
	function getRegisteredTypeNames() {
		return array_keys(Config::get('documents.types'));
	}
	
	/**
	 * Returns the names of all registered document aspects
	 *
	 * @return array of strings
	 */
	function getRegisteredAspectNames() {
		return array_keys(Config::get('documents.aspects'));
	}
	
	/**
	 * Get the a DmType initialised with the definition
	 * returns null if type does not exist
	 * 
	 * @param string $type
	 * @return DmType
	 */
	function getType($type) {
		$def = Config::get('documents.types.'.$type);
		if (!empty($def)) {
			return new DmType($type,$def);
		}
	}

	/**
	 * Get the a DmAspect initialised with the definition
	 * returns null if aspect does not exist
	 * 
	 * @param string $aspect
	 * @return DmAspect
	 */
	function getAspect($aspect) {
		return Config::get('documents.aspects.'.$aspect);
	}
	
}