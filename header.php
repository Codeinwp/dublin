<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Dublin
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php if ( get_theme_mod('site_favicon') ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
<?php endif; ?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'dublin' ); ?></a>

	<?php if ( get_theme_mod('contact_display') || has_nav_menu( 'social' ) ) : //Check if the top bar has reasons to display ?>
	<div class="top-bar clearfix">
		<div class="container">
			<?php if ( get_theme_mod('contact_display') ) : ?>
				<div class="contact-info col-md-8">
					<?php if ( get_theme_mod('phone_number') ) : ?>
						<span><?php echo '<i class="fa fa-phone"></i>' . esc_html( get_theme_mod('phone_number') ) ;?></span>
					<?php endif; ?>
					<?php if ( get_theme_mod('email_address') ) : ?>
						<span><?php echo '<i class="fa fa-envelope-o"></i>' . esc_html( get_theme_mod('email_address') ) ;?></span>
					<?php endif; ?>	
					<?php if ( get_theme_mod('p_address') ) : ?>
						<span><?php echo '<i class="fa fa-map-marker"></i>' . esc_html( get_theme_mod('p_address') ) ;?></span>
					<?php endif; ?>										
				</div>
			<?php endif; ?>
			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation col-md-4 col-sm-12">
					<?php wp_nav_menu( array( 'theme_location' => 'social', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'menu_class' => 'menu clearfix', 'fallback_cb' => false ) ); ?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; //Top bar end ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<div class="site-branding col-md-4 col-sm-12">
				<?php if ( get_theme_mod('site_logo') ) : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><img class="site-logo" src="<?php echo esc_url(get_theme_mod('site_logo')); ?>" alt="<?php bloginfo('name'); ?>" /></a>
				<?php else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation col-md-8 col-sm-12" role="navigation">
				<button class="menu-toggle"><i class="fa fa-bars"></i></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => false ) ); ?>
			</nav><!-- #site-navigation -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content container">
