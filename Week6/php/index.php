<?php
include 'db.php';

$stmt = $pdo->query("SELECT ID AS id, name, email, course FROM students");
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css?v=<?= filemtime(__DIR__ . '/../css/style.css'); ?>">
    <title>Student List</title>
</head>
<body>
    <div class="container">
        <h2>Student List</h2>
        <a href="create.php" class="btn-primary">Add New Student</a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr>
                    <td data-label="ID"><?= htmlspecialchars($student['id']) ?></td>
                    <td data-label="Name"><?= htmlspecialchars($student['name']) ?></td>
                    <td data-label="Email"><?= htmlspecialchars($student['email']) ?></td>
                    <td data-label="Course"><?= htmlspecialchars($student['course']) ?></td>
                    <td data-label="Actions">
                        <a href="edit.php?id=<?= $student['id'] ?>" class="btn-edit">Edit</a>
                        <a href="delete.php?id=<?= $student['id'] ?>" class="btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>