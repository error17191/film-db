<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true
    || !isset($data['uid'])) {
    exit();
}

$uid = $data['uid'];

$reports = json_decode(file_get_contents('../../data/reports.json'));
$films = json_decode(file_get_contents('../../data/films.json'));
$report_index = -1;
$film_index = -1;

for ($i = 0; $i < count($reports); $i++) {
    if ($reports[$i]->uid == $uid) {
        $report_index = $i;
        break;
    }
}


for ($i = 0; $i < count($films); $i++) {
    if ($films[$i]->uid == $uid) {
        $film_index = $i;
        break;
    }
}

if ($report_index < 0 || $film_index < 0) {
    echo json_encode([
        'success' => false
    ]);
    exit;
}

unset($reports[$report_index]);
unset($films[$film_index]);

echo json_encode([
    'success' => true
]);
