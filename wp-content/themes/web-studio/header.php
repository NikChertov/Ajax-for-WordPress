<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package web-studio
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<title>WebStudio</title>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="header">
    <div class="header__container _container">
        <div class="header__body">
            <div class="header__logo">
                <a href="<?php echo home_url(); ?>">
                    <img src="<?php echo get_template_directory_uri().'/assets/img/logo.png' ?>" alt="logo">
                </a>
            </div>
            <nav class="header__nav">
                <ul class="header__list">
                    <li class="header__item">
                        <a href="#" class="header__link">Студия</a>
                    </li>
                    <li class="header__item">
                        <a href="#" class="header__link">Портфолио</a>
                    </li>
                    <li class="header__item">
                        <a href="#" class="header__link">Контакты</a>
                    </li>
                </ul>
			</nav>
            <div class="header__info">
                <div class="header__mail">
                    <a href="#">info@devstudio.com</a>
                </div>
                <div class="header__tel">
                    <a href="#">+38 096 111 11 11</a>
                </div>
            </div>
        </div>
    </div>
</header>
