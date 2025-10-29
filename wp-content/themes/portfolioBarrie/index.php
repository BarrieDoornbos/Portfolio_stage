<?php
$headingFontName        = get_field('heading_font_name');
$headingFontLink        = get_field('heading_font_link');
$textFontLink           = get_field('text_font_link');
$textFontName           = get_field('text_font_name');

$headingColor           = get_field('heading_color');
$textColor              = get_field('text_color');
$headingShadow          = get_field('heading_shadow');
$headingShadowColor     = get_field('heading_shadow_color');
$textShadow             = get_field('text_shadow');
$textShadowColor            = get_field('text_shadow_color');

$projects               = ['Project 1', 'Project 2', 'Project 3', 'Project 4', 'Project 5', 'Project 6', 'Project 7', 'Project 8', 'Project 9', 'Project 10', 'Project 11', 'Project 12', 'Project 13'];
?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="./assets/css/output.css" rel="stylesheet">
        
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <style>
            @import url('<?= $headingFontLink ?>');
            @import url('<?= $textFontLink ?>');

            .scrollbar-hidden::-webkit-scrollbar {
                display: none;
            }

            h1,
            h2,
            h3,
            h4,
            h5,
            h6 {
                font-family: '<?= $headingFontName ?>', cursive;
                color : <?= $headingColor ?>;
            }

            p{
                font-family: '<?= $textFontName ?>', cursive;
                color : <?= $textColor ?>;
            }

            .heading-shadow-outline {
                text-shadow:
                1px 1px 0 <?= $headingShadowColor ?>,
                -1px -1px 0 <?= $headingShadowColor ?>,
                1px -1px 0 <?= $headingShadowColor ?>,
                -1px 1px 0 <?= $headingShadowColor ?>,
                1px 0 0 <?= $headingShadowColor ?>,
                -1px 0 0 <?= $headingShadowColor ?>,
                0 1px 0 <?= $headingShadowColor ?>,
                0 -1px 0 <?= $headingShadowColor ?>;
            }

            .text-shadow-outline {
                text-shadow:
                1px 1px 0 <?= $textShadowColor ?>,
                -1px -1px 0 <?= $textShadowColor ?>,
                1px -1px 0 <?= $textShadowColor ?>,
                -1px 1px 0 <?= $textShadowColor ?>,
                1px 0 0 <?= $textShadowColor ?>,
                -1px 0 0 <?= $textShadowColor ?>,
                0 1px 0 <?= $textShadowColor ?>,
                0 -1px 0 <?= $textShadowColor ?>;
            }
        </style>
    </head>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <body class = "bg-[<?= get_field('bg_color'); ?>] text-white">
        <div class="flex items-center pt-10">
            <div class="flex-grow border-t border-[#0089FA]"></div>
            <h1 class = "px-5 text-5xl <?= $headingShadow ? 'heading-shadow-outline' : ''?>"><?= get_field('heading_text'); ?></h1>
            <div class="flex-grow border-t border-[#0089FA]"></div>
        </div>

        <div class="max-w-[80%] m-auto overflow-x-scroll scrollbar-hidden">
            <div class="flex">
                <?= $blogPageProjects ?>
                <?php foreach($projects as $project) { ?>
                    <div class="min-w-[300px] h-[200px] m-5 rounded-lg bg-white flex flex-row items-center justify-center text-2xl text-center <?= $textShadow ? 'text-shadow-outline' : ''?>">
                        <p> <?= $project ?> </p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <?php 
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => -1,
            'category_name' => 'blogPagina',);

            $blogPageProjects = new WP_Query($args);
        
            if ( $blogPageProjects->have_posts() ) { ?>
                <div class="hidden xl:block max-w-[80%] m-auto overflow-x-scroll scrollbar-hidden">
                    <div class="flex items-center py-10">
                        <?php
                        while ( $blogPageProjects->have_posts() ) {
                            $blogPageProjects->the_post(); ?>
                            <div class="min-w-[10%] hover:min-w-[20%] h-[200px] hover:h-[250px] transition-all duration-1000 border border-2 border-black m-5 flex mx-auto items-center justify-center text-2xl text-center <?= $textShadow ? 'text-shadow-outline' : ''?> bg-cover" style="background-image: url('<?= the_post_thumbnail_url() ?>')">
                                    <p class="w-full h-full flex justify-center items-center transition-all duration-1000 opacity-0 hover:opacity-100">
                                        <?= get_the_title(); ?>
                                    </p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } else {
                esc_html_e( 'No posts have been found' );
            } ?>
        </div>
        </div>
        <?php
            wp_reset_postdata();       
        ?>
        </body>
<?php endwhile; endif; ?>