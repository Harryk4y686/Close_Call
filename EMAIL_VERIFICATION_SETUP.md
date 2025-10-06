# Email Verification System Setup Guide

## Overview
This Laravel application now includes a complete custom email verification system with the following features:

- User registration with email verification
- Custom verification emails with 24-hour expiration
- Resend verification functionality
- Protected routes for verified users only
- Beautiful Tailwind CSS styled pages

## Email Configuration (Mailtrap)

Add the following configuration to your `.env` file:

```env
# Mail Configuration for Mailtrap
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="no-reply@example.com"
MAIL_FROM_NAME="${APP_NAME}"

# Application URL
APP_URL=http://localhost:8000
```

## Database Setup

The following migrations have been created and run:
- `email_verifications` table with user_id, token, and expires_at columns
- Added `verified` column to `users` table

## Routes Available

### Public Routes
- `GET /register` - Registration form (using existing UI)
- `POST /register` - Process registration
- `GET /verify-email?token={token}` - Email verification link

### Protected Routes
- `GET /email/verify` - Show verification notice page (using existing UI)
- `POST /resend-verification` - Resend verification email

### Protected Routes (Requires Verification)
- `GET /landingpage2` - Protected landing page (example)

## Usage Flow

1. **User Registration**: Visit `/user-register` to create a new account
2. **Email Sent**: Verification email is automatically sent with a 24-hour token
3. **Email Verification**: User clicks the link in their email
4. **Access Granted**: User can now access protected areas

## Files Created/Modified

### Models
- `app/Models/User.php` - Added verified column and relationship
- `app/Models/EmailVerification.php` - New model for verification tokens

### Controllers
- `app/Http/Controllers/Auth/UserRegistrationController.php` - Registration logic
- `app/Http/Controllers/Auth/EmailVerificationController.php` - Verification logic

### Mail
- `app/Mail/VerifyEmailMail.php` - Custom verification email
- `resources/views/emails/verify-email.blade.php` - Email template

### Views
- `resources/views/auth/register.blade.php` - Registration form
- `resources/views/auth/verification-notice.blade.php` - Verification notice
- `resources/views/auth/verification-success.blade.php` - Success page
- `resources/views/auth/verification-failed.blade.php` - Error page

### Middleware
- `app/Http/Middleware/EnsureEmailIsVerified.php` - Protects routes

## Testing

1. Start your Laravel server: `php artisan serve`
2. Visit `http://localhost:8000/user-register`
3. Fill out the registration form
4. Check your Mailtrap inbox for the verification email
5. Click the verification link
6. Try accessing protected routes

## Security Features

- Tokens expire after 24 hours
- Unique tokens for each verification request
- Old tokens are deleted when new ones are generated
- Users are logged out if they access protected routes without verification
- CSRF protection on all forms

## Customization

You can customize the email template, expiration time, and styling by modifying the respective files mentioned above.
