<?php
session_start();
$tag =  $_GET["param"];
$_SESSION['message'] = '';
$textFor = file_get_contents('./tags/'.$tag.'/text.txt');
$txt = (explode("\n", $textFor));
?>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css?1222223">
<div id="wrapper">
    <div id="form">


        <form action=""  method="post">
            <textarea name="text" style="height: 850px;width:790px;" rows="50" cols="50"  ><?php
                foreach ($txt as $v){
                    echo "$v";
                }?></textarea>
            <input type="submit" name="add" value="Добави" class="btn btn-block btn-primary">
        </form>
    </div>
</div>
<?php
if (isset($_POST['add'])){
    $file = $_POST['text'];
    /*echo "/$tag/text.txt";*/


    file_put_contents('/$tag/text.txt', print_r($file, true), FILE_APPEND);

    $filename = "./tags/$tag/text.txt";
    $text = $_POST['text'];

    foreach($text as $key => $value)
    {
        $text .= $key." : ".$value."\n";
    }
    $fh = fopen($filename, "w") or die("Could not open log file.");
    fwrite($fh, $text) or die("Could not write file!");
    fclose($fh);


    Header("Location: readFromFile.php?param=$tag");


}
?>
