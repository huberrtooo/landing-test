<?php get_header(); ?>

<header>
    <?php
    $isVideo = get_field('slider_video_img');
    if ($isVideo) :
        $image = get_field('slider_img');
    else :
        $video = get_field('slider_video');
    endif;
    ?>
    <div class="container-fluid hero" <?php if ($isVideo) : ?> style="background-image: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(0,0,0,0.6) 0%), url('<?php echo esc_url($image['url']); ?>');" <?php endif; ?>>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 hero__content">
                    <div>
                        <h1 class="header-h1"><?php the_field('slider_header'); ?></h1>
                    </div>
                    <div class="pt-3 hero__desc">
                        <p><?php the_field('slider_desc'); ?></p>
                    </div>
                    <div class="pt-4">
                        <?php
                        $link1 = get_field('slider_button_1');
                        $link2 = get_field('slider_button_2');
                        if ($link1) : ?>
                            <a class="me-4 button button__highlight" href="<?php echo esc_url($link1['url']); ?>"><?php echo esc_html($link1['title']); ?></a>
                        <?php endif;
                        if ($link2) : ?>
                            <a class="button" href="<?php echo esc_url($link2['url']); ?>"><?php echo esc_html($link2['title']); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col px-lg-5 cta">
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
                    <h2 class="header-h2"><?php the_field('services_desc'); ?></h2>
                </div>
            </div>
            <div class="row">
                <?php
                if (have_rows('services_boxes')) :
                    while (have_rows('services_boxes')) : the_row(); ?>
                        <div class="col-12 col-md-6 col-lg-3 p-2">
                            <div class="services__box">
                                <?php $icon = get_sub_field('icon');
                                if (!empty($icon)) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                <?php endif; ?>
                                <h3 class="header-h3"><?php the_sub_field('name'); ?></h3>
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

</main>

<?php get_footer(); ?>