<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css?122223">
<div id="wrapper">
    <div id="form">
        <div id="logo">
            <img src="./assets/pics/logo.png" alt="Logo">
            <?php
            session_start();
            $fullPath = $_SESSION['finalDir'];
            $displayPic = $_SESSION['dirPath'];
            $finalyDir = $_SESSION['finDir'];
            $tempDir = $_SESSION['path'];


            if (isset($_POST['pics']) && $_POST['pics'] || isset($_POST['buttonSelector'])) {

                $pics = $_POST['pics'];
                foreach ($pics as $k => $value) {
                    if (unlink($tempDir .'/'. $k)) {
                        unset($_POST['comment'][$k]);
                        unset($_POST['all'][$k]);
                    }
                }
                foreach ($_POST['all'] as $k=>$v) {
                    copy($tempDir.'/'.$k,$finalyDir.'/'.$k);
                    $myfile = fopen($finalyDir . "/{$k}.txt", "w");
                    fwrite($myfile, pack("CCC",0xef,0xbb,0xbf));
                    fwrite($myfile, $v);
                    fclose($myfile);
                    unlink($tempDir.'/'.$k);
                }

                echo '<a href="./index.php"><strong>Отначало</strong></a>';
            }


            ?>
        </div>
    </div>

</div>


