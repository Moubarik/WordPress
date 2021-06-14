<?php

/*
Plugin Name:  Abdel Moubarik Example Forms Plugin
Plugin URI:   https://AbdelMoubarik.com
Description:  An example forms plugin. This is meant purely as a training aid and not for use in production environments.
Version:      20180209
Author:       Abdel Moubarik
Author URI:   https://www.abdel Moubarik.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  jmo-forms
Domain Path:  /languages
*/


require_once( __DIR__ . '/includes/class-PHPFormBuilder.php' );
require_once( __DIR__ . '/admin/class-JMOFormsAdmin.php' );

// Main Plugin Class
if ( ! class_exists( 'JMOForms' ) ) {
    class JMOForms {
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
            add_shortcode( 'jmoform', array( $this, 'form' ) );
            add_action( 'admin_post_nopriv_jmo_contact_form', array( $this, 'form_handler' ) );
            add_action( 'admin_post_jmo_contact_form', array( $this, 'form_handler' ) );
        }
        
        public function enqueue_scripts() {
            wp_enqueue_style( 'jmoforms', plugins_url( '/public/css/style.css', __FILE__ ), array(), 0.1 );
        }
        
        public function form($atts) {
            global $post;
            
            $atts = shortcode_atts(
        		array(
        			'add_honeypot' => false,
        		), $atts, 'jmoform' );
        	
        	// Instantiate form class
    		$form = new PHPFormBuilder();
    		
    		// Set form options
    		$form->set_att( 'action', esc_url( admin_url( 'admin-post.php' ) ) );
    		$form->set_att( 'add_honeypot', $atts['add_honeypot'] );
    		
    		// Add form inputs
			$form->add_input( 'action', array(
    		    'type' => 'hidden',
    		    'value' => 'jmo_contact_form',
    		    ), 'action' );
    		    
		    $form->add_input( 'wp_nonce', array(
    		    'type' => 'hidden',
    		    'value' => wp_create_nonce( 'submit_contact_form' ),
    		    ), 'wp_nonce' );
    		    
		    $form->add_input( 'redirect_id', array(
    		    'type' => 'hidden',
    		    'value' => $post->ID,
    		    ), 'redirect_id' );
    		    
    		$form->add_input( __( 'Name', 'jmo-forms' ), array(
    		    'type' => 'text',
    		    'placeholder' => __( 'Enter your name', 'jmo-forms' ),
    		    'required' => true,
    		    ), 'name' );
    		    
		    $form->add_input( __( 'Email', 'jmo-forms' ), array(
    		    'type' => 'email',
    		    'placeholder' => __( 'Enter your email address', 'jmo-forms' ),
    		    'required' => true,
    		    ), 'email' );
    		    
		    $form->add_input( __( 'Website', 'jmo-forms' ), array(
    		    'type' => 'url',
    		    'placeholder' => __( 'Enter your website URL', 'jmo-forms' ),
    		    'required' => false,
    		    ), 'website' );
    		    
		    $form->add_input( __( 'Message', 'jmo-forms' ), array(
    		    'type' => 'textarea',
    		    'placeholder' => __( 'Enter your message', 'jmo-forms' ),
    		    'required' => true,
    		    ), 'message' );
    		    
		    // Shortcodes should not output data directly
		    ob_start(); 
		    
		    // Status message
		    $status = filter_input( INPUT_GET, 'status', FILTER_VALIDATE_INT );
		    
		    if ( $status == 1 ) {
		        printf( '<div class="message success"><p>%s</p></div>', __( 'Your message was submitted successfully.', 'jmo-forms' ) );
		    }
		    
		    // Build the form
		    $form->build_form();
		    
		    // Return and clean buffer contents
		    return ob_get_clean();
        }
        
        public function form_handler() {
            $post = $_POST;
            
            // Verify nonce
            if ( ! isset( $post['wp_nonce'] ) || ! wp_verify_nonce( $post['wp_nonce'], 'submit_contact_form') ) {
                wp_die( __( "Cheatin' uh?", 'jmo-forms' ) );
            }
            
            // Verify required fields
            $required_fields = array( 'name', 'email', 'message' );
            
            foreach ( $required_fields as $field ) {
                if ( empty( $post[$field] ) ) {
                    wp_die( __( "The name, email and message fields are required.", 'jmo-forms' ) );
                }
            }
            
            // Build post arguments
            $postarr = array(
                'post_author' => 1,
                'post_title' => sanitize_text_field( $post['name'] ),
                'post_content' => sanitize_textarea_field( $post['message'] ),
                'post_type' => 'jmo_contact_form',
                'post_status' => 'publish',
                'meta_input' => array(
                    'submission_email' => sanitize_email( $post['email'] ),
                    'submission_website' => sanitize_text_field( $post['website'] ),
                )
            );
            
            // Insert the post
            $postid = wp_insert_post( $postarr, true );

            if ( is_wp_error( $postid ) ) {
                wp_die( __( "There was problem with your submission. Try again.", 'jmo-forms' ) );
            }
            
            // Send emails to admins
            $to = array();
            $post_edit_url = sprintf( '%s?post=%s&action=edit', admin_url( 'post.php' ), $postid );
            $admins = get_users( array( 'role' => 'administrator' ) );
            
            foreach ( $admins as $admin ) {
                $to[] = $admin->user_email;
            }
            
            // Build the email
            $subject = __( 'New feedback posted', 'jmo-forms' );
            $message = sprintf( '<p>%s</p>', __( 'You have new feedback. Here are the details:', 'jmo-forms' ) ) ;
            $message .= sprintf( '<p>%s: %s<br>', __( 'Name', 'jmo-forms' ), sanitize_text_field( $post['name'] ) );
            $message .= sprintf( '<p>%s: %s<p>', __( 'Name', 'jmo-forms' ), sanitize_textarea_field( $post['message'] ) );
            $message .= sprintf( '<p>%s: <a href="%s">%s</a>', __( 'View/edit the full message here', 'jmo-forms' ), $post_edit_url, $post_edit_url );
            $headers = array('Content-Type: text/html; charset=UTF-8');
            
            // Send the email
            wp_mail( $to, $subject, $message, $headers );
            
            // Redirect back to page
            wp_redirect( add_query_arg( 'status', '1', get_permalink( $post['redirect_id'] ) ) );
        }
    }
}

$jmoforms = new JMOForms;