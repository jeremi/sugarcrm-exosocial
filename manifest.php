<?php
$manifest = array(
'acceptable_sugar_flavors' => array(
'CE',
'PRO',
'ENT',
),
'acceptable_sugar_versions' => array(
'6.0',
),
'is_uninstallable' => true,
'name' => 'eXo Social Plugin',
'description' => 'Connector for eXo Platform',
'author' => 'Jeremi Joslin - eXo',
'published_date' => '2010/06/01',
'version' => '1.0',
'type' => 'module',
'icon' => '',
);
 
$installdefs = array (
    'id' => 'ext_rest_spaces',
    'connectors' => array (
        array (
            'connector' => '<basepath>/spaces/source',
            'formatter' => '<basepath>/spaces/formatter',
            'name' => 'ext_rest_spaces',
        ),
    ),
    'logic_hooks'	=> array(
        array(
			'module'		=> 'Cases',
			'hook'		 	=> 'after_save',
		    'order'			=> 42,
			'description'	=> 'eXo Spaces',
			'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
			'class'			=> 'PublishActivity',
			'function'		=> 'postUpdate',
		),
		array(
			'module'		=> 'Bugs',
			'hook'		 	=> 'after_save',
		    'order'			=> 42,
			'description'	=> 'eXo Spaces',
			'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
			'class'			=> 'PublishActivity',
			'function'		=> 'postUpdate',
		),
		array(
			'module'		=> 'Calls',
			'hook'		 	=> 'after_save',
		    'order'			=> 42,
			'description'	=> 'eXo Spaces',
			'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
			'class'			=> 'PublishActivity',
			'function'		=> 'postUpdate',
		),
		array(
			'module'		=> 'Emails',
			'hook'		 	=> 'after_save',
		    'order'			=> 42,
			'description'	=> 'eXo Spaces',
			'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
			'class'			=> 'PublishActivity',
			'function'		=> 'postUpdate',
		),
    	array(
    		'module'		=> 'Meetings',
    		'hook'		 	=> 'after_save',
    	    'order'			=> 42,
    		'description'	=> 'eXo Spaces',
    		'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
    		'class'			=> 'PublishActivity',
    		'function'		=> 'postUpdate',
    	),
    	array(
    		'module'		=> 'Notes',
    		'hook'		 	=> 'after_save',
    	    'order'			=> 42,
    		'description'	=> 'eXo Spaces',
    		'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
    		'class'			=> 'PublishActivity',
    		'function'		=> 'postUpdate',
    	),
    	array(
    		'module'		=> 'Tasks',
    		'hook'		 	=> 'after_save',
    	    'order'			=> 42,
    		'description'	=> 'eXo Spaces',
    		'file'			=> 'custom/modules/Connectors/connectors/sources/ext/rest/spaces/publish_activity.php',
    		'class'			=> 'PublishActivity',
    		'function'		=> 'postUpdate',
    	),
	),
 
);
 
?>