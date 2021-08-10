<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php seo_title(); ?></title>
    <meta name="MobileOptimized" content="width"/>
    <meta name="HandheldFriendly" content="True"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5">
    <link rel="preload" href="<?php echo theme(); ?>/fonts/" as="font" crossorigin="anonymous" />
    <!--    <meta name="theme-color" content="#00bcb0">-->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-a="<?php echo admin_url('admin-ajax.php'); ?>">
<div class="main">
    <header>
        <div class="container">
            <?php echo get_custom_logo(); ?>
            <?php if ( has_nav_menu( 'main_menu' ) ) : ?>
                <nav class="main-menu">
                <?php wp_nav_menu( array(
                    'container'      => false,
                    'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                    'theme_location' => 'main_menu'
                ) ); ?>
                </nav>
                <nav class="mobile-main-menu">
                <?php wp_nav_menu( array(
                    'container'      => false,
                    'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                    'theme_location' => 'main_menu'
                ) ); ?>
                </nav>
                <div class="menu-burger"></div>
            <?php endif; ?>
            <?php get_search_form(); ?>
        </div>
    </header>
