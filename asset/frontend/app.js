
/** Video loader **/

const PageVideos = [];
$("[data-video-id]").each(function () {
    const videoId = $(this).data('videoId');
    const appAlias = $(this).data('app');

    switch (appAlias) {
        case 'vimeo':
            fetch(videoId)
                .then(r => r.json())
                .then(v => {
                    $(this).children('p').remove();
                    const player = new Vimeo.Player(this, { url: v.link, responsive: true, texttrack: 'tr' });
                    PageVideos.push(player);
                });
            break;
        default:
            alert('Not suitable player found for alias ' + appAlias + '!');
    }
});
