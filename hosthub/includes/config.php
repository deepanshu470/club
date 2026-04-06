<?php
// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hosthub_db');

// Site Configuration
define('SITE_NAME', 'HostHub');
define('SITE_URL', 'http://localhost/hosthub');
define('ADMIN_EMAIL', 'admin@hosthub.com');

// Security
define('SESSION_LIFETIME', 3600); // 1 hour

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database Connection
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $conn->set_charset("utf8mb4");
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}

// Helper Functions
function sanitize_input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}

function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

function is_admin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
}

function redirect($url) {
    header("Location: " . $url);
    exit();
}

function get_user_data($user_id) {
    global $conn;
    $user_id = (int)$user_id;
    $query = "SELECT * FROM users WHERE id = $user_id LIMIT 1";
    $result = $conn->query($query);
    return $result->fetch_assoc();
}

function format_price($price) {
    return '$' . number_format($price, 2);
}

function get_error_message() {
    if (isset($_SESSION['error'])) {
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
        return '<div class="alert alert-error">' . htmlspecialchars($error) . '</div>';
    }
    return '';
}

function get_success_message() {
    if (isset($_SESSION['success'])) {
        $success = $_SESSION['success'];
        unset($_SESSION['success']);
        return '<div class="alert alert-success">' . htmlspecialchars($success) . '</div>';
    }
    return '';
}
?>
