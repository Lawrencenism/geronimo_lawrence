<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Student - Pixel Theme</title>
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
        input {
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
    <h1>✏ Edit Student</h1>

    <form action="/LAVACRUD/students/update/<?= $student['id'] ?>" method="POST">
        <input type="text" name="lastname" placeholder="Last Name" value="<?= htmlspecialchars($student['lastname']) ?>" required>
        <br>
        <input type="text" name="firstname" placeholder="First Name" value="<?= htmlspecialchars($student['firstname']) ?>" required>
        <br>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($student['email']) ?>" required>
        <br>
        <button type="submit">💾 Save Changes</button>
    </form>

    <br>
    <a href="/LAVACRUD/students/index" class="back">⬅ Back to List</a>
</body>
</html>
