<?php
$themeName = wp_get_theme();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
    <header>
       
        <?php $logo = get_field( 'logo' ); ?>
        
        <figure>
        <?php if ( $logo ) { ?>
            <!-- <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" /> -->
            <?php echo wp_get_attachment_image( $logo, 'team-logo' ); ?>
        <?php }	?>
        </figure>
        
        
    </header>
    <?php
    if ( !empty( get_the_content() ) ) {
    ?>
    <section class="wrapper">
        <?php the_content();?>
    </section>
    <?php
    }
    ?>
    	
    <section class="alignwide">
        <?php 
        $showmetheboss_array = get_field( 'showmetheboss' ); 
        // !! Bidirectional field, use field_key, not field_name !!
        $members = get_field( 'field_5acdbb70a7637' ); 
        ?>
        <?php if ( $members ): 
                $i=aeris_team_manager_randomID();	
            ?>
        <section class="aeris_team_manager_listMembers">
            <?php foreach ( $members as $post ):  ?>
                <?php 
                setup_postdata ($post); 
                // protect email
                $mail = explode('@', get_field( 'mail' ));							
                ?>
                
                <?php if (($i === 0) && ( $showmetheboss_array )){?>							
                <div>
                <?php }	?>
                    <article class="aeris_team_manager_membersEmbed slide-in-left delay-display" vocab="http://schema.org/" typeof="Person">
                        <input type="checkbox" name="aeris_team_manager_member_info<?php echo $i;?>" id="aeris_team_manager_member_info<?php echo $i;?>">
                        <header title="Click on arrow to show contact informations">
                        <?php 
                        // Include photo
                        $image = get_field( 'photo' ); 
                        $size = "member-photo";
                        ?>
                            <figure>
                            <?php if ( $image ) { 
                            ?>
                            <?php echo wp_get_attachment_image( $image, $size );?>
                            <?php } else {
                            ?>
                                <img src="<?php echo plugin_dir_url ( __DIR__ ) . 'images/user.svg';  ?>" alt="photo" property="image">
                            <?php	
                            } 
                            ?>
                            </figure>
                        
                            <div>
                                <h3>
                                    <span class="aeris_team_manager_uppercase" property="name"><?php the_field( 'lastname' );?></span> <?php the_field( 'firstname' ); ?>
                                </h3>
                                <p property="jobTitle">
                                <?php the_field( 'fonction' ); ?>
                                </p>
                            </div>
                            
                            <label for="aeris_team_manager_member_info<?php echo $i;?>"></label>
                            
                        </header>
                        <?php 
                            include ('aeris-team-memberinfosection.php');
                        ?>
                                        
                    </article>
                <?php if (($i === 0) && ( $showmetheboss_array )) {?>
                    <hr>
                </div>
                <?php }
                $i++;
                ?>
            <?php endforeach; ?>
        </section>
        <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </section>

    <!--<footer>
        <?php //the_post_navigation();?>
    </footer> -->
</article>