<?php

$headerColor            = get_field('header_color', 'option');
$timeColor              = get_field('time_color', 'option');
$text                   = get_field('brand_text', 'option');
$textColor              = get_field('brand_text_color', 'option');
$leftMenuItem           = get_field('item_left_side', 'option');
$mobileBackgroundColor  = get_field('mobile_background_color', 'option');
$mobileGlowColor        = get_field('mobile_background_glow_color', 'option');
$hamburgerColor         = get_field('hamburger_icon_color', 'option');
$mobileTextColor        = get_field('mobile_text_color', 'option');
$socialLinks            = get_field('social_links', 'option');

$menuItems = [];

if (have_rows('page_sections')) {
    while (have_rows('page_sections')) {
        the_row();
        $title = get_sub_field('title');

        if (empty($title)) {
            continue;
        }
        
        $menuItems[] = [
            'title' => $title,
            'id'    => sanitize_title($title)
        ];
    }
    reset_rows();
}
?>

<div class="bg-<?= $headerColor ?> fixed top-0 flex justify-between items-center w-full h-24 z-30">
    <?php if ($leftMenuItem && $socialLinks) { ?>
    <div class="hidden lg:flex ml-5 gap-6">
        <?php 
        
        foreach ($socialLinks as $link) {
            if ($link['social_media_link'] && $link['social_media_icon']) {

        ?>
        <a href="<?= $link['social_media_link'] ?>" target="_blank">
            <span class="iconify text-center size-8 text-white" data-icon="<?= $link['social_media_icon'] ?>"></span>
        </a>
        <?php }} ?>
    </div>
    <?php } else { ?>
    <div class="hidden lg:flex text-<?= $timeColor ?> items-center ml-5 gap-2">
        <span>Amsterdam, NL</span>
        <span>-</span>
        <time id="local-time"></time>
    </div>
    <?php } ?>
    <a href="#" id="brand" class="text-3xl w-60 sm:w-auto font-heading text-<?= $textColor ?> ml-5 lg:ml-0"><?= $text ?></a>
    <button class="btn mr-5 hidden lg:block animations" data-card="contact">Contact</button>
    <div class="lg:hidden mr-5">
        <button id="menu-toggle" class="menu-btn">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </button>
    </div>
</div>

<div id="mobile-menu" class="lg:hidden fixed flex top-0 -right-full animations w-full h-full z-20">
    <div class="w-2/6 h-full bg-linear-to-l from-<?= $mobileGlowColor ?> to-transparent"></div>
    <div class="w-4/6 flex flex-col h-full bg-<?= $mobileBackgroundColor ?>">
        <?php if ($menuItems) { ?>
            <nav class="flex flex-col mt-32 text-<?= $mobileTextColor ?> gap-8 text-center text-2xl font-text">
                <?php foreach ($menuItems as $item) { ?>
                    <a class="menu-item" href="#<?= $item['id'] ?>"><?= $item['title'] ?></a>
                <?php } ?>
            </nav>
        <?php } ?>
        <?php if ($socialLinks) { ?>
            <div class="grid grid-cols-3 justify-items-center mt-auto mb-8">
                <?php 
                
                foreach ($socialLinks as $link) {
                    if ($link['social_media_link'] && $link['social_media_icon']) {

                ?>
                <a href="<?= $link['social_media_link'] ?>" target="_blank">
                    <span class="iconify text-center size-8 text-<?= $mobileTextColor ?>" data-icon="<?= $link['social_media_icon'] ?>"></span>
                </a>
                <?php }} ?>
            </div>
        <?php } ?>
        </div>
    </div>

</div>