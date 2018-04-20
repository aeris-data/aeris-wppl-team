<?php 
/**
* Plugin Name: Aeris Team Manager
* Plugin URI : https://github.com/sedoo/sedoo-wppl-docmanager
* Description: Plugin pour gérer les membres et les équipes
* Author: Pierre VERT
* Version: 0.2.0
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
//---------------------------------------------------------------------------------------------------------------------------------------------------------
    /**
     * FLUSH REWRITE RULE
     * 
     * !!! WARNING !!! SEULEMENT à L'ACTIVATION/DESACTIVATION DU PLUGIN !!!
     * 
     * source : https://codex.wordpress.org/Function_Reference/flush_rewrite_rules
     */

        register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
        register_activation_hook( __FILE__, 'aeris_team_manager_flush_rewrites' );
        function aeris_team_manager_flush_rewrites() {
        // call your CPT registration function here (it should also be hooked into 'init')
        aeris_team_manager_cpt();
        flush_rewrite_rules();
        }   

//---------------------------------------------------------------------------------------------------------------------------------------------------------
        // LOAD ACF CONFIG FILE & custom functions for ACF
        require_once 'inc/acf-config.php';

        // LOAD CSS & SCRIPTS
        function aeris_team_manager_scripts() {
            wp_register_style( 'prefix-style', plugins_url('css/aeris-team-manager.css', __FILE__) );
            wp_enqueue_style( 'prefix-style' );
        }
        add_action('wp_enqueue_scripts','aeris_team_manager_scripts');

//---------------------------------------------------------------------------------------------------------------------------------------------------------
        /**
         * CREATE CUSTOM MENU
         * 
         * source : http://imtiazrayhan.com/multiple-custom-post-types-menu-section/
         */
        /*
        * Adding a menu to contain the custom post types for frontpage
        */

        function aeris_team_manager_admin_menu() {
        
            add_menu_page(
                'Teams manager',
                'Teams manager',
                'read',
                'aeris_team_manager_admin_menu',
                '',
                'dashicons-groups',
                20
            );        
        }        
        add_action( 'admin_menu', 'aeris_team_manager_admin_menu' );

//---------------------------------------------------------------------------------------------------------------------------------------------------------
        /** 
        * Création des custom post type (cpt)
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
                        'all_items' => 'Gérer les équipes',
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
                    // Show in this admin menu
                    'show_in_menu' => 'aeris_team_manager_admin_menu',
                    // rewrite URL 
                    'rewrite' => array( 'slug' => 'teams' ),	
                    'supports' => array(			
                        'title',
                        'editor'	
                    ),
                    'has_archive' => true, 
                    // Url vers une icone ou à choisir parmi celles de WP : https://developer.wordpress.org/resource/dashicons/.
                    'menu_icon'   => 'dashicons-groups',
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
                        'all_items' => 'Gérer les membres',
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
                    // Show in this admin menu
                    'show_in_menu' => 'aeris_team_manager_admin_menu',
                    // rewrite URL 
                    'rewrite' => array( 'slug' => 'members' ),
                    // 'supports' => array(			
                        // 'title',
                        // 'author',
                        // 'editor'	
                    // ),
                    'supports' => false,
                    'has_archive' => true, 
                    // Url vers une icone ou à choisir parmi celles de WP : https://developer.wordpress.org/resource/dashicons/.
                    'menu_icon'   => 'dashicons-admin-users',
                ) 
            );
        }

//---------------------------------------------------------------------------------------------------------------------------------------------------------
        /*
        * REGISTER TPL SINGLE TEAM
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
        

//---------------------------------------------------------------------------------------------------------------------------------------------------------    
    } // end test plugin ACF

}
add_action('plugins_loaded', 'aeris_team_manager_plugin_init');

?>