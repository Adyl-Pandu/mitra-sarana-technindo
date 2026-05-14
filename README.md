# PT Mitra Sarana Technindo - Website Penjualan Sparepart Pelayaran

Website e-commerce sparepart pelayaran dengan SEO. Laravel 11, MySQL, Tailwind CSS.

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
# Edit .env (database & WHATSAPP_NUMBER)
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

## Login Admin
- URL: http://localhost:8000/admin
- Email: admin@mitrast.com
- Password: admin123

## Fitur
- Katalog produk + pencarian + filter kategori
- Keranjang belanja (tanpa login)
- Checkout via WhatsApp
- Admin: CRUD Produk, Kategori, Pesanan, Laporan
- SEO: meta tags, URL friendly, Open Graph, responsive
