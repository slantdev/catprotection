
</div>

<?php get_template_part( 'assets/inc/template-parts/tp-subscribe-popup' );?>
<?php get_template_part('assets/inc/template-parts/tp-no-more-voting-popup'); ?>
<?php get_template_part('assets/inc/template-parts/tp-share-email'); ?>

<?php wp_footer(); ?>

<?php if (defined('WP_ENV') && (WP_ENV == 'development') && isset($_GET['debug'])) : ?>
    <?php
        global $template;
        var_dump(basename($template));
        var_dump($wp_query);
    ?>
<?php endif; ?>



</body>
</html>
