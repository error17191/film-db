<?php


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['film']) || !($uid = trim($data['film']))) {
    exit;
}

$films = json_decode(file_get_contents('../films.json'));

foreach ($films as $film) {
    if ($film->uid == $uid) {
        $reports = json_decode(file_get_contents('../reports.json'));
        $reports[] = $film;

        file_put_contents('../reports.json',
            json_encode($reports,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );

        echo json_encode([
            'success' => true
        ]);
        exit;
    }
}

echo json_encode([
    'success' => false
]);
