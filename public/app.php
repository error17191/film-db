<?php

$films = json_decode(file_get_contents('../data/films.json'));

$film = $films[mt_rand(0, count($films) - 1)];
$film->link = 'https://www.elcinema.com/work/' . $film->uid;

echo json_encode($film);