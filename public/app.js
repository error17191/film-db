var $mainBtn = document.getElementById('random-film');

var $filmName = document.getElementById('film-name');

var $year = document.getElementById('film-year');

var $reportBtn = document.getElementById('report');
var $reportContainer = document.getElementById('report-container');
var $reportMessage = $reportContainer.querySelector('.report-message');
var $reportSent = $reportContainer.querySelector('.report-sent');
var $reportSending = $reportContainer.querySelector('.report-sending');

$mainBtn.addEventListener('click', function (e) {
    e.preventDefault();
    $mainBtn.classList.add('loading');
    axios.get('app.php').then(function (response) {
        $mainBtn.classList.remove('loading');
        var film = response.data;
        $filmName.textContent = film.name;
        $filmName.href = film.link;
        $year.textContent = film.year;
        $reportContainer.style.display = 'block';
        $reportMessage.style.display = 'block';
        $reportSent.style.display = 'none';
        $reportSending.style.display = 'none';
    });
});

$reportBtn.addEventListener('click', function (e) {
    e.preventDefault();

    $reportMessage.style.display = 'none';
    $reportSent.style.display = 'none';
    $reportSending.style.display = 'block';

    setTimeout(function () {
        $reportSent.style.display = 'block';
        $reportSending.style.display = 'none';
    },500);
});

