<?php


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['film']) || !($uid = trim($data['film']))) {
    exit;
}

$films = json_decode(file_get_contents('../data/films.json'));

foreach ($films as $film) {
    if ($film->uid == $uid) {
        $reports = json_decode(file_get_contents('../data/reports.json'));
        $reports[] = $film;


        echo json_encode([
            'success' => false !== file_put_contents('../data/reports.json',
                    json_encode($reports,
                        JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
                )
        ]);
        exit;
    }
}

echo json_encode([
    'success' => false
]);
