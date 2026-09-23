# Sree Kumaran Jewellers — UI-only Laravel Project

Stack: Laravel 12, Blade, Tailwind CSS, Alpine.js, Vite.
This is a **UI-only** scaffold — no backend logic, auth, or database. All routes render static Blade views with placeholder content.

## Structure
- `resources/views/layouts/` — `app.blade.php` (public site), `dashboard.blade.php` (customer area), `admin.blade.php` (admin panel)
- `resources/views/components/` — navbar, footer, product-card, section-heading, dashboard/admin sidebars & topbars, stat-card
- `resources/views/pages/` — all 11 public pages
- `resources/views/dashboard/` — 9 customer dashboard pages
- `resources/views/admin/` — 9 admin panel pages
- `routes/web.php` — all routes wired via `Route::view()`

## Setup (once dropped into a Laravel 12 app)
```bash
composer create-project laravel/laravel skj   # if starting fresh
# copy these resources/ and routes/ files into the app, then:
npm install
npm run dev   # or npm run build
php artisan serve
```

Design: white / gold (#d4af37 family) / black (ink) palette, Playfair Display for headings, Inter for body — GRT-style layout with a luxury boutique feel.
