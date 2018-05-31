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
    	
    <section class="wrapper-content">
        <?php $showmetheboss_array = get_field( 'showmetheboss' );?>
        <?php $members = get_field( 'aeris_team_manager_bidirectionnal_relation' ); ?>
        <?php if ( $members ): 
                $i=0;	
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
                    <article class="aeris_team_manager_membersEmbed">
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
                            
                            <label for="aeris_team_manager_member_info<?php echo $i;?>"></label>
                            
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