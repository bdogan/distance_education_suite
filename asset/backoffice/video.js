
(function () {

    // Processors
    const processors = {
        vimeo(video) {
            return {
                app_alias: 'vimeo',
                video_id: video.resource_key,
                name: video.name,
                duration: video.duration,
                thumbnail: video.pictures.sizes[2].link
            };
        }
    };

    // Selected video app
    const selectedVideoApp = new Vue({
        el: $('#selected_video')[0],
        data: {
            selectedVideo: (typeof selectedVideo === 'undefined' ? null : selectedVideo)
        },
        computed: {
            getSelectedVideo() {
                return this.selectedVideo || {};
            }
        }
    });

    // Tab data load
    $('.video-selector a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        // Active tab
        const activeTab = e.target;

        // Active alias
        const activeAlias = $(e.target).data('alias');

        // Check loaded
        const apps = [];
        if (!$(activeTab).data('vue')) {
            const app = new Vue({
                el: $($(activeTab).attr('href'))[0],
                data: {
                    message: 'Hello World',
                    alias: activeAlias,
                    selectedVideo: (typeof selectedVideo === 'undefined' ? null : selectedVideo),
                    videos: null,
                    hasMore: true,
                    page: 1,
                    loading: false
                },
                filters: {
                    formatDate: (v) => {
                        if (!v) return '';
                        return moment(String(v)).format('DD/MM/YYYY hh:mm');
                    }
                },
                watch: {
                    // Emit loading
                    loading(n, o) {
                        if (n !== o) this.$emit(n === true ? 'loading' : 'loaded');
                    }
                },
                methods: {
                    loadVideos() {
                        if (this.loading || !this.hasMore) return;
                        this.loading = true;
                        fetch(BO.PREFIX + '/connected_app/' + this.alias + '/videos.json' + '?page=' + this.page)
                            .then(response => {
                                this.hasMore = !!response.headers.get("X-Next-Page");
                                if (this.hasMore) this.page++;
                                return response.json();
                            })
                            .then(videos => {
                                this.videos = [].concat(this.videos || [], videos.map(v => processors[this.alias](v)));
                                this.loading = false;
                            });
                    },
                    selectVideo(video) {
                        this.$emit('selected.video', video);
                    }
                },
                mounted() {
                    this.loadVideos();
                }
            });
            app.$on('loading', () => $(activeTab).find("[role='status']").show());
            app.$on('loaded', () => $(activeTab).find("[role='status']").hide());
            app.$on('selected.video', (video) => {
                selectedVideoApp.$set(selectedVideoApp, 'selectedVideo', video);
                apps.forEach(a => a.$set(a, 'selectedVideo', video));
            });
            $(activeTab).data('vue', app);
            apps.push(app);
        }

    }).first().tab('show');




})();


