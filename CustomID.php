<?php

class CustomIDPlugin extends MantisPlugin {
	function register() {
		$this->name = 'Custom ID Plugin';    # Proper name of plugin
		$this->description = 'Allows to display the contents of a custom field instead of the issue ID';    # Short description of the plugin
		$this->page = 'config_page';           # Default plugin page

		$this->version = '0.2';     # Plugin version string
		$this->requires = array(    # Plugin dependencies, array of basename => version pairs
            'MantisCore' => '1.2',  #   Should always depend on an appropriate version of MantisBT
		);

		$this->author = 'GTZ Ethiopia ICT Service - Development Team';         # Author/team name
		$this->contact = 'ict-et@gtz.de';        # Author/team e-mail address
		$this->url = '';            # Support webpage
	}

	function hooks() {
		return array(
            'EVENT_DISPLAY_BUG_ID' => 'display_bug_id'
		);
	}
	
	
    function config() {
        return array(
            'project_id' => 0,
        	'field_id' => 0,
        	'prefix' => "",
        );
    }
	
    
    
	function display_bug_id($p_event, $p_text) {
		$p_bug_id = (int)$p_text;
		
		$bug = bug_get($p_bug_id);
		$project = $bug->__get("project_id");
		
		if ($project != plugin_config_get('project_id'))
			return $p_text;
		
		$p_field_id = plugin_config_get('field_id');
		$prefix = plugin_config_get('prefix');
		
		$t_custom_field_value = custom_field_get_value( $p_field_id, $p_bug_id );
		global $g_custom_field_type_definition;
		if( isset( $g_custom_field_type_definition[$p_def['type']]['#function_string_value'] ) ) {
			return $prefix.call_user_func( $g_custom_field_type_definition[$p_def['type']]['#function_string_value'], $t_custom_field_value );
		}
		return $prefix.$t_custom_field_value;
		
	}

	// todo: remove jump to field for such projects!
}

