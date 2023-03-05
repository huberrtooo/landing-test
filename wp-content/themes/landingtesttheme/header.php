<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Test</title>
    <?php wp_head(); ?>
</head>


<body>
    <!-- NAVIGATION -->
    <nav class="navbar navbar-expand-lg justify-content-start p-0 pt-4 menu">
        <div class="container-fluid py-2 px-xl-5">
            <div>
                <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                    <img src="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>" alt="Logo">
                </a>
            </div>
            <button class="navbar-toggler menu__button" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <img class="menu__mobile-btn-icon" src="<?php echo get_template_directory_uri() . "/assets/icons/btn-mobilemenu.svg"; ?>" alt="Toogle icon">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'container' => true,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto pe-xl-5 pe-3 w-100 justify-content-end %2$s">%3$s</ul>',
                    'depth' => 1,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ));
                ?>
            </div>
        </div>
    </nav>