<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Perfume Store
 */

get_header(); ?>

<div class="box-image">
    <div class="single-page-img"></div>
    <div class="page-header">
        <h2><?php the_title();?></h2> 
        <span><?php perfume_store_the_breadcrumb(); ?></span>
    </div> 
</div>

<div class="container">
    <div id="content" class="contentsecwrap">
    <?php
        $perfume_store_single_post_layout_option = get_theme_mod( 'perfume_store_sidebar_single_post_layout','right');
        if($perfume_store_single_post_layout_option == 'right'){ ?>
        <div class="row">
            <div class="col-lg-9 col-md-8">
                <section class="site-main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content-single', 'single' ); ?>
                        <?php the_post_navigation(); ?>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                        	comments_template();
                        ?>
                    <?php endwhile; // end of the loop. ?>
                </section>
            </div>
            <div class="col-lg-3 col-md-4">
                <?php get_sidebar();?>
            </div>
        </div>
        <?php } elseif($perfume_store_single_post_layout_option == 'left'){ ?>
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <?php get_sidebar();?>
            </div>
            <div class="col-lg-9 col-md-8">
                <section class="site-main">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'template-parts/post/content-single', 'single' ); ?>
                        <?php the_post_navigation(); ?>
                        <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || '0' != get_comments_number() )
                        	comments_template();
                        ?>
                    <?php endwhile; // end of the loop. ?>
                </section>
            </div>
        </div>
        <?php } else { ?>
            <section class="site-main">
                <?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/post/content-single', 'single' ); ?>
                    <?php the_post_navigation(); ?>
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                    ?>
                <?php endwhile; // end of the loop. ?>
            </section>
        <?php } ?>
        <div class="clear"></div>
    </div>
</div>

<?php get_footer(); ?>