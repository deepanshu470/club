<?php include 'includes/header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">Welcome to <span class="highlight">HostHub</span></h1>
                <p class="hero-subtitle">Premium Web Hosting Solutions for Your Success</p>
                <p class="hero-description">Fast, Secure, and Reliable hosting with 99.9% uptime guarantee. Start your online journey with us today!</p>
                <div class="hero-buttons">
                    <a href="plans.php" class="btn btn-primary">View Plans</a>
                    <a href="register.php" class="btn btn-secondary">Get Started Free</a>
                </div>
            </div>
        </div>
        <div class="hero-animation">
            <div class="floating-element el-1">🌐</div>
            <div class="floating-element el-2">🚀</div>
            <div class="floating-element el-3">⚡</div>
            <div class="floating-element el-4">🔒</div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title">Why Choose HostHub?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Lightning Fast</h3>
                    <p>SSD storage and CDN integration ensure your website loads at blazing speeds.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure & Protected</h3>
                    <p>Free SSL certificates, DDoS protection, and daily backups keep your data safe.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">📈</div>
                    <h3>99.9% Uptime</h3>
                    <p>Industry-leading uptime guarantee with redundant infrastructure.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💬</div>
                    <h3>24/7 Support</h3>
                    <p>Expert support team available round the clock via chat, email, and phone.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎯</div>
                    <h3>Easy Control Panel</h3>
                    <p>User-friendly cPanel interface for effortless website management.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Best Value</h3>
                    <p>Competitive pricing with no hidden fees. Get more for less!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number" data-target="50000">0</div>
                    <div class="stat-label">Happy Customers</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="99.9">0</div>
                    <div class="stat-label">% Uptime</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="150">0</div>
                    <div class="stat-label">Countries Served</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="24">0</div>
                    <div class="stat-label">Hour Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Preview -->
    <section class="pricing-preview">
        <div class="container">
            <h2 class="section-title">Our Hosting Plans</h2>
            <p class="section-subtitle">Choose the perfect plan for your needs</p>
            <?php
            $query = "SELECT * FROM hosting_plans WHERE is_active = 1 ORDER BY price ASC LIMIT 3";
            $result = $conn->query($query);
            ?>
            <div class="pricing-grid">
                <?php while($plan = $result->fetch_assoc()): ?>
                <div class="pricing-card">
                    <h3><?php echo htmlspecialchars($plan['plan_name']); ?></h3>
                    <div class="price">
                        <span class="currency">$</span>
                        <span class="amount"><?php echo number_format($plan['price'], 2); ?></span>
                        <span class="period">/mo</span>
                    </div>
                    <ul class="features-list">
                        <li>✓ <?php echo htmlspecialchars($plan['disk_space']); ?> SSD Storage</li>
                        <li>✓ <?php echo htmlspecialchars($plan['bandwidth']); ?> Bandwidth</li>
                        <li>✓ <?php echo $plan['domains']; ?> Domain(s)</li>
                        <li>✓ <?php echo $plan['email_accounts']; ?> Email Accounts</li>
                        <li>✓ <?php echo $plan['databases']; ?> MySQL Databases</li>
                        <li>✓ Free SSL Certificate</li>
                        <li>✓ <?php echo htmlspecialchars($plan['support_level']); ?> Support</li>
                    </ul>
                    <a href="plans.php" class="btn btn-primary">Choose Plan</a>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="text-center">
                <a href="plans.php" class="btn btn-outline">View All Plans</a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of satisfied customers and launch your website today!</p>
            <a href="register.php" class="btn btn-large">Start Your Free Trial</a>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>
