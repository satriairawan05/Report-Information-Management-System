(function ($) {
    "use strict";

    // Event listener for elements with data-load-file="file"
    $(document).on('click', '[data-load-file="file"]', function () {
        setValueOnModal($(this));
    });

    /**
     * Set modal content based on the clicked element's data attributes.
     * @param {Object} $element - jQuery object of the clicked element.
     */
    function setValueOnModal($element) {
        const target = $element.attr('data-load-target');
        const url = $element.attr('data-url');
        const title = $element.attr('data-title');
        const previewUrl = $element.attr('data-preview-url');

        // Update modal elements with the provided data
        $('.modal-title').text(title);
        $('.modal-preview-link').attr('href', previewUrl || '#');

        if (target && url) {
            loadDocToHtml(target, url);
        } else {
            console.error("Missing 'data-load-target' or 'data-url' attributes.");
        }
    }

    /**
     * Load document content into the specified target element using officeToHtml plugin.
     * @param {string} target - The selector of the target container.
     * @param {string} url - The URL of the document to be loaded.
     */
    function loadDocToHtml(target, url) {
        $(target).empty(); // Clear the target container
        $(target).officeToHtml({
            url: url,
            pdfSetting: {
                setLang: "", // Set language for PDF (if needed)
                setLangFilesPath: "" // Path to language files for PDF (adjust as required)
            }
        });
    }

    // Automatically handle document display based on URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const param = urlParams.get('page-type');
    let element = null;

    if (param) {
        switch (param) {
            case 'pdf':
                element = $('#pdf-container');
                break;
            case 'docx':
                element = $('#docx-container');
                break;
            case 'pptx':
                element = $('#pptx-container');
                break;
            case 'xlsx':
                element = $('#xlsx-container');
                break;
            default:
                console.warn("Unsupported 'page-type' parameter:", param);
                break;
        }

        if (element && element.length) {
            setValueOnModal(element);
            $('#exampleModal').modal('show');
        }
    }
})(jQuery);
