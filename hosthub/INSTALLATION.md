# HostHub - Quick Installation Guide

## 🚀 Quick Start (5 Minutes)

### Step 1: Copy Files
Copy the entire `hosthub` folder to your web server:
- **XAMPP/WAMP**: `C:/xampp/htdocs/hosthub`
- **Linux**: `/var/www/html/hosthub`
- **Mac**: `/Applications/XAMPP/htdocs/hosthub`

### Step 2: Create Database
1. Open **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Click "New" to create a database
3. Name it: `hosthub_db`
4. Click on "Import" tab
5. Choose file: `hosthub/sql/database.sql`
6. Click "Go"

### Step 3: Configure Database
Open `hosthub/includes/config.php` and update if needed:
```php
define('DB_HOST', 'localhost');     // Usually localhost
define('DB_USER', 'root');          // Your MySQL username
define('DB_PASS', '');              // Your MySQL password
define('DB_NAME', 'hosthub_db');    // Database name
```

### Step 4: Access Website
Open your browser and go to:
- **Homepage**: `http://localhost/hosthub/`
- **Admin Panel**: `http://localhost/hosthub/admin/`

### Step 5: Login as Admin
Default admin credentials:
- **Username**: `admin`
- **Password**: `admin123`

⚠️ **IMPORTANT**: Change this password immediately!

## 📋 What You Get

### User Features
✅ User registration and login
✅ View hosting plans
✅ User dashboard
✅ Contact form
✅ Responsive mobile design

### Admin Features
✅ Admin dashboard with statistics
✅ Manage users (activate/deactivate)
✅ View orders
✅ Read contact messages
✅ Assign admin roles

## 🎨 Customization

### Change Site Name
Edit `hosthub/includes/config.php`:
```php
define('SITE_NAME', 'Your Company Name');
```

### Change Colors
Edit `hosthub/css/style.css` (line 9-15):
```css
:root {
    --primary-color: #6366f1;    /* Main color */
    --secondary-color: #8b5cf6;  /* Secondary color */
    --accent-color: #ec4899;     /* Accent color */
}
```

### Add Your Logo
Replace `hosthub/images/logo.svg` with your logo image.

## 🔧 Troubleshooting

### Database Connection Error
- Check if MySQL is running
- Verify database credentials in `config.php`
- Make sure `hosthub_db` database exists

### Page Not Found (404)
- Check if files are in correct location
- Verify web server is running
- Check file permissions (Linux/Mac)

### Blank White Page
- Enable error reporting in PHP
- Check Apache/PHP error logs
- Verify all PHP files are uploaded

### CSS/JS Not Loading
- Clear browser cache (Ctrl+F5)
- Check file paths in header.php
- Verify CSS/JS files exist

## 📱 Testing

1. **Register a new user**
   - Go to Register page
   - Fill in the form
   - Login with new account

2. **Test admin panel**
   - Login as admin
   - Check dashboard statistics
   - Try managing users

3. **Test contact form**
   - Submit a message
   - Check admin panel for new message

4. **Mobile responsive**
   - Open on phone/tablet
   - Test navigation menu
   - Check all pages

## 🔐 Security Checklist

Before going live:
- [ ] Change admin password
- [ ] Update database credentials
- [ ] Enable HTTPS/SSL
- [ ] Set proper file permissions
- [ ] Remove test accounts
- [ ] Configure email settings
- [ ] Set up backups

## 📚 Next Steps

### Recommended Enhancements
1. Add email verification
2. Implement password reset
3. Integrate payment gateway
4. Add more hosting plans
5. Create support ticket system
6. Add email notifications

### Learn More
- Read full `README.md` for detailed documentation
- Check `sql/database.sql` for database structure
- Explore `includes/config.php` for configuration options

## 💡 Tips

- Use strong passwords
- Regular database backups
- Keep PHP and MySQL updated
- Monitor server resources
- Test before making changes

## 🆘 Need Help?

Common issues:
1. **Can't login** - Check database connection
2. **Page errors** - Enable PHP error display
3. **Styling issues** - Clear browser cache
4. **Database errors** - Re-import SQL file

## 🎯 Production Deployment

For live hosting:
1. Use a hosting provider (HostGator, Bluehost, etc.)
2. Upload files via FTP/cPanel
3. Create database via cPanel
4. Import SQL file
5. Update config.php with production credentials
6. Set up SSL certificate
7. Configure domain name

---

**Need more help?** Check the full README.md or create an issue!

**Happy Hosting! 🚀**
