<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User - Admin</title>
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
        form {
            margin: 30px auto;
            display: inline-block;
            background: #222;
            padding: 20px;
            border: 3px solid #00ffcc;
            border-radius: 8px;
        }
        input, select {
            font-family: inherit;
            padding: 8px;
            margin: 10px;
            border: 2px solid #ffcc00;
            background: #111;
            color: #00ffcc;
            width: 250px;
            text-align: center;
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
        a.back {
            display: inline-block;
            margin-top: 20px;
            color: #00ffcc;
            text-decoration: none;
            border: 2px solid #00ffcc;
            padding: 5px 10px;
        }
        a.back:hover {
            background: #00ffcc;
            color: #000;
        }
    </style>
</head>
<body>
    <h1>✏ Edit User</h1>

    <form action="/admin/update/<?= $user['id'] ?>" method="POST">
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <br>
        <input type="password" name="password" placeholder="New Password (leave blank to keep current)">
        <br>
        <select name="role">
            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
        <br>
        <button type="submit">💾 Save Changes</button>
    </form>

    <br>
    <a href="/admin/index" class="back">⬅ Back to List</a>
</body>
</html>
