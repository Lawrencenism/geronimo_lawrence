<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students List - Pixel Theme</title>
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
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            border: 2px solid #00ffcc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #222;
            color: #ffcc00;
        }
        td {
            background: #111;
        }
        .form-container {
            margin: 20px auto;
            display: none; /* hidden by default */
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
        .toggle-btn {
            display: inline-block;
            background: #00ffcc;
            color: #000;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            margin: 15px;
        }
        .toggle-btn:hover {
            background: #ffcc00;
        }
        a {
            color: #ffcc00;
            text-decoration: none;
        }
        a:hover {
            color: #ff0066;
        }
    </style>
</head>
<body>
    <h1>👾 Students List</h1>

    <!-- Search Form -->
    <form action="/students/index" method="GET" style="margin: 20px 0;">
        <input type="text" name="search" placeholder="Search by name or email" value="<?= htmlspecialchars($search ?? '') ?>" style="width: 70%; padding: 8px; font-family: inherit; border: 2px solid #ffcc00; background: #111; color: #00ffcc;">
        <button type="submit" style="padding: 8px 15px; font-family: inherit; background: #ff0066; color: #fff; border: none; cursor: pointer;">🔍 Search</button>
    </form>

    <!-- Toggle button -->
    <button class="toggle-btn" onclick="toggleForm()">➕ Add Student ▼</button>

    <!-- Add Student Form -->
    <div class="form-container" id="addForm">
        <form action="/students/create" method="POST">
            <input type="text" name="lastname" placeholder="Last Name" required><br>
            <input type="text" name="firstname" placeholder="First Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <button type="submit">Save Student</button>
        </form>
    </div>

    <!-- Students Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Lastname</th>
                <th>Firstname</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($students)): ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['lastname']) ?></td>
                        <td><?= htmlspecialchars($student['firstname']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td>
                            <a href="/students/edit/<?= $student['id'] ?>">✏ Edit</a> | 
                            <a href="/students/delete/<?= $student['id'] ?>" onclick="return confirm('Are you sure you want to delete this student?');">🗑 Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No students found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <?php if (!empty($pagination)): ?>
        <div style="margin: 20px 0;">
            <?= $pagination ?>
        </div>
    <?php endif; ?>

    <script>
        function toggleForm() {
            const form = document.getElementById("addForm");
            const btn = document.querySelector(".toggle-btn");
            if (form.style.display === "none" || form.style.display === "") {
                form.style.display = "block";
                btn.innerHTML = "➖ Hide Form ▲";
            } else {
                form.style.display = "none";
                btn.innerHTML = "➕ Add Student ▼";
            }
        }
    </script>
</body>
</html>
