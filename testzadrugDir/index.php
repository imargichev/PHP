    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="./assets/css/reset.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css?122223">
<div id="wrapper">
    <div id="form">
        <div id="logo">
            <img src="./assets/pics/logo.png" alt="Logo">
        </div>
<form action="filter.php" method="post">
    <input type="text" name="path" value="<?php echo $_POST['path'] ?>" placeholder="Въведете директорията"/>
    <input type="number" name="valueOfPhoto"Z value="<?php echo $_POST['numberOfFoto'] ?>" placeholder="Брой на снимки">
    <input type="submit" name="button" value="Покажи снимките "/>
    <br/><br/>
</form>
    </div>

</div>