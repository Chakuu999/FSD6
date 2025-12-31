<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT id, name, email, course FROM students WHERE id = :id");
$stmt->execute(['id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$student) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name = :name, email = :email, course = :course WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute(['name' => $name, 'email' => $email, 'course' => $course, 'id' => $id])) {
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/style.css?v=<?= filemtime(__DIR__ . '/../css/style.css'); ?>">
    <title>Edit Student</title>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn-back">← Back</a>
        <h2>Edit Student</h2>
        <form method="POST">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($student['name'] ?? '') ?>" required>
            
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($student['email'] ?? '') ?>" required>
            
            <label>Course:</label>
            <input type="text" name="course" value="<?= htmlspecialchars($student['course'] ?? '') ?>" required>
            
            <button type="submit" class="btn-primary">Update Student</button>
        </form>
    </div>
</body>
</html>