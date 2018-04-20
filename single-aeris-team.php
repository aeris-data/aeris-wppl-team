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

	<div id="content-area" class="fullwidth">
		<main id="main" class="site-main" role="main">
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
				<header>
				<?php $logo = get_field( 'logo' ); ?>
					<?php if ( $logo ) { ?>
					<figure>
					
						<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
					
					</figure>
					<?php } ?>
					
					<?php //sedoo_docmanager_show_categories($categories);?>
				</header>
			
            	<section class="wrapper-content">

					<?php $members = get_field( 'aeris_team_manager_bidirectionnal_relation' ); ?>
					<?php if ( $members ): ?>
					<section class="aeris_team_manager_listMembers">
						<?php foreach ( $members as $post ):  ?>
							<?php setup_postdata ($post); ?>
							<article class="aeris_team_manager_embedMembers">
								
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
								<section>
									<h3>
										<a href="<?php the_permalink(); ?>"><?php the_field( 'lastname' ); ?> <?php the_field( 'firstname' ); ?></a>
									</h3>
									<p>
									<?php the_field( 'fonction' ); ?>
									</p>
									<p>
										Tel : <?php the_field( 'tel' ); ?><br>
										Mail : <?php the_field( 'mail' ); ?>
									</p>
								</section>
							</article>
						<?php endforeach; ?>
					</section>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
		        </section>
				

				<footer>
					<?php the_post_navigation();?>
				</footer><!-- .entry-meta -->
			</article>

		</main><!-- #main -->

	</div><!-- #primary -->
<?php
endwhile; // End of the loop.

// get_sidebar();
get_footer();
