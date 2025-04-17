<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
  
    <h2>Hello {{ $user->firstName }} {{ $user->lastName }},</h2>
    <p>Thank you for registering with us. To complete your registration, please use the OTP below to verify your email
        address:</p>
    <h3>OTP: {{ $otp }}</h3>
    <p>The OTP is valid for 1 minutes. If you did not request this, please ignore this email.</p>
    <p>Best Regards,<br>Kaam Sansar</p>
</body>

</html>
