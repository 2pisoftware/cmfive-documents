<?php
/**
 * A DmNode is the generic object of the Document Model. 
 * A Node can be of any type, eg. a document or a folder.
 * 
 * By Attaching aspects to a node one can add metadata and 
 * associations to any node in addition to the type definition.
 * 
 * Associations between nodes are implemented via the DmNodeAssoc class.
 * Either the type or aspect will define various associations for one node, eg.
 * a folder type will define an association named "child" with many target nodes
 * of any type.
 * 
 * A "chapter" type may define a "section" type with many targets, but restricted 
 * to "section" type nodes.
 * 
 * The is_root property marks this node as being at the very top of any association
 * that the node may have with other nodes. That means that a node which is_root 
 * will be displayed on the index of the document management system before any
 * further drill-down is required. Usually there is no need for there to be more
 * than one is_root nodes .
 * 
 * @author careck
 *
 */
class DmNode extends DbObject {
	
	public $node_type;
	public $is_root;

	public $creator_id;
	public $modifier_id;
	public $dt_created;
	public $dt_modified;
	public $is_deleted;

	public $_searchable;
}