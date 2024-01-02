<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        /* Add your inline styles here */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #bdbcbc;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border: 0;
            cellspacing: 0;
            cellpadding: 0;
        }

        h2 {
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 15px;
        }

        a {
            color: #2170c4;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            color: rgb(255, 60, 60);
        }

        .email-container {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            padding: 20px;
            text-align: center;
            background-color: #fa2525; /* Red background color */
            color: #fff; /* White text color */
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .content {
            padding: 20px;
        }

        .footer {
            padding: 20px;
            text-align: center;
            background-color: #fa2525; /* Red background color */
            color: #fff; /* White text color */
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .copyright {
            color: #ffffff;
        }
        /* Add more styles as needed */
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h2>Password Reset</h2>
        </div>
        <div class="content">
            <p>Hello {{$username}},</p>
            <p>We received a request to reset your password. Click the link below to reset your password:</p>
            <p><a href="http://127.0.0.1:8000/api/user/reset/{{$token}}">Reset Password</a></p> <h2>Or,</h2>
            <p><a href="http://127.0.0.1:8000/api/user/reset/{{$token}}">http://127.0.0.1:8000/api/user/reset/{{$token}}</a></p>

            <p>If you didn't request a password reset, you can safely ignore this email.</p>
            <p>Thank you,</p>
            <p>Nothing</p>
        </div>
        <div class="footer">
            <p class="copyright">&copy; {{ date('Y') }} Nothing. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
