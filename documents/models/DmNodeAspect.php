<?php
class DmNodeAspect extends DbObject {
	
	public $aspect_name;
	public $node_id;
	public $is_mandatory;

	public $creator_id;
	public $modifier_id;
	public $dt_created;
	public $dt_modified;
	public $is_deleted;	
}