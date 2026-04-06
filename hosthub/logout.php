<?php
require_once 'includes/config.php';

// Destroy all session data
session_destroy();

// Clear session variables
$_SESSION = array();

// Redirect to homepage
redirect('index.php');
?>
