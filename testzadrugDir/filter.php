<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
<link rel="stylesheet" type="text/css" href="./assets/css/style.css?12222223">
<form action="selector.php" method="post">
    <div id="wrapper">
        <div id="logo">
            <img src="./assets/pics/logo.png" alt="Logo">
        </div>
        <?php
        session_start();
        if (isset($_POST['button'])) {
           $numberOfPhoto = $_POST['valueOfPhoto'];
            $textFor = file_get_contents('./files/text.txt');//vzimame tekstovete
            $txt = (explode("\n", $textFor));//explodvame gi
            shuffle($txt);//burka me gi
            //var_dump($txt);
            $arr = array_filter($txt);

            //var_dump($arr);

            //$dirPath = $_POST['path'];
            $tag = $_POST['path'];

            $importDir = "./$tag/import";//Direktoriq ot koqto chetem snimkite
            $tempDell = "./$tag/import";
            $dirWithTag = "./$tag";//direktoriq s tag osnovnata
            $smallPicDir = "./$tag/smallPics";//direktoriq za vsqka papka s malkite kartinki
            $tempDir = "./$tag/temp_files";//direktoriq za vremmenite failove
            $finalyDir = "./$tag/plan";//Finalna direktoriq sled vsichki prowerki


            $_SESSION['path'] = $tempDir;
            $_SESSION['finDir'] = $finalyDir;

            $counter = 0;

            if (is_dir($dirWithTag)){

               echo "В таг $tag вие искахте $numberOfPhoto<br/><br/>";
                $handle = opendir($importDir);
                while ($file = readdir($handle)) {


                    if ($counter == $numberOfPhoto){
                        break;
                    }
                    if ($file !== '.' && $file !== '..') {

                        list($width, $height) = getimagesize($importDir . '/' . $file);
                        if ($width > "640" || $height > "480") {

                            $uniqid = date("YmdHis");
                            $uniqid1 = md5($file);

                            $newNamePath = '/' . $today . '/' . $counter;

                            $path_parts = pathinfo($file, PATHINFO_EXTENSION);
                            $newPathDir = $newName . '/' . $counter . '.' . $path_parts;

                            $newName = $uniqid1.'.'.$path_parts;
                            $picName = $counter . '.' . $path_parts;

                            echo '<div class="holder">
                                <img src="./'.$tag.'/temp_files'.'/'.$newName.' "width="385px" height="370px""  />
                                    <input type="checkbox" value="' . $txt[$counter] . '" name="pics[' . $newName . ']">
                                    <input type="hidden" value="' . $txt[$counter] . '" name="all['.$newName.']" >
      
                                       <textarea rows="4" cols="50" id="txt" name="comment[' . $newName . ']" placeholder="Коментар">' . $arr[rand(0,count($arr)-1)] . '</textarea>
                               </div>';
                            /*$fromDir = $dirPath . '/' . $file;
                            $toDir = $dirPath . '/' . $today . '/' . $file;
                            $sessionToDir = $dirPath . '/' . $today . '/';
                            $_SESSION['path'] = $sessionToDir;
                            $oldNameFile = $dirPath . '/' . $today . '/' . $file;
                            $newNameWithExt = $dirPath . '/' . $today . '/' . $counter . '.' . $path_parts;
                            $newName = $dirPath . '/' . $today . '/' . $counter;
                            $newNamePath = $_SESSION['dirPath'];*/
                            if (!is_dir($tempDir)) {

                                mkdir($tempDir);
                            }

                            copy("$importDir/$file", "$tempDir/$file");

                            rename("$tempDir/$file", "$tempDir/$newName");
                           /* echo "$importDir/$file";
                            echo "<br/>";
                            echo "$tempDir/$file";
                            die;*/
                            unlink("$tempDell/$file");

                            $counter++;
                        } else {
                            if (!is_dir($smallPicDir)) {
                                mkdir($smallPicDir);
                            }
                            copy("$importDir/$file", "$smallPicDir/$file");
                            unlink("$tempDell/$file");
                        }
                    }
                }
            } else {
                echo "<br/>" . "Не правилно въведен адрес.";
            }
        }
        ?>
        <br/>
        <div style="clear: both"></div>
        <input type="submit" name="buttonSelector" value="Изтрий">
</form>
</div>