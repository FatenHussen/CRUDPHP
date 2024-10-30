<?php
include '../connect.php'; // Adjusted path to locate connect.php correctly

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $role = $_POST['role'];
    
    $sql = "INSERT INTO user (name, role) VALUES ('$name', '$role')";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php"); // Redirect back to main page after insertion
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add User</h1>
        
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role" required>
            </div>
            <button type="submit" class="btn btn-primary">Send</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<!-- <?php $conn->close(); ?> -->
