# CloseCall Admin System Setup Guide

## Overview
The admin system allows you to manage users, events, jobs, and companies from a centralized dashboard.

## Step 1: Run Migration
First, add the `is_admin` column to the users table:

```bash
php artisan migrate
```

## Step 2: Create Your First Admin Account

### Option A: Using Artisan Command (Recommended)
```bash
php artisan admin:create
```

Follow the prompts to enter:
- Admin email address
- Admin password (minimum 8 characters)
- Admin name

### Option B: Manual Database Update
If you have an existing user account, you can make it an admin:

```bash
php artisan admin:create your-email@example.com
```

Then select "Yes" when asked to make the existing user an admin.

### Option C: Direct Database Update
Using phpMyAdmin or MySQL:
```sql
UPDATE users SET is_admin = 1, verified = 1 WHERE email = 'your-email@example.com';
```

## Step 3: Login as Admin

1. Go to: `http://localhost/login` (or your site URL)
2. Login with your admin credentials
3. You will be automatically redirected to the Admin Dashboard

## Admin Dashboard Features

### 📊 Dashboard (Home)
- View statistics: Total Users, Jobs, Events, Companies
- Quick access to all management sections
- Overview of your application data

### 👥 Users Database
- View all registered users
- See user details (name, email, role, verification status)
- Delete users (cannot delete admin users for safety)
- Pagination for large user lists

### 📅 Events Database
- View all events created by users
- See event details (title, creator, date, location, attendees)
- Delete events (with automatic banner image cleanup)
- Add new events using existing create event page
- View events on the front-end

### 💼 Jobs Database
- Placeholder for future job management
- Will allow CRUD operations on job postings
- Coming in next update

### 🏢 Companies Database
- Placeholder for future company management
- Will allow CRUD operations on company profiles
- Coming in next update

## Admin URLs

- **Dashboard**: `/admin/dashboard`
- **Users**: `/admin/users`
- **Jobs**: `/admin/jobs`
- **Events**: `/admin/events`
- **Companies**: `/admin/companies`

## Security Features

### Protected Routes
All admin routes are protected by:
1. **Authentication**: Must be logged in
2. **Admin Middleware**: Must have `is_admin = true`

### Access Control
- Regular users cannot access admin panel
- Attempting to access admin pages redirects to profile with error message
- Admin users cannot be deleted (for safety)

### Automatic Verification
- Admin accounts are automatically verified
- No email verification required for admin users

## How It Works

### Login Flow
1. User enters credentials on login page
2. System checks if user is verified
3. If user is admin (`is_admin = true`):
   - Redirect to Admin Dashboard
4. If user is regular:
   - Redirect to Jobs page

### Adding Content as Admin
1. **Events**: Use the existing "Create Event" page - events will show on both admin and user sides
2. **Jobs**: Coming soon - will have dedicated admin interface
3. **Companies**: Coming soon - will have dedicated admin interface

### Viewing Changes as Regular User
1. Logout from admin account
2. Login with regular user account
3. All events/jobs/companies you added will be visible

## Design Features

- Modern teal color scheme (#00A88F)
- Clean sidebar navigation
- Responsive tables with hover effects
- Statistics cards with icons
- Smooth transitions and animations
- Matches your application's design system

## Tips

1. **Create Admin First**: Before testing, create at least one admin account
2. **Test Both Roles**: Login as admin to manage, then as regular user to see changes
3. **Safe Deletion**: Admin users are protected from deletion
4. **Back to Profile**: Use the sidebar link to return to regular user view
5. **Event Management**: All events created (admin or user) appear in admin dashboard

## Troubleshooting

### "You do not have admin access" Error
- Your account's `is_admin` field is `false`
- Run: `php artisan admin:create your-email@example.com`

### Can't See Admin Dashboard After Login
- Clear browser cache and cookies
- Make sure migration ran successfully
- Check database: `is_admin` should be `1` (true)

### Events Not Showing
- Events require creator relationship
- Check that events have valid `user_id`

## Future Updates

The following features will be added in future updates:
- Job model and CRUD operations
- Company model and CRUD operations
- Bulk actions (delete multiple items)
- Search and filtering
- Export data (CSV/Excel)
- User role management
- Activity logs
- Email templates management

---

**Need Help?**
Check your database structure, ensure migrations ran successfully, and verify admin status in the `users` table.
