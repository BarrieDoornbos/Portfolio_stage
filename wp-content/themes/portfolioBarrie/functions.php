<?php
function portfolio_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'portfolio_theme_setup');

function portfolio_enqueue_scripts() {
    wp_enqueue_style( 'main-css', get_template_directory_uri() . '/assets/css/output.css');
    wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/assets/js/main.js', array(), filemtime(get_template_directory() . '/assets/js/main.js'), true);

    wp_enqueue_style( 'google-fonts-1', get_field('heading_font_link'));
    wp_enqueue_style( 'google-fonts-2', get_field('text_font_link'));

    wp_enqueue_script( 'iconify', 'https://code.iconify.design/3/3.1.0/iconify.min.js' );
}
add_action( 'wp_enqueue_scripts', 'portfolio_enqueue_scripts');

function portfolio_register_acf_blocks() {
    register_block_type( __dir__ . '/blocks/introduction');
    register_block_type( __dir__ . '/blocks/text-block');
    register_block_type( __dir__ . '/blocks/skills');
    register_block_type( __dir__ . '/blocks/projects');
}
add_action('init', 'portfolio_register_acf_blocks');

// Add options page
if(function_exists('acf_add_options_page')) {
    if (get_option('mijn_thema_licentie_activatie')) {
        acf_add_options_page(array(
            'page_title'    => 'Algemene instellingen',
            'menu_title'    => 'Thema instellingen',
            'menu_slug'     => 'theme-general-settings',
            'capability'    => 'edit_posts',
            'redirect'      => false
        ));
    }
}

function add_theme_colors() {
    $backgroundColor        = get_field('background_color', 'option');
    $dividingLineColor      = get_field('dividing_line_color', 'option');
    $blockBorderColor       = get_field('block_border_color', 'option');
    $blockBackgroundColor   = get_field('block_background_color', 'option');
    $brandShadowColor       = get_field('brand_text_shadow_color', 'option');
    $navCircleFillColor     = get_field('nav_circle_fill_color', 'option');

    $themeColor1            = get_field('theme_color_1', 'option');
    $themeColor2            = get_field('theme_color_2', 'option');
    $themeColor3            = get_field('theme_color_3', 'option');
    $themeColor4            = get_field('theme_color_4', 'option');
    $themeColor5            = get_field('theme_color_5', 'option');

    $headingColor           = get_field('heading_color', 'option');
    $headingShadow          = get_field('heading_shadow', 'option');
    $headingShadowColor     = get_field('heading_shadow_color', 'option');
    $fontHeading            = get_field('heading_font_name', 'option');
    $textColor              = get_field('text_color', 'option');
    $textShadow             = get_field('text_shadow', 'option');
    $textShadowColor        = get_field('text_shadow_color', 'option');
    $fontText               = get_field('text_font_name', 'option');
    $typewriterColor        = get_field('typewriter_blinker_color', 'option');

    $buttonColor            = get_field('button_color', 'option');
    $buttonTextColor        = get_field('button_text_color', 'option');
    $buttonHoverColor       = get_field('button_hover_color', 'option');
    $buttonHoverTextColor   = get_field('button_hover_text_color', 'option');
    $buttonRadius           = get_field('button_border_radius', 'option') . 'px';
    echo '<style>
        :root {
            --background-color: '           . esc_html($backgroundColor) . ';
            --dividing-line-color: '        . esc_html($dividingLineColor) . ';
            --block-border-color: '         . esc_html($blockBorderColor) . ';
            --block-background-color: '     . esc_html($blockBackgroundColor) . ';
            --brand-shadow-color: '         . esc_html($brandShadowColor) . ';
            --nav-circle-fill-color: '      . esc_html($navCircleFillColor) . ';
            --theme-color-1: '              . esc_html($themeColor1) . ';
            --theme-color-2: '              . esc_html($themeColor2) . ';
            --theme-color-3: '              . esc_html($themeColor3) . ';
            --theme-color-4: '              . esc_html($themeColor4) . ';
            --theme-color-5: '              . esc_html($themeColor5) . ';
            --heading-color: '              . esc_html($headingColor) . ';
            --heading-shadow: '             . ($headingShadow ? '-1px -1px 0 var(--heading-shadow-color), 1px -1px 0 var(--heading-shadow-color), -1px 1px 0 var(--heading-shadow-color), 1px 1px 0 var(--heading-shadow-color);' : 'none') . ';
            --heading-shadow-color: '       . esc_html($headingShadowColor) . ';
            --font-heading: '               . esc_html($fontHeading) . ';
            --text-color: '                 . esc_html($textColor) . ';
            --text-shadow: '                . ($textShadow ? '-1px -1px 0 var(--text-shadow-color), 1px -1px 0 var(--text-shadow-color), -1px 1px 0 var(--text-shadow-color), 1px 1px 0 var(--text-shadow-color);' : 'none') . ';
            --text-shadow-color: '          . esc_html($textShadowColor) . ';
            --font-text: '                  . esc_html($fontText) . ';
            --typewriter-color: '           . esc_html($typewriterColor) . ';
            --button-color: '               . esc_html($buttonColor) . ';
            --button-text-color: '          . esc_html($buttonTextColor) . ';
            --button-hover-color: '         . esc_html($buttonHoverColor) . ';
            --button-hover-text-color: '    . esc_html($buttonHoverTextColor) . ';
            --button-border-radius: '       . esc_html($buttonRadius) . ';

        }</style>';
}
add_action('wp_head', 'add_theme_colors');
?>