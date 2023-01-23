<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>

  <title><?php wp_title(''); ?></title>

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <meta name="facebook-domain-verification"content="qoktkpag3a4h43w7r8dwii2gtzukfh"/>
  <link rel="profile" href="http://gmpg.org/xfn/11">

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#81bb26">
  <meta name="theme-color" content="#ffffff">

	<?php wp_head(); ?>

  <!-- Facebook Pixel Code -->
  <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window,document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '869537140086673');
    fbq('init', '1958191807813800');
    fbq('track', 'PageView');
  </script>
<noscript>
<img height="1" width="1" src="https://www.facebook.com/tr?id=869537140086673&ev=PageView&noscript=1"/>
<img height="1" width="1" src="https://www.facebook.com/tr?id=1958191807813800&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

</head>

<body <?php body_class(); ?> <?php
if (is_single()) {
    ?>
	data-post_id="<?php echo esc_attr($post->ID); ?>"<?php
} ?>>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-129432152-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-129432152-1');
  </script>

    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '869537140086673',
          cookie     : true,
          xfbml      : true,
          version    : 'v4.0'
        });

        FB.AppEvents.logPageView();

      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>

	<div class="stage">

		<header class="header">

		    <div class="header__left">
		        <a href="/" title="Cat Protection - Society of Victoria" class="logo header__logo">
		            <object type="image/svg+xml" data="<?php echo get_template_directory_uri(); ?>/assets/img/cat-logo.svg"></object>
		            <span class="header__logo--txt">Cat Protection<br />Society of Victoria</span>
		        </a>
		    </div>

		    <div class="header__center">
		        <div class="nav-main" >
		            <nav class="nav-main__inner" id="mob-menu" data-auto-height="true" data-hide-for="large">
						<?php
                        wp_nav_menu(
        array(
                                'theme_location' => 'main-navigation',
                                'menu'           => '',
                                'orderby'        => 'menu_order',
                                'container' => false,
                                'items_wrap' => '<ul class="nav-main__items drilldown" data-auto-height="true" data-animate-height="true" data-hide-for="large">%3$s</ul>',
                                'li_class'  => 'nav-main__item',
                                'a_class'  => 'nav-main__link'
                            )
    );
                        ?>
		            </nav>
		        </div>

		    </div>

		    <div class="header__right">
		        <div class="nav-left">
		            <div class="nav-left__toggler" data-responsive-toggle="mob-menu">
		                <div class="nav-toggler" data-toggle="mob-menu">
		                    <div class="nav-toggler__inner"></div>
		                </div>
		            </div>
		            <div class="nav-left__cart cart-top">
		                <a href="/cart" title="" class="cart-top__link">Cart</a>
		                <span class="cart-top__count"><?php echo WC()->cart->cart_contents_count; ?></span>
		            </div>
		            <a href="<?php the_field('donate_today', 'options'); ?>" class="nav-left__button">Donate today!</a>
		        </div>
		    </div>

		</header>
