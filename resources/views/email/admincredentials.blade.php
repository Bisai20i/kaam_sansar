<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login credentials</title>
</head>
<body>
    <h2>Hello {{ $admin->fullName }},</h2>
    <p>Your admin account has been successfully created. Below are your login details:</p>
    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Password:</strong> {{ $password }}</p>
    <p>You can log in to your account using these credentials. Please make sure to change your password after logging in for the first time.</p>
    <p>Best Regards,<br>Your Company Name</p>
</body>
</html>
