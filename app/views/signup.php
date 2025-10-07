<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Pixel Theme</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <style>
        body {
            background: #1b1b1b;
            color: #00ffcc;
            font-family: 'Press Start 2P', cursive;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #ffcc00;
            text-shadow: 2px 2px #ff0066;
        }
        .form-container {
            margin: 20px auto;
            background: #222;
            padding: 20px;
            border: 3px solid #00ffcc;
            border-radius: 8px;
            width: 400px;
        }
        input {
            font-family: inherit;
            padding: 8px;
            margin: 10px;
            border: 2px solid #ffcc00;
            background: #111;
            color: #00ffcc;
            width: 90%;
            text-align: center;
        }
        label {
            font-family: inherit;
            color: #00ffcc;
            margin: 10px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        button {
            font-family: inherit;
            background: #ff0066;
            color: #fff;
            padding: 10px 15px;
            margin-top: 15px;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }
        button:hover {
            background: #ffcc00;
            color: #000;
        }
        a {
            color: #ffcc00;
            text-decoration: none;
        }
        a:hover {
            color: #ff0066;
        }
        .error {
            color: #ff0066;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>👾 Sign Up</h1>

    <?php if (isset($errors) && !empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <form action="/auth/signup" method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <label><input type="checkbox" id="showPassword"> Show Password</label><br>
            <button type="submit">Sign Up</button>
        </form>
    </div>

    <p>Already have an account? <a href="/auth/login">Log In</a></p>

    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            var passwordFields = document.querySelectorAll('input[type="password"]');
            for (var i = 0; i < passwordFields.length; i++) {
                passwordFields[i].type = this.checked ? 'text' : 'password';
            }
        });
    </script>
</body>
</html>
