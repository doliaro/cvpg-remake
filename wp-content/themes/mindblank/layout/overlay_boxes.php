<div class="container">
        <div class="row">
            <div class="col-md-4 box box-1">
                <?php
                    if( have_rows('box_1') ){
                        while ( have_rows('box_1') ) : the_row(); ?>
                            <div class="overlay-icon">
                                <i class="<?php echo get_sub_field('icon'); ?>"></i>
                            </div>
                            <?php the_sub_field('title');?>
                            <br>
                            <?php if (the_sub_field('text')) : ?>
                                <div class="overlay-text">
                                    <?php the_sub_field('text');?>
                                </div>
                            <?php endif ?>
                        <?php endwhile;
                    }
                ?>
                <br>
                <div class="button-wrapper">
                    <a href="http://google.com" class="overlay-btn btn btn-primary">Learn More</a>
                </div>
            </div>
            <div class="col-md-4 box box-2">
                <?php
                    if( have_rows('box_2') ){
                        while ( have_rows('box_2') ) : the_row(); ?>
                            <div class="overlay-icon">
                                <i class="<?php echo get_sub_field('icon'); ?>"></i>
                            </div>
                            <?php the_sub_field('title');?>
                            <br>
                            <?php if (the_sub_field('text')) : ?>
                                <div class="overlay-text">
                                    <?php the_sub_field('text');?>
                                </div>
                            <?php endif ?>
                        <?php endwhile;
                    }
                ?>
                <br>
                <div class="button-wrapper">
                    <a href="http://google.com" class="overlay-btn btn btn-primary">Learn More</a>
                </div>
            </div>
            <div class="col-md-4 box box-3">
                <?php
                    if( have_rows('box_3') ){
                        while ( have_rows('box_3') ) : the_row(); ?>
                            <div class="overlay-icon">
                                <i class="<?php echo get_sub_field('icon'); ?>"></i>
                            </div>
                            <?php the_sub_field('title');?>
                            <br>
                            <?php if (the_sub_field('text')) : ?>
                                <div class="overlay-text">
                                    <?php the_sub_field('text');?>
                                </div>
                            <?php endif ?>
                        <?php endwhile;
                    }
                ?>
                <br>
                <div class="button-wrapper">
                    <a href="/directory" class="overlay-btn btn btn-primary">Learn More</a>
                </div>
            </div>
        </div>
    </div> <!-- container -->