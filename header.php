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

	$logo = array(
		'primary'			=> get_theme_mod( 'logo_text_primary', 'Pro' ),
		'secondary'			=> get_theme_mod( 'logo_text_secondary', 'Salon' ),
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
				<div class="row">
					<div id="topbar-content" class="content" aria-expanded="false">
						<div class="flex-center flex-column">
							<?php prosalon_get_social(); ?>

							<div class="business-info">

								<?php if ( ! empty( $business_info[ 'hours' ] ) ) : ?>
									<span class="business-hours info"><i class="fa fa-clock-o"></i><?php printf( esc_html__( '%s', 'prosalon' ), $business_info[ 'hours' ] ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $business_info[ 'phone' ] ) ) : ?>
									<span class="phone-number info"><i class="fa fa-phone"></i><?php printf( esc_html__( '%s', 'prosalon' ), $business_info[ 'phone' ] ); ?></span>
								<?php endif; ?>

								<?php if ( ! empty( $business_info[ 'email' ] ) ) : ?>
									<span class="email info"><i class="fa fa-envelope-o"></i><?php printf( esc_html__( '%s', 'prosalon' ), $business_info[ 'email' ] ); ?></span>
								<?php endif; ?>

							</div>
						</div>
					</div>
					<a href="#" class="toggle text-center" aria-expanded="false" aria-controls="topbar-content">
						<span class="sr-only"><?php esc_html_e( 'Toggle Topbar with Site Info', 'medlabs' ); ?></span>
						<span class="fa fa-chevron-down"></span>
					</a>
				</div>
			</div>
		</div>

		<div id="navbar">
			<div class="container">
				<div class="row flex-align-center justify-space-between">
					<div class="col">
						<div class="site-branding">

							<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
								<h1 class="text-logo">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex-align-center" rel="home">
										<span class="text-primary">
											<?php printf( esc_html__( '%s', 'prosalon' ), $logo[ 'primary' ] ); ?>
										</span>
										<span class="text-secondary">
											<?php printf( esc_html__( '%s', 'prosalon' ), $logo[ 'secondary' ] ); ?>
										</span>
									</a>
								</h1>
							<?php endif; ?>

						</div>
					</div>
					<div class="col">
						<div class="site-menu">
							<button type="button" class="menu-toggle flex-center" aria-expanded="false" aria-controls="primary-menu">
								<span class="screen-reader-text"><?php esc_html_e( 'Toggle Site Navigation', 'medlabs' ); ?></span>
								<i class="fa fa-bars"></i>
							</button>
							<nav id="site-navigation">
								<div class="container">
									<?php
										wp_nav_menu( array(
											'theme_location' => 'primary-menu',
											'menu_id'        => 'primary-menu',
											'menu_class'		 => 'nav-menu',
											'container'			 => 'false',
										) );
									?>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
