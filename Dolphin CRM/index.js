window.addEventListener('load', () => {
    console.log('loaded')
    document.querySelectorAll('.no_refresh').forEach(link =>{
        console.log(link)
        link.addEventListener('click', async e => {
            e.preventDefault();
            const page = e.target.getAttribute('href');

            const stateObj = {page: formatForUrl(page)};
            history.pushState(stateObj, null, formatForUrl(page));

            await requestContent(page);
        });

        window.addEventListener('popstate', async () => {
            const page = history.state.page;
            const filename = page + '.php';

            // load the page and put its contents in the main element.
            await requestContent(filename);
        });
    });
});