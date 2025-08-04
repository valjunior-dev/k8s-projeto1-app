<?php
$servername = getenv('DB_HOST') ?: 'mysql'; 
$username   = getenv('DB_USER') ?: 'dio';
$password   = getenv('DB_PASS') ?: 'dio';
$database   = getenv('DB_NAME') ?: 'dio';

$link = new mysqli($servername, $username, $password, $database);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
