<?php

function create_button_callback( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'href' => '',
		'target' => '',
		'class' => '',
		'title' => '',
		'onclick' => ''
	), $atts));

	ob_start();
	?>
		<a href="<?php echo $href; ?>" class="button secondary <?php echo $class; ?>" target="<?php echo $target; ?>" onclick="<?php echo $onclick; ?>" title="<?php echo $title; ?>"><?php echo $content; ?></a>
	<?php
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
}


function custom_gallery_shortcode_callback( $attr ) {
	$post = get_post();

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => $html5 ? 'figure'     : 'dl',
		'icontag'    => $html5 ? 'div'        : 'dt',
		'captiontag' => $html5 ? 'figcaption' : 'dd',
		'columns'    => 3,
		'size'       => 'thumbnail',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	$html = '';

	$ids = explode( ',', $atts['include'] );

	if( count( $ids ) > 0 ) {
		$html .= '<div class="blog-gallery">';
			foreach( $ids as $id ) {
				$this_thumb = get_attachment_for_gallery( (int) $id, 'img-blog-post' );
				$html .= '<img src="' . $this_thumb[0] . '" alt="" class="rsImg" style="max-width: ' . $this_thumb[1] . 'px;" />';
			}
		$html .= '</div>';
	}

	return $html;
}



function vol_accordion_wrapper_callback( $atts, $content ) {

	$opts = shortcode_atts( array(
		'class' => ''
	), $atts );

	$html = '<section class="container snippet content-accordion ' . $opts['class'] . '">';
	$html .= '<div class="row"><div class="columns">';
	$html .= '<ul class="accordion" data-accordion data-allow-all-closed="true">';
	$html .= do_shortcode( $content );
	$html .= '</ul></div></div></section>';	

	return $html;
}


function vol_accordion_item_callback( $atts, $content ) {
	$opts = shortcode_atts( array(
		'active' => '',
		'title' => '',
		'description' => '',
		'heading_size' => 'h2' 
	), $atts );	

	$title = esc_attr($opts['title']);
	$description = esc_attr($opts['description']);

	$html .= '<li class="accordion-item" data-accordion-item><a href="#" class="accordion-title"><h3>' . $title . '</h3>';
	if ( $description != '' ) {
		$html .= '<p class="accordion-description">' . $description . '</p>';
	}

	$html .= '</a>';

	$html .= '<div class="accordion-content" data-tab-content>';
	$html .= do_shortcode( apply_filters( 'the_content', $content ) );
	$html .= '</div></li>';

	return $html;
}


function video_embed_callback( $atts, $content ) {
	$opts = shortcode_atts( array(
		'wistia_id' => '',
		'width' => '100%'
	), $atts );

	$html = '<div style="max-width: ' . $opts['width'] . '" class="responsive-video-align-center">';
	$html .= '<div class="responsive-video-wrapper">';

	if( strlen( $opts['wistia_id'] ) > 0 ) {
		// Wistia video embed
		$hashed_id = get_hashed_id_from_wistia_id( $opts['wistia_id'] );
		$html .= '<iframe src="//fast.wistia.net/embed/iframe/' . $hashed_id . '?videoFoam=false&amp;playerColor=252525" allowtransparency="true" frameborder="0" scrolling="no" class="wistia_embed" name="wistia_embed" allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen width="560" height="315"></iframe>';

	} else {
		// Other video embed

		$html .= $content;
	}

	$html .= '</div></div>';

	return $html;
}


// These are the main shortcodes used throughout the site. 
// As it currently stands the authors don't need to manually use these shortcodes as 
// they are rendered inside the snippet-audio and snippet-featured_video template parts 
// via the ACF Media Block flexible content. '

function wistia_embed_shortcode( $atts ) {

	// Define shortcode attributes
	$a = shortcode_atts( array(
		'id' => ''
	), $atts );

	// Create embed code
	$embed_code = '<script src="//fast.wistia.com/embed/medias/'.$a['id'].'.jsonp" async></script>
	<script src="//fast.wistia.com/assets/external/E-v1.js" async></script>
	<div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;margin-bottom:20px;">
	<div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
	<div class="wistia_embed wistia_async_'.$a['id'].' seo=false videoFoam=true" style="height:100%;width:100%">&nbsp;</div></div></div>';

	return $embed_code;

}

function vimeo_embed_shortcode( $atts ) {

	// Define shortcode attributes
	$a = shortcode_atts( array(
		'id' => ''
	), $atts );

	$embed_code = '<div class="responsive-embed"><iframe src="http://player.vimeo.com/video/'. $a['id'] .'" width="560" height="315" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';

	return $embed_code;

}

function youtube_embed_shortcode( $atts ) {

	// Define shortcode attributes
	$a = shortcode_atts( array(
		'id' => ''
	), $atts );

	$embed_code = '<div class="responsive-embed"><iframe src="http://www.youtube.com/embed/' . $a['id'] . '" width="560" height="315" frameborder="0" allowfullscreen></iframe></div>';

	return $embed_code; 

}

function register_shortcodes() {

	add_shortcode( 'accordion_wrapper', 'vol_accordion_wrapper_callback' );
	add_shortcode( 'accordion_item', 'vol_accordion_item_callback' );
	add_shortcode( 'button', 'create_button_callback' );
	add_shortcode( 'video_embed', 'video_embed_callback' );

	// custom gallery
	remove_shortcode( 'gallery' );
	add_shortcode( 'gallery', 'custom_gallery_shortcode_callback' );

	// Video
	add_shortcode( 'vimeo', 'vimeo_embed_shortcode' );
	add_shortcode( 'youtube', 'youtube_embed_shortcode' );
	add_shortcode( 'wistia', 'wistia_embed_shortcode' );

	// General
	add_shortcode( 'button', 'button_embed_callback' );
	
}

add_action('init', 'register_shortcodes');
