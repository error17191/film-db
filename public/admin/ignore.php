<?php

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true
    || !isset($_POST['uid'])) {
    exit();
}
$data = json_decode(file_get_contents('php://input'), true);

$uid = $data->uid;

$reports = json_decode(file_get_contents('../../data/reports.json'));

for ($i = 0; $i < count($reports); $i++) {
    if ($reports[$i]->uid == $uid) {
        unset($reports[$i]);
        echo json_encode([
            'success' => true
        ]);
        exit;
    }
}

echo json_encode([
    'success' => false
]);