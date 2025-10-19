# Database Migration Cleanup Guide

## ✅ What Was Done

I've created a single, organized migration file that replaces all your scattered migrations:
- **File**: `database/migrations/2025_01_01_000000_create_all_tables.php`
- **Contains**: All 20+ tables organized into 7 logical sections

## 📊 Migration Structure

The new migration is organized into these sections:

### Section 1: Core Tables
- users
- password_reset_tokens
- sessions
- cache & cache_locks
- jobs, job_batches, failed_jobs

### Section 2: Content Management
- services
- pages

### Section 3: Blog System
- blog_categories
- blog_posts
- blog_tags
- blog_post_tags (pivot)

### Section 4: Therapist & Availability
- therapists
- service_therapist (pivot)
- therapist_availability
- therapist_holidays

### Section 5: Appointments & Contacts
- appointments
- contacts
- newsletter_subscribers

### Section 6: Additional Content
- faq_categories
- faqs
- testimonials
- gallery
- team_members

### Section 7: Settings & SEO
- settings
- seo_settings

## 🚀 How to Clean Up and Reset

### Option 1: Fresh Start (Recommended)

```bash
# Step 1: Wipe the database completely
php artisan db:wipe --force

# Step 2: Delete all old migration files (EXCEPT the new one)
# Keep only: 2025_01_01_000000_create_all_tables.php
rm database/migrations/0001_01_01_000000_create_users_table.php
rm database/migrations/0001_01_01_000001_create_cache_table.php
rm database/migrations/0001_01_01_000002_create_jobs_table.php
rm database/migrations/2025_04_30_*.php
rm database/migrations/2025_07_30_*.php
rm database/migrations/2025_10_19_*.php

# Or use this one-liner to delete all old migrations:
find database/migrations -type f ! -name '2025_01_01_000000_create_all_tables.php' -delete

# Step 3: Run the new migration
php artisan migrate

# Step 4: Seed the SEO settings
php artisan db:seed --class=SeoSettingSeeder

# Step 5: Clear all caches
php artisan optimize:clear
```

### Option 2: Manual Cleanup

```bash
# Step 1: Wipe the database
php artisan db:wipe --force

# Step 2: Manually delete old migrations
# Open database/migrations folder and delete all files except:
# - 2025_01_01_000000_create_all_tables.php

# Step 3: Run migrations
php artisan migrate:fresh --seed
```

### Option 3: Using GUI

If you prefer using a database GUI (like TablePlus, Sequel Pro, phpMyAdmin):

1. **Drop all tables** from your database
2. **Delete migration files** manually from `database/migrations/` folder
3. **Keep only** `2025_01_01_000000_create_all_tables.php`
4. Run `php artisan migrate`
5. Run `php artisan db:seed --class=SeoSettingSeeder`

## ⚠️ Important Notes

### Before You Start
1. **Backup your database** if you have any important data
2. **Save any custom data** you want to keep
3. **Note down any settings** you've configured

### Old Migration Files to Delete

Delete these files (they're all included in the new consolidated migration):

```
0001_01_01_000000_create_users_table.php
0001_01_01_000001_create_cache_table.php
0001_01_01_000002_create_jobs_table.php
2025_04_30_185253_create_faq_categories_table.php
2025_04_30_185315_create_faqs_table.php
2025_04_30_191014_create_services_table.php
2025_07_30_100001_create_appointments_table.php
2025_07_30_100002_create_contacts_table.php
2025_07_30_100003_create_blog_categories_table.php
2025_07_30_100004_create_blog_posts_table.php
2025_07_30_100005_create_blog_tags_table.php
2025_07_30_100006_create_blog_post_tags_table.php
2025_07_30_100007_create_testimonials_table.php
2025_07_30_100008_create_pages_table.php
2025_07_30_100009_create_settings_table.php
2025_07_30_100010_create_gallery_table.php
2025_07_30_100011_create_team_members_table.php
2025_07_30_100012_create_newsletter_subscribers_table.php
2025_10_19_010211_create_therapists_table.php
2025_10_19_010242_create_service_therapist_table.php
2025_10_19_013000_create_therapist_availability_table.php
2025_10_19_013502_update_therapist_availability_to_weekly_schedule.php
2025_10_19_013946_create_therapist_holidays_table.php
2025_10_19_021046_add_therapist_id_to_appointments_table.php
2025_10_19_024947_create_seo_settings_table.php
```

### Files to Keep

Keep only this ONE file:
```
2025_01_01_000000_create_all_tables.php
```

## 🎯 Quick Command Reference

### Complete Reset (One Command)
```bash
# Wipe DB, remove old migrations, run new migration, and seed
php artisan db:wipe --force && \
find database/migrations -type f ! -name '2025_01_01_000000_create_all_tables.php' -delete && \
php artisan migrate && \
php artisan db:seed --class=SeoSettingSeeder && \
php artisan optimize:clear
```

### Check Migration Status
```bash
# See which migrations have run
php artisan migrate:status

# See all migration files
ls -la database/migrations/
```

### If Something Goes Wrong

```bash
# Rollback everything
php artisan migrate:rollback --step=100

# Or reset completely
php artisan migrate:reset

# Then run fresh
php artisan migrate:fresh --seed
```

## ✨ Benefits of Consolidated Migration

1. **Cleaner**: One file instead of 25+ files
2. **Organized**: Logical sections with comments
3. **Faster**: Single migration runs faster
4. **Maintainable**: Easier to understand and modify
5. **No Conflicts**: All foreign keys are in correct order

## 📝 After Migration

Once you've run the new migration, you should have:
- ✅ All 24 tables created
- ✅ All foreign key relationships
- ✅ All indexes and constraints
- ✅ Default SEO settings (after running seeder)

## 🔍 Verify Everything Works

```bash
# Check tables were created
php artisan tinker
>>> Schema::hasTable('appointments')
>>> Schema::hasTable('seo_settings')
>>> Schema::hasTable('therapists')

# Check SEO settings were seeded
>>> App\Models\SeoSetting::count()
# Should return 6

# Test SEO helper
>>> App\Helpers\SeoHelper::get('home')
```

## 🆘 Troubleshooting

### "Migration file not found"
Make sure the new migration file exists and has correct permissions:
```bash
ls -la database/migrations/2025_01_01_000000_create_all_tables.php
chmod 644 database/migrations/2025_01_01_000000_create_all_tables.php
```

### "Foreign key constraint fails"
The consolidated migration handles all foreign keys in the correct order. If you still get errors:
```bash
# Wipe and start fresh
php artisan db:wipe --force
php artisan migrate
```

### "Class not found"
Clear your autoload cache:
```bash
composer dump-autoload
php artisan clear-compiled
php artisan optimize:clear
```

---

**Ready to proceed?** Run the cleanup command and enjoy your organized migrations! 🎉
