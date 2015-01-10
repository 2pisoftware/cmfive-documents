<?php

Config::set('documents', array(
    'version' => '0.8.0',
    'active' => false,
    'path' => 'modules',
    'topmenu' => true,
));

/***********************************************************************************************************
 * Definition of basic document types
 ***********************************************************************************************************/

/**
 * Type Object
 */
Config::set('documents.types.dm_object', array(

	'title' => "Object",
	'comment' => "An Object is the toplevel node type",
	'is_a' => null, // does not inherit from any other type
	'is_abstract' => true // this means it will not appear in the UI for creating new nodes
));

/**
 * Type Content
 */
Config::set('documents.types.dm_content', array(
	'title' => "Content",
	'comment' => "Content is just plain content, eg. a web page or a note",
	
	'is_a' => 'object', // inherits from 'object' type
	'has_attachments' => true, // 'has_attachments' defines the number of allowed cmfive attachments for a node of this type
	'has_comments' => true, // whether to allow the cmfive comment tab on this node type
	
	// these aspects are automatically added to any node with this type
	'mandatory_aspects' => array(
		'dm_has_description', 
		'dm_has_title',
	),
));

/**
 * Type File
 */
Config::set('documents.types.dm_file', array(

	'title' => "File",
	'comment' => "A file is an object which has a binary or text attachment",

	'is_a' => 'object', // inherits from 'object' type
	'has_attachments' => true, // 'has_attachments' defines the number of allowed cmfive attachments for a node of this type
	'limit_attachments' => 1, // the number of attachments is limited to 1
	'has_comments' => true, // whether to allow the cmfive comment tab on this node type
	
	'properties' => array (
		'dm_file_name' => array(
			'title' => 'File Name',
			'type' => 'shorttext', // may be mapped to VARCHAR(1024) in the database, see DmNodeProperty
			'read_only' => true, // this property can not be changed via the UI
			'mandatory' => true,
		),
		'dm_mime_type' => array(
			'title' => 'Mime Type',
			'type' => 'shorttext', // may be mapped to VARCHAR(1024) in the database, see DmNodeProperty
			'read_only' => true,
			'mandatory' => true,
		),
		'dm_file_size' => array(
			'title' => 'File Size',
			'type' => 'integer', // may be mapped to BIGINT in the database, see DmNodeProperty
			'read_only' => true,
			'mandatory' => true,
		),	
	),
	
	// these aspects are automatically added to any node with this type
	'mandatory_aspects' => array(
		'dm_has_description', 
		'dm_has_title',
	),
));

/**
 * Type Folder
 */
Config::set('documents.types.dm_folder', array(

	// type definition
	'title' => "Folder",
	'comment' => "A folder holds other objects",
	'is_a' => 'object', // inherits from 'object' type
	'has_attachments' => 0, // defines the number of allowed cmfive attachments for a node of this type, 
							//false means no attachments, 0 means unlimited attachments!
	'has_comments' => true, // allow cmfive comments
	
	// definition of properties
	'properties' => array (
		'dm_parent_link' => array(
			'type' => 'noderef',
			'mandatory' => false,
		)
	),
	
	// definition of associations
	'associations' => array(
	
		'dm_contains' => array(
			// the source definition describes 'this' side of the association
			'source' => array(
				'many' => true, // a folder can be contained in another folder
				'mandatory' => false, // a folder does not have to be contained in another folder
			),
			// the target definition describes the 'other' side of the association
			'target' => array(
				'many' => true, // a folder can have many children
				'mandatory' => false, // a folder doesn't have to have children
				'type' => 'dm_object', // a restriction on the type of the nodes that can be part of this association
			),
			'is_child_association' => true, // if the parent is deleted, all children will be deleted, too
			'allow_duplicates' => false, // a folder cannot have duplicate children
		),
	),

	// these aspects are automatically added to any node with this type
	'mandatory_aspects' => array(
		'dm_has_description',
		'dm_has_title',
	),
	
));

/**
 * Type Category
 */
Config::set('documents.types.dm_category', array(

	// type definition
	'title' => "Category",
	'comment' => "A category ",
	'is_a' => null, // Does NOT inherit from dm_object!
	'has_attachments' => false, // 'has_attachments' defines the number of allowed cmfive attachments for a node of this type
	'has_comments' => false,
	
	// definition of associations
	'associations' => array(
	
		'dm_subcategories' => array(
			// the source definition describes 'this' side of the association
			'source' => array(
				'many' => true, 
				'mandatory' => false, 
			),
			// the target definition describes the 'other' side of the association
			'target' => array(
				'many' => true, 
				'mandatory' => false, 
				'type' => 'dm_category', 
			),
			'is_child_association' => false, // this way deletes do not traverse from the parent to the children!
			'allow_duplicates' => false, // a folder cannot have duplicate children
		),
	),
	
	
	// these aspects are automatically added to any node with this type
	'mandatory_aspects' => array(
		'dm_has_description',
		'dm_has_title',
	),
	
));

/***********************************************************************************************************
 * Definition of basic aspects
***********************************************************************************************************/

/**
 * Aspect Has Title
 */
Config::set ( 'document.aspects.dm_has_title', array (
		
	'title' => "Has Title",
	'comment' => "Adds a title to any node with this aspect",
	'is_a' => null, // does not inherit from other aspects
	
	'properties' => array (
		'dm_title' => array (
			'title' => "Title",
			'type' => 'shorttext', // may be mapped to VARCHAR(1024) in the database, see DmNodeProperty
			'mandatory' => false,
			'read_only' => false 
		) 
	) 
) );

/**
 * Aspect Has Description
 */
Config::set ( 'document.aspects.dm_has_description', array (
		
	'title' => "Has Description",
	'comment' => "Adds a descriptive long text to any node with this aspect",
	'is_a' => null, // does not inherit from other aspects
	
	'properties' => array (
		'dm_description' => array (
			'title' => "Description",
			'type' => 'longtext', // may be mapped to LONGTEXT in the database, see DmNodeProperty
			'mandatory' => false,
			'read_only' => false 
		) 
	) 
) );

/**
 * Aspect Classifiable
 */
Config::set ('document.aspects.dm_classifiable', array (
	
	'title' => "Classifiable",
	'comment' => "Enables a node to be associated with one or many categories",
	'is_a' => null, // does not inherit from other aspects
	
	'associations' => array(
		'dm_categories' => array(
			'source' => array(
				'many' => true,
				'mandatory' => false,
			),
			'target' => array(
				'many' => true,
				'mandatory' => false,
				'type' => 'dm_category',
			),
		),
	),
));