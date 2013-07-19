<?php
/**
 * This template displays portfolio post content
 *
 * @package Portfolio Press
 */

if ( is_page() && post_password_required() ) {
	echo get_the_password_form();
} else {
	// Set the size of the thumbnails and content width
	$fullwidth = false;
	
	// If portfolio is displayed full width
	if ( of_get_option( 'portfolio_sidebar' ) || is_page_template( 'full-width-portfolio.php' ) )
		$fullwidth = true;
		
	// If portfolio is a 1-column layout
	if ( of_get_option('layout','layout-2cr') ==  'layout-1col' )
		$fullwidth = true;
	
	$thumbnail = 'portfolio-thumbnail';

	if ( $fullwidth )
		$thumbnail = 'portfolio-thumbnail-fullwidth';
	
	// Query posts if this is being used as a page template


	global $paged;

	if ( get_query_var( 'paged' ) )
		$paged = get_query_var( 'paged' );
	elseif ( get_query_var( 'page' ) )
		$paged = get_query_var( 'page' );
	else
		$paged = 1;


	$args = array();
	$args['paged'] = $paged;

	$posts_per_page = apply_filters( 'portfoliopress_posts_per_page', '12' );
	$args['posts_per_page'] = $posts_per_page;

	if ( is_page_template() ) {
	
		global $post;


		$args_str = $post->post_content;
		$args_arr = explode('&', $args_str);
		foreach ($args_arr as $kv) {
			$kv_arr = explode('=', $kv);
			if($kv_arr && count($kv_arr) == 2)
				$args[$kv_arr[0]] = json_decode($kv_arr[1]);
		}
		
		
	} else if ( is_category() ) {
		$cat = get_query_var('cat');
		$args['cat'] = $cat;
	}
	query_posts( $args );
?>
<div id="portfolio"<?php if ( $fullwidth ) { echo ' class="full-width"'; }?>>

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
<?php } ?>      