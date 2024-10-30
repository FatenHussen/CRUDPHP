<?php
include '../connect.php'; // Adjust path to locate connect.php

// Check if user ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch user data from the database
    $result = $conn->query("SELECT * FROM user WHERE id = $id");
    
    // Check if the user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

// Handle form submission for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $role = $_POST['role'];
    
    $sql = "UPDATE user SET name='$name', role='$role' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php"); // Redirect back to the main page after update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit User</h1>
        
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" class="form-control" id="role" name="role" value="<?php echo htmlspecialchars($user['role']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
