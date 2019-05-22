<?php 
/**
* Plugin Name: Aeris Team Manager
* Plugin URI : https://github.com/sedoo/sedoo-wppl-docmanager
* Description: Plugin pour gérer les membres et les équipes
* Text Domain: aeris-wppl-team-manager
* Domain Path: /languages
* Author: Pierre VERT & Elisabeth Pointal
* Version: 1.1.1
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
        /* 
        * LOAD TEXT DOMAIN FOR TEXT TRANSLATIONS
        */

        function aeris_team_manager_load_plugin_textdomain() {
            $domain = 'aeris-wppl-team-manager';
            $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
            // wp-content/languages/plugin-name/plugin-name-fr_FR.mo
            load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
            // wp-content/plugins/plugin-name/languages/plugin-name-fr_FR.mo
            load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
           
        }
        add_action( 'init', 'aeris_team_manager_load_plugin_textdomain' );

//---------------------------------------------------------------------------------------------------------------------------------------------------------
        // LOAD ACF CONFIG FILE & custom functions for ACF
        function load_acf_config() {
           require_once 'inc/acf-config.php';
        }
        add_action('init', 'load_acf_config');

        // LOAD CSS & SCRIPTS 
        function aeris_team_manager_scripts() {
            wp_register_style( 'prefix-style', plugins_url('css/aeris-team-manager.css', __FILE__) );
            wp_enqueue_style( 'prefix-style' );
        }
        add_action('wp_enqueue_scripts','aeris_team_manager_scripts');
        
        // @author epointal
        // LOAD CSS & SCRIPTS FOR GUTENBERG EDITOR
        function gutenberg_enqueue_block_editor_assets() {
        	wp_enqueue_script(
        			'aeris-team-block-js', // Unique handle.
        			plugins_url('js/team-block.js', __FILE__),
        			array( 'wp-blocks', 'wp-i18n', 'wp-element' )
        			);
        	// write teams list for js script
        	wp_localize_script( 'aeris-team-block-js', 'aerisTeamOptions', get_teams_options() );
        	
        }
        add_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets');

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
                    'label' => __('Team', 'aeris-wppl-team-manager'), 			
                    'labels' => array(    			
                        'name' => __('Teams', 'aeris-wppl-team-manager'),
                        'singular-name' => __('Team', 'aeris-wppl-team-manager'),
                        'all_items' => __('Manage teams', 'aeris-wppl-team-manager'),
                        'add_new_item' => __('Add team', 'aeris-wppl-team-manager'),
                        'edit_item' => __('Edit team', 'aeris-wppl-team-manager'),
                        'new_item' => __('New team', 'aeris-wppl-team-manager'),
                        'view_item' => __('See team', 'aeris-wppl-team-manager'),
                        'search_item' => __('Search team', 'aeris-wppl-team-manager'),
                        'not_found' => __('No team found', 'aeris-wppl-team-manager'),
                        'not_found_in_trash' => __('No team found in trash', 'aeris-wppl-team-manager')
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
                    'label' => __('Member', 'aeris-wppl-team-manager'), 			
                    'labels' => array(    			
                        'name' => __('Members', 'aeris-wppl-team-manager'),
                        'singular-name' => __('Member', 'aeris-wppl-team-manager'),
                        'all_items' => __('Manage members', 'aeris-wppl-team-manager'),
                        'add_new_item' => __('Add member', 'aeris-wppl-team-manager'),
                        'edit_item' => __('Edit member', 'aeris-wppl-team-manager'),
                        'new_item' => __('New member', 'aeris-wppl-team-manager'),
                        'view_item' => __('See member', 'aeris-wppl-team-manager'),
                        'search_item' => __('Search member', 'aeris-wppl-team-manager'),
                        'not_found' => __('No member found', 'aeris-wppl-team-manager'),
                        'not_found_in_trash' => __('No member found in trash', 'aeris-wppl-team-manager')
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
        /* Add image size for team logo
        * https://developer.wordpress.org/reference/functions/add_image_size/
        */
        function aeris_team_manager_images_setup() {
            add_image_size( 'team-logo', 200, 200, false );
            add_image_size( 'member-photo', 150, 150, true );

        }
        add_action( 'after_setup_theme', 'aeris_team_manager_images_setup' );
//--------------------------------------------------------------------------------------------------------------------------------
      /**
       * SEARCH TEAMS 
       ***************/
        
        /* @author epointal
         * Return  array of teams 
         * ie array of couple (value, label) where value is the ID, and label the name of team
         */
        function get_teams_options () {
        	$args = array( 'post_type' => 'aeris-team', 'posts_per_page' => 200 , 'order' => 'desc');
        	$teams = new WP_Query( $args );
        	$values = array();
        	foreach($teams->posts as $post){
        		array_push($values, array('value' => $post->ID, 'label' =>$post->post_title));
        	}
        	return $values;
        }
  
//---------------------------------------------------------------------------------------------------------------------------------------------------------
        /****************************************************************************************************
        * SHORTCODES
        */

        function aeris_team_manager_register_shortcodes(){
            add_shortcode('aeris_team', 'aeris_team_manager_team_shortcode');
            add_shortcode('aeris_member', 'aeris_team_manager_member_shortcode');
            
            // @author epointal
            // Gutenberg team block like <!-- wp:aeris-wppl-team/team-block {"id":607} /-->
            // is interpreted like [aeris_team id=607]
            if (function_exists('register_block_type')) {
            	register_block_type( 'aeris-wppl-team/team-block', array(
            			'render_callback' => 'aeris_team_manager_team_shortcode'
            	) );
            }
        }

        /*************************************************************************
        * SHORTCODE FOR INSERT TEAM
        */

        // Team Shortcode output
        function aeris_team_manager_team_shortcode($atts) {
            global $post;
            $atts = shortcode_atts([
                'id' => null,
            ], $atts, 'aeris_team');

            if (!$atts['id']) {
                return;
            }
            $_post = get_post($atts['id']);
            if (!$_post || 'publish' !== $_post->post_status) {
                return;
            }
            $post = $_post;
            setup_postdata($post);

            ob_start();
            ?>
            <div class="aeris_team_manager_shortcode_team_display">
                <h2><?php the_title();?></h2>
            <?php
            include( 'template-parts/aeris-team-showteam.php' );
            ?>
            </div>
            <?php
            $out = ob_get_clean();
            wp_reset_postdata();

            return $out;
        }

       
 
        /** ********************************************************************
         * 
         * Show Team Shortcode in admin page
        */

        /** *******************************************
         * 1 . Ajout de la colonne Shortcode pour les CPT aeris-team
         * 
         */

        function aeris_team_manager_team_shortcode_columns($column) {
            $column['shortcode'] = 'Shortcode';
            return $column;
        }
        add_filter('manage_aeris-team_posts_columns', 'aeris_team_manager_team_shortcode_columns');
    
        /** ********************************************************************
         * 2 . Html à afficher dans les lignes de la colonne Shortcode 
         * pour les CPT aeris-team 
         */
        function aeris_team_manager_team_shortcode_rows($column, $post_id) {
            switch ($column) {
                    case 'shortcode':
                        echo "[aeris_team id=" . $post_id . "]";                                                    
                        break;
                    default:
                        break;
            }
        }
        add_action('manage_aeris-team_posts_custom_column', 'aeris_team_manager_team_shortcode_rows', 10, 2);

        /**
         * 3 . Adds a box to the main column on the Aeris-team edit screens.
         */
        function aeris_team_manager_team_shortcode_metabox() {
            add_meta_box(
                'aeris_team_manager_team_metabox_id',
                __('Shortcode integration', 'aeris-wppl-team-manager'),
                'aeris_team_manager_team_shortcode_metabox_callback', 'aeris-team', 'side'
            );
        }
        add_action('add_meta_boxes', 'aeris_team_manager_team_shortcode_metabox');
        
        /**
         * 4 . Render meta box content for CPT aeris-team
         */
        function aeris_team_manager_team_shortcode_metabox_callback($post) {
            echo '<p style="font-size:1.5rem;color:#4765a0;">[aeris_team id="' . $post->ID . '"]</p>';
        }


        /*************************************************************************
        * SHORTCODE FOR INSERT MEMBER
        */

        // Member Shortcode output **********************************
        function aeris_team_manager_member_shortcode($atts) {
            global $post;
            $atts = shortcode_atts([
                'id' => null,
            ], $atts, 'aeris_member');

            if (!$atts['id']) {
                return;
            }
            $_post = get_post($atts['id']);
            if (!$_post || 'publish' !== $_post->post_status) {
                return;
            }
            $post = $_post;
            setup_postdata($post);

            ob_start();
            ?>
            <div class="aeris_team_manager_shortcode_member_display">

            <?php
            include( 'template-parts/aeris-team-showmember.php' );
            ?>
            </div>
            <?php
            $out = ob_get_clean();
            wp_reset_postdata();
            return $out;
        }

        // hook in wordpress
        add_action( 'init', 'aeris_team_manager_register_shortcodes');

        /** ********************************************************************
         * 
         * Show Member Shortcode in admin page
        */

        /** *******************************************
         * 1 . Ajout de la colonne Shortcode pour les CPT aeris-member
         * 
         */
        function aeris_team_manager_member_shortcode_columns($column) {
            $column['shortcode'] = 'Shortcode';
            return $column;
        }
        add_filter('manage_aeris-member_posts_columns', 'aeris_team_manager_member_shortcode_columns');
    
        /** *******************************************
         * 2 . Html à afficher dans les lignes de la colonne Shortcode 
         * pour les CPT aeris-member 
         */

        function aeris_team_manager_member_shortcode_rows($column, $post_id) {
            switch ($column) {
                    case 'shortcode':
                        echo "[aeris_member id=" . $post_id . "]";                                                    
                        break;
                    default:
                        break;
            }
        }
        add_action('manage_aeris-member_posts_custom_column', 'aeris_team_manager_member_shortcode_rows', 10, 2);

        /** ********************************************************************
         * 3 . Adds a box to the main column on the 
         * aeris-member edit screens.
         */
        function aeris_team_manager_member_shortcode_metabox() {
            add_meta_box(
                'aeris_team_manager_member_metabox_id',
                __('Shortcode integration', 'aeris-wppl-team-manager'),
                'aeris_team_manager_member_shortcode_metabox_callback', 'aeris-member', 'side'
            );
        }
        add_action('add_meta_boxes', 'aeris_team_manager_member_shortcode_metabox');
        
        /** ******************************************
         * 4 . Render meta box content for CPT aeris-member
         */
        function aeris_team_manager_member_shortcode_metabox_callback($post) {
            echo '<p style="font-size:1.3rem;color:#4765a0;">[aeris_member id="' . $post->ID . '"]</p>';
        }

//---------------------------------------------------------------------------------------------------------------------------------------------------------    
        /*
        * Custom CSS FOR AERIS THEME
        */     
        function aeris_team_manager_customCSS() {

            if (get_theme_mod('theme_aeris_main_color') == "custom" ) {
                $code_color = get_theme_mod( 'theme_aeris_color_code' );
            }
            else {
                $code_color	= get_theme_mod( 'theme_aeris_main_color' );
            }
            ?>
            <style>
                input[id^="aeris_team_manager_member_info"]:checked ~ header,
                .aeris_team_manager_memberSingle > header {
                    background: <?php echo $code_color;?> ;
                }
                label[for^="aeris_team_manager_member_info"] { 
                    background: <?php echo $code_color;?>;
                    color:#FFF;
                }
                .aeris_team_manager_membersEmbed > header:hover label[for^="aeris_team_manager_member_info"] {
                    background:<?php echo get_theme_mod('theme_aeris_second_color_code' );?>
                }

                input[id^="aeris_team_manager_member_info"]:checked ~ header label {
                    background:#EEE;
                    color:<?php echo $code_color;?>;
                }
            </style>
            <?php
        }
        add_action('wp_head', 'aeris_team_manager_customCSS');

        remove_filter( 'the_content', 'wpautop' );
//---------------------------------------------------------------------------------------------------------------------------------------------------------    
    } // end test plugin ACF

}
add_action('plugins_loaded', 'aeris_team_manager_plugin_init');

?>