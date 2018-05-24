<?php
//Template Name: Contact
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

                        <img class="aligncenter wp-image-1365 size-full" src="http://cvpg.mindsharedevelopment.com/wp-content/uploads/2018/05/cvpg.png" alt="" width="1300" height="82" />
                    </header>
                    <section class="clearfix" itemprop="articleBody">
                        <div class="col-sm-6 alignleft">
                            <?php the_field('col_1'); ?>
                        </div>
                        <div class="col-sm-6 alignleft">
                            <?php the_field('col_2'); ?>
                        </div>
                        <?php the_content(); ?>
                    </section>

                </article>

            <?php endwhile; ?>

            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'layout/top-footer.php';
get_footer();
