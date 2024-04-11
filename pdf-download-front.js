document.addEventListener('DOMContentLoaded', function() {
    var pdfDownloadButton = document.querySelector('.pdf-download-button');
    if (pdfDownloadButton) {
        pdfDownloadButton.addEventListener('click', function() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '/wp-admin/admin-ajax.php', true);
            xhr.responseType = 'blob';
            xhr.onload = function() {
                if (this.status === 200) {
                    const url = window.URL.createObjectURL(this.response);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'page-content.pdf';
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                } else {
                    alert('Failed to generate PDF.');
                }
            };
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('action=generate_pdf&content=' + encodeURIComponent(document.documentElement.outerHTML));
        });
    }
});
