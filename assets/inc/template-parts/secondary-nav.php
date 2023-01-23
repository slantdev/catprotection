<?php 
    $secondarynav = get_field('select_secondary_navigation'); 

    if( $secondarynav['value'] == 'about' ):
        wp_nav_menu(
            array(
                'theme_location' => 'about-secondary-navigation',
                'menu'           => '',
                'menu_class'     => 'sub-nav__items',
                'orderby'        => 'menu_order',
                'container' => false,
                'li_class'  => 'sub-nav__item',
				'a_class'  => 'sub-nav__link'
            )
        );
    elseif( $secondarynav['value'] == 'adopt' ):
        wp_nav_menu(
            array(
                'theme_location' => 'adopt-secondary-navigation',
                'menu'           => '',
                'menu_class'     => 'sub-nav__items',
                'orderby'        => 'menu_order',
                'container' => false,
                'li_class'  => 'sub-nav__item',
				'a_class'  => 'sub-nav__link'
            )
        );                                   
    elseif( $secondarynav['value'] == 'services' ):
        wp_nav_menu(
            array(
                'theme_location' => 'services-secondary-navigation',
                'menu'           => '',
                'menu_class'     => 'sub-nav__items',
                'orderby'        => 'menu_order',
                'container' => false,
                'li_class'  => 'sub-nav__item',
				'a_class'  => 'sub-nav__link'
            )
        ); 
    elseif( $secondarynav['value'] == 'shop' ):
        wp_nav_menu(
            array(
                'theme_location' => 'shop-secondary-navigation',
                'menu'           => '',
                'menu_class'     => 'sub-nav__items',
                'orderby'        => 'menu_order',
                'container' => false,
                'li_class'  => 'sub-nav__item',
				'a_class'  => 'sub-nav__link'
            )
        ); 
    elseif( $secondarynav['value'] == 'support' ):
            wp_nav_menu(
                array(
                    'theme_location' => 'support-secondary-navigation',
                    'menu'           => '',
                    'menu_class'     => 'sub-nav__items',
                    'orderby'        => 'menu_order',
                    'container' => false,
                    'li_class'  => 'sub-nav__item',
                    'a_class'  => 'sub-nav__link'
                )
            );                                                                            
    endif;
?>