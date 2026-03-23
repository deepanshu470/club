# ShopPremium - Full-Featured E-Commerce Website

A complete, professional e-commerce website built with PHP using MVC architecture. Features a premium UI with Tailwind CSS styling, Font Awesome icons, and responsive design for all devices.

## Features

### Customer Features
- 🏠 **Homepage** with featured products and categories
- 🛍️ **Product Catalog** with category filtering
- 🔍 **Search Functionality** for finding products
- 🛒 **Shopping Cart** with quantity management
- ❤️ **Wishlist** for saving favorite products
- 💳 **Checkout Process** with multiple payment options
- 👤 **User Authentication** (Login/Register)
- 📦 **Order History** and tracking
- ⭐ **Product Reviews** and ratings
- 📱 **Responsive Design** for mobile, tablet, and desktop

### Admin Panel Features
- 📊 **Dashboard** with statistics and recent orders
- 📦 **Product Management** (Add, Edit, Delete)
- 🏷️ **Category Management**
- 📋 **Order Management** with status updates
- 👥 **User Management**
- 📸 **Image Upload** for products
- 🎯 **Featured Products** management

### Technical Features
- 🏗️ **MVC Architecture** for clean code organization
- 🔒 **Secure Authentication** with password hashing
- 🗄️ **MySQL Database** with PDO
- 🎨 **Premium UI** with custom CSS
- 📱 **Fully Responsive** design
- 🔐 **SQL Injection Protection**
- 🚀 **Clean URL Routing** with .htaccess
- 🎯 **Font Awesome Icons** for better UX

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache web server with mod_rewrite enabled

### Setup Instructions

1. **Clone the repository**
   ```bash
   cd /var/www/html
   git clone <repository-url>
   cd club
   ```

2. **Create the database**
   ```bash
   mysql -u root -p
   ```
   Then execute:
   ```sql
   CREATE DATABASE ecommerce_db;
   ```

3. **Import the database schema**
   ```bash
   mysql -u root -p ecommerce_db < database.sql
   ```

4. **Configure database connection**
   Edit `config/Database.php` and update the following:
   ```php
   private $host = 'localhost';
   private $dbname = 'ecommerce_db';
   private $username = 'root';
   private $password = 'your_password';
   ```

5. **Set up file permissions**
   ```bash
   chmod 755 -R public/uploads
   ```

6. **Configure Apache**
   Make sure `mod_rewrite` is enabled:
   ```bash
   sudo a2enmod rewrite
   sudo systemctl restart apache2
   ```

   Update your Apache virtual host or .htaccess to allow override:
   ```apache
   <Directory /var/www/html/club>
       AllowOverride All
   </Directory>
   ```

7. **Access the website**
   - Frontend: `http://localhost/club/`
   - Admin Panel: `http://localhost/club/admin`

## Default Login Credentials

### Admin Account
- **Email:** admin@ecommerce.com
- **Password:** admin123

## Directory Structure

```
club/
├── app/
│   ├── controllers/     # Application controllers
│   ├── models/          # Database models
│   └── views/           # View templates
│       ├── admin/       # Admin panel views
│       ├── cart/        # Shopping cart views
│       ├── checkout/    # Checkout views
│       ├── home/        # Homepage views
│       ├── layouts/     # Layout templates
│       ├── products/    # Product views
│       └── user/        # User account views
├── config/              # Configuration files
│   └── Database.php     # Database connection
├── public/              # Public assets
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   ├── images/         # Static images
│   └── uploads/        # Uploaded product images
├── .htaccess           # URL rewriting rules
├── index.php           # Application entry point
└── database.sql        # Database schema
```

## Usage Guide

### For Customers

1. **Browse Products**
   - Visit the homepage to see featured products
   - Click "Products" to view all items
   - Filter by category or use the search bar

2. **Add to Cart**
   - Click "Add to Cart" on any product
   - Adjust quantities in the cart
   - Proceed to checkout when ready

3. **Create Account**
   - Click "Sign Up" in the navigation
   - Fill in your details
   - Start shopping immediately

4. **Place Order**
   - Add items to cart
   - Click "Proceed to Checkout"
   - Enter shipping details
   - Select payment method
   - Confirm your order

### For Administrators

1. **Login to Admin Panel**
   - Visit `/admin`
   - Use admin credentials to login

2. **Manage Products**
   - Click "Products" in admin sidebar
   - Add new products with images
   - Edit or delete existing products
   - Mark products as featured

3. **Manage Categories**
   - Click "Categories"
   - Add or edit product categories
   - Organize your product catalog

4. **Process Orders**
   - Click "Orders"
   - Update order status (Pending → Processing → Shipped → Delivered)
   - View customer details and shipping information

## Features in Detail

### Shopping Cart
- Add/remove products
- Update quantities
- Real-time total calculation
- Free shipping on orders over ₹999

### Checkout Process
- Secure checkout flow
- Multiple payment options (COD, UPI, Card, Net Banking)
- Address management
- Order notes support

### Product Reviews
- Star ratings (1-5)
- Written reviews
- Average rating display
- Review count

### Admin Dashboard
- Total products count
- Total orders count
- Total users count
- Revenue calculation
- Recent orders overview

## Security Features

- Password hashing with bcrypt
- PDO prepared statements to prevent SQL injection
- Session-based authentication
- Admin role verification
- XSS protection through htmlspecialchars
- CSRF protection ready

## Responsive Design

The website is fully responsive and tested on:
- 📱 Mobile devices (320px and up)
- 📱 Tablets (768px and up)
- 💻 Desktops (1024px and up)
- 🖥️ Large screens (1280px and up)

## Technologies Used

- **Backend:** PHP 7.4+
- **Database:** MySQL with PDO
- **Frontend:** HTML5, CSS3, JavaScript
- **Icons:** Font Awesome 6.4.0
- **Fonts:** Google Fonts (Inter)
- **Server:** Apache with mod_rewrite

## Customization

### Changing Colors
Edit `public/css/style.css` and modify the CSS variables:
```css
:root {
    --primary-color: #4F46E5;
    --secondary-color: #10B981;
    --dark-color: #1F2937;
}
```

### Adding New Routes
Edit `index.php` and add to the routes array:
```php
'new-route' => ['ControllerName', 'methodName']
```

### Adding New Models
Create a new file in `app/models/` following the existing pattern.

## Troubleshooting

### Images not uploading
- Check permissions on `public/uploads/` directory
- Ensure PHP upload_max_filesize is sufficient

### Clean URLs not working
- Verify mod_rewrite is enabled
- Check .htaccess file exists
- Ensure AllowOverride is set to All

### Database connection failed
- Verify MySQL credentials in config/Database.php
- Ensure MySQL service is running
- Check database exists

## Support

For issues, questions, or feature requests, please contact the development team.

## License

This project is created for educational and commercial purposes.

---

**Built with ❤️ using PHP MVC Architecture**