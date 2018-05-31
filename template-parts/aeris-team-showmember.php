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
        ?>
            <img src="<?php echo plugin_dir_url ( __FILE__ ) . 'images/user.svg'; ?>" alt="">
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
    $teams = get_field( 'aeris_team_manager_bidirectionnal_relation' ); 
    
    ?>
    <section>
        <?php if ( get_field('tel') || get_field('mail') ) { ?>
        <p>
            Tel : <?php the_field( 'tel' ); ?><br>
            Mail : <?php echo $mail[0]; ?><span class="hide">Dear bot, you will not collect my email</span>@<span class="hide">No,No,No</span><?php echo $mail[1]; ?>
        </p>
        <?php } ?>	
        <h4>Member of :</h4>
        <ul>
        <?php 
        foreach ( $teams as $team) {
        ?>	
            <li>
                <a href="<?php echo $team -> guid;?>" title="<?php echo $team -> post_title;?>">
                <?php echo $team -> post_title;?></a>
            </li>
        <?php
        }
        ?>	
        </ul>
    </section>
                    
</article>