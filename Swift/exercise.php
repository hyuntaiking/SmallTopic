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
    $swift = "import Foundation\n" . $swift; // Auto add 'import Foundation'
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
</head>
<body>
<form method="post" action="exercise.php">
<br>
<br>
<br>
<div class="container-fluit">
    <div class="row">
        <div class="col-sm-5"
             style="background-color: lightgray; min-height: 600px">
            <div class="form-group">
                <label for="comment">Code.Swift:</label>
                <textarea class="form-control" rows="28" name="swift"><?php
                    if (isset($swift)) {
                        echo $swift;
                    }
                    ?></textarea>
            </div>
        </div>
        <div class="col-sm-2"
             style="background-color: lightgray; min-height: 600px">
            <input class="btn btn-primary" type="submit" value="Run">
        </div>
        <div class="col-sm-5"
             style="background-color: lightgray; min-height: 600px">
            <div class="form-group">
                <label for="comment">Console:</label>
                <textarea class="form-control" rows="28" name="console"><?php
                    if (isset($output)) {
                        foreach ($output as $value) {
                            echo $value . "\n";
                        }
                    }
                    ?></textarea>
            </div>
        </div>
    </div>
</div>
</form>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>