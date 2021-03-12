<?php get_header(); ?>

    <section class="single-post">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <div class="container content space">
                <h1 class="tac"><?php the_title(); ?></h1>
                <?php if ( has_post_thumbnail() ) : ?>
                    <figure class="thumbnail">
                        <?php the_post_thumbnail( 'large' ); ?>
                    </figure>
                <?php endif; ?>
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                <div class="author">Author: <?php the_author(); ?></div>
                <div class="cats">Category: <?php echo cats($post->ID); ?></div>
                <div class="text last-no-spacing cfx">
                    <?php the_content(); ?>
                </div>
                <div class="tags_list">Tags: <?php the_tags(''); ?></div>
                <div class="share-icons">
                    <a class="fab fa-twitter" href="https://twitter.com/intent/tweet?status=<?php the_title(); ?> - <?php the_permalink(); ?>" title="Tweet It" target="_blank" rel="noopener"></a>
                    <a class="fab fa-facebook" href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share at Facebook" target="_blank" rel="noopener"></a>
                    <a class="fab fa-linkedin" href="https://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>" title="Share at LinkedIn" target="_blank" rel="noopener"></a>
                    <a class="fab fa-pinterest" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" title="Pin It" target="_blank" rel="noopener"></a>
                </div>
                <div class="post_navigation">
                    <?php if (get_previous_post_link()) : ?>
                        <div class="prev_post"><?php previous_post_link('<span><i class="i-arr_left"></i>Previous</span> %link'); ?></div>
                    <?php endif; ?>
                    <?php if (get_next_post_link()) : ?>
                        <div class="next_post"><?php next_post_link('<span>Next<i class="i-arr_right"></i></span> %link'); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; endif; ?>
    </section>

<?php get_footer(); ?>
