<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .button { display: inline-block; padding: 12px 24px; background: #10B981; color: white; 
                  text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 30px; font-size: 0.9em; color: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hello {{ $name }}!</h2>
        <p>Please verify your email address to access all features of WhatsApp Web Auto.</p>
        <p style="margin: 25px 0;">
            <a href="{{ $url }}" class="button">Verify Email Address</a>
        </p>
        <p>If you did not create an account, no further action is required.</p>
        <div class="footer">
            <p>Thanks,<br>WhatsApp Web Auto Team</p>
        </div>
    </div>
</body>
</html>
