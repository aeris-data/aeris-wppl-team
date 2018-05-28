<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sedoo
 */

get_header(); 

// $categories = get_the_terms( $post->ID, 'sedoo-type-document');  

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="aeris_team_manager_width1400">
		<main id="main" class="site-main" role="main">
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
				<header>
				<?php $logo = get_field( 'logo' ); ?>
					<?php if ( $logo ) { ?>
					<figure>
					
						<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
					
					</figure>
					<?php } ?>
					
				</header>
			
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
								<article class="aeris_team_manager_embedMembers">
									<input type="checkbox" name="aeris_team_manager_member_info<?php echo $i;?>" id="aeris_team_manager_member_info<?php echo $i;?>">
									<header title="Click on arrow to show contact informations">
									<?php 
									// Include photo
									$image = get_field( 'photo' ); 
									$size = "medium";
									if ( $image ) { 
										?>
										<figure>
										<?php echo wp_get_attachment_image( $image, $size );?>
										</figure>
									<?php	
									} 
									?>
										<div>
											<h3>
												<span class="aeris_team_manager_uppercase"><?php the_field( 'lastname' );?></span> <?php the_field( 'firstname' ); ?>
											</h3>
											<p>
											<?php the_field( 'fonction' ); ?>
											</p>
										</div>
										
									<?php // show deploy button for email & phone
									if ( get_field('tel') || get_field('mail') ) {										
									?>
										<label for="aeris_team_manager_member_info<?php echo $i;?>"><i class="fa fa-angle-down"></i></label>
										
									<?php } ?>
									</header>
									<?php if ( get_field('tel') || get_field('mail') ) {
									?>									
									<section>
										<p>
											Tel : <?php the_field( 'tel' ); ?><br>
											Mail : <?php echo $mail[0]; ?><span class="hide">Dear bot, you will not collect my email</span>@<span class="hide">No,No,No</span><?php echo $mail[1]; ?>
										</p>
									</section>
									<?php } ?>										
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

		</main><!-- #main -->

	</div><!-- #primary -->
<?php
endwhile; // End of the loop.

// get_sidebar();
get_footer();
