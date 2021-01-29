</div>
<footer>
    <div class="container">
        <?php if ( $copyright = get_field( 'copyright', 'option' ) ) : ?>
            <span class="copyright">Copyright &#169; <?php echo date( "Y" ); ?> <?php echo $copyright; ?></span>
        <?php endif; ?>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
