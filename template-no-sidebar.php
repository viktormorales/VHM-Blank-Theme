<?php
/*
Template Name: No Sidebar template
*/
?>
<?php get_header(); ?>
    <div class="container">
        <section id="page">
            <?php
            // Start the loop.
            while ( have_posts() ) { the_post();
                get_template_part( 'content', get_post_format() );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

                // Previous/next post navigation.
                the_post_navigation( array(
                    'prev_text' => '<span class="post-title"><i class="fa fa-angle-double-left"></i> %title</span>',
                    'next_text' => '<span class="post-title">%title <i class="fa fa-angle-double-right"></i></span>'
                ) );
            }
            ?>
        </section><!-- .content-area -->
    </div>
<?php get_footer(); ?>
