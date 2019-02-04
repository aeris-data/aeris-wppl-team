<?php
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array (
        'key' => 'group_5acdbb4075390',
        'title' => __('Team', 'aeris-wppl-team-manager'),
        'fields' => array (
            array (
                'key' => 'field_5acdc41010911',
                'label' => __('Logo', 'aeris-wppl-team-manager'),
                'name' => 'logo',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_5b0c146276dbe',
                'label' => __('Display', 'aeris-wppl-team-manager'),
                'name' => 'showmetheboss',
                'type' => 'checkbox',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'showmetheboss' => __('Show the manager first, on an independent line', 'aeris-wppl-team-manager'),
                ),
                'allow_custom' => 0,
                'save_custom' => 0,
                'default_value' => array (
                ),
                'layout' => 'vertical',
                'toggle' => 0,
                'return_format' => 'value',
            ),
            array (
                'key' => 'field_5acdbb70a7637',
                'label' => __('Members', 'aeris-wppl-team-manager'),
                'name' => 'aeris_team_manager_bidirectionnal_relation',
                'type' => 'relationship',
                'instructions' => __('The 1st member of the list will be considered as manager for the team', 'aeris-wppl-team-manager'),
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array (
                    0 => 'aeris-member',
                ),
                'taxonomy' => array (
                ),
                'filters' => array (
                    0 => 'search',
                    1 => 'post_type',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'aeris-team',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    
    acf_add_local_field_group(array (
        'key' => 'group_5acdbc3ae71a8',
        'title' => 'Membre',
        'fields' => array (
            array (
                'key' => 'field_5ad9f2879041b',
                'label' => __('Name', 'aeris-wppl-team-manager'),
                'name' => 'lastname',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5acdc21ff0a0f',
                'label' => __('Firstname', 'aeris-wppl-team-manager'),
                'name' => 'firstname',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_5acdc0d4cbe12',
                'label' => __('Photo', 'aeris-wppl-team-manager'),
                'name' => 'photo',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_5acdc027db83d',
                'label' => __('Email', 'aeris-wppl-team-manager'),
                'name' => 'mail',
                'type' => 'email',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array (
                'key' => 'field_5acdc047db83e',
                'label' => __('Phone', 'aeris-wppl-team-manager'),
                'name' => 'tel',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        	// @epointal add field organism, url organism and page perso
        	array(
        		'key' => 'field_5bf517aeff620',
        		'label' =>  __('Organization', 'aeris-wppl-team-manager'),
        		'name' => 'organism',
        		'type' => 'text',
        		'instructions' => '',
        		'required' => 0,
        		'conditional_logic' => 0,
        		'wrapper' => array(
        			'width' => '',
        			'class' => '',
        			'id' => '',
        		),
        		'default_value' => '',
        		'placeholder' => '',
        		'prepend' => '',
        		'append' => '',
        		'maxlength' => '',
        	),
        	array(
        		'key' => 'field_5bf5181aff622',
        		'label' =>	__('Organization url', 'aeris-wppl-team-manager'),
        		'name' => 'url_organism',
        		'type' => 'url',
        		'instructions' => '',
        		'required' => 0,
        		'conditional_logic' => array(
        			array(
        				array(
        					'field' => 'field_5bf517aeff620',
        					'operator' => '!=empty',
        				),
        			),
        		),
        		'wrapper' => array(
        			'width' => '',
        			'class' => '',
        			'id' => '',
        		),
        		'default_value' => '',
        		'placeholder' => '',
        	),
        	array(
        		'key' => 'field_5bf5195939c8d',
        		'label' => 'Page perso',
        		'name' => 'page_perso',
        		'type' => 'url',
        		'instructions' => '',
        		'required' => 0,
        		'conditional_logic' => 0,
        		'wrapper' => array(
        			'width' => '',
        			'class' => '',
        			'id' => '',
        		),
        		'default_value' => '',
        		'placeholder' => '',
        	),
        	// end @epointal ajout
            array (
                'key' => 'field_5acdbc42db83a',
                'label' => __('Teams', 'aeris-wppl-team-manager'),
                'name' => 'aeris_team_manager_bidirectionnal_relation',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array (
                    0 => 'aeris-team',
                ),
                'taxonomy' => array (
                ),
                'filters' => array (
                    0 => 'search',
                    1 => 'post_type',
                    2 => 'taxonomy',
                ),
                'elements' => '',
                'min' => '',
                'max' => '',
                'return_format' => 'object',
            ),
            array (
                'key' => 'field_5acdbc64db83b',
                'label' => __('Position / Fonction', 'aeris-wppl-team-manager'),
                'name' => 'fonction',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'aeris-member',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array (
            0 => 'the_content',
            1 => 'excerpt',
            2 => 'custom_fields',
            3 => 'discussion',
            4 => 'comments',
            5 => 'revisions',
            6 => 'author',
            7 => 'format',
            8 => 'page_attributes',
            9 => 'featured_image',
            10 => 'categories',
            11 => 'tags',
            12 => 'send-trackbacks',
        ),
        'active' => 1,
        'description' => '',
    ));
    
    endif;

/**
 * BIDIRECTIONNAL RELATIONSHIP
 * source : https://www.advancedcustomfields.com/resources/bidirectional-relationships/
 * 
 * 
 */

function aeris_team_manager_bidirectional_acf_update_value( $value, $post_id, $field  ) {
	
	// vars
	$field_name = $field['name'];
	$field_key = $field['key'];
	$global_name = 'is_updating_' . $field_name;
		
	// bail early if this filter was triggered from the update_field() function called within the loop below
	// - this prevents an inifinte loop
	if( !empty($GLOBALS[ $global_name ]) ) return $value;	
	
	// set global variable to avoid inifite loop
	// - could also remove_filter() then add_filter() again, but this is simpler
	$GLOBALS[ $global_name ] = 1;	
	
	// loop over selected posts and add this $post_id
	if( is_array($value) ) {
	
		foreach( $value as $post_id2 ) {
			
			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);			
			
			// allow for selected posts to not contain a value
			if( empty($value2) ) {				
				$value2 = array();				
			}
			
			// bail early if the current $post_id is already found in selected post's $value2
			if( in_array($post_id, $value2) ) continue;			
			
			// append the current $post_id to the selected post's 'related_posts' value
			$value2[] = $post_id;			
			
			// update the selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);			
		}
	}
	
	// find posts which have been removed
	$old_value = get_field($field_name, $post_id, false);
	
	if( is_array($old_value) ) {
		
		foreach( $old_value as $post_id2 ) {
			
			// bail early if this value has not been removed
			if( is_array($value) && in_array($post_id2, $value) ) continue;
			
			// load existing related posts
			$value2 = get_field($field_name, $post_id2, false);			
			
			// bail early if no value
			if( empty($value2) ) continue;			
			
			// find the position of $post_id within $value2 so we can remove it
			$pos = array_search($post_id, $value2);			
			
			// remove
			unset( $value2[ $pos] );			
			
			// update the un-selected post's value (use field's key for performance)
			update_field($field_key, $value2, $post_id2);			
		}		
	}
	// reset global varibale to allow this filter to function as per normal
	$GLOBALS[ $global_name ] = 0;
	
	// return
    return $value;
    
}
// name : id 
add_filter('acf/update_value/name=aeris_team_manager_bidirectionnal_relation', 'aeris_team_manager_bidirectional_acf_update_value', 10, 3);


/**
 * AUTO ADD & UPDATE TITLE POST WITH ACF FIELD
 * changer le title du post par le champ "lastname" pour les membres
 * 
 * source : https://support.advancedcustomfields.com/forums/topic/use-acf-field-to-create-post-title/
 */

//Auto add and update Title field:
function aeris_team_manager_title_updater( $post_id ) {

    $my_post = array();
    $my_post['ID'] = $post_id;

    if ( get_post_type() == 'aeris-member' ) {
      $my_post['post_title'] = get_field('lastname')." ".get_field('firstname');
      $my_post['post_name'] = get_field('lastname');
    } 

    // Update the post into the database
    wp_update_post( $my_post );

  }
   
  // run after ACF saves the $_POST['fields'] data
  add_action('acf/save_post', 'aeris_team_manager_title_updater', 20);
//END Auto add and update Title field:

?>