<!-- FOOTER -->
<footer class="footer">
  <div class="grid-container">
    <div class="grid-x align-middle">
      <nav class="cell small-order-2 large-order-1 large-auto large-text-left text-center footer__left">
        <?php
        $phone_number = get_field('phone_number', 'options');
        $phone_number_txt = get_field('phone_number_txt', 'options');
        ?>
        <?php if ($phone_number_txt) : ?>
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
          $tiktok = get_field('tiktok', 'options');
          ?>

          <?php if ($facebook) : ?>
            <a href="<?php echo $facebook; ?>" target="_blank" class="footer__icon footer__icon--facebook">Facebook</a>
          <?php endif; ?>
          <?php if ($instagram) : ?>
            <a href="<?php echo $instagram; ?>" target="_blank" class="footer__icon footer__icon--instagram">Instagram</a>
          <?php endif; ?>
          <?php if ($youtube) : ?>
            <a href="<?php echo $youtube; ?>" target="_blank" class="footer__icon footer__icon--youtube">youtube</a>
          <?php endif; ?>
          <?php if ($tiktok) : ?>
            <a href="<?php echo $tiktok; ?>" target="_blank" class="footer__icon footer__icon--tiktok">
              <svg class="w-8 h-8" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M16.5999 5.82C15.9163 5.03962 15.5396 4.03743 15.5399 3H12.4499V15.4C12.4261 16.071 12.1428 16.7066 11.6597 17.1729C11.1766 17.6393 10.5314 17.8999 9.85991 17.9C8.43991 17.9 7.25991 16.74 7.25991 15.3C7.25991 13.58 8.91991 12.29 10.6299 12.82V9.66C7.17991 9.2 4.15991 11.88 4.15991 15.3C4.15991 18.63 6.91991 21 9.84991 21C12.9899 21 15.5399 18.45 15.5399 15.3V9.01C16.7929 9.90985 18.2973 10.3926 19.8399 10.39V7.3C19.8399 7.3 17.9599 7.39 16.5999 5.82Z" fill="white" />
              </svg>
            </a>
          <?php endif; ?>
        </div>
        <?php if ($donatelink) : ?>
          <a href="<?php echo $donatelink; ?>" class="button donate footer__right--button">Donate Today!</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>