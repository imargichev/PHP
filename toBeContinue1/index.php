<?php
session_start();
$_SESSION['message'] = '';
?>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css?1222223">
<div id="wrapper">
    <div id="form">
        <form action="index.php" method="post">
            <div class="alert alert-error"><?= $_SESSION['message']?></div>
            <input type="text" name="dir" value="" placeholder="Въведете директорията"/>
            <input type="submit" name="button" value="Листване" class="btn btn-block btn-primary"/>
            <br/><br/>
        </form>
    </div>
</div>
<?php
header('location: scanTags.php');
$_SESSION['path'] = $_POST['dir'];
if(isset($_POST['button'])) {
    $_SESSION['post-data']['dir'];
    echo $_SESSION['dir'];
    $dir = $_POST['dir'];
    if (empty($dir)) {
        $_SESSION['message'] ='Полето за въвеждане е празно';
    } else {
        header('location: scanTags.php');
    }
}
?>