<?php 

$title              = get_sub_field('title');
$name               = get_sub_field('name');
$nameColor          = get_sub_field('name_text_color');
$occupationColor    = get_sub_field('occupation_text_color');
$text               = get_sub_field('text');
$image              = get_sub_field('image');

$occupationTexts = [];

if (have_rows('occupation')) {
    while (have_rows('occupation')) {
        the_row();
        $occupationTexts[] = get_sub_field('occupation_text');
    }
}
?>

<section id="<?= sanitize_title($title) ?>">
    <div>
        <?php if (!empty($title)) { ?>
            <div class="flex items-center">
                <div class="dividing-line -ml-[50vw]"></div>
                <h2 class="px-2"><?= $title ?></h2>
                <div class="dividing-line -mr-[50vw]"></div>
            </div>
        <?php } ?>
        <div class="block-shadow mt-8">
            <div class="grid lg:grid-cols-2 gap-6 p-8 items-center">
                <div class="w-full justify-items-center lg:order-1">
                    <?php if (!empty($image)) { ?>
                        <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" class=" w-full sm:w-4/5 h-64 lg:h-full object-contain" />
                    <?php } ?>
                </div>
                <div>
                    <h2 class="mb-2 text-<?= $nameColor ?>"><?= $name ?></h2>
                    <?php if (!empty($occupationTexts)) { ?>
                        <h3 class="typewriter text-<?= $occupationColor ?>" data-texts='<?= json_encode($occupationTexts); ?>'></h3>
                    <?php } ?>
                    <p class="mt-6"><?= $text ?></p>
                </div>
            </div>
        </div>
    </div>
</section>