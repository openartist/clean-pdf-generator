<?php

require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Pelago\Emogrifier\CssInliner;

function generate_clean_pdf($html_content) {
    // Assuming $html_content is your full HTML including <style> tags or links to CSS files.
    // Initialize Emogrifier and inline the CSS
    $emogrifiedContent = CssInliner::fromHtml($html_content)->inlineCss()->render();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($emogrifiedContent); // Use the processed HTML
    $dompdf->set_option('isHtml5ParserEnabled', true);
    $dompdf->set_option('isRemoteEnabled', true); // Allow remote resources if your HTML needs it
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream("generated-pdf.pdf", array("Attachment" => 1));
}
