<?php
include 'helpers.php';

start_session();
session_unset();
session_destroy();

header('Location: index.php');
exit;
?>
