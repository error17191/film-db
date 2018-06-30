<?php


$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['film']) || !($uid = trim($data['film']))) {
    exit;
}

$films = json_decode(file_get_contents('../data/films.json'));

foreach ($films as $film) {
    if ($film->uid == $uid) {
        save_report($film);
        exit;
    }
}

echo json_encode([
    'success' => false
]);


function save_report($film)
{
    $reports = json_decode(file_get_contents('../data/reports.json'));

    for ($i = 0; $i < count($reports); $i++) {
        if ($reports[$i]->uid == $film->uid){
            $reports[$i]->count++;
            break;
        }
    }
    if($i == count($reports)){
        $film->count = 1;
        $reports[] = $film;
    }

    echo json_encode([
        'success' => false !== file_put_contents('../data/reports.json',
                json_encode($reports,
                    JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
            )
    ]);


}