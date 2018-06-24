<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/post/content', get_post_format() );
				?>
					<table>
						<tr>
							<th>Price</th><td><?php echo wp_get_post_terms($post->ID, 'price')[0]->name; ?></td>
						</tr>
						<tr>
							<th>Location</th><td><?php echo wp_get_post_terms($post->ID, 'location')[0]->name; ?></td>
						</tr>
						<tr>
							<th>Color</th><td><?php echo wp_get_post_terms($post->ID, 'color')[0]->name; ?></td>
						</tr>		
					</table>
				<?php
				
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
