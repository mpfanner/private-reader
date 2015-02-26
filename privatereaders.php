<?php
/**
 * @package Private_Readers
 * @version 0.2
 */
/*
Plugin Name: Private Readers
Plugin URI: http://c3.co
Description: This plugin is mainly a support for professional wordpress users in an environment where a professional agency creates content for a customer.<br>In this scenario you want to give your customer an option to have a look at the article while unable to break anything.<br>This plugin makes this possible: as soon as you activate it, private posts are visible to all logged in users, independent of all other rights. You do not want that privilege to be available to the lower levels? No problem, just deactivate the plugin and it will clear out the user rights!
Author: Martin Pfanner
Version: 0.2
Author URI: http://c3.co
*/

/**
 * This line of code defines a constant to make the plugin file available
 * @var unknown
 */
define( 'MM_PLUGIN_FILE', __FILE__ );

/**
 * This function provides the main "magic" of the plugin:
 * Here we change the standard user rights settings by adding 
 * the "read_private_posts" capability to the lower roles.
 */
function pr_set_rights() {

	//provide an array to collect the role objects
	$roles = array();
	// gets the author role
	$roles[] = get_role( 'author' );
	// gets the contributor role
	$roles[] = get_role( 'contributor' );
	// gets the subscriber role
	$roles[] = get_role( 'subscriber' );
	
	// adds the right to read private posts to each selected role
	foreach ($roles as $role) {
		$role->add_cap( 'read_private_posts' );
	}
	
} // pr_set_rights END

/**
 * This function undoes the main "magic" of the plugin:
 * Here we restore the standard user rights settings by removing 
 * the "read_private_posts" capability from the lower roles.
 */
function pr_remove_rights() {
	
	//provide an array to collect the role objects
	$roles = array();
	// gets the author role
	$roles[] = get_role( 'author' );
	// gets the contributor role
	$roles[] = get_role( 'contributor' );
	// gets the subscriber role
	$roles[] = get_role( 'subscriber' );
	
	
	// removes the right to read private posts from each selected role
	foreach ($roles as $role) {
		$role->remove_cap( 'read_private_posts' );
	}
	
	
} // pr_remove_rights END

/**
 * This line of codes activates the function that sets the necessary rights
 * This happens when the plugin is activated
 */
register_activation_hook( MM_PLUGIN_FILE, 'pr_set_rights' );

/**
 * This line of codes activates the function that removes the necessary rights
 * This happens when the plugin is deactivated
 */
register_deactivation_hook( MM_PLUGIN_FILE, 'pr_remove_rights' );

 ?>