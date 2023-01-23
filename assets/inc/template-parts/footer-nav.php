<!-- FOOTER -->
<footer class="footer">
    <div class="grid-container">
        <div class="grid-x align-middle">
            <nav class="cell small-order-2 large-order-1 large-auto large-text-left text-center footer__left">
                <?php 
                    $phone_number = get_field('phone_number', 'options');
                    $phone_number_txt = get_field('phone_number_txt', 'options');
                ?>
                <?php if( $phone_number_txt ): ?>
                <a href="tel: <?php echo $phone_number; ?>" class="footer__phone"><?php echo $phone_number_txt; ?></a>
                <?php endif; ?>
                <?php 
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-navigation',
                            'menu'           => '',
                            'orderby'        => 'menu_order',
                            'container' => false,
                            'menu_class' => 'footer__items',
                            'li_class'  => 'footer__item',
							'a_class'  => 'footer__link'
                        )
                    );
                ?>                
            </nav>
            <div class="cell small-order-1 large-order-2 large-shrink footer__right">
                <div class="footer__icons">
                    <?php 
                        $facebook = get_field('facebook', 'options');
                        $instagram = get_field('instagram', 'options');
                        $donatelink = get_field('donate_today', 'options');
                        $youtube = get_field('youtube', 'options');
                    ?>

                    <?php if( $facebook ): ?>
                        <a href="<?php echo $facebook; ?>" target="_blank" class="footer__icon footer__icon--facebook">Facebook</a>
                    <?php endif; ?>
                    <?php if( $instagram ): ?>
                        <a href="<?php echo $instagram; ?>" target="_blank" class="footer__icon footer__icon--instagram">Instagram</a>
                    <?php endif; ?>
                    <?php if( $youtube ): ?>
                        <a href="<?php echo $youtube; ?>" target="_blank" class="footer__icon footer__icon--youtube">youtube</a>
                    <?php endif; ?>
                </div>                 
                <?php if( $donatelink ): ?>
                    <a href="<?php echo $donatelink; ?>" class="button donate footer__right--button">Donate Today!</a>
                <?php endif; ?>                
            </div>
        </div>
    </div> 
</footer>