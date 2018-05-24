<?php
//Template Name: Board of Directors
get_header();
include 'layout/top-header.php';
include 'layout/brand.php';

?>
    <div class="container">
    <div class="row">
        <div id="main" class="col-md-12">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> itemscope itemtype="http://schema.org/BlogPosting">
                    <header class="article-header page-header">

                        <br>
                        <h1 class="entry-title page-title" itemprop="headline"><?php the_title(); ?></h1>
                        <h3 class="entry-sub-title"><?php the_field('sub_title'); ?></h3>

                        <img class="aligncenter wp-image-1365 size-full" style="padding-bottom: 35px;" src="http://cvpg.mindsharedevelopment.com/wp-content/uploads/2018/05/cvpg.png" alt="" width="1300" height="82" />


                    </header>
                    <section class="content clearfix" itemprop="articleBody">
                        <?php the_content(); ?>
                        <?php
                        $i = 1;
                        if( have_rows('board_of_directors') ):
                            echo '<div class="row">';
                            $i = 1;
                            echo '<div class="row staff-members">';
                            // loop through the rows of data
                            while ( have_rows('board_of_directors') ) : the_row();
                                $image_obj = get_sub_field('image');

                                $name = get_sub_field('name');
                                $title = get_sub_field('title');
                                echo '<div class="col-md-3 single-staff">';
                                if($image_obj) :
                                    $image_url = $image_obj['url'];
                                    $image_type = wp_check_filetype( $image_url );

                                    $image_src = aq_resize($image_url, 180, 180, true);
                                    echo '<img src="' . $image_src . '"/>';
                                endif;

                                echo '<h5 class="staff-name">' . $name . '</h5>';
                                echo '<span class="staff-title">' . $title . '</span>';
                                echo '</div>';
                            endwhile;
                            echo '</div>';
                        endif;
                        echo '</div>';

                        ?>
                    </section>

                </article>

            <?php endwhile; ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php include 'layout/top-footer.php';
get_footer();


