<?php 
/**
* Plugin Name: Aeris Team Manager
* Plugin URI : https://github.com/sedoo/sedoo-wppl-docmanager
* Description: Plugin pour gérer les membres et les équipes
* Author: Pierre VERT
* Version: 0.1.0
* GitHub Plugin URI: aeris-data/aeris-wppl-team-manager
* GitHub Branch:     master
*/

include 'inc/commons.php';

function aeris_team_manager_plugin_init(){

    /* Gestion de la dépendance de ACF */
	if ( ! function_exists('get_field') && current_user_can( 'activate_plugins' ) ) {
        
        add_action( 'admin_init', 'sb_plugin_deactivate');
        add_action( 'admin_notices', 'sb_plugin_admin_notice');

        //Désactiver le plugin
        function sb_plugin_deactivate () {
            deactivate_plugins( plugin_basename( __FILE__ ) );
        }
        
        // Alerter pour expliquer pourquoi il ne s'est pas activé
        function sb_plugin_admin_notice () {
            
            echo '<div class="error">Le plugin "Aeris Team Member" requiert ACF Pro pour fonctionner <br><strong>Activez ACF Pro ci-dessous</strong> ou <a href=https://wordpress.org/plugins/advanced-custom-fields/> Téléchargez ACF Pro &raquo;</a><br></div>';

            if ( isset( $_GET['activate'] ) ) 
                unset( $_GET['activate'] );	
        }

    } else {
    // Le plugin est activé 
    
    // FLUSH REWRITE RULE !!! SEULEMENT à L'ACTIVATION/DESACTIVATION DU PLUGIN


    require_once 'inc/acf-config.php';
        /** 
        * Création du custom post type (cpt)
        */
        add_action('init', 'aeris_team_manager_cpt');
        function aeris_team_manager_cpt() {

            // CPT EQUIPE
            register_post_type( 
                'aeris-team', 							
                array(
                    'label' => 'Equipe', 			
                    'labels' => array(    			
                        'name' => 'Equipes',
                        'singular-name' => 'équipe',
                        'all_items' => 'Toutes les équipes',
                        'add_new_item' => 'Ajouter une équipe',
                        'edit_item' => 'Editer l\'équipe',
                        'new_item' => 'Nouveau équipe',
                        'view_item' => 'Voir l\'équipe',
                        'search_item' => 'Rechercher parmis les équipes',
                        'not_found' => 'Pas d\'équipe trouvé',
                        'not_found_in_trash' => 'Pas d\'équipe dans la corbeille'
                    ),
                    'public' => true, 				
                    'show_in_rest' => true,         
                    'capability_type' => 'post',	
                    'supports' => array(			
                        'title',
                        // 'author',
                        'editor'	
                    ),
                    'has_archive' => true, 
                    // Url vers une icone ou à choisir parmi celles de WP : https://developer.wordpress.org/resource/dashicons/.
                    'menu_icon'   => 'dashicons-networking',
                ) 
            );

            // MEMBRES
            register_post_type( 
                'aeris-member', 							
                array(
                    'label' => 'Membre', 			
                    'labels' => array(    			
                        'name' => 'Membres',
                        'singular-name' => 'membre',
                        'all_items' => 'Tous les membres',
                        'add_new_item' => 'Ajouter un membre',
                        'edit_item' => 'Editer le membre',
                        'new_item' => 'Nouveau membre',
                        'view_item' => 'Voir le membre',
                        'search_item' => 'Rechercher parmis les membres',
                        'not_found' => 'Pas de membre trouvé',
                        'not_found_in_trash' => 'Pas de membre dans la corbeille'
                    ),
                    'public' => true, 				
                    'show_in_rest' => true,         
                    'capability_type' => 'post',	
                    'supports' => array(			
                        'title',
                        // 'author',
                        'editor'	
                    ),
                    'has_archive' => true, 
                    // Url vers une icone ou à choisir parmi celles de WP : https://developer.wordpress.org/resource/dashicons/.
                    'menu_icon'   => 'dashicons-admin-users',
                ) 
            );
        }

        /******************************************************************
        * CUSTOM TAXONOMIES 
        */

        //add_action('init', 'aeris_team_manager_taxonomies');
        function aeris_team_manager_taxonomies()
        {
            
            /*** 
            *  TAXONOMIE Equipe
            */
            
            $labels_type = array(
                'name' => 'Equipes',
                'singular_name' => 'Equipe',
                'all_items' => 'Toutes les Equipes',
                'edit_item' => 'Éditer l\'équipe',
                'view_item' => 'Voir l\'équipe',
                'update_item' => 'Mettre à jour l\'équipe',
                'add_new_item' => 'Ajouter une équipe',
                'new_item_name' => 'Nouveau équipe',
                'search_items' => 'Rechercher parmi les Equipes',
                'popular_items' => 'Equipes les plus utilisées',
            );
            
            $args_type = array (
                'label' => 'équipe',
                'labels' => $labels_type,
                'hierarchical' => true,
        //        'show_admin_column' => false,
        //        'show_in_nav_menus' => false,
        //        'show_tagcloud' => false,
                'show_ui' => true
            );

            register_taxonomy('aeris-team', array('aeris-member'), $args_type);

            // register_taxonomy_for_object_type( 'aeris-team', 'document' );
        }

        /*
        * REGISTER TPL SINGLE MEMBER
        */
        add_filter ( 'single_template', 'aeris_team_manager_single' );
        function aeris_team_manager_single($single_template) {
            global $post;
            
            if ($post->post_type == 'aeris-team') {
                $single_template = plugin_dir_path ( __FILE__ ) . 'single-aeris-team.php';
            }
            return $single_template;
        }

        /*
        * REGISTER TPL SINGLE MEMBER
        */
        add_filter ( 'single_template', 'aeris_member_manager_single' );
        function aeris_member_manager_single($single_template) {
            global $post;
            
            if ($post->post_type == 'aeris-member') {
                $single_template = plugin_dir_path ( __FILE__ ) . 'single-aeris-member.php';
            }
            return $single_template;
        }
        

    
    } // end test plugin ACF

}
add_action('plugins_loaded', 'aeris_team_manager_plugin_init');
?>