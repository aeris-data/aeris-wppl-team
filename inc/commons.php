<?php
/******************************************************************
 * Afficher les catégories
 * $categories = get_the_terms( $post->ID, 'category');  
 */

function aeris_team_manager_show_categories($categories) {
 
  if( $categories ) {
  ?>
  <div class="tag">
  <?php
      foreach( $categories as $categorie ) { 
          if ($categorie->slug !== "non-classe") {
          echo '<a href="'.site_url().'/sedoo-type-document/'.$categorie->slug.'" class="'.$categorie->slug.'">';

                echo $categorie->name; 
              ?>                    
          </a>
  <?php 
          }
      }
  ?>
  </div>
  <div class="clear"></div>
<?php
    } 
}

/**
 * RANDOM ID
 * génère un random pour pouvoir afficher plusieurs équipes en shortcode dans une page
 */

function aeris_team_manager_randomID() {
    $out=rand(0,99999);
    return $out;
}