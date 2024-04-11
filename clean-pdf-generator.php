<?php
/**
 * Plugin Name: Clean PDF Generator
 * Description: Generates a clean PDF for download, capturing the current page's design.
 * Version: 1.0 Beta
 * Author: Paul Bloch
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once 'pdf-generator.php'; // Includes the PDF generation functionality
require_once __DIR__ . '/vendor/autoload.php';

// Enqueue JavaScript for the Gutenberg block
function clean_pdf_generator_enqueue_block_editor_assets() {
    wp_enqueue_script(
        'clean-pdf-generator-block',
        plugins_url('block/index.js', __FILE__),
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

        // Generate and stream the PDF to the browser
        generate_clean_pdf($html_content);
    }

    wp_die(); // Terminate AJAX request
}

function clean_pdf_enqueue_frontend_script() {
    wp_enqueue_script(
        'clean-pdf-download-front',
        plugins_url('pdf-download-front.js', __FILE__),
        array(),
        '1.0.0', // Version number for cache control
        true // Load in the footer
    );
}
add_action('wp_enqueue_scripts', 'clean_pdf_enqueue_frontend_script');
