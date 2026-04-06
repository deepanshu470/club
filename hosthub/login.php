<?php
require_once 'includes/config.php';

if (is_logged_in()) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password!";
    } else {
        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$username' LIMIT 1";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                if ($user['is_active'] == 1) {
                    // Set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['is_admin'] = $user['is_admin'];

                    // Update last login
                    $update_query = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
                    $conn->query($update_query);

                    redirect('dashboard.php');
                } else {
                    $error = "Your account has been deactivated. Please contact support.";
                }
            } else {
                $error = "Invalid username or password!";
            }
        } else {
            $error = "Invalid username or password!";
        }
    }
}

include 'includes/header.php';
?>

<main class="auth-page">
    <div class="container">
        <div class="auth-container">
            <div class="auth-card">
                <h2>Welcome Back!</h2>
                <p class="auth-subtitle">Login to access your hosting dashboard</p>

                <?php
                echo get_error_message();
                echo get_success_message();
                if ($error):
                ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="" class="auth-form" id="loginForm">
                    <div class="form-group">
                        <label for="username">Username or Email</label>
                        <input type="text" id="username" name="username" required
                               placeholder="Enter your username or email"
                               value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required
                               placeholder="Enter your password">
                    </div>

                    <div class="form-group form-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php">Sign up now</a></p>
                    <p><a href="#">Forgot your password?</a></p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
