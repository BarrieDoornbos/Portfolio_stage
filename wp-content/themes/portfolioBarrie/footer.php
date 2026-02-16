<?php

$backgroundColor        = get_field('footer_background_color', 'option');
$textColor              = get_field('footer_text_color', 'option');
$footerText             = get_field('footer_text', 'option');
$footerCTA              = get_field('footer_cta', 'option');
$showContactButton      = get_field('contact_button', 'option');
$showSocials            = get_field('footer_socials', 'option');
$socialLinks            = get_field('social_links', 'option');
$cardBackgroundColor    = get_field('card_background_color', 'option');
$cardTitleColor         = get_field('card_title_color', 'option');
$cardTitleShadow        = get_field('card_title_shadow', 'option');
$cardTextColor          = get_field('card_text_color', 'option');

?>

<footer class="bg-<?= $backgroundColor ?>">
    <div class="container pt-8 mb-0">
        <div class="text-center mt-8 mb-12">
            <?php if (!empty($footerText)) { ?>
            <h3 class="text-<?= $textColor ?>"><?= $footerText ?></h3>
            <?php } if (!empty($footerCTA)) { ?>
            <a href="<?= $footerCTA['url'] ?>" target="<?= $footerCTA['target'] ?>" class="text-center btn animations"><?= $footerCTA['title'] ?></a>
            <?php } if ($showContactButton) { ?>
            <button class="btn animations mt-4" data-card="contact">Contact</button>
            <?php } ?>
        </div>
        <?php if ($socialLinks && $showSocials) { ?>
        <div>
            <h4 class="text-center text-<?= $textColor ?>">Of bekijk mijn social media:</h4>
            <div class="flex justify-around mt-4 mb-8">
                <?php 
                
                foreach ($socialLinks as $link) {
                    if ($link['social_media_link'] && $link['social_media_icon']) {

                ?>
                <a href="<?= $link['social_media_link'] ?>" target="_blank">
                    <span class="iconify text-center size-8 text-white" data-icon="<?= $link['social_media_icon'] ?>"></span>
                </a>
                <?php }} ?>
            </div>
        </div>
        <?php } ?>
        <div class="site-info text-center">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>

<div id="card-overlay" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50"></div>
        <div id="card" class="absolute top-2/10 lg:top-1/10 left-1/10 lg:left-3/20 w-8/10 lg:w-7/10 h-6/10 lg:h-8/10 bg-<?= $cardBackgroundColor ?> rounded-2xl animations translate-y-full overflow-hidden">
            <button id="card-close" class="absolute text-white font-extrabold top-4 right-4 z-10">✕</button>
            <div data-card="project" class="flex flex-col h-full">
                <img id="card-image" class="w-full h-3/10 md:h-4/10 object-cover object-top" alt=""/>
                <div class="flex flex-col p-6 h-7/10 md:h-6/10">
                    <h3 id="card-title" class="self-center break-all text-<?= $cardTitleColor ?> <?= $cardTitleShadow ? '' : 'text-shadow-none' ?>"></h3>
                    <div id="card-description" class="mb-4 mt-1 lg:mt-4 overflow-y-auto text-<?= $cardTextColor ?>"></div>
                    <a id="card-link" href="" target="_blank" class="block mt-auto btn animations self-center text-center w-40">Bekijk website</a>
                </div>
            </div>
            <div data-card="contact" class="flex flex-col h-full p-6" hidden>
                <h3 class="self-center mb-6 text-<?= $cardTitleColor ?> <?= $cardTitleShadow ? '' : 'text-shadow-none' ?>">Contact</h3>
                <div class="justify-items-center text-center text-<?= $cardTextColor ?> overflow-hidden">
                    <?= do_shortcode('[contact-form-7 id="e82dfae" title="Contactformulier 1"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>