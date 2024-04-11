<?php
/**
 * Plugin Name: Clean PDF Generator
 * Description: Generates a clean PDF for download, capturing the current page's HTML.
 * Version: 1.0
 * Author: Your Name
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

require_once 'pdf-generator.php'; // Include your PDF generation functionality
require_once __DIR__ . '/vendor/autoload.php';

// Enqueue JavaScript for the Gutenberg block
function clean_pdf_generator_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'clean-pdf-generator-block',
        plugins_url('block/index.js', __FILE__), // Make sure this path is correct
        array('wp-blocks', 'wp-element', 'wp-editor'),
        filemtime(plugin_dir_path(__FILE__) . '/block/index.js')
    );
}
add_action('enqueue_block_editor_assets', 'clean_pdf_generator_enqueue_block_editor_assets');

// Handle AJAX request for PDF generation
add_action('wp_ajax_generate_pdf', 'handle_pdf_generation_ajax');
add_action('wp_ajax_nopriv_generate_pdf', 'handle_pdf_generation_ajax');
function handle_pdf_generation_ajax() {
    if (!empty($_POST['content'])) {
        // Decode the HTML content sent from the front-end
        $html_content = rawurldecode($_POST['content']);

        // Optionally, perform security checks here, like nonce verification

        // Generate and stream the PDF to the browser
        generate_clean_pdf($html_content);
    }

    wp_die(); // Terminate AJAX request
}

function clean_pdf_enqueue_frontend_script() {
    wp_enqueue_script(
        'clean-pdf-download-front', // Handle for your script
        plugins_url('pdf-download-front.js', __FILE__), // Path to your JS file
        array(), // Dependencies, can be an array of handles e.g., array('jquery')
        '1.0.0', // Version number for cache control
        true // Load in the footer
    );
}
add_action('wp_enqueue_scripts', 'clean_pdf_enqueue_frontend_script');
