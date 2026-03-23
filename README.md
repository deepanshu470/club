# Achar Club

Single-page MVC PHP storefront for a premium achar (pickle) boutique. Ships with a responsive Tailwind + Bootstrap Icons UI, product catalog, cart, checkout stub, and a lightweight admin panel for managing the catalog.

## Features
- Front controller `index.php` with simple MVC routing
- Product catalog, detail pages, cart, and checkout confirmation
- Session-backed cart with quantity updates and removal
- File-backed product repository (`data/products.json`) seeded with sample SKUs
- Admin panel (login: `admin@achar.club` / `letmein123`) for adding, updating, and deleting products
- Responsive premium UI using TailwindCSS CDN + Bootstrap Icons

## Running locally
1. Ensure PHP 8+ is installed.
2. From the repo root, start the built-in server:
   ```bash
   php -S localhost:8000
   ```
3. Open `http://localhost:8000` in your browser.

## Notes
- All routes are fronted through `index.php` with `?route=` query parameters.
- Product data persists in `data/products.json`; keep it writable for admin edits.
