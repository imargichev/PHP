<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css?122222223">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
<div id="wrapper">
    <div id="form">
        <table>

<?php
$_SESSION['dir'];
$tags = '.'.'/'."tags";
foreach (new DirectoryIterator('./tags') as $fileInfo) {
    if($fileInfo->isDot()) continue;
    echo "<tr>";
    echo "<td>";
    echo $fileInfo->getFilename();
    echo "</td>";
    echo "<td>";
    echo "&nbsp;&nbsp;";
    echo "</td>";
    echo "<td>";
    echo "<a href='./readFromFile.php?param=".$fileInfo->getFilename()."' class=\"btn btn-block btn-primary\"  >Управление на текстове<br/></a>";
    echo "</td>";
    echo "<tr>";
}

?>

        </table>
</div>
    </div>
<style>
    table, th, td {
        border: 20px;
        height: 30px;


    td {width: 50px;}

    textarea  {
        font-family: Verdana, Geneva, sans-serif;
    }
</style>