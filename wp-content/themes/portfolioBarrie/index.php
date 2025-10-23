<?php
$bgColor = get_field('background_color');
$headingColor = get_field('heading_color');
$textColor = get_field('text_color');
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <body class = "bg-black">
        <h1 class = "text-white">Home</h1>
        </body>
<?php endwhile; endif; ?>