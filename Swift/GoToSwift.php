<!DOCTYPE html>
<head>
    <link rel="shortcut icon" href="image/favicon.ico">
    <link rel="bookmark" href="image/favicon.ico">
    <title>Go To Swift</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet">
    <style>
        code {
            font-family: Droid Sans Mono;
            font-size: 18px;
            line-height: 1.5em;
        }
    </style>
</head>
<body>
<form>
<!--Horizontal Menu-->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header active">
            <a class="navbar-brand" href="GoToSwift.php">Go to Swift</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="exercise.php">Exercise</a></li>
            <li><a href="https://developer.apple.com/documentation/swift">Library</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>
    </div>
</nav>
<br>
<br>
<br>
<div class="container">
<h1><span class="label label-primary">Welcome to Swift</span></h1>
<?php
include 'sql.php';
$language = "en"; // change language (English:'en' Chinese:'zh-Hans')
$sql = "select * from swiftbook where language = '{$language}' or type = 'x' order by chapter,sequence";
$stmt = $pdo->prepare($sql);
$stmt->execute([]);
while ($swiftbook = $stmt->fetchObject()) {
    switch ($swiftbook->type) {
        case 'h':
            echo '<br><br><br>';
            echo "<h2>{$swiftbook->content}</h2>";
            break;
        case 'p':
            echo "<p class='lead'>{$swiftbook->content}</p>";
//            <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
            break;
        case 'x':
            echo '<div class="well">';
            switch ($language) {
                case 'en':
                    echo '<h3>EXAMPLE</h3>';
                    $btnLabel = "Try it Yourself";
                    break;
                case 'zh-Hans':
                    echo '<h3>练习</h3>';
                    $btnLabel = "试试吧";
                    break;
            }
            echo '<div class="bs-callout bs-callout-primary">';
            echo "<p><code>{$swiftbook->content}</code></p>";
            echo '</div>';
            echo "<button type='button' class='btn btn-primary btn-lg' onclick=\"javascript:location.href='exercise.php?chapter={$swiftbook->chapter}&sequence={$swiftbook->sequence}'\">{$btnLabel} >></button>";
            echo '</div>';
            break;
        case 'n':
            echo '<div class="bs-callout bs-callout-danger">';
            if ($language == 'en') {
                echo 'NOTE';
            }
            echo "<p>{$swiftbook->content}</p>";
            echo '</div>';
            break;
        case 'e':
            echo '<div class="bs-callout bs-callout-default">';
            switch ($language) {
                case 'en':
                    echo 'EXPERIMENT';
                    break;
                case 'zh-Hans':
                    echo '实验';
                    break;
            }
            echo "<p>{$swiftbook->content}</p>";
            echo '</div>';
            break;
    }
}
?>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>