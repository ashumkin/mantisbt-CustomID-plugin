<?php 

auth_reauthenticate();
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_project_id			= gpc_get_int('customid_project_id',0);
$f_field_id		= gpc_get_int('customid_field_id',2);
$f_prefix			= gpc_get_string('customid_prefix','');
        
plugin_config_set('project_id'			, $f_project_id);	
plugin_config_set('field_id'		, $f_field_id);	
plugin_config_set('prefix'				, $f_prefix);	

print_successful_redirect( plugin_page( 'config_page',TRUE ) );