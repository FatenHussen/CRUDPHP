<?php
include '../connect.php'; // Adjust path for database connection

// Fetch Users for Assigning Tasks
$users = $conn->query("SELECT * FROM user");

// Fetch Tasks
$tasks = $conn->query("SELECT task.*, user.name AS user_name FROM task LEFT JOIN user ON task.user_id = user.id");

// Handle Add Task Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_task'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $user_id = $_POST['user_id'];

    $conn->query("INSERT INTO task (title, description, user_id) VALUES ('$title', '$description', $user_id)");
    header("Location: ManageTasks.php"); // Refresh the page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Task Management</h1>

        <!-- Add Task Form -->
        <div class="mb-4">
            <form method="post" class="d-flex align-items-end">
                <input type="hidden" name="add_task">
                <div class="me-2">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="me-2">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="me-2">
                    <label for="user_id" class="form-label">Assign to User</label>
                    <select class="form-select" id="user_id" name="user_id" required>
                        <option value="">Select User</option>
                        <?php while ($user = $users->fetch_assoc()): ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>

        <!-- Display Tasks -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned User</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($task = $tasks->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $task['title']; ?></td>
                        <td><?php echo $task['description']; ?></td>
                        <td><?php echo $task['user_name']; ?></td>
                        <td>
                            <a href="UpdateTask.php?id=<?php echo $task['id']; ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="DeleteTask.php?id=<?php echo $task['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
