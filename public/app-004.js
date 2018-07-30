var app = new Vue({
    el: '#app',
    mounted() {
        this.ready = true;
    },
    data: {
        ready:false,
        lastFilm: null,
        currentFilm: null,
        loadingFilm: false,
        undoVisibility: 'hidden',
        showReporting: false,
        showReported: false,
    },
    methods: {
        clickedOnMainButton() {
            this.lastFilm = this.currentFilm;
            this.loadingFilm = true;
            axios.get('app.php?c=' + Date.now()).then(response => {
                this.showReporting = false;
                this.showReported = false;
                this.loadingFilm = false;
                this.currentFilm = response.data;

                if (this.lastFilm) {
                    this.undoVisibility = 'visible';
                }

            });
        },
        report() {
            this.showReporting = true;
            axios.post('report.php', {film: this.currentFilm.uid}).then(response => {
                if (response.data.success) {
                    this.showReporting = false;
                    this.showReported = true;
                }
            });
        },
        undo() {
            this.currentFilm = this.lastFilm;
            this.undoVisibility = 'hidden';
        }
    }
});
