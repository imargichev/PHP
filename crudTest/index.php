<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="/crudTest/css/bootstrap.min.css" rel="stylesheet">
    <script src="/crudTest/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
        #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.4em; height: 18px; }
        #sortable li span { position: absolute; margin-left: -1.3em; }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#sortable tbody" ).sortable({
                opacity: 0.6,
                cursor: 'move',
                update: function () {
                    var order = $(this).sortable("serialize");
                    $.post( "post.php", order ,  function(  ) {
                        $(".result").html( order );
                    });
                }
            });
        } );
    </script>
</head>
<body>
<div class="result"></div>
<div class="container">
    <div class="row">
        <h3>Facebook Auto Poster</h3>
    </div>
    <div class="row">
        <p>
            <a href="create.php" class="btn btn-success">Create</a>
        </p><!--id="sortable"-->
        <table  class="table table-striped table-bordered">
            <thead>
            <tr>
                <th width="3%">ID</th>
                <th width="8%">Page ID</th>
                <th width="16%">Post data</th>
                <th width="5%">Posted</th>
                <th width=250>Post text</th>
                <th width=250>Post picture</th>
                <th width=250>Post type</th>
                <th width="17%"Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            include 'database.php';
            $resultSet = $db->query('SELECT * FROM plan');
            while( ($row = $resultSet->fetch(PDO::FETCH_NUM)) !== false){
                echo '<tr id="sortorder-'.$row[0].'">';
                echo '<td width=250>'. $row[0] . '</td>';
                echo '<td width=250>'. $row[1] . '</td>';
                echo '<td width=250 >'. $row[2] . '</td>';
                echo '<td width=250>'. $row[3] . '</td>';
                echo '<td width=250>'. $row[4] . '</td>';
                echo '<td width=250>'. $row[5] . '</td>';
                echo '<td width=250>'. $row[6] . '</td>';
                echo '<td width=450>';
                echo '<a class="btn btn-success" href="update.php?id='.$row[0].'">Update</a>';
                echo ' ';
                echo '<a class="btn btn-danger" href="delete.php?id='.$row[0].'">Delete</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div> <!-- /container -->
</body>
</html>