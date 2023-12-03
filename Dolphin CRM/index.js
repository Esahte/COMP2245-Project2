$(document).ready(function () {
    $('body').on('click', function (e) {
        const targetClass = $(e.target).attr('class');
        const targetId = $(e.target).attr('id');
        // const targetType = $(e.target).attr('type');

        if (targetId === 'home') {
            const page = $(e.target).attr('href');
            const stateObj = {page: formatForUrl(page)};
            history.pushState(stateObj, null, formatForUrl(page));

            $(window).on('popstate', function () {
                const page = history.state.page;
                const filename = page + '.php';

                // Load the page and put its contents in the main element.
                requestMainContent(filename);
            });
        } else if (targetClass === 'no_refresh') {
            e.preventDefault();
            const page = $(e.target).attr('href');
            const stateObj = {page: formatForUrl(page)};
            history.pushState(stateObj, null, formatForUrl(page));

            // Load the page and put its contents in the main element.
            requestMainContent(page);

            $(window).on('popstate', function () {
                const page = history.state.page;
                const filename = page + '.php';

                // Load the page and put its contents in the main element.
                requestMainContent(filename);
            });
        } else if (targetClass === 'contactInfo') {
            e.preventDefault();
            const page = $(e.target).attr('href');
            const stateObj = {page: formatForUrl(page)};
            history.pushState(stateObj, null, formatForUrl(page));

            const contactName = $(e.target).attr('id');
            console.log(contactName);

            $.ajax(`contact_info.php?contactName=${contactName}`, {
                method: 'GET'
            }).done(response => requestContactInfo(response))
                .fail(() => alert('There was a problem with the request.'));

            $(window).on('popstate', function () {
                const page = history.state.page;
                const filename = page + '.php';

                // Load the page and put its contents in the main element.
                requestContactInfo(filename);
            });
        } else if (targetClass === 'cont_types') {
            e.preventDefault();
            const filter = $(e.target).attr('id');

            $.ajax(`contacts.php?filter=${filter}`, {
                method: 'GET'
            }).done(response => requestHomeContent(response))
                .fail(() => alert('There was a problem with the request.'));

            removeActiveClass();
            $(e.target).parent().addClass('active');
        } else if (targetClass === 'assigned_to_me') {
            let assigned_to = $(e.target).attr('id');
            let contactName = $(e.target).attr('value');

            $.ajax(`contact_info.php?contactName=${contactName}`, {
                method: 'POST',
                data: {
                    assigned_to: assigned_to
                }
            }).done(response => requestContactInfo(response))
                .fail(() => alert('There was a problem with the request.'));
        } else if (targetClass === 'switch') {
            let type = $(e.target).attr('value');
            let contactName = $(e.target).attr('id');

            $.ajax(`contact_info.php?contactName=${contactName}`, {
                method: 'POST',
                data: {
                    type: type
                }
            }).done(response => requestContactInfo(response))
                .fail(() => alert('There was a problem with the request.'));
        } else if (targetId === 'addNote') {
            e.preventDefault();
            let comment = $('#comment').val();
            let contactName = $(e.target).attr('value');

            $.ajax(`contact_info.php?contactName=${contactName}`, {
                method: 'POST',
                data: {
                    comment: comment
                }
            }).done(response => requestContactInfo(response))
                .fail(() => alert('There was a problem with the request.'));
        }
    });
});


// window.addEventListener('load', () => {
//     window.addEventListener('popstate', async () => {
//         const page = history.state.page;
//         const filename = page + '.php';
//
//         // load the page and put its contents in the main element.
//         await requestMainContent(filename);
//     });
//     console.log(history.state)
//     document.querySelector('body').addEventListener('click', async e => {
//         e.preventDefault();
//         if (e.target.getAttribute('class') === 'no_refresh') {
//             const page = e.target.getAttribute('href');
//
//             const stateObj = {page: formatForUrl(page)};
//             history.pushState(stateObj, null, formatForUrl(page));
//
//             await requestMainContent(page);
//
//             window.addEventListener('popstate', async () => {
//                 const page = history.state.page;
//                 const filename = page + '.php';
//
//                 // load the page and put its contents in the main element.
//                 await requestMainContent(filename);
//             });
//         } else if (e.target.getAttribute('class') === 'contactInfo') {
//             e.preventDefault();
//             const page = e.target.getAttribute("href");
//             const stateObj = {page: formatForUrl(page)};
//             history.pushState(stateObj, null, formatForUrl(page));
//
//             const contactId = e.target.getAttribute('id');
//             console.log(contactId)
//
//             try {
//                 const response = await fetch(`contact_info.php?contactId=${contactId}`);
//                 if (!response.ok) {
//                     throw new Error('There was a problem with the request.');
//                 }
//
//                 const content = await response.text();
//                 await requestContactInfo(content);
//             } catch (error) {
//                 alert(error.message);
//             }
//             window.addEventListener('popstate', async () => {
//                 const page = history.state.page;
//                 const filename = page + '.php';
//
//                 // load the page and put its contents in the main element.
//                 await requestContactInfo(filename);
//             });
//         } else if (e.target.getAttribute('class') === 'cont_types') {
//             e.preventDefault();
//             const page = e.target.getAttribute("href");
//             const stateObj = {page: formatForUrl(page)};
//             history.pushState(stateObj, null, formatForUrl(page));
//
//             const filter = e.target.getAttribute('id');
//
//             try {
//                 const response = await fetch(`contacts.php?filter=${filter}`);
//                 if (!response.ok) {
//                     throw new Error('There was a problem with the request.');
//                 }
//
//                 const content = await response.text();
//                 requestHomeContent(content);
//             } catch (error) {
//                 alert(error.message);
//             }
//
//             removeActiveClass();
//             e.target.parentElement.classList.add('active');
//
//             window.addEventListener('popstate', async () => {
//                 const page = history.state.page;
//                 const filename = page + '.php';
//
//                 // load the page and put its contents in the main element.
//                 requestHomeContent(filename);
//
//                 removeActiveClass();
//                 document.getElementById('nav-' + page).parentElement.classList.add('active');
//             });
//         }
//     });
// });