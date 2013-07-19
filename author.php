<?php
/**
 * The template for displaying author pages
 *
 * @package Portfolio Press
 */

get_header(); 
$author = get_tag(get_query_var('author'));
$raw_description = $author->description ? $author->description : $author->author_description;
$is_grid = (strrpos($raw_description, '<!--:grid-->') !== false);
$is_fullwidth = (strrpos($raw_description, '<!--:fullwidth-->') !== false);?>


<?php
if ($is_grid){
?>
	<div id="primary"  class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">
		<!--<div id="content" role="main">-->
			<div id="portfolio"  class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">
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
						$classes .= ' no-thumb';
					} ?>
					<div class="<?php echo $classes; ?>">
						<?php if ( has_post_thumbnail() && !post_password_required() ) { ?>
						<a href="<?php the_permalink() ?>" rel="bookmark" class="thumb"><?php the_post_thumbnail( $thumbnail ); ?></a>
						<?php } ?>
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
<?php }else { ?>

	<div id="primary"  class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">

		<div id="content" role="main"  class="<?php if ( $is_fullwidth ) { echo ' full-width-list full-width'; }?><?php if ( $is_grid ) { echo ' grid-list'; }?>">

			<?php the_post(); ?>
			
			<h2 class="page-title"><?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'portfoliopress' ), "<a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a>" ); ?></h2>

			<?php rewind_posts(); ?>
			
			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
			<div class="author-info clearfix">
				<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'portfoliopress_author_bio_avatar_size', 60 ) ); ?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h3><?php printf( __( 'About %s', 'portfoliopress' ), get_the_author() ); ?></h3>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div><!-- .author-description	-->
			</div><!-- .author-info -->
			<?php endif; ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

		</div><!-- #content -->
		
		<?php if (! $is_fullwidth ) { ?>
		<div id="sidebar" class="others-sidebar">
			<?php if ( ! dynamic_sidebar( 'sidebar-others' ) ) : ?>
			<?php endif; // end top widget area ?>
		</div>
		<?php } ?>
	</div><!-- #primary -->
<?php } ?>
<?php get_footer(); ?>