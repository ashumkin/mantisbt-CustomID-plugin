<?php
auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

html_page_top( lang_get( 'plugin_format_title' ) );

print_manage_menu( );

?>

<br/>

<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">
<?php echo form_security_field( 'plugin_CustomID_config_update' ) ?>
<table align="center" class="width75" cellspacing="1">
<tr>
	<td class="form-title" colspan="3">
		<?php echo plugin_lang_get( 'plugin_title' ) . ': ' . plugin_lang_get( 'config' ) ?>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'project_name' ) ?>
	</td>
	<td width="20%">
		<select name="customid_project_id">
			<option value="0" selected="selected"><?php echo lang_get( 'all_projects' ); ?></option>
			<?php print_project_option_list( plugin_config_get('project_id'), false ) ?>
		</select>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo lang_get( 'custom_field' ) ?>
	</td>
	<td width="20%">
		<select name="customid_field_id">
			<?php
				$t_custom_fields = custom_field_get_ids();

				foreach( $t_custom_fields as $t_field_id )
				{
					$t_desc = custom_field_get_definition( $t_field_id );
					echo "<option value=\"$t_field_id\"";
					check_selected($t_field_id, plugin_config_get('field_id') );
					echo ">" . string_attribute( $t_desc['name'] ) . '</option>' ;
				}
			?>
		</select>
	</td>
</tr>

<tr <?php echo helper_alternate_class() ?> >
	<td class="category" width="60%">
		<?php echo plugin_lang_get( 'config_prefix' ) ?>
	</td>
	<td width="20%">
		<input name="customid_prefix" size="30" value="<?php echo plugin_config_get('prefix') ?>">
	</td>
</tr>

<tr>
	<td class="center" colspan="2">
		<input type="submit" class="button" value="<?php echo plugin_lang_get( 'update_config' ) ?>" />
	</td>
</tr>
</table>

</form>

<?php
html_page_bottom();