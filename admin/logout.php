<?php
// admin/logout.php
include 'config.php';
session_unset();
session_destroy();
header("Location: login.php");
exit;