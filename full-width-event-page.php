<?php
/**
 * Template Name: Full-width Event Page
 * Description: A full-width template with no sidebar for events
 *
 * @package Portfolio Press
 */
global $comments_form_above_list;
/*
global $content_width;

if ( of_get_option('layout') == 'layout-1col' ) {
	$content_width = 780;
} else {
	$content_width = 980;
}
*/
get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<?php the_content(); ?>
					<?php wp_link_pages( 'before=<div class="page-link">' . __( 'Pages:', 'portfoliopress' ) . '&after=</div>' ); ?>
					<?php edit_post_link( __( 'Edit', 'portfoliopress' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-<?php the_ID(); ?> -->


		</div><!-- #content -->
	</div><!-- #primary -->
	<div id="sidebar" role="complementary">
		<?php if ( comments_open() ) {
			$comments_form_above_list = true;
			comments_template( '', true );
		}
		?>
	</div><!-- #sidebar -->
<?php get_footer(); ?>