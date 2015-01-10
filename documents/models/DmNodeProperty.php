<?php
class DmNodeProperty extends DbObject {
	
	public $node_id;
	public $property_name;
	
	// values by for different value types
	// as defined in the type / aspect definition
	
	public $noderef_id; // node_id for node to node references, BIGINT
	public $shorttext_value; // VARCHAR(1024) 
	public $text_value; // TEXT
	public $longtext_value; // LONG_TEXT
	public $integer_value; // BIGINT
	public $float_value; //  FLOAT
	public $d_date_value; // DATE
	public $dt_datetime_value; // DATETIME
	
	// lifecycle data
	
	public $creator_id;
	public $modifier_id;
	public $dt_created;
	public $dt_modified;
	public $is_deleted;
}