<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #009688 0%, #00796b 100%);
            padding: 30px;
            text-align: center;
        }
        .email-header img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
        }
        .email-header h1 {
            color: white;
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .email-body {
            padding: 40px 30px;
        }
        .email-body h2 {
            color: #2d3748;
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .email-body p {
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .reset-button {
            display: inline-block;
            background: #009688;
            color: white;
            padding: 14px 40px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: background 0.3s ease;
        }
        .reset-button:hover {
            background: #00796b;
        }
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        .info-box {
            background: #f7fafc;
            border-left: 4px solid #009688;
            padding: 15px 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .info-box p {
            margin: 0;
            color: #2d3748;
            font-size: 14px;
        }
        .email-footer {
            background: #f7fafc;
            padding: 20px 30px;
            text-align: center;
            color: #718096;
            font-size: 13px;
        }
        .email-footer a {
            color: #009688;
            text-decoration: none;
        }
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <h1>🔐 CloseCall</h1>
        </div>

        <!-- Body -->
        <div class="email-body">
            <h2>Hello{{ !empty($name) ? ' ' . $name : '' }}!</h2>
            
            <p>We received a request to reset your password for your CloseCall account.</p>
            
            <p>Click the button below to reset your password:</p>

            <div class="button-container">
                <a href="{{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}" class="reset-button">
                    Reset Password
                </a>
            </div>

            <div class="info-box">
                <p>⏱️ This password reset link will expire in <strong>60 minutes</strong>.</p>
            </div>

            <div class="divider"></div>

            <p style="font-size: 14px; color: #718096;">
                If the button above doesn't work, copy and paste this link into your browser:
            </p>
            <p style="font-size: 13px; color: #4299e1; word-break: break-all;">
                {{ url('/reset-password/' . $token . '?email=' . urlencode($email)) }}
            </p>

            <div class="divider"></div>

            <p style="font-size: 14px; color: #718096;">
                <strong>🔒 Security Notice:</strong> If you didn't request a password reset, please ignore this email. Your account remains secure.
            </p>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <p>© {{ date('Y') }} CloseCall. All rights reserved.</p>
            <p style="margin-top: 10px;">
                Need help? <a href="mailto:support@closecall.com">Contact Support</a>
            </p>
        </div>
    </div>
</body>
</html>
