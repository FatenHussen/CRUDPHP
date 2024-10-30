<?php
include '../connect.php'; // Adjust path for database connection

// Check if the task ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch task data from the database
    $task_result = $conn->query("SELECT * FROM task WHERE id = $id");
    
    // Check if the task exists
    if ($task_result->num_rows > 0) {
        $task = $task_result->fetch_assoc();
    } else {
        echo "Task not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

// Fetch users for the assignment dropdown
$users = $conn->query("SELECT * FROM user");

// Handle form submission for updating task
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];
    
    $sql = "UPDATE task SET title='$title', description='$description', user_id=$user_id WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ManageTasks.php"); // Redirect back to tasks page after update
        exit();
    } else {
        echo "Error updating task: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Update Task</h1>
        
        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Task Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Assign to User</label>
                <select class="form-select" id="user_id" name="user_id" required>
                    <option value="">Select User</option>
                    <?php while ($user = $users->fetch_assoc()): ?>
                        <option value="<?php echo $user['id']; ?>" <?php if ($user['id'] == $task['user_id']) echo 'selected'; ?>>
                            <?php echo $user['name']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Task</button>
            <a href="ManageTasks.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>
