
/** Video loader **/

const PageVideos = [];
$("[data-video-id]").each(function () {
    const videoId = $(this).data('videoId');
    const appAlias = $(this).data('app');

    switch (appAlias) {
        case 'vimeo':
            PageVideos.push(new Vimeo.Player(this, { id: videoId }));
            break;
        default:
            alert('Not suitable player found for alias ' + appAlias + '!');
    }
});
