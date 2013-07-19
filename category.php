<?php
/**
 * The template used to display categories (for standard posts)
 *
 * @package Portfolio Press
 */

get_header(); 
$category = get_category(get_query_var('cat'));
$raw_description = $category->description ? $category->description : $category->category_description;
$is_grid = (strrpos($raw_description, '<!--:grid-->') !== false);
$is_fullwidth = (strrpos($raw_description, '<!--:fullwidth-->') !== false);


?>

<?php
if ($is_grid){
?>
	<div id="primary" class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">
		<!--<div id="content" role="main">-->
			<div id="portfolio" class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">
				
				<h2 class="page-title"><?php
					printf( __( 'Category Archives: %s', 'portfoliopress' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h2>
				<?php if ( is_tax() ): ?>
				<header class="entry-header">
					<h1 class="entry-title"><?php echo single_cat_title( '', false ); ?></h1>
					<?php $categorydesc = category_description(); if ( ! empty( $categorydesc ) ) echo apply_filters( 'archive_meta', '<div class="archive-meta">' . $categorydesc . '</div>' ); ?>
				</header>

				<?php endif; ?>

				<?php  if ( have_posts() ) : $count = 0;
					while ( have_posts() ) : the_post(); $count++;
					$classes = 'portfolio-item item-' . $count;
					if ( $count % 3 == 0 ) {
						$classes .= ' ie-col3';
					}
					if ( !has_post_thumbnail() || post_password_required() ) {
						# $classes .= ' no-thumb';
					} ?>
					<div class="<?php echo $classes; ?>">
            <a href="<?php the_permalink() ?>" rel="bookmark" class="thumb"><img src="<?php echo catch_that_image($post->post_content); ?>"></img></a>
						<a href="<?php the_permalink() ?>" rel="bookmark" class="title-overlay"><?php the_title() ?></a>
					</div>
					<?php endwhile; ?>
			        <?php portfoliopress_content_nav(); ?>
					<?php else: ?>
					<h2 class="title"><?php _e( 'Sorry, no posts matched your criteria.', 'portfoliopress' ) ?></h2>
				<?php endif; ?>

			</div><!-- #portfolio -->
		<!--</div>--><!-- #content -->
		<?php if (! $is_fullwidth ) { ?>
		<div id="sidebar" class="others-sidebar">
			<?php if ( ! dynamic_sidebar( 'sidebar-others' ) ) : ?>
			<?php endif; // end top widget area ?>
		</div>
		<?php } ?>
	</div><!-- #primary -->
<?php
} else { ?>
	<div id="primary" class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">
		<div id="content" role="main">

			<h2 class="page-title"><?php
				printf( __( 'Category Archives: %s', 'portfoliopress' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			?></h2>

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php portfoliopress_content_nav(); ?>
				
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div><!-- #content -->
		<?php if (! $is_fullwidth ) { ?>
		<div id="sidebar" class="others-sidebar">
			<?php category_description_widget($category)?>
			<?php if ( ! dynamic_sidebar( 'sidebar-others' ) ) : ?>
			<?php endif; // end top widget area ?>
		</div>
		<?php } ?>
	</div><!-- #primary -->
<?php }
get_footer(); ?>
