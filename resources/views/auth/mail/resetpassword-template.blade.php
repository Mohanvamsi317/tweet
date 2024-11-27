<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .email-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .email-content {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }
        .reset-link {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h2>Password Reset Request</h2>
        </div>

        <div class="email-content">
            <p>Hi {{ $usermail }},</p>
            <p>We received a request to reset your password. Click the button below to reset it:</p>
            <a href="{{ url('reset-password/' . $resettoken . '?email=' . $usermail) }}" class="reset-link">Reset Your Password</a>


        </div>

        <div class="footer">
            <p>If you didn't request a password reset, please ignore this email.</p>
        </div>
    </div>

</body>
</html>
