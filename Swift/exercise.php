<?php
include 'sql.php';
if (isset($_GET['chapter'])) {
    $chapter  = $_GET['chapter'];
    $sequence = $_GET['sequence'];
    $sql = "select code from exercise where chapter = ? and sequence = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$chapter, $sequence]);
    if ($stmt->rowCount() > 0) {
        $objExercise = $stmt->fetchObject();
        $swift = $objExercise->code;
    }
}
if (@$swift || @isset($_POST['swift'])) {
    if (@isset($_POST['swift'])) {
        $swift = $_POST['swift'];
    }
    $fp = fopen('Code.Swift', "w+");
    if (strpos($swift, 'import Foundation') === false) {
        $swift = "import Foundation\n" . $swift; // Auto add 'import Foundation'
    }

    fwrite($fp, $swift);
    fclose($fp);
    exec("/usr/bin/swift Code.Swift --username hyuntai --password WHTP@ssw0rd --non-interactive log -r HEAD --xml --verbose http://a51.unfuddle.com/svn/a51_activecollab/ 2>&1", $output);
}
?>
<html>
<head>
    <link rel="shortcut icon" href="image/favicon.ico">
    <link rel="bookmark" href="image/favicon.ico">
    <title>Swift Exercise</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans+Mono" rel="stylesheet">
</head>
<body style="font-family: Droid Sans Mono;">
<!--Horizontal Menu-->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="GoToSwift.php">Go to Swift</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="exercise.php">Exercise</a></li>
            <li><a href="https://developer.apple.com/documentation/swift">Library</a></li>
            <li><a href="#">Page 3</a></li>
        </ul>
    </div>
</nav>
<form method="post">
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-6"
             style="background-color: lightgray;">
            <div class="form-group">
                <h3><span class="label label-default">Code.Swift</span></h3>
                <textarea class="form-control" rows="19" name="swift" style="font-size:20px;color:green; background-color: black;"><?php
                    if (isset($swift)) {
                        echo "$swift";
                    }
                    ?></textarea>
            </div>
        </div>
        <div class="col-sm-6"
             style="background-color: lightgray;">
            <div class="form-group">
                <h3><span class="label label-default">Console</span></h3>
                <textarea class="form-control" rows="19" name="console" style="font-size:20px;color:green; background-color: black;" readonly><?php
                    if (isset($output)) {
                        foreach ($output as $value) {
                            echo $value . "\n";
                        }
                    }
                    ?></textarea>
            </div>
        </div>
        <div class="col-sm-12"
             style="background-color: lightgray; min-height: 600px">
            <button class="btn btn-primary btn-block" type="submit"><span class="glyphicon glyphicon-play" aria-hidden="true" style="font-size: 350%;"></span></button>
        </div>
    </div>
</div>
</form>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>