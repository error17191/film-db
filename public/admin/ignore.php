<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true
    || !isset($data['uid'])) {
    exit();
}

$uid = $data['uid'];

$reports = json_decode(file_get_contents('../../data/reports.json'));

for ($i = 0; $i < count($reports); $i++) {
    if ($reports[$i]->uid == $uid) {
        unset($reports[$i]);

        echo json_encode([
            'success' => false !== file_put_contents('../../data/reports.json',
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