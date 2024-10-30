<?php
include '../connect.php'; // Adjust path to locate connect.php

// Check if task ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete task from the database
    $sql = "DELETE FROM task WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ManageTasks.php"); // Redirect back to tasks page after deletion
        exit();
    } else {
        echo "Error deleting task: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}

$conn->close();
