window.addEventListener('load', () => {
    console.log('contacts loaded')
    document.querySelectorAll('.contactInfo').forEach(element => {
        element.addEventListener('click', async e => {
            e.preventDefault();
            const page = e.target.getAttribute("href");
            const stateObj = {page: formatForUrl(page)};
            history.pushState(stateObj, null, formatForUrl(page));

            const contactId = e.target.getAttribute('id');
            console.log(contactId)

            try {
                const response = await fetch(`contact_info.php?contactId=${contactId}`);
                if (!response.ok) {
                    throw new Error('There was a problem with the request.');
                }

                const content = await response.text();
                await requestContent(content);
            } catch (error) {
                alert(error.message);
            }
        })

        window.addEventListener('popstate', async () => {
            const page = history.state.page;
            const filename = page + '.php';

            // load the page and put its contents in the main element.
            await requestContent(filename);
        });
    })
});

