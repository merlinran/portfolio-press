<?php
/**
 * Template for displaying a single post
 *
 * @package Portfolio Press
 */

get_header(); 
$is_grid = false;
$is_event = false;
$category = null;
?>
<?php while ( have_posts() ) : the_post(); 
		$categories = get_the_category();
		if($categories){
			foreach ($categories as $c) {
				$category = $c;
				$raw_description = $category->description ? $category->description : $category->category_description;
				$is_grid = (strrpos($raw_description, '<!--:grid-->') !== false);
				$is_event = (strrpos($raw_description, '<!--:event-->') !== false);
			}
		}
	endwhile;
?>
<?php rewind_posts(); ?>
<div id="primary" class="<?php echo $is_event ? 'event-post' : ($is_grid ? 'grid-post-detail' : '');?>">
	<div id="content" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>

				<div class="entry-meta">
					<?php portfoliopress_postby_meta(); ?>
				</div><!-- .entry-meta -->
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfoliopress' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->

			<footer class="entry-meta">
				<?php
					$tag_list = get_the_tag_list( '', ', ' );
					if ( '' != $tag_list ) {
						$utility_text = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'portfoliopress' );
					} else {
						$utility_text = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'portfoliopress' );
					}
					printf(
						$utility_text,
						get_the_category_list( ', ' ),
						$tag_list,
						get_permalink(),
						the_title_attribute( 'echo=0' )
					);
				?>

				<?php edit_post_link( __( 'Edit', 'portfoliopress' ), '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- .entry-meta -->
		</article><!-- #post-<?php the_ID(); ?> -->

		<?php if ( comments_open() && !$is_event) {
			comments_template( '', true );
        } ?>

	<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

	<div id="sidebar" role="complementary">
		<?php 
		if ( comments_open() && $is_event) {
			$comments_form_above_list = true;
			comments_template( '', true );
		} else {
			if(!$is_grid)
				category_description_widget($category);
			?>
			<?php
			if ($is_grid){
			?>
			<li id="post_navigation" class="widget-container widget_post_navigation">
			<h3 >
				<?php _e('Navigation', 'portfoliopress') ?>
				<div class="next">
					<?php next_post_link('%link', '<span>&nbsp;</span>', true); ?>
				</div>
				<div class="previous">
					<?php previous_post_link('%link', '<span>&nbsp;</span>', true); ?>
				</div>
				<div class="clear"></div>
			</h3>
			</li>
			<?php
			}
			?>
			<?php if ( ! dynamic_sidebar( $is_grid ? 'sidebar-post-grid' : 'sidebar-post' ) ) : ?>
			<?php endif; // end top widget area ?>
			<?php
		}
		?>
	</div><!-- #sidebar -->
</div><!-- #primary -->

<?php get_footer(); ?>