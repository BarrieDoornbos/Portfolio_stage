<?php

$title = get_sub_field('title');

?>

       <div class="col-span-1 flex flex-col">
            <?php if (!empty($title)) { ?>
                <div class="flex items-center">
                    <div class="dividing-line -ml-[50vw]"></div>
                    <h2 class="px-2 bg-background z-2"><?= $title ?></h2>
                    <div class="dividing-line -mr-[50vw]"></div>
                </div>
            <?php } ?>

            <div class="block-shadow mt-8 p-8 flex-1">
                <?php if (have_rows('skill_list')) { ?>
                    <div class="justify-items-center">
                        <?php 
                        
                        while (have_rows('skill_list')) {
                            the_row();

                        ?>
                        <h4><?= get_sub_field('skill_category') ?></h4>
                            <?php if (have_rows('skill')) { ?>
                                <div class="grid grid-cols-3 md:grid-cols-6 xl:grid-cols-3 gap-4 mt-4 mb-8">
                                    <?php

                                    while (have_rows('skill')) {
                                        the_row();

                                    ?>
                                    <div>
                                        <?php

                                        $skillImage = get_sub_field('skill_image');
                                        $skillName  = get_sub_field('skill_name');

                                        if (!empty($skillImage)) {
                                        ?>
                                        <div class="h-24 content-center mb-2">
                                            <img src="<?= $skillImage['url'] ?>" alt="<?= $skillImage['alt'] ?>" class="max-w-24 max-h-24 justify-self-center">
                                        </div>
                                        <?php 
                                        
                                        } 
                                        if (!empty($skillName))

                                        ?>
                                        <p class="justify-self-center"><?= $skillName ?></p>
                                    </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>