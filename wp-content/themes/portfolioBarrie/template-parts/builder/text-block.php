<?php

$title      = get_sub_field('title');
$leadText   = get_sub_field('lead_text');
$leadSize   = get_sub_field('lead_text_size');
$leadShadow = get_sub_field('lead_text_shadow');
$leadColor  = get_sub_field('lead_text_color');
$text       = get_sub_field('text');

?>
<section class="xl:col-span-3">
    <div class="grid xl:grid-cols-3 gap-10 lg:gap-16 items-stretch">
        <div id="<?= esc_attr(sanitize_title($title)); ?>" class="col-span-1 xl:col-span-2 flex flex-col">
            <?php if (!empty($title)) { ?>
                <div class="flex items-center">
                    <div class="dividing-line -ml-[50vw]"></div>
                    <h2 class="px-2 bg-background z-2"><?= $title ?></h2>
                    <div class="dividing-line -mr-[50vw]"></div>
                </div>
            <?php } ?>
            
            <div class="block-shadow p-8 mt-8 flex-1">
                <?php if (!empty($leadText)) { ?>
                <div class="mb-6">
                    <p class="<?= $leadShadow ? '' : 'text-shadow-none!' ?> text-<?= $leadColor ?>!" style="font-size: <?= $leadSize ?>px;"><?= $leadText ?></p>
                </div>
                <?php 
                
                } 
                if (!empty($text)) {

                ?>
                    <div><?= $text ?></div>
                <?php } ?>
            </div>
        </div>