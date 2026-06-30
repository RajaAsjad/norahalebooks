# Vercel Deployment — Nora Hale Books

## Important

This is a **Laravel CMS** with MySQL and file uploads. Vercel is serverless — you **must** use an external database.

### Required Vercel Environment Variables

Set these in Vercel Dashboard → Project → Settings → Environment Variables:

| Variable | Example |
|----------|---------|
| `APP_KEY` | From your `.env` (base64:...) |
| `APP_URL` | `https://your-project.vercel.app` |
| `DB_CONNECTION` | `mysql` |
| `DB_HOST` | External MySQL host (PlanetScale, Aiven, Railway, Hostinger remote DB) |
| `DB_PORT` | `3306` |
| `DB_DATABASE` | Database name |
| `DB_USERNAME` | Database user |
| `DB_PASSWORD` | Database password |
| `SITE_NAME` | Nora Hale Books |
| `SITE_FACEBOOK` | Your Facebook URL |

After adding env vars, redeploy.

### Deploy via CLI

```bash
vercel login
vercel link
vercel --prod
```

### Deploy via GitHub

1. Push to `main` on https://github.com/RajaAsjad/norahalebooks
2. Import project in Vercel Dashboard
3. Add environment variables above
4. Deploy

### Limitations on Vercel

- Admin file uploads may not persist (use image URLs instead)
- Run migrations on external DB separately: `php artisan migrate --force`
- For full CMS + uploads, Hostinger is recommended (see HANDOFF.md)
