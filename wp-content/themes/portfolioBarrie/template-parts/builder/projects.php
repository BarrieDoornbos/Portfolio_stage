<?php

$title                  = get_sub_field('title');
$text                   = get_sub_field('text');
$category               = get_sub_field('category');
$allCategories          = get_sub_field('all_categories');
$itemBorderColor        = get_sub_field('item_border_color');
$arrowIcon              = get_sub_field('arrow_icon');
$arrowDirection         = get_sub_field('arrow_point_direction');
$arrowPosition          = get_sub_field('arrow_position');
$backgroundType         = get_sub_field('active_item_background');
$itemBackgroundColor    = get_sub_field('background_color');
$gradientDirection      = get_sub_field('gradient_direction');
$gradientFromColor      = get_sub_field('gradient_from_color');
$gradientToColor        = get_sub_field('gradient_to_color');
$itemTextColor          = get_sub_field('item_text_color');
$itemTextShadow         = get_sub_field('item_text_shadow');

$arrow = '';

if (!empty($arrowIcon)) {
    $arrow = $arrowIcon;
} else {
    $arrow = 'fe:arrow-left';
}

$args = [
    'post_type'         => 'post',
    'posts_per_page'    => -1,
    'orderby'           => 'date',
    'order'             => 'DESC',
];

if (!$allCategories && !empty($category)) {
    $args['tax_query'] = [
        [
            'taxonomy' => 'category',
            'field'    => 'term_id',
            'terms'    => $category,
        ],
    ];
}
$query = new WP_Query($args);

$itemBackground = '';
if ($backgroundType === true) {
    $itemBackground = 'bg-linear-to-' . $gradientDirection . ' from-' . $gradientFromColor . '/50 to-' . $gradientToColor . '/50';
} else {
    $itemBackground = 'bg-' . $itemBackgroundColor . '/50';
}

?>

<section id="<?= esc_attr(sanitize_title($title)); ?>">
    <div class="">
        <?php if (!empty($title)) { ?>
            <div class="flex items-center">
                <div class="dividing-line -ml-[50vw]"></div>
                <h2 class="px-2"><?= $title ?></h2>
                <div class="dividing-line -mr-[50vw]"></div>
            </div>
        <?php } ?>
        <div class="block-shadow mt-8 py-8">
            <?php if (!empty($text)) { ?>
                <p class="mb-6 mx-8"><?= $text ?></p>
                <?php } ?>
            <?php if ($query->have_posts()) { ?>
            <div class="carousel flex gap-5 lg:gap-0 overflow-x-auto overflow-y-hidden snap-x lg:mx-8" data-carousel>
                <div class="min-w-2/10 lg:hidden"></div>
                <?php

                while ($query->have_posts()) {
                    $query->the_post();
                    
                    ?>
                        <div class="mobile-item relative lg:hidden h-96 min-w-3/4 snap-center animations" data-card="project" data-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-description="<?php echo esc_attr( wp_kses_post( get_field('description') ) ); ?>" data-link="<?php the_field('website_url'); ?>" data-image="<?= esc_url(get_the_post_thumbnail_url(null, 'full')) ?>">
                            <img src="<?= esc_url(get_the_post_thumbnail_url(null, 'full')) ?>" alt="" class="absolute inset-0 w-full h-full object-cover snap-x">
                            <div class="item-info absolute inset-0 content-center text-center opacity-0 <?= $itemBackground ?>">
                                <h3 class="wrap-break-word mx-4 text-<?= $itemTextColor ?> <?= $itemTextShadow ? '' : 'text-shadow-none' ?>"><?= esc_html(get_the_title()); ?></h3>
                            </div>
                        </div>

                        <div class="desktop-item hidden lg:block relative h-75 min-w-1/10 animations border-2 border-<?= $itemBorderColor ?>" data-card="project" data-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-description="<?php echo esc_attr( wp_kses_post( get_field('description') ) ); ?>" data-link="<?php the_field('website_url'); ?>" data-image="<?= esc_url(get_the_post_thumbnail_url(null, 'full')) ?>">
                            <img src="<?= esc_url(get_the_post_thumbnail_url(null, 'full')) ?>" alt="" class="absolute inset-0 h-full object-cover">
                            <div class="item-info absolute inset-0 content-center text-center opacity-0 <?= $itemBackground ?>">
                                <h3 class="wrap-break-word mx-4 text-<?= $itemTextColor ?> <?= $itemTextShadow ? '' : 'text-shadow-none' ?>"><?= esc_html(get_the_title()); ?></h3>
                            </div>
                        </div>

                <?php } ?>
                <div class="min-w-2/10 lg:hidden"></div>
            </div>
            <div class="hidden lg:flex mt-6 mx-8 justify-<?= $arrowPosition ?>">
                <button class="hover:cursor-pointer" data-carousel-prev>
                    <span class="iconify size-8 text-white <?= $arrowDirection ? 'rotate-180' : '' ?>" data-icon="<?= $arrow ?>"></span>
                </button>
                <button class="hover:cursor-pointer" data-carousel-next>
                    <span class="iconify size-8 text-white <?= $arrowDirection ? '' : 'rotate-180' ?>" data-icon="<?= $arrow ?>"></span>
                </button>
            </div>
            <?php
                
                wp_reset_postdata();
            }
            
            ?>
        </div>
    </div>
</section>