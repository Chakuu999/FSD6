<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // Explicitly calculate the next id because the table lacks an auto-increment default
    $nextId = $pdo->query("SELECT COALESCE(MAX(id), 0) + 1 FROM students")->fetchColumn();

    $sql = "INSERT INTO students (id, name, email, course) VALUES (:id, :name, :email, :course)";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['id' => $nextId, 'name' => $name, 'email' => $email, 'course' => $course])) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css?v=<?= filemtime(__DIR__ . '/../css/style.css'); ?>">
    <title>Add Student</title>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back">← Back</a>
        <h2>Add New Student</h2>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" required>
            
            <label>Email:</label>
            <input type="email" name="email" required>
            
            <label>Course:</label>
            <input type="text" name="course" required>
            
            <button type="submit" class="btn-primary">Save Student</button>
        </form>
    </div>
</body>
</html>