var $mainBtn = document.getElementById('random-film');

var $filmName = document.getElementById('film-name');

var $year = document.getElementById('film-year');

var $undoBtn = document.querySelector('.undo');

var lastFilm, currentFilm;

var $reportContainer = document.querySelector('.report-container');
var $reportMsg = document.querySelector('.report-msg');
var $reportBtn = document.querySelector('#report-btn');
var $reportSending = document.querySelector('.report-sending');
var $reportSent = document.querySelector('.report-sent');

$mainBtn.addEventListener('click', function (e) {
    e.preventDefault();
    lastFilm = currentFilm;
    $mainBtn.classList.add('loading');
    axios.get('app.php').then(function (response) {
        $mainBtn.classList.remove('loading');
        currentFilm = response.data;

        if (lastFilm) {
            $undoBtn.style.visibility = 'visible';
        }

        $filmName.textContent = currentFilm.name;
        $filmName.href = currentFilm.link;
        $year.textContent = currentFilm.year;

        $reportContainer.style.display = 'block';
        $reportMsg.style.display = 'block';
        $reportSending.style.display = 'none';
        $reportSent.style.display = 'none';
    });
});

$undoBtn.addEventListener('click', function (e) {
    e.preventDefault();
    $filmName.textContent = lastFilm.name;
    $filmName.href = lastFilm.link;
    $year.textContent = lastFilm.year;
    currentFilm = lastFilm;
    $undoBtn.style.visibility = 'hidden';
});

$reportBtn.addEventListener('click', function (e) {
    e.preventDefault();
    $reportMsg.style.display = 'none';
    $reportSending.style.display = 'block';
    axios.post('report.php', {film: currentFilm.uid}).then(function (response) {
        if (response.data.success) {
            $reportSending.style.display = 'none';
            $reportSent.style.display = 'block';
        }
    });
});