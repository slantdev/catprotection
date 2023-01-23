<?php
// This file is to add any particular hooks for gravity forms

/*
*	This will force any scripts from Gravity Forms into the footer, after we have enqueued our own scripts
*/
add_filter("gform_init_scripts_footer", "vol_init_scripts_footer");
function vol_init_scripts_footer() {
	return true;
}


add_filter("gform_ajax_spinner_url", "change_spinner_url_callback", 10, 2);
function change_spinner_url_callback($image_src, $form){
	return get_bloginfo( 'template_url' ) .'/assets/img/loading-aqua.svg';
}

// Turn off autocomplete for certain fields
add_filter( 'gform_field_content', 'add_autocomplete_callback', 10, 5 );
function add_autocomplete_callback( $field_content, $field, $value, $lead_id, $form_id ) {
	$css_classes = explode( ' ', $field['cssClass'] );

	if( in_array( 'no-autocomplete', $css_classes ) ) {
		$field_content = str_replace( '<select', '<select autocomplete="off"', $field_content );
	}

	return $field_content;
}


// Wrap the notification emails in the stylish header and footer 
// add_filter( 'gform_notification', 'custom_email_styling_notification_callback', 10, 3 );
function custom_email_styling_notification_callback( $notification, $form, $entry ) {
	$current_message = $notification['message'];

	$new_message = create_html_email_message_header();
	$new_message .= $current_message;
	$new_message .= create_html_email_message_footer();

	$notification['message'] = $new_message;

	return $notification;
}

// TODO Remove this and add auto post and email so client did not need to add post one by pne
add_filter( 'gform_notification_11', 'custom_email_url_notification_callback', 10, 3 );
function custom_email_url_notification_callback($notification, $form, $entry)
{
    if ($notification['name']  == 'Accepted') {
        $current_message = $notification['message'];
		$title = sanitize_title($entry['1']);
		$url = get_page_by_title( $title, OBJECT, 'cat-entrants' );
		$url = get_permalink( $url );

        if ($url) {
			$new_message = str_replace('https://www.catprotection.com.au/famousfelines/', $url, $current_message);
			$notification['message'] = $new_message;
        }

		
	}
	
	return $notification;
}

add_filter( 'gform_pre_render', 'populate_select' );
add_filter( 'gform_pre_validation', 'populate_select' );
add_filter( 'gform_pre_submission_filter', 'populate_select' );
add_filter( 'gform_admin_pre_render', 'populate_select' );
function populate_select( $form ) {
	
    foreach ( $form['fields'] as &$field ) {
		
        if ( $field->type == 'select' && strpos( $field->cssClass, 'breed_option' ) == true ) {
			$posts = get_breed_option();
 
			$choices = array();
	 
			foreach ( $posts as $value => $text ) {
				$choices[] = array( 'text' => $text, 'value' => $value );
			}
	
			$field->placeholder = 'Select a Breed';
			$field->choices = $choices;
		}
		
		if ( $field->type == 'select' && strpos( $field->cssClass, 'compatibility_option' ) == true ) {
			$posts = get_compatibility_option();
 
			$choices = array();
	 
			foreach ( $posts as $value => $text ) {
				$choices[] = array( 'text' => $text, 'value' => $value );
			}
	
			$field->placeholder = 'Select a Compatibility';
			$field->choices = $choices;
		}
		
		if ( $field->type == 'select' && strpos( $field->cssClass, 'age_option' ) == true ) {
			$posts = get_age_option();
 
			$choices = array();
	 
			foreach ( $posts as $value => $text ) {
				$choices[] = array( 'text' => $text, 'value' => $value );
			}
	
			$field->placeholder = 'Select a Age';
			$field->choices = $choices;
		}

		if ( $field->type == 'select' && strpos( $field->cssClass, 'gender_option' ) == true ) {
			$posts = get_gender_option();
 
			$choices = array();
	 
			foreach ( $posts as $value => $text ) {
				$choices[] = array( 'text' => $text, 'value' => $value );
			}
	
			$field->placeholder = 'Select a Gender';
			$field->choices = $choices;
		}
		
		if ( $field->type == 'select' && strpos( $field->cssClass, 'colour_option' ) == true ) {
			$posts = get_colour_option();
 
			$choices = array();
	 
			foreach ( $posts as $value => $text ) {
				$choices[] = array( 'text' => $text, 'value' => $value );
			}
	
			$field->placeholder = 'Select a Colour';
			$field->choices = $choices;
		}

		if ( $field->type == 'gfb_appointment_services_category' && strpos( $field->cssClass, 'booking_category' ) == true ) {
			
			$field->defaultValue = 1;
		}
    }
 
    return $form;
}