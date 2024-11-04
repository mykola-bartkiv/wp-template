</div>
<footer>
    <div class="wrap">
        <a href="<?php echo get_home_url(); ?>" class="footer-logo">
            <img src="<?php echo theme(); ?>/img/logo.png" alt="Footer Logo" width="207" height="46">
        </a>
        <?php if ( has_nav_menu( 'footer_menu' ) ) : ?>
            <nav class="footer-menu">
                <?php wp_nav_menu( array(
                    'container'      => false,
                    'items_wrap'     => '<ul id="%1$s">%3$s</ul>',
                    'theme_location' => 'footer_menu',
                    'depth'          => 1,
                ) ); ?>
            </nav>
        <?php endif; ?>
        <?php if ( $copyright = get_field( 'copyright', 'option' ) ) : ?>
            <span class="copyright">Copyright &#169; <?php echo date( "Y" ); ?> <?php echo $copyright; ?></span>
        <?php endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
