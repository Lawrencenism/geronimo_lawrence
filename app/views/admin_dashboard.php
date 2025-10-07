<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Users List</title>
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
        a {
            color: #ffcc00;
            text-decoration: none;
        }
        a:hover {
            color: #ff0066;
        }
        /* Pagination styling */
        .pagination {
            margin: 20px;
        }
        .pagination a {
            color: #00ffcc;
            border: 2px solid #ffcc00;
            padding: 8px 12px;
            margin: 0 5px;
            background: #111;
            text-decoration: none;
        }
        .pagination a.active {
            background: #ff0066;
            color: #fff;
        }
        .pagination a:hover {
            background: #ffcc00;
            color: #000;
        }
    </style>
</head>
<body>
    <h1>👑 Admin Dashboard - Users List</h1>

    <p style="color: #00ffcc;">Welcome, <?= htmlspecialchars($user_email ?? 'Admin') ?> | <a href="/auth/logout">Logout</a> | <a href="/students/index">Students</a></p>

    <!-- Search Form -->
    <form action="/admin/index" method="GET" style="margin: 20px 0;">
        <input type="text" name="search" placeholder="Search by email" value="<?= htmlspecialchars($search ?? '') ?>">
        <button type="submit">🔍 Search</button>
        <?php if (!empty($search)): ?>
            <a href="/admin/index" style="margin-left: 10px;">Clear Search</a>
        <?php endif; ?>
    </form>

    <!-- Search Results Info -->
    <?php if (!empty($search)): ?>
        <p style="color: #ffcc00;">Search results for: "<?= htmlspecialchars($search) ?>"</p>
    <?php endif; ?>

    <!-- Pagination Info -->
    <?php if ($totalRecords > 0): ?>
        <p style="color: #00ffcc;">
            Showing <?= count($users) ?> of <?= $totalRecords ?> users
            (Page <?= $currentPage ?> of <?= $totalPages ?>)
        </p>
    <?php endif; ?>

    <!-- Users Table -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Password</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>***</td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <a href="/admin/edit/<?= $user['id'] ?>">✏ Edit</a> |
                            <a href="/admin/delete/<?= $user['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?');">🗑 Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No users found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <?php if (!empty($pagination)): ?>
        <?= $pagination ?>
    <?php endif; ?>
</body>
</html>
