var $mainBtn = document.getElementById('random-film');

var $filmName = document.getElementById('film-name');

var $year = document.getElementById('film-year');

var $undoBtn = document.querySelector('.undo');

var lastFilm, savedFilm;

$mainBtn.addEventListener('click', function (e) {
    e.preventDefault();
    lastFilm = savedFilm;
    $mainBtn.classList.add('loading');
    axios.get('app.php').then(function (response) {
        $mainBtn.classList.remove('loading');
        var film = response.data;
        savedFilm = film;
        if (lastFilm) {
            $undoBtn.style.visibility = 'visible';
        }

        $filmName.textContent = film.name;
        $filmName.href = film.link;
        $year.textContent = film.year;
    });
});

$undoBtn.addEventListener('click', function (e) {
    e.preventDefault();
    $filmName.textContent = lastFilm.name;
    $filmName.href = lastFilm.link;
    $year.textContent = lastFilm.year;
    savedFilm = lastFilm;
    $undoBtn.style.visibility = 'hidden';
});