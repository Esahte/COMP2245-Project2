window.addEventListener('load', () => {
    document.querySelectorAll('.cont_types').forEach((link) => {
        console.log(link);
            link.addEventListener('click', async (e) => {
                console.log(e.target);
                e.preventDefault();
                const page = e.target.getAttribute("href");
                const stateObj = {page: formatForUrl(page)};
                history.pushState(stateObj, null, formatForUrl(page));

                const filter = e.target.getAttribute('id');

                try {
                    const response = await fetch(`contacts.php?filter=${filter}`);
                    if (!response.ok) {
                        throw new Error('There was a problem with the request.');
                    }

                    const content = await response.text();
                    requestHomeContent(content);
                } catch (error) {
                    alert(error.message);
                }
            });

            window.addEventListener('popstate', async (e) => {
                const page = history.state.page;
                const filename = page + '.php';

                // load the page and put its contents in the main element.
                requestHomeContent(filename);
            });
        }
    );
});