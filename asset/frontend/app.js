
/** Video loader **/
(function () {

    let l = {};
    const sendInterval = 1000;
    const sendUserEvent = (videoId, action, data) => {
        const url = videoId + '/log/' + action;
        const currentDate = new Date();
        if (l.hasOwnProperty(url) && (currentDate.getTime() - l[url].d.getTime()) < sendInterval) return Promise.resolve();
        l[url] = Object.assign(l[url] || {}, { d: currentDate });
        if (l[url].w) return Promise.reject('There are awaiting requests');
        l[url].w = true;
        return fetch(videoId + '/log/' + action,{
            'method': 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': CSRF_TOKEN
            },
            body: JSON.stringify(Object.assign({ timestamp: new Date() }, data || {}))
        }).then(r => {
            l[url].w = false;
            return Promise.resolve(r);
        });
    };
    const setInfo = (videoId, info) => {
        const target = $($("[data-video-id='" + videoId + "']").attr("data-info-target"));
        return target.html(info).addClass('show');
    };
    $("[data-video-id]").each(function () {
        const videoId = $(this).data('videoId');
        const appAlias = $(this).data('app');

        switch (appAlias) {
            case 'vimeo':
                Promise.all([
                    fetch(videoId).then(r => r.json()),
                    fetch(videoId + '/logs').then(r => r.json())
                ])
                    .then(r => {
                        v = r[0];
                        a = r[1];
                        $(this).children('p').remove();
                        const player = new Vimeo.Player(this, { url: v.link, responsive: true, texttrack: 'tr' });

                        // Listen events
                        if (!a.find(_l => _l.event === 'view')) player.on('loaded', () => sendUserEvent(videoId, 'view'));
                        if (!a.find(_l => _l.event === 'play')) player.on('play', () => sendUserEvent(videoId, 'play'));
                        if (!a.find(_l => _l.event === 'ended')) player.on('ended', () => sendUserEvent(videoId, 'ended'));
                        if (!a.find(_l => _l.event === 'ended')) player.on('timeupdate', (p) => sendUserEvent(videoId, 'playing', p));

                        // Set last play point
                        const lastPlayPoint = a.find(_l => _l.event === 'playing');
                        if (!a.find(_l => _l.event === 'ended') && !!lastPlayPoint) {
                            player.setCurrentTime(lastPlayPoint.context.seconds);
                        }

                        // Set info
                        if (a.find(_l => _l.event === 'ended')) setInfo(videoId, "<i class='material-icons-round md-18'>check_circle</i> Bu videoyu daha önce izlediniz");
                    });
                break;
            default:
                alert('Not suitable player found for alias ' + appAlias + '!');
        }
    });

})();
