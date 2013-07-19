<?php
/**
 * Header template
 *
 * @package Portfolio Press
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_uri(); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_stylesheet_directory_uri(); ?>/qingyuanse/style.css" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="wrapper">
	<div id="header-1">
		<div class="col-width">
		<?php if ( ! dynamic_sidebar( 'header-1' ) ) : ?>
		<?php endif; // end top widget area ?>
		</div>
	</div>
	<header id="branding">
    	<div class="col-width">
        <?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
		<hgroup id="logo">
			<<?php echo $heading_tag; ?> id="site-title"><a href="<?php echo function_exists('qtrans_convertURL') ? qtrans_convertURL(home_url( '/' )) : home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
            <?php if ( of_get_option('logo', false) ) { ?>
				<img src="<?php echo of_get_option('logo'); ?>" alt="<?php echo bloginfo( 'name' ) ?>" />
			<?php } else {
				bloginfo( 'name' );
			}?>
            </a>
            </<?php echo $heading_tag; ?>>
			<?php if ( !of_get_option('logo', false) ) { ?>
            	<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php } ?>
		</hgroup>
      
      	<div id="header-2">
			<?php if ( ! dynamic_sidebar( 'header-2' ) ) : ?>
			<?php endif; // end top widget area ?>
		</div>
		<nav id="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'portfoliopress' ); ?></h3>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'portfoliopress' ); ?>"><?php _e( 'Skip to content', 'portfoliopress' ); ?></a></div>
	
			<?php wp_nav_menu( array( 'theme_location' => 'primary') ); ?>
		</nav><!-- #access -->
    
    </div>
    
	</header><!-- #branding -->

	<div id="main">
    	<div class="col-width">
    		<!-- 导航-->
    		<div id="breadcrumb">
			    <?php if(function_exists('bcn_display'))
			    {
			    	if(function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')){
			    		echo qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage(bcn_display(true));
			    	}else{
			    		bcn_display();
			    	}
			    }?>
    		</div>