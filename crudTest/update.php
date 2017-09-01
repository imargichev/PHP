<?php
require 'database.php';
$id = 1;

if ( !empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

echo $id;


if ( null==$id ) {
    header("Location: index.php");
}
    $pageIdSelect = $_POST['pageIdSelect'];
    $selectYN = $_POST['selectYN'];
    $textArea = $_POST['textArea'];
    $dateTime = $_POST['date'];
    $photoPath = $_POST['photo'];
    $postedType = $_POST['PostedType'];

if (isset($_POST['update'])) {
    $valid = true;
    if (empty($pageIdSelect)) {
        $idError = 'Please select page ID!';
        $valid = false;
    }
    if (empty($selectYN)){
        $selectYNError = 'Please select Yes or No!';
        $valid = false;
    }
    if (empty($textArea)) {
        $textAreaError = 'Please enter text for post!';
        $valid = false;
    }
    if (empty($dateTime)) {
        $dateError = 'Please select data!';
        $valid = false;
    }
    if (empty($postedType)) {
        $postedTypeError = 'Select posted Type';
        $valid = false;
    }


    if (empty($photoPath)) {
        $photoError = 'Empy row';
        $valid = false;
    }
      if ($valid) {
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE plan SET page_id=:pageIdSelect,post_date=:dateTime,posted=:selectYN,post_text=:textArea,post_picture=:photoPath,post_type=:PostedType WHERE id =:id";



          $db->bindParam(':pageIdSelect', $pageIdSelect, PDO::PARAM_INT);
          echo "Heelooo ne stiga";
          $db->bindParam(':post_date', $dateTime, PDO::PARAM_STR);
          $db->bindParam(':posted',$selectYN,PDO::PARAM_STR);
          $db->bindParam(':post_text',$textArea,PDO::PARAM_STR);
          $db->bindParam(':post_picture',$photoPath,PDO::PARAM_STR);
          $db->bindParam(':post_type',$postedType,PDO::PARAM_STR);

          $db = $db->prepare($sql);
          $sql = "UPDATE plan SET page_id=:pageIdSelect,post_date=:dateTime,posted=:selectYN,post_text=:textArea,post_picture=:photoPath,post_type=:PostedType WHERE id =:id";

          echo $sql;

          if ($db->execute($sql) == true) {
              1;
              header("Location: index.php");
          } else {
              2;

          }
          $db->execute();
  }

}
    // update data
 $resultSet = $db->query("SELECT * FROM plan where id = '$id'");
while( ($row = $resultSet->fetch(PDO::FETCH_NUM)) !== false){

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




</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="row">
            <h3>Update post status</h3>
        </div>

        <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
            <div class="control-group <?php echo !empty($idError)?'error':'';?>">
                <label class="control-label">Page ID</label>
                <div class="controls">
                    <select name="pageIdSelect"  value="<?=$row[1] ?>"  class="selectpicker">
                        <option value="1"><?=$row[1] ?></option>
                        <option value="2">1</option>
                        <option value="3">2</option>
                    </select>
                    <?php if (!empty($idError)): ?>
                        <span class="help-inline"><?php echo $idError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($selectYNError)?'error':'';?>">
                <label class="control-label">Posted</label>
                <div class="controls">
                    <select  name="selectYN" class="selectpicker">
                        <option value="1"><?=$row[3] ?></option>
                        <option value="2">Yes</option>
                        <option value="3">No</option>
                    </select>
                    <?php if (!empty($selectYNError)): ?>
                        <span class="help-inline"><?php echo $selectYNError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($textAreaError)?'error':'';?>">
                <label class="control-label">Posted text</label>
                <div class="controls">
                    <textarea  name="textArea" class="form-control" style="width: 450px;margin-left: 2px"  id="comment"><?= $row[4] ;?></textarea>
                    <?php if (!empty($textAreaError)): ?>
                        <span class="help-inline"><?php echo $textAreaError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($dateError) ? 'error' : ''; ?>">
                <label class="control-label">Date</label>
                <div class="controls">
                    <div id="datetimepicker" class="input-append date">
                        <input name="date" type="text" value="<?= $row [2]?>"> </input>
                        <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                    </div>
                    <!-- <input name="email" type="text" placeholder="Email Address" value="<?php /*echo !empty($email)?$email:'';*/ ?>">-->
                    <?php if (!empty($dateError)): ?>
                        <span class="help-inline"><?php echo $dateError; ?></span>
                    <?php endif; ?>
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
            <div class="control-group <?php echo !empty($photoError)?'error':'';?>">
                <label class="control-label">Photo</label>
                <div class="controls">
                    <input name="photo" type="text"  placeholder="Photo" value="<?=$row[5] ?>">

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
                        <option value="1"><?= $row[6] ?></option>
                        <option value="2">Place Holder</option>
                        <option value="3">Place Holder</option>
                    </select>
                    <?php if (!empty($PostedTypeError)): ?>
                        <span class="help-inline"><?php echo $PostedTypeError;?></span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button name="update" type="submit" class="btn btn-success">Update</button>
                <a class="btn" href="index.php">Back</a>
            </div>
        </form>
    </div>

</div> <!-- /container -->
</body>
</html><?php }?>