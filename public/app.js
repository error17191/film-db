var $mainBtn = document.getElementById('random-film');

var $filmName = document.getElementById('film-name');

var $year = document.getElementById('film-year');

$mainBtn.addEventListener('click', function (e) {
    e.preventDefault();
    $mainBtn.classList.add('loading');
    axios.get('app.php').then(function (response) {
        $mainBtn.classList.remove('loading');
        var film = response.data;
        $filmName.textContent = film.name;
        $filmName.href = film.link;
        $year.textContent = film.year;
    });
});