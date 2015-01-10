<?php
class DmNodeAssoc extends DbObject {
	
	public $node_id;
	public $assoc_name;
	public $target_node_id;	
	
	public $creator_id;
	public $modifier_id;
	public $dt_created;
	public $dt_modified;
	public $is_deleted;	
}