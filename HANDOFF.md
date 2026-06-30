# Nora Hale Books — Site Handoff Document

**Client:** Nora Hale / Nora Hale Books  
**Website:** https://norahalebooks.com  
**Platform:** Laravel (custom CMS) — self-hosted on Hostinger  
**Handoff Date:** July 2026  

---

## 1. Ownership Confirmation

All of the following belong to **you (Nora Hale)**:

| Asset | Location |
|-------|----------|
| Website source code | Your Hostinger hosting account / project files |
| Database | MySQL on Hostinger (`norahalebooks` or as configured) |
| Domain | norahalebooks.com (your registrar) |
| Admin login credentials | You set these at deployment — change default password immediately |
| Kit (ConvertKit) account | Your existing Kit account — unchanged |
| Amazon / marketplace links | Managed by you in admin panel |

---

## 2. Platform Overview

This site uses **Laravel** with a built-in **Admin Panel** — similar to WordPress in that you log in and add content without coding.

| What | Details |
|------|---------|
| **Frontend** | Mobile-responsive public website |
| **Admin URL** | `https://norahalebooks.com/admin/login` |
| **Tech stack** | PHP 8.x, Laravel, MySQL, Blade templates |
| **Why Laravel vs WordPress** | Faster, more secure custom site with exactly the modules you need (books, recipes, favorites, blog) — no plugin bloat |

---

## 3. Login Locations

### Admin Panel
- **URL:** `/admin/login`
- **Default seeder account** (change immediately after deploy):
  - Email: `admin@gmail.com`
  - Password: `admin@123`

### Hostinger
- **hPanel:** https://hpanel.hostinger.com
- Manage: domain, SSL, backups, file manager, database

### Kit (ConvertKit)
- **URL:** https://app.kit.com (or your Kit login)
- Your 3 landing pages remain at:
  - `/connect` — Newsletter
  - `/bonusrecipes` — Bonus Recipes
  - `/ARCreaders` — ARC Readers

---

## 4. SSL / HTTPS

- Hostinger provides **free SSL** (Let's Encrypt) via hPanel → **Security → SSL**
- Ensure **Force HTTPS** is enabled
- Verify padlock icon on iPhone Safari and Android Chrome after deploy

---

## 5. Automatic Backups

### Hostinger (recommended)
1. hPanel → **Backups**
2. Enable **Automatic daily backups** (plan-dependent)
3. Download a manual backup before major changes

### Database backup (manual)
```bash
php artisan db:backup
```
Or export via hPanel → **Databases → phpMyAdmin → Export**

---

## 6. SEO Structure (Built In)

| Feature | How it works |
|---------|--------------|
| Page titles | Each page has `<title>` — editable per book/blog/recipe in admin |
| Meta descriptions | Set in admin for books, blog posts, recipes; site-wide default in config |
| Clean URLs | `/blog/my-post`, `/recipes/castor-oil-mask`, `/books/castor-oil-for-life` |
| Image alt text | Uses item title automatically on cards; set descriptive titles in admin |
| Open Graph tags | Included in master layout for social sharing |

---

## 7. Admin Panel — How to Add Content

Log in at `/admin/login` → sidebar **Content**:

### Add a Blog Post
1. **Content → Blog Posts → Add New**
2. Fill title, excerpt, body (HTML allowed)
3. Upload image or paste image URL
4. Set SEO meta title/description
5. Check **Published** → Save

### Add a Recipe
1. **Content → Recipes → Add New**
2. Title, ingredients (one per line), instructions
3. Prep/cook time, servings, image
4. Check **Published** → Save

### Add a Favorite Product
1. **Content → Favorites → Add New**
2. Title, description, category
3. **Amazon Buy URL** — paste full Amazon link (test on mobile!)
4. Optional second marketplace URL + button label
5. Check **Published** → Save

### Add a Book
1. **Content → Books → Add New**
2. Title, subtitle, description
3. Cover image (upload or URL)
4. Amazon buy link + optional second store
5. Check **Featured** for homepage display

### View Contact Messages
- **All Contact Us** in sidebar

---

## 8. Kit Landing Pages

Three URLs are preserved and must keep working:

| URL | Purpose |
|-----|---------|
| `/connect` | Newsletter signup |
| `/bonusrecipes` | Bonus recipes collection |
| `/ARCreaders` | ARC readers application |

### Configure Kit embed (in `.env` on server):
```env
KIT_CONNECT_EMBED=https://your-kit-form-embed-url
KIT_BONUSRECIPES_EMBED=https://your-kit-form-embed-url
KIT_ARC_EMBED=https://your-kit-form-embed-url
```

If embed URL is empty, the page redirects to your existing Kit URL automatically.

**Facebook link** appears on all Kit landing pages via `SITE_FACEBOOK` in `.env`.

---

## 9. Site Branding (`.env` variables)

```env
SITE_NAME="Nora Hale Books"
SITE_TAGLINE="Author of Castor Oil for Life"
SITE_DESCRIPTION="Wellness author Nora Hale..."
SITE_FACEBOOK=https://www.facebook.com/norahalebooks
SITE_EMAIL=hello@norahalebooks.com

SITE_COLOR_PRIMARY="#2D6A4F"
SITE_COLOR_SECONDARY="#B8860B"
SITE_COLOR_ACCENT="#40916C"
SITE_COLOR_BG="#FAF8F4"
```

After changing `.env`, run: `php artisan config:clear`

---

## 10. Deployment Checklist (Hostinger)

1. Upload project files to `public_html` (or configure document root to `/public`)
2. Create MySQL database in hPanel
3. Copy `.env.example` → `.env`, fill DB credentials + site vars
4. Run:
   ```bash
   composer install --no-dev
   php artisan key:generate
   php artisan migrate --force
   php artisan db:seed --force
   php artisan storage:link
   php artisan config:cache
   ```
5. Enable SSL in hPanel
6. Change admin password
7. Add your Kit embed URLs
8. Upload book cover images via admin
9. Test Buy links on iPhone Safari + Android Chrome

---

## 11. Buy Links — Mobile Testing

All Buy buttons use:
- `target="_blank"` — opens in new tab (works on iOS/Android)
- `rel="noopener sponsored"` — Amazon affiliate best practice
- Minimum 44px tap height for mobile accessibility

**Always test** after adding a new product or book link on your phone.

---

## 12. Files & Plugins Summary

| Component | Purpose |
|-----------|---------|
| Laravel Framework | Core application |
| Spatie Permission | Admin roles (optional) |
| Custom CMS modules | Books, Blog, Recipes, Favorites |
| `site.css` / `site.js` | Frontend theme, loader, canvas animations |
| `config/site.php` | Brand, nav, Kit pages, theme colors |

No WordPress plugins required — this is a standalone Laravel application.

---

## 13. Support Notes

- **Adding many blog posts/recipes/products:** Use admin panel — no code needed
- **Cover images:** Upload in admin OR paste external URL (e.g. Amazon CDN)
- **Google Docs content:** Copy/paste into blog body or recipe fields in admin
- **Backups:** Enable Hostinger daily backups + export database monthly

---

**All files, logins, domain, and content belong to Nora Hale.**

For technical changes beyond admin panel content, contact your developer.
