<?php get_header(); ?>

<?php get_sidebar(); ?>

<main class="overflow-hidden">
    <div class="container">
    <?php while (have_rows('page_sections')){
        
        the_row();

        if (get_row_layout() === 'text_block'){
            get_template_part('template-parts/builder/text-block');
        } elseif (get_row_layout() === 'introduction'){
            get_template_part('template-parts/builder/introduction');
        } elseif (get_row_layout() === 'skills'){
            get_template_part('template-parts/builder/skills');
        } elseif (get_row_layout() === 'projects'){
            get_template_part('template-parts/builder/projects');
        }
    } ?>
    </div>
</main>

<?php get_footer(); ?>