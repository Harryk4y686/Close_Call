# Mailtrap Configuration for Password Reset

This guide will help you configure Mailtrap for the forgot password feature in CloseCall.

## What is Mailtrap?

Mailtrap is an email testing tool that captures emails sent from your application without delivering them to real recipients. Perfect for development and testing!

## Step 1: Get Your Mailtrap Credentials

1. Go to [Mailtrap.io](https://mailtrap.io/) and sign in (or create a free account)
2. Navigate to **Email Testing** → **Inboxes**
3. Select your inbox (or create a new one)
4. Click on **SMTP Settings** or **Show Credentials**
5. Copy your credentials:
   - **Host**: smtp.mailtrap.io
   - **Port**: 2525 (or 465, 587)
   - **Username**: Your Mailtrap username
   - **Password**: Your Mailtrap password

## Step 2: Configure Your .env File

Open your `.env` file in the CloseCall project and update the following variables:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@closecall.com"
MAIL_FROM_NAME="CloseCall"
```

**Important**: Replace `your_mailtrap_username` and `your_mailtrap_password` with your actual Mailtrap credentials from Step 1.

## Step 3: Clear Configuration Cache

After updating your `.env` file, run this command to clear Laravel's configuration cache:

```bash
php artisan config:clear
```

## Step 4: Test the Password Reset

1. Open your browser and go to `http://localhost/login` (or your local URL)
2. Click on **"Forgot your password?"**
3. Enter a Gmail address that exists in your database
4. Click **"Send Reset Link"**
5. Check your Mailtrap inbox - you should see the password reset email!
6. Click the reset link in the email
7. Enter a new password and submit
8. Try logging in with the new password

## Troubleshooting

### Email not appearing in Mailtrap?

- ✅ Verify your Mailtrap credentials are correct in `.env`
- ✅ Run `php artisan config:clear` to refresh configuration
- ✅ Check Laravel logs: `storage/logs/laravel.log`
- ✅ Make sure your Mailtrap inbox is not full

### "Connection refused" error?

- ✅ Check if port 2525 is correct (try 587 or 465 if blocked)
- ✅ Verify `MAIL_ENCRYPTION=tls` is set correctly
- ✅ Ensure your firewall isn't blocking SMTP connections

### "Only Gmail addresses" error showing?

- ✅ This is expected! The system only accepts `@gmail.com` emails
- ✅ Make sure the email in your database ends with `@gmail.com`

## Sample .env Configuration

Here's a complete example:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=1a2b3c4d5e6f7g
MAIL_PASSWORD=9h8i7j6k5l4m3n
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@closecall.com"
MAIL_FROM_NAME="CloseCall"
```

## What Happens Next?

Once configured:

1. **Development**: Emails go to Mailtrap (safe testing)
2. **Production**: Update `.env` with real SMTP settings (Gmail, SendGrid, Mailgun, etc.)

## Security Features Implemented

✅ **Gmail-only restriction**: Only `@gmail.com` addresses can reset passwords  
✅ **Token expiration**: Reset links expire after 60 minutes  
✅ **Secure tokens**: Tokens are hashed in the database  
✅ **One-time use**: Tokens are deleted after successful password reset  
✅ **Email validation**: Checks if user exists before sending email

---

**Need Help?** Contact your development team or check Laravel's [Mail documentation](https://laravel.com/docs/mail).
