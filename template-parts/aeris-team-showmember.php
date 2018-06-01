<article class="aeris_team_manager_memberSingle">
    <header>
    <?php 
    $mail = explode('@', get_field( 'mail' ));	
    // Include photo				
    $image = get_field( 'photo' ); 
    $size = "medium";
    ?>
        <figure>
        <?php if ( $image ) { 
        ?>
        <?php echo wp_get_attachment_image( $image, $size );?>
        <?php } else {
            $plugin_dir_path = dirname(__FILE__);
        ?>
            <img src="<?php echo plugin_dir_url ( __DIR__ ) . 'images/user.svg'; ?>" alt="">
        <?php	
        } 
        ?>
        </figure>
    
        <div>
            <h3>
                <span class="aeris_team_manager_uppercase"><?php the_field( 'lastname' );?></span> <?php the_field( 'firstname' ); ?>
            </h3>
            <p>
            <?php the_field( 'fonction' ); ?>
            </p>
        </div>
                            
    </header>
    <?php 
    include ('aeris-team-memberinfosection.php');
    ?>
                    
</article>