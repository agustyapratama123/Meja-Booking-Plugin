<!DOCTYPE html>
<html>
<head>
    <title>Login Resto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom, #f3f4f6, #e2e8f0);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-box {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            padding: 32px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .login-box h2 {
            margin-bottom: 24px;
            text-align: center;
            color: #333;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 15px;
            background-color: #f9fafb;
        }

        .login-box label {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .login-box input[type="checkbox"] {
            margin-right: 6px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background-color: #10b981;
            border: none;
            color: white;
            font-size: 16px;
            font-weight: bold;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-box button:hover {
            background-color: #059669;
        }

        .login-box .error {
            color: #dc2626;
            background: #fee2e2;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 16px;
            text-align: center;
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 24px;
                margin: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login Admin Resto</h2>

        <?php if (!empty($error)) echo '<div class="error">' . esc_html($error) . '</div>'; ?>

        <form method="post">
            <input type="text" name="log" placeholder="Username" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <label>
                <input type="checkbox" name="rememberme"> Ingat saya
            </label>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
