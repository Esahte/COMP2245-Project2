/**
 * Format page filename to get the page name
 *
 * @param page string the path to the page with an extension.
 * @return string
 */
function formatForUrl(page) {
    const pageName = page.split('.');
    return pageName[0];
}

/**
 * Load the page and put its contents in the main element.
 *
 * @param content
 */
function requestHomeContent(content) {
    document.getElementById('homeResult').innerHTML = content;
}

/**
 * Load the page and put its contents in the main element.
 *
 * @param content
 */
async function requestContent(content) {
    try {
        const response = await fetch(content);
        if (!response.ok) {
            throw new Error('There was a problem with the request.');
        }

        document.getElementById('results').innerHTML = await response.text();
    } catch (error) {
        alert(error.message);
    }
}