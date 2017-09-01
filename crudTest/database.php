<?php
define('DB_HOST','localhost');
define('DB_USER','toni');
define('DB_PASS','fYb4WPawqX8bn');
define('DB_NAME','toni');

try {$db = new PDO("mysql:host=". DB_HOST .";dbname=" . DB_NAME,
    DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {echo $e->getMessage();}
catch (Exception $e) {}
?>