<?php
require_once 'includes/config.php';

// Get all active plans
$query = "SELECT * FROM hosting_plans WHERE is_active = 1 ORDER BY price ASC";
$plans_result = $conn->query($query);

include 'includes/header.php';
?>

<main class="plans-page">
    <div class="container">
        <div class="page-header">
            <h1>Choose Your Perfect Hosting Plan</h1>
            <p>Flexible and affordable hosting solutions for every need</p>
        </div>

        <div class="pricing-grid">
            <?php while($plan = $plans_result->fetch_assoc()):
                $is_popular = ($plan['plan_name'] == 'Business');
            ?>
            <div class="pricing-card <?php echo $is_popular ? 'popular' : ''; ?>">
                <?php if ($is_popular): ?>
                    <div class="popular-badge">Most Popular</div>
                <?php endif; ?>

                <h3><?php echo htmlspecialchars($plan['plan_name']); ?></h3>

                <div class="price">
                    <span class="currency">$</span>
                    <span class="amount"><?php echo number_format($plan['price'], 0); ?></span>
                    <span class="period">/month</span>
                </div>

                <p class="plan-description">Perfect for
                    <?php
                    switch($plan['plan_name']) {
                        case 'Starter': echo 'personal websites & blogs'; break;
                        case 'Business': echo 'small to medium businesses'; break;
                        case 'Professional': echo 'professional websites & portfolios'; break;
                        case 'Enterprise': echo 'large enterprises & agencies'; break;
                        default: echo 'your needs';
                    }
                    ?>
                </p>

                <ul class="features-list">
                    <li>
                        <span class="check">✓</span>
                        <strong><?php echo htmlspecialchars($plan['disk_space']); ?></strong> SSD Storage
                    </li>
                    <li>
                        <span class="check">✓</span>
                        <strong><?php echo htmlspecialchars($plan['bandwidth']); ?></strong> Bandwidth
                    </li>
                    <li>
                        <span class="check">✓</span>
                        <strong><?php echo $plan['domains']; ?></strong>
                        <?php echo $plan['domains'] == 1 ? 'Domain' : 'Domains'; ?>
                    </li>
                    <li>
                        <span class="check">✓</span>
                        <strong><?php echo $plan['email_accounts']; ?></strong> Email Accounts
                    </li>
                    <li>
                        <span class="check">✓</span>
                        <strong><?php echo $plan['databases']; ?></strong> MySQL Databases
                    </li>
                    <?php if ($plan['ssl_certificate']): ?>
                    <li>
                        <span class="check">✓</span>
                        Free SSL Certificate
                    </li>
                    <?php endif; ?>
                    <?php if ($plan['backup']): ?>
                    <li>
                        <span class="check">✓</span>
                        Daily Backups
                    </li>
                    <?php endif; ?>
                    <li>
                        <span class="check">✓</span>
                        <?php echo htmlspecialchars($plan['support_level']); ?> Support
                    </li>
                    <li>
                        <span class="check">✓</span>
                        99.9% Uptime Guarantee
                    </li>
                    <li>
                        <span class="check">✓</span>
                        cPanel Control Panel
                    </li>
                    <li>
                        <span class="check">✓</span>
                        Free Website Migration
                    </li>
                </ul>

                <?php if (is_logged_in()): ?>
                    <a href="#" class="btn btn-primary btn-block">Order Now</a>
                <?php else: ?>
                    <a href="register.php" class="btn btn-primary btn-block">Get Started</a>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>

        <!-- Features Comparison -->
        <div class="features-comparison">
            <h2>All Plans Include</h2>
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">⚡</div>
                    <h4>SSD Storage</h4>
                    <p>Lightning-fast solid-state drives</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🔒</div>
                    <h4>Free SSL</h4>
                    <p>Secure your website with HTTPS</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">📧</div>
                    <h4>Email Hosting</h4>
                    <p>Professional email accounts</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🛡️</div>
                    <h4>DDoS Protection</h4>
                    <p>Enterprise-grade security</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🔄</div>
                    <h4>Daily Backups</h4>
                    <p>Automatic data protection</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🌍</div>
                    <h4>Global CDN</h4>
                    <p>Worldwide content delivery</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <h4>Can I upgrade my plan later?</h4>
                    <p>Yes! You can upgrade your hosting plan at any time from your dashboard.</p>
                </div>
                <div class="faq-item">
                    <h4>Do you offer refunds?</h4>
                    <p>We offer a 30-day money-back guarantee on all hosting plans.</p>
                </div>
                <div class="faq-item">
                    <h4>Is there a setup fee?</h4>
                    <p>No, there are no setup fees. The price you see is what you pay.</p>
                </div>
                <div class="faq-item">
                    <h4>What payment methods do you accept?</h4>
                    <p>We accept all major credit cards, PayPal, and bank transfers.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
