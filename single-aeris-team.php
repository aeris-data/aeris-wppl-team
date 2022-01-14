<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package sedoo
 */

get_header(); 

while ( have_posts() ) : the_post();
	if ($themeName->TextDomain !== "aeris-wordpress-theme") {
	get_template_part( 'template-parts/header-content', 'page' );
	}
?>

	<div id="content-area" class="aeris_team_manager_wrapper">
		<main id="main" class="site-main" role="main">
		<h1><?php the_title(); ?></h1>
		<?php
			include( 'template-parts/aeris-team-showteam.php' );
		?>
		</main><!-- #main -->

	</div><!-- #primary -->
<?php
endwhile; // End of the loop.

// get_sidebar();
get_footer();
