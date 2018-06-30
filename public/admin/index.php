<?php
session_start();
if(! isset($_SESSION['logged']) || $_SESSION['logged'] !== true){
    header('location: /login');
}

$reports = array_reverse(json_decode(file_get_contents('../../data/reports.json')));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اختارلي فيلم</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link rel="stylesheet" href="../style-003.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"
            integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9"
            crossorigin="anonymous"></script>
</head>
<body>
<h2>عاوز تمسح الأفلام دي؟</h2>
<br>
<?php foreach ($reports as $report) : ?>
<div class="report-block">
    <div class="film-name">
        <h3><a href="https://www.elcinema.com/work/<?php echo $film->uid;?>"><?php echo $report->name; ?></a>
        </h3>
    </div>
    <div class="film-year">
        <h3><?php echo $report->year ; ?></h3>
        <?php if($report->count > 1) echo "<span onclick='showTooltip()' class='rounded-label'>{$report->count}</span>" ?>
    </div>
    <div>
        <div class="btn-left">
            <button class="btn">لا</button>
        </div>
        <div class="btn-right">
            <button class="btn">نعم</button>
        </div>
    </div>
</div>
<?php endforeach; ?>

<footer>
    <p>
        Made for fun by @ <a target="_blank" href="https://facebook.com/error17191">Mohamed Ahmed</a>
    </p>
</footer>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="admin.js"></script>
</body>
</html>