<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ProSalon
 */
?>

<?php

	$business_info = array(
		'hours'				=> get_theme_mod( 'business_info_hours' ),
		'phone'				=> get_theme_mod( 'business_info_phone' ),
		'email'				=> get_theme_mod( 'business_info_email' ),
	);

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'prosalon' ); ?></a>

	<header id="masthead" class="site-header">

		<div id="topbar">
			<div class="container">
				<div class="row flex-justify-center">
					<div id="topbar-content" class="content business-info" aria-expanded="false">

						<?php if ( ! empty( $business_info[ 'hours' ] ) ) : ?>
							<span class="business-hours info"><i class="fa fa-clock-o"></i><?php printf( esc_html__( '%s' ), $business_info[ 'hours' ] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $business_info[ 'phone' ] ) ) : ?>
							<span class="phone-number info"><i class="fa fa-phone"></i><?php printf( esc_html__( '%s' ), $business_info[ 'phone' ] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $business_info[ 'email' ] ) ) : ?>
							<span class="email info"><i class="fa fa-envelope-o"></i><?php printf( esc_html__( '%s' ), $business_info[ 'email' ] ); ?></span>
						<?php endif; ?>

					</div>
					<a href="#" class="toggle text-center" aria-controls="topbar-content">
						<span class="sr-only"></span>
						<span class="fa fa-chevron-down"></span>
					</a>
				</div>
			</div>
		</div>

		<div id="navbar">
			<div class="container">
				<div class="row flex-align-center justify-space-between">
					<div class="site-branding">

						<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
							<h1 class="text-logo">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
						<?php endif; ?>

					</div>
					<div class="site-menu">

					</div>
				</div>
			</div>
		</div>

		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;

			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'prosalon' ); ?></button>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
