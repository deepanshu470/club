# HostHub - Premium Web Hosting Platform

HostHub is a complete, modern web hosting platform built with PHP, MySQL, HTML, CSS, and JavaScript. It provides a full-featured hosting service management system with user authentication, hosting plans, order management, and an admin panel.

## 🚀 Features

### User Features
- **User Registration & Login** - Secure authentication system
- **Hosting Plans** - Multiple pricing tiers with detailed features
- **User Dashboard** - Manage hosting services and account
- **Contact System** - Contact form with message management
- **Responsive Design** - Works on all devices (mobile, tablet, desktop)

### Admin Features
- **Admin Dashboard** - Overview of all platform statistics
- **User Management** - Activate/deactivate users, assign admin roles
- **Order Management** - View and manage hosting orders
- **Message Management** - Handle customer inquiries
- **Plan Management** - Manage hosting plans and pricing

### Technical Features
- **PHP Backend** - Secure server-side logic
- **MySQL Database** - Robust data storage
- **Form Validation** - Client and server-side validation
- **Password Encryption** - Bcrypt password hashing
- **SQL Injection Protection** - Sanitized inputs
- **Session Management** - Secure user sessions
- **Responsive CSS** - Mobile-first design approach
- **Interactive JavaScript** - Enhanced user experience

## 📁 Project Structure

```
hosthub/
├── index.php                 # Homepage
├── login.php                 # User login
├── register.php              # User registration
├── dashboard.php             # User dashboard
├── plans.php                 # Hosting plans listing
├── contact.php               # Contact page
├── logout.php                # Logout handler
│
├── includes/
│   ├── config.php           # Database & site configuration
│   ├── header.php           # Common header
│   └── footer.php           # Common footer
│
├── admin/
│   ├── index.php            # Admin dashboard
│   └── manage-users.php     # User management
│
├── css/
│   ├── style.css            # Main stylesheet
│   └── responsive.css       # Responsive design
│
├── js/
│   ├── main.js              # Main JavaScript
│   └── form-validation.js   # Form validation
│
├── images/                   # Images and icons
│
└── sql/
    └── database.sql          # Database schema
```

## 🛠️ Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Web browser

### Setup Steps

1. **Clone or Download** the project to your web server directory
   ```bash
   cd /var/www/html
   # or your XAMPP/WAMP htdocs folder
   ```

2. **Create Database**
   - Open phpMyAdmin or MySQL command line
   - Run the SQL file:
   ```bash
   mysql -u root -p < hosthub/sql/database.sql
   ```

3. **Configure Database Connection**
   - Open `hosthub/includes/config.php`
   - Update database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'hosthub_db');
   ```

4. **Set File Permissions** (Linux/Mac)
   ```bash
   chmod 755 hosthub
   chmod 644 hosthub/*.php
   ```

5. **Access the Application**
   - Homepage: `http://localhost/hosthub/`
   - Admin Panel: `http://localhost/hosthub/admin/`

## 👤 Default Admin Account

After running the SQL file, you can login with:
- **Username:** admin
- **Password:** admin123

**⚠️ IMPORTANT:** Change the default admin password immediately after first login!

## 🎨 Features Walkthrough

### Homepage
- Modern hero section with animations
- Feature highlights
- Pricing preview
- Call-to-action sections
- Animated statistics counter

### User Registration
- Form validation (client & server-side)
- Password strength indicator
- Email validation
- Secure password hashing

### User Dashboard
- Service overview
- Quick actions
- Account information
- Order history

### Hosting Plans
- Multiple pricing tiers (Starter, Business, Professional, Enterprise)
- Feature comparison
- FAQ section
- Responsive pricing cards

### Admin Dashboard
- User statistics
- Order management
- Message handling
- User activation/deactivation
- Role management

## 🔒 Security Features

1. **Password Security**
   - Bcrypt hashing (PASSWORD_DEFAULT)
   - Minimum length requirements
   - Strength validation

2. **SQL Injection Prevention**
   - Input sanitization
   - Parameterized queries (recommended upgrade)

3. **Session Security**
   - Secure session management
   - Session timeout
   - Admin role verification

4. **XSS Protection**
   - HTML entity encoding
   - Input sanitization

## 🎯 Customization

### Change Site Name
Edit `includes/config.php`:
```php
define('SITE_NAME', 'Your Hosting Name');
define('SITE_URL', 'http://yourdomain.com');
```

### Modify Color Scheme
Edit `css/style.css`:
```css
:root {
    --primary-color: #6366f1;  /* Change to your color */
    --secondary-color: #8b5cf6;
    /* ... */
}
```

### Add New Hosting Plans
1. Add via phpMyAdmin to `hosting_plans` table
2. Or create an admin interface for plan management

## 📱 Responsive Breakpoints

- **Desktop:** 1024px and above
- **Tablet:** 768px - 1023px
- **Mobile:** Below 768px
- **Small Mobile:** Below 480px

## 🧪 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Opera (latest)

## 📝 License

This project is created for educational purposes. Feel free to use and modify as needed.

## 🤝 Contributing

Suggestions and improvements are welcome!

## 📧 Support

For issues or questions, please use the contact form or create an issue in the repository.

## 🚀 Future Enhancements

Potential improvements:
- Payment gateway integration (Stripe, PayPal)
- Email verification system
- Password reset functionality
- cPanel integration
- Invoice generation
- Support ticket system
- Knowledge base
- Multi-language support
- API integration
- Automated backups

## 👨‍💻 Developer Notes

### Database Schema
The database includes:
- `users` - User accounts
- `hosting_plans` - Service plans
- `orders` - Customer orders
- `contact_messages` - Contact inquiries

### Code Standards
- PHP: Procedural style with some OOP concepts
- CSS: BEM-like naming convention
- JavaScript: ES6+ features
- SQL: Normalized database structure

---

**Built with ❤️ for learning and development**
