The Clean PDF Generator plugin is designed to convert WordPress pages, especially those created with the Gutenberg editor, into clean, styled PDF documents. This document outlines the current challenges and issues faced during the development and use of the plugin.

Current Issues

1. CSS and Style Rendering
Issue: The generated PDFs do not accurately reflect the CSS styles and layout of the Gutenberg blocks on the WordPress site. Styles applied through WordPress's enqueuing system and Gutenberg's dynamic blocks are not being captured or applied in the PDF output.
Impact: The lack of styling leads to PDF documents that do not match the website's visual appearance, affecting usability and branding consistency.
2. Font Inclusion
Issue: Fonts specified in WordPress themes and Gutenberg blocks, including custom fonts and those loaded from external sources like Google Fonts, are not correctly rendered in the generated PDFs.
Impact: The absence of the correct fonts results in fallback fonts being used, which can alter the document's intended design and readability.
3. Integration with Emogrifier
Issue: Despite integrating Emogrifier to inline CSS styles with the hope of solving the styling issues, the generated PDFs still lack accurate CSS rendering.
Impact: The expected improvement in styling fidelity has not been realized, indicating potential gaps in the CSS inlining process or limitations in the styles supported by the PDF generation library.
4. Handling of Gutenberg Styles
Issue: Difficulty in capturing and applying the dynamically loaded styles and scripts associated with Gutenberg blocks, which are essential for rendering the page accurately in PDF format.
Impact: The dynamic nature of Gutenberg's content creation poses a challenge for static PDF generation, leading to discrepancies between the web and PDF versions of the content.
Steps Taken

Confirmed the installation and updating of necessary libraries (Dompdf and Emogrifier) through Composer.
Ensured the inclusion of the Composer autoloader in the plugin's main file to facilitate class loading.
Attempted manual inclusion of Gutenberg's styles and the inlining of CSS to address styling issues.
Conducted debugging to resolve class loading errors and ensure the proper functioning of the Emogrifier library.
Next Steps

Investigate alternative methods or libraries for more accurate CSS rendering and font inclusion in PDFs generated from WordPress content.
Explore improvements in capturing and processing Gutenberg block styles and external fonts for inclusion in PDFs.
Consider simplifying the page content and styles targeted for PDF conversion to enhance compatibility with the PDF generation process.
Continue debugging and testing to resolve issues with library integration and class loading, ensuring a stable foundation for the plugin's functionality.
