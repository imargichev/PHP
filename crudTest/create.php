<?php

require 'database.php';

if ( !empty($_POST)) {
    // keep track validation errors
    $pageId = null;
    $emailError = null;
    $mobileError = null;

    // keep track post values


    $pageIdSelect = $_POST['pageIdSelect'];
    $selectYN = $_POST['selectYN'];
    $textArea = $_POST['textArea'];
    $date = $_POST['date'];
    $photoPath = $_POST['photo'];
    $PostedType = $_POST['PostedType'];

    /*echo $pageIdSelect;
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];*/

    // validate input
    $valid = true;
    if ($pageIdSelect==0) {
        $idError = 'Please select page ID!';
        $valid = false;
    }
    if ($selectYN==0) {
        $selectYNError = 'Please select Yes or No!';
        $valid = false;
    }
    if (empty($textArea)) {
        $textAreaError = 'Please enter text for post!';
        $valid = false;
    }
    if (empty($date)) {
        $dateError = 'Please select data!';
        $valid = false;
    }
    if (empty($PostedType)) {
        $PostedTypeError = 'Select posted Type';
        $valid = false;
    }



    if (empty($photoPath)) {
        $photoError = 'Empy row';
        $valid = false;
    }

    // insert data
    if ($valid) {
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO plan (page_id,post_date,posted,post_text,post_picture,post_type) VALUES ('{$pageIdSelect}','{$date}','{$selectYN}','{$textArea}','{$photoPath}','{$PostedType}')";

        if ($db->exec($sql) == true) {
            1;
            header("Location: index.php");
        } else {
            2;
        }



        /*
        $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";

        $q = $pdo->prepare($sql);
        $q->execute(array($name,$email,$mobile));
        header("Location: index.php");*/
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">

    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
          href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">


    <!--<script src="js/bootstrap.min.js"></script>-->
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Create a Record</h3>
        </div>

        <form class="form-horizontal" action="create.php" method="post">
            <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                <label class="control-label">Page ID</label>
                <div class="controls">
                            <select name="pageIdSelect" class="selectpicker">
                                <option value="0"> Select page </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                    <?php if (!empty($idError)): ?>
                        <span class="help-inline"><?php echo $idError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($selectYNError)?'error':'';?>">
                <label class="control-label">Posted</label>
                <div class="controls">
                    <select name="selectYN" class="selectpicker">
                        <option value="0">Y/N</option>
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                    <?php if (!empty($selectYNError)): ?>
                        <span class="help-inline"><?php echo $selectYNError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($textAreaError)?'error':'';?>">
                <label class="control-label">Posted text</label>
                <div class="controls">
                    <textarea name="textArea" class="form-control" style="width: 450px;margin-left: 2px"  id="comment"><?=$_POST['textArea'] ?></textarea>
                    <?php if (!empty($textAreaError)): ?>
                        <span class="help-inline"><?php echo $textAreaError;?></span>
                    <?php endif;?>
                </div>
            </div>








            <div class="control-group <?php echo !empty($dateError) ? 'error' : ''; ?>">
                <label class="control-label">Date</label>
                <div class="controls">
                    <div id="datetimepicker" class="input-append date">
                        <input name="date" type="text"> <?= $_POST['date']?></input>
                        <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                    </div>
                    <!-- <input name="email" type="text" placeholder="Email Address" value="<?php /*echo !empty($email)?$email:'';*/ ?>">-->
                    <?php if (!empty($dateError)): ?>
                        <span class="help-inline"><?php echo $dateError; ?></span>
                    <?php endif; ?>
                </div>
            </div>






            <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">

                <div class="controls">

                    <!--<input name="mobile" type="text"  placeholder="Mobile Number" value="<?php /*echo !empty($mobile)?$mobile:'';*/?>">-->
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
            </div>

                <script type="text/javascript"
                        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
                </script>
                <script type="text/javascript"
                        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
                </script>
                <script type="text/javascript">
                    $('#datetimepicker').datetimepicker({
                        inline:true,
                        format: 'yyyy-MM-dd hh:mm:ss',
                        language: 'pt-EN',


                    });
                </script>
                    <!--<input name="mobile" type="text"  placeholder="Mobile Number" value="<?php /*echo !empty($mobile)?$mobile:'';*/?>">-->
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>



    <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
        <label class="control-label">Posted</label>
        <div class="controls">
            <input name="photo" type="text"  placeholder="Photo" value="<?php echo !empty($mobile)?$mobile:'';?>">

            <!-- <input name="email" type="text" placeholder="Email Address" value="<?php /*echo !empty($email)?$email:'';*/?>">-->
            <?php if (!empty($photoError)): ?>
                <span class="help-inline"><?php echo $photovError;?></span>
            <?php endif;?>
        </div>
    </div>

            <div class="control-group <?php echo !empty($PostedTypeError)?'error':'';?>">
                <label class="control-label">Posted type</label>
                <div class="controls">
                    <select name="PostedType" class="selectpicker">
                        <option value="1">Posted</option>
                        <option value="2">Place Holder</option>
                        <option value="3">Place Holder</option>
                    </select>
                    <?php if (!empty($PostedTypeError)): ?>
                        <span class="help-inline"><?php echo $PostedTypeError;?></span>
                    <?php endif; ?>
                </div>
            </div>





            <div class="form-actions">
                <button type="submit" class="btn btn-success">Create</button>
                <a class="btn" href="index.php">Back</a>
            </div>
        </form>
    </div>

</div> <!-- /container -->
</body>
</html>