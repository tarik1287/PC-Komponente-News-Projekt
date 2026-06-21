<?php
header('Content-Type: text/html; charset=utf-8');

$servername = 'localhost';
$username = 'root';
$password = '';
$basename = 'projekt0246122685';

$dbc = @mysqli_connect($servername, $username, $password, $basename);

if ($dbc) {
    mysqli_set_charset($dbc, 'utf8mb4');
} else {
    $db_error = mysqli_connect_error();
}
?>
