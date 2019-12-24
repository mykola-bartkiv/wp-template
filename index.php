<?php get_header(); ?>
<section class="content">
    <div class="container">
        <article>
            <h1><?php echo get_the_title(BLOG_ID); ?></h1>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="post">
                    <?php if (has_post_thumbnail()) { ?>
                        <a class="thumb" href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    <?php } else {?>
                        <a class="thumb" href="<?php the_permalink(); ?>">
                            <img src="<?php echo theme() ?>/img/holder.png" alt="holder">
                        </a>
                    <?php } ?>
                    <div class="info">
                        <time datetime="<?php echo get_the_date('Y-m-d'); ?>"><?php echo get_the_date('F j, Y'); ?></time>
                        <div class="author_name">Author:
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo wp_trim_words(get_the_content(), 40); ?></p>
                        <a class="more" href="<?php the_permalink(); ?>">Read more ></a>
                    </div>
                </div>
            <?php endwhile; endif; ?>
        </article>
        <?php echo ( is_active_sidebar( 'blog_sidebar' ) ) ? '<aside>'. dynamic_sidebar('blog_sidebar') .'</aside>' : ''; ?>
    </div>
</section>
<?php get_footer(); ?>