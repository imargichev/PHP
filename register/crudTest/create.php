<?php

require 'database.php';

if ( !empty($_POST)) {
    // keep track validation errors
    $nameError = null;
    $emailError = null;
    $mobileError = null;

    // keep track post values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    // validate input
    $valid = true;
    if (empty($name)) {
        $nameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    if (empty($mobile)) {
        $mobileError = 'Please enter Mobile Number';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO customers (name,email,mobile) values(?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($name,$email,$mobile));
        Database::disconnect();
        header("Location: index.php");
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
            <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                <label class="control-label">Page ID</label>
                <div class="controls">

                            <select class="selectpicker">
                                <option value="0"> Select page </option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                                <option value="">123123124123</option>
                            </select>

                    <!--<input name="name" type="text"  placeholder="Name" value="<?php /*echo !empty($name)?$name:'';*/?>">-->
                    <?php if (!empty($nameError)): ?>
                        <span class="help-inline"><?php echo $nameError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                <label class="control-label">Posted</label>
                <div class="controls">
                    <select class="selectpicker">
                        <option value="0">Y/N</option>
                        <option value="">Yes</option>
                        <option value="">No</option>
                    </select>

                   <!-- <input name="email" type="text" placeholder="Email Address" value="<?php /*echo !empty($email)?$email:'';*/?>">-->
                    <?php if (!empty($emailError)): ?>
                        <span class="help-inline"><?php echo $emailError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                <label class="control-label">Posted Text</label>
                <div class="controls">
                    <div class="form-group">
                        <textarea class="form-control" style="width: 450px;margin-left: 2px"  id="comment"></textarea>
                    </div>
                    <!--<input name="mobile" type="text"  placeholder="Mobile Number" value="<?php /*echo !empty($mobile)?$mobile:'';*/?>">-->
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                <label class="control-label">Date</label>
                <div id="datetimepicker" class="input-append date">
                    <input type="text"></input>
                    <span class="add-on">
        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
      </span>
                </div>
                <!--<script type="text/javascript"
                        src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
                </script>-->
                <!--<script type="text/javascript"
                        src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
                </script>-->
                <script type="text/javascript"
                        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
                </script>
                <script type="text/javascript"
                        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
                </script>
                <script type="text/javascript">
                    $('#datetimepicker').datetimepicker({
                        format: 'dd/MM/yyyy hh:mm:ss',
                        language: 'pt-EN'
                    });
                </script>
                    <!--<input name="mobile" type="text"  placeholder="Mobile Number" value="<?php /*echo !empty($mobile)?$mobile:'';*/?>">-->
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                <label class="control-label">Photo</label>
                <div class="controls">
                    <input name="mobile" type="text"  placeholder="Photo" value="<?php echo !empty($mobile)?$mobile:'';?>">
                    <?php if (!empty($mobileError)): ?>
                        <span class="help-inline"><?php echo $mobileError;?></span>
                    <?php endif;?>
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