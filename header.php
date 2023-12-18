<!DOCTYPE html>
<html <?php language_attributes( ); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php bloginfo( 'name' ) ?> <?php wp_title('')?></title>
    <meta name="description" content="<?php bloginfo( 'description' )?>"
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body class=" mb-5 pb-5">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">Mobile Shop</a>
        <div />
        <?php
        wp_nav_menu(array(
            'theme_location'  => 'primary',
            'container'       => 'div',
            'container_id'    => 'navbarNav',
            'menu_class'      => 'nav justify-content-end ',
        ));
        ?>
        </div>
    </div>
</nav>


<div>
        <?php
        get_search_form( ); ?>

    </div>



