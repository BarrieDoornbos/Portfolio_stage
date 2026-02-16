<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/output.css"/>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php wp_head(); ?>
</head>

<body>
    <header>
        <?php get_template_part('template-parts/menu/menu'); ?>
    </header>
</body>
</html>
