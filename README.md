# Club Commerce

Premium PHP MVC storefront with Tailwind + Bootstrap styling, responsive layouts, cart/checkout flows, and a secure admin panel.

## Features
- MVC front controller with `index.php`
- Product catalog, detail pages, cart, and checkout flow with order confirmation
- Session-backed cart and in-memory product data (seeded from `app/Data/products.php`)
- Admin login (`admin` / `demo123`) to add or edit products and toggle featured status
- Tailwind + Bootstrap UI with icons, gradients, and responsive layouts

## Getting started
1. Ensure PHP 8+ is installed.
2. Serve the project root (so `index.php` is the entry). Example:
   ```bash
   php -S localhost:8000
   ```
3. Open `http://localhost:8000/index.php` to view the storefront.
4. Access the admin panel at `http://localhost:8000/index.php?route=admin/login` using the demo credentials.

## Notes
- Product and cart state are kept in the session for demo purposes; restart the server to reset.
- Assets are loaded via CDN plus `assets/css/custom.css` and `assets/js/app.js`.
