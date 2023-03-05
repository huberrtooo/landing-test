<?php get_header(); ?>

<header>
    <?php
    // choose video or image on background on hero slider
    $isVideo = get_field('slider_video_img');
    if ($isVideo) :
        $image = get_field('slider_img');
    else :
        $video = get_field('slider_video'); ?>
    <?php endif; ?>

    <!-- HERO SLIDER -->
    <div class="container-fluid p-0 hero" <?php if ($isVideo) : ?> style="background-image: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.6) 0%), url('<?php echo esc_url($image['url']); ?>');" <?php endif; ?>>
        <?php if (!$isVideo) : ?>
            <video autoplay muted loop class="hero__video">
                <source src="<?php echo $video['url']; ?>" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        <?php endif; ?>
        <div class="container px-4 <?php if (!$isVideo) : echo ('position-relative');
                                endif; ?> ">
            <div class="row">
                <div class="col-12 col-lg-6 hero__content">
                    <div>
                        <h1 class="header-h1"><?php the_field('slider_header'); ?></h1>
                    </div>
                    <div class="pt-3 hero__desc">
                        <p><?php the_field('slider_desc'); ?></p>
                    </div>
                    <div class="d-lg-flex pt-4">
                        <?php
                        $link1 = get_field('slider_button_1');
                        $link2 = get_field('slider_button_2');
                        if ($link1) : ?>
                        <div class="">
                            <a class="me-4 button button__highlight" href="<?php echo esc_url($link1['url']); ?>"><?php echo esc_html($link1['title']); ?></a>
                        </div>
                        <?php endif;
                        if ($link2) : ?>
                        <div class="pt-5 pt-lg-0">
                            <a class="button" href="<?php echo esc_url($link2['url']); ?>"><?php echo esc_html($link2['title']); ?></a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <!-- CTA - SEARCH DOMAIN -->
    <section>
        <div class="container-fluid">
            <div class="container">
                <div class="row px-2">
                    <div class="col px-3 py-5 px-lg-5 py-lg-0 cta">
                        <div>
                            <h2 class="header-h2"><?php the_field('cta1_header'); ?></h2>
                        </div>
                        <div class="pt-3 cta__desc">
                            <p><?php the_field('cta1_desc'); ?></p>
                        </div>
                        <div class="px-lg-5 pt-4">
                            <form class="px-lg-5 cta__form">
                                <label for="inputDomain" class="visually-hidden">Domain name</label>
                                <input type="text" class="form-control" id="inputDomain" placeholder="Search your perfect domain name">
                                <div class="cta__search">
                                    <button type="submit" class="button button__orange">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section id="features">
        <div class="container-fluid py-5 services">
            <div class="container py-lg-5">
                <div class="row text-center">
                    <div class="col-12">
                        <h4 class="header-h4"><?php the_field('services_subheader'); ?></h4>
                    </div>
                    <div class="col-12 py-3">
                        <h2 class="header-h2"><?php the_field('services_header'); ?></h2>
                    </div>
                    <div class="col-12">
                        <p><?php the_field('services_desc'); ?></p>
                    </div>
                </div>
                <div class="row pt-lg-5">
                    <?php
                    if (have_rows('services_boxes')) :
                        while (have_rows('services_boxes')) : the_row(); ?>
                            <div class="col-12 col-md-6 col-lg-3 p-2">
                                <div class="services__box">
                                    <?php $icon = get_sub_field('icon');
                                    if (!empty($icon)) : ?>
                                        <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                    <?php endif; ?>
                                    <h3 class="pt-4 pb-2 header-h3"><?php the_sub_field('name'); ?></h3>
                                    <p><?php the_sub_field('desc'); ?></p>
                                </div>
                            </div>
                    <?php endwhile;
                    else :
                        echo ('Brak dodanych usług');
                    endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- PRICING -->
    <section id="pricing">
        <div class="container-fluid pricing">
            <div class="container">
                <div class="row text-center">
                    <div class="col-12">
                        <h4 class="header-h4"><?php the_field('pricing_subheader'); ?></h4>
                    </div>
                    <div class="col-12 py-3">
                        <h2 class="header-h2"><?php the_field('pricing_header'); ?></h2>
                    </div>
                    <div class="col-12">
                        <p><?php the_field('pricing_desc'); ?></p>
                    </div>
                </div>
                <div class="row pt-lg-5">
                    <?php
                    if (have_rows('pricing_boxes')) :
                        while (have_rows('pricing_boxes')) : the_row(); ?>
                            <div class="col-12 col-lg-4 p-2 p-lg-3">
                                <div class="pricing__box <?php if (get_sub_field('star')) : echo ('pricing__box--green');
                                                            endif; ?>">
                                    <div class="pricing__name"><?php the_sub_field('name'); ?></div>
                                    <div class="pt-2"><span class="pricing__price">$<?php the_sub_field('price'); ?></span>/Month</div>
                                    <div class="pt-5">
                                        <p class="pricing__desc"><?php the_sub_field('desc'); ?></p>
                                    </div>
                                    <div class="pt-3 ps-2">
                                        <div class="pricing__more-info"><?php the_sub_field('moreInfo'); ?></div>
                                        <?php $link = get_sub_field('button');
                                        if ($link) : ?>
                                            <div class="py-3">
                                                <a class="me-4 button pricing__button" href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                    <?php endwhile;
                    else :
                        echo ('Brak dodanych cen');
                    endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact-us">
        <div class="container-fluid py-5">
            <div class="container py-lg-5">
                <div class="row px-2">
                    <div class="col px-lg-5 cta cta--2">
                        <div>
                            <h2 class="header-h2"><?php the_field('cta2_header'); ?></h2>
                        </div>
                        <div class="pt-3 cta__desc">
                            <p><?php the_field('cta2_desc'); ?></p>
                        </div>
                        <div class="px-lg-5 pt-4">
                            <?php
                            $link = get_field('cta2_button');
                            if ($link) : ?>
                                <a class="me-4 button" href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>