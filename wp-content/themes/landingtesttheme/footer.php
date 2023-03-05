<!-- FOOTER -->
<footer>
    <div class="container-fluid footer">
        <div class="container py-4">
            <div class="row py-5">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="pb-4">
                        <img src="<?php echo esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))); ?>" alt="Logo">
                    </div>
                    <?php
                    $email = get_field('email');
                    $phone = get_field('phone');
                    $address = get_field('address');
                    ?>
                    <div class="pb-3">
                        <?php
                        if ($email) : ?>
                            <a class="" href="<?php echo esc_url($email['url']); ?>"><?php echo esc_html($email['title']); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="pb-3">
                        <?php
                        if ($phone) : ?>
                            <a class="" href="<?php echo esc_url($phone['url']); ?>"><?php echo esc_html($phone['title']); ?></a>
                        <?php endif; ?>
                    </div>
                    <div class="pb-3">
                        <?php
                        if ($address) : ?>
                            <a target="_blank" href="<?php echo esc_url($address['url']); ?>"><?php echo esc_html($address['title']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-white fw-semibold pb-3 pt-4 pt-lg-0">Features</div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-features',
                        'container' => true,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto pe-xl-5 pe-3 w-100 justify-content-end %2$s">%3$s</ul>',
                        'depth' => 1,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    ));
                    ?>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-white fw-semibold pb-3 pt-4 pt-lg-0">Services</div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-services',
                        'container' => true,
                        'menu_class' => '',
                        'fallback_cb' => '__return_false',
                        'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto pe-xl-5 pe-3 w-100 justify-content-end %2$s">%3$s</ul>',
                        'depth' => 1,
                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                    ));
                    ?>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="text-white fw-semibold pb-3 pt-4 pt-lg-0">Support</div>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer-support',
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
            <div class="row pt-5 pb-2">
                <div class="col">
                    <p class="text-white text-center">
                        Copyright 2021 Allright reserved / Dimo.ui
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

</body>

</html>