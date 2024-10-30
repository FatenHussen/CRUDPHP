<?php
include 'connect.php'; // Include database connection

// Fetch Users
$users = $conn->query("SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">User Management</h1>
        
        <!-- Add User and Task Buttons -->
        <div class="mb-4">
            <a href="Users/AddUser.php" class="btn btn-primary">Add User</a>
            <a href="Tasks/ManageTasks.php" class="btn btn-secondary">Tasks</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $users->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <!-- Edit and Delete Buttons -->
                            <a href="Users/UpdateUser.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="Users/DeleteUser.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>
                    