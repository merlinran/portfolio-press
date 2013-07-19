<?php
/**
 * General post content template
 *
 * @package Portfolio Press
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">[<?php the_category( ', ' ); ?>] <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'portfoliopress' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<div class="entry-meta">
			<?php portfoliopress_postby_meta(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="meta-sep"> | </span>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'portfoliopress' ), __( '1 Comment', 'portfoliopress' ), __( '% Comments', 'portfoliopress' ) ); ?></span>
		<?php endif; ?>
		
		<?php edit_post_link( __( 'Edit', 'portfoliopress' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<?php if ( is_archive() || is_search() ) : // Only display Excerpts for archives & search ?>
	<div class="entry-summary">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'portfoliopress' ) ); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'portfoliopress' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portfoliopress' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	
	<?php /*portfoliopress_footer_meta( get_post_format() );*/ ?>
		
</article><!-- #post-<?php the_ID(); ?> -->
