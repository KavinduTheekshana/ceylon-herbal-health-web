# Fresh Database Start - Quick Guide

## 🚀 Ready to Reset Your Database

Your migrations are now clean and organized. Use these commands to start fresh.

## ⚡ Quick Start (One Command)

```bash
php artisan db:wipe --force && php artisan migrate && php artisan db:seed --class=SeoSettingSeeder && php artisan optimize:clear
```

This command will:
1. ✅ Wipe the entire database
2. ✅ Run all 23 migrations in correct order
3. ✅ Seed 6 default SEO settings
4. ✅ Clear all caches

## 📋 Step-by-Step (If You Prefer)

### Step 1: Wipe Database
```bash
php artisan db:wipe --force
```

### Step 2: Run Migrations
```bash
php artisan migrate
```

You should see:
```
INFO  Running migrations.

0001_01_01_000000_create_users_table ............... DONE
0001_01_01_000001_create_cache_table ............... DONE
0001_01_01_000002_create_jobs_table ................ DONE
2025_04_30_185253_create_faq_categories_table ...... DONE
2025_04_30_185315_create_faqs_table ................ DONE
2025_04_30_191014_create_services_table ............ DONE
2025_07_30_100001_create_appointments_table ........ DONE
2025_07_30_100002_create_contacts_table ............ DONE
2025_07_30_100003_create_blog_categories_table ..... DONE
2025_07_30_100004_create_blog_posts_table .......... DONE
2025_07_30_100005_create_blog_tags_table ........... DONE
2025_07_30_100006_create_blog_post_tags_table ...... DONE
2025_07_30_100007_create_testimonials_table ........ DONE
2025_07_30_100008_create_pages_table ............... DONE
2025_07_30_100009_create_settings_table ............ DONE
2025_07_30_100010_create_gallery_table ............. DONE
2025_07_30_100011_create_team_members_table ........ DONE
2025_07_30_100012_create_newsletter_subscribers_... DONE
2025_10_19_010211_create_therapists_table .......... DONE
2025_10_19_010242_create_service_therapist_table ... DONE
2025_10_19_013000_create_therapist_availability_... DONE
2025_10_19_013946_create_therapist_holidays_table .. DONE
2025_10_19_024947_create_seo_settings_table ........ DONE
```

### Step 3: Seed SEO Settings
```bash
php artisan db:seed --class=SeoSettingSeeder
```

### Step 4: Clear Caches
```bash
php artisan optimize:clear
```

## ✅ Verification

### Check Migration Status
```bash
php artisan migrate:status
```

All migrations should show as "Ran".

### Count Tables
```bash
php artisan tinker
>>> \DB::select('SHOW TABLES');
```

You should have 24 tables total.

### Check SEO Settings
```bash
php artisan tinker
>>> App\Models\SeoSetting::count()
```

Should return: `6`

### View SEO Settings
```bash
php artisan tinker
>>> App\Models\SeoSetting::select('key', 'page_name', 'title')->get()
```

Should show:
- default
- home
- services
- about
- contact
- appointment

## 🎯 What You'll Have

After running these commands, your database will have:

### Core Tables (11 tables)
- users
- password_reset_tokens
- sessions
- cache
- cache_locks
- jobs
- job_batches
- failed_jobs
- settings
- seo_settings
- migrations (Laravel internal)

### Content Tables (13 tables)
- services
- pages
- blog_categories
- blog_posts
- blog_tags
- blog_post_tags
- faq_categories
- faqs
- testimonials
- gallery
- team_members
- contacts
- newsletter_subscribers

### Therapist & Appointment System (4 tables)
- therapists
- service_therapist
- therapist_availability
- therapist_holidays
- appointments

**Total: 24 tables + migrations table = 25 tables**

## 🔑 Important Notes

### Database Configuration
Make sure your `.env` file has correct database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### Before You Start
- ⚠️ **Backup any important data** you want to keep
- ⚠️ **This will delete everything** in your database
- ⚠️ **Make sure you're in the right environment** (not production!)

### After Setup
1. Create your first admin user (Filament)
2. Configure SEO settings in admin panel
3. Add some test data
4. Test the appointment booking system

## 🚨 If Something Goes Wrong

### Migration Fails
```bash
# Check error message and fix the migration file
# Then try again:
php artisan db:wipe --force
php artisan migrate
```

### Foreign Key Error
```bash
# Make sure migrations run in order
php artisan migrate:fresh
```

### Seeder Fails
```bash
# Run manually:
php artisan tinker
>>> (new \Database\Seeders\SeoSettingSeeder)->run()
```

## 📱 Access Admin Panel

After setup, access Filament admin:

1. Create admin user (if needed):
```bash
php artisan make:filament-user
```

2. Visit: `http://your-domain.com/admin`

3. Go to **Settings** → **SEO Settings** to manage SEO

## ✨ Next Steps

1. ✅ Run the fresh start command
2. ✅ Create admin user
3. ✅ Login to admin panel
4. ✅ Configure SEO settings
5. ✅ Add your services
6. ✅ Add therapists
7. ✅ Set therapist availability
8. ✅ Test appointment booking

---

**You're ready to go!** 🎉

Just run: `php artisan db:wipe --force && php artisan migrate && php artisan db:seed --class=SeoSettingSeeder && php artisan optimize:clear`
