// $main = $('#results');

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
const requestHomeContent = (content) => $('#homeResult').html(content);

/**
 * Load the page and put its contents in the main element.
 *
 * @param content
 */
const requestMainContent = (content) => $('#results').load(content);

/**
 * Load the page and put its contents in the main element.
 *
 * @param contactInfo
 */
const requestContactInfo = (contactInfo) => {
    $('#results').html(contactInfo)
};

const removeActiveClass = () => $('.active').removeClass('active');


// /**
//  * Format page filename to get the page name
//  *
//  * @param page string the path to the page with an extension.
//  * @return string
//  */
// function formatForUrl(page) {
//     const pageName = page.split('.');
//     return pageName[0];
// }
//
// /**
//  * Load the page and put its contents in the main element.
//  *
//  * @param content
//  */
// const requestHomeContent = (content) => document.getElementById('homeResult').innerHTML = content;
//
// /**
//  * Load the page and put its contents in the main element.
//  *
//  * @param content
//  */
// async function requestMainContent(content) {
//     try {
//         const response = await fetch(content);
//         if (!response.ok) {
//             throw new Error('There was a problem with the request.');
//         }
//
//         document.getElementById('results').innerHTML = await response.text();
//     } catch (error) {
//         alert(error.message);
//     }
// }
//
// /**
//  * Load the page and put its contents in the main element.
//  *
//  * @param contactInfo
//  */
// const requestContactInfo = (contactInfo) => document.getElementById('results').innerHTML = contactInfo;
//
// function removeActiveClass() {
//     const active = document.querySelector('.active');
//     if (active) {
//         active.classList.remove('active');
//     }
// }
