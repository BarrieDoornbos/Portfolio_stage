<?php

$navCircleOutlineColor  = get_field('nav_circle_outline_color', 'option');
$navTextColor           = get_field('nav_text_color', 'option');

$menuItems = [];

if (have_rows('page_sections')) {
    while (have_rows('page_sections')) {
        the_row();
        $title = get_sub_field('title');

        if (empty($title) || $title == 'Skills') {
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

<?php if (!empty($menuItems)) { ?>
<aside class="text-white h-full fixed top-0 right-0 hidden lg:flex lg:flex-col justify-center items-end z-10">
    <nav class="flex flex-col gap-4 mr-5">
        <?php foreach ($menuItems as $item) { ?>
        <a class="side-menu-item group flex flex-row overflow-hidden self-end justify-end w-6 gap-2 animations" href="#<?= $item['id'] ?>">
            <div class="text-nowrap text-<?= $navTextColor ?>"><?= $item['title'] ?></div>
            <div class="nav-circle border-2 border-<?= $navCircleOutlineColor ?> rounded-full min-w-6 animations"></div>
        </a>
        <?php } ?>
    </nav>
</aside>
<?php } ?>