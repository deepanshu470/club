<?php
require_once 'includes/config.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = "All fields are required!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    } else {
        $insert_query = "INSERT INTO contact_messages (name, email, subject, message)
                        VALUES ('$name', '$email', '$subject', '$message')";

        if ($conn->query($insert_query)) {
            $success = "Thank you for contacting us! We'll get back to you soon.";
            // Clear form
            $_POST = array();
        } else {
            $error = "Failed to send message. Please try again.";
        }
    }
}

include 'includes/header.php';
?>

<main class="contact-page">
    <div class="container">
        <div class="page-header">
            <h1>Get In Touch</h1>
            <p>Have questions? We'd love to hear from you!</p>
        </div>

        <div class="contact-container">
            <div class="contact-info">
                <h2>Contact Information</h2>
                <p>Feel free to reach out to us through any of the following channels:</p>

                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="method-icon">📧</div>
                        <h3>Email</h3>
                        <p>support@hosthub.com</p>
                        <p>sales@hosthub.com</p>
                    </div>

                    <div class="contact-method">
                        <div class="method-icon">📞</div>
                        <h3>Phone</h3>
                        <p>+1-800-HOST-HUB</p>
                        <p>Mon-Fri: 9AM - 6PM EST</p>
                    </div>

                    <div class="contact-method">
                        <div class="method-icon">💬</div>
                        <h3>Live Chat</h3>
                        <p>24/7 Support Available</p>
                        <p>Average response: 2 min</p>
                    </div>

                    <div class="contact-method">
                        <div class="method-icon">📍</div>
                        <h3>Address</h3>
                        <p>123 Tech Street</p>
                        <p>Digital City, DC 12345</p>
                    </div>
                </div>

                <div class="social-links">
                    <h3>Follow Us</h3>
                    <div class="social-icons">
                        <a href="#" class="social-icon">📘 Facebook</a>
                        <a href="#" class="social-icon">🐦 Twitter</a>
                        <a href="#" class="social-icon">💼 LinkedIn</a>
                        <a href="#" class="social-icon">📷 Instagram</a>
                    </div>
                </div>
            </div>

            <div class="contact-form-container">
                <h2>Send Us a Message</h2>

                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <?php endif; ?>

                <?php if ($error): ?>
                    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="" class="contact-form" id="contactForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Your Name *</label>
                            <input type="text" id="name" name="name" required
                                   placeholder="John Doe"
                                   value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   placeholder="john@example.com"
                                   value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject *</label>
                        <input type="text" id="subject" name="subject" required
                               placeholder="How can we help you?"
                               value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="message">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  placeholder="Write your message here..."><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                </form>
            </div>
        </div>

        <!-- Support Hours -->
        <div class="support-hours">
            <h2>Support Hours</h2>
            <div class="hours-grid">
                <div class="hours-item">
                    <h4>📧 Email Support</h4>
                    <p>24/7 - We respond within 2 hours</p>
                </div>
                <div class="hours-item">
                    <h4>💬 Live Chat</h4>
                    <p>24/7 - Instant responses</p>
                </div>
                <div class="hours-item">
                    <h4>📞 Phone Support</h4>
                    <p>Mon-Fri: 9:00 AM - 6:00 PM EST</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
