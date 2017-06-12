<?php
if (isset($_POST['swift'])) {
    $swift = $_POST['swift'];
    $fp = fopen('temp.swift', "w+");
    fwrite($fp, $swift);
    fclose($fp);
    exec("/usr/bin/swift temp.swift --username hyuntai --password WHTP@ssw0rd --non-interactive log -r HEAD --xml --verbose http://a51.unfuddle.com/svn/a51_activecollab/ 2>&1", $output);

//    exec('/usr/bin/swift temp.swift', $output, $return_var);
}
?>
<html>
<head>

</head>
<body>
<form method="post">
    Swift Code:
    <textarea name="swift" rows="10" cols="130" style="font-size:20px;color:blue;"><?php
        if (isset($swift)) {
            echo $swift;
        }
        ?></textarea><br>
    <input type="submit" value="Try Swift" style="width:120px;height:70px;font-size:20px;"><br>
    Output:
    <textarea name="output" rows="10" cols="130" style="font-size:20px;color:red;"><?php
        if (isset($output)) {
            if (count($output) == 0) {
                echo "Compile error";
            } else {
                foreach ($output as $value) {
                    echo $value . "\n";
                }
            }
        }
        ?></textarea><br>
</form>
</body>
</html>