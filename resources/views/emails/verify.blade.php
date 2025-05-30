<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            line-height: 1.6; 
            color: #2D3748; 
            background-color: #F7FAFC; 
            margin: 0;
            padding: 0;
        }
        .container { 
            max-width: 600px; 
            margin: 40px auto; 
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo-text {
            font-size: 24px;
            font-weight: bold;
            color: #10B981;
        }
        h2 { 
            color: #1A202C; 
            margin-bottom: 25px;
            font-size: 24px;
        }
        .button { 
            display: inline-block; 
            padding: 14px 32px; 
            background: #10B981; 
            color: white; 
            text-decoration: none; 
            border-radius: 6px;
            font-weight: 600;
            text-align: center;
            transition: background 0.3s ease;
        }
        .button:hover {
            background: #059669;
        }
        .notice {
            font-size: 0.9em;
            color: #718096;
            padding: 15px 0;
            border-top: 1px solid #E2E8F0;
            margin-top: 30px;
        }
        .footer { 
            margin-top: 40px; 
            padding-top: 20px;
            border-top: 1px solid #E2E8F0;
            font-size: 0.9em; 
            color: #718096; 
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <div class="logo-text">AutoWhatsApp</div>
        </div>
        <h2>Hello {{ $name }}!</h2>
        <p>Thank you for registering with AutoWhatsApp. To ensure the security of your account and access all our features, please verify your email address by clicking the button below:</p>
        <p style="margin: 35px 0; text-align: center;">
            <a href="{{ $url }}" class="button">Verify Email Address</a>
        </p>
        <p>This link will expire in 24 hours. If you did not create an account, please disregard this email.</p>
        <div class="notice">
            <p>If you're having trouble clicking the button, copy and paste this URL into your browser:</p>
            <p style="font-size: 0.85em; color: #4A5568;">{{ $url }}</p>
        </div>
        <div class="footer">
            <p>Best regards,<br>The AutoWhatsApp Team</p>
            <p style="font-size: 0.85em; margin-top: 15px;">© {{ date('Y') }} AutoWhatsApp.web.id. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
