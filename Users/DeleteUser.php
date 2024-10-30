<?php
include '../connect.php'; // Adjust path to locate connect.php

// Check if user ID is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // First, delete all tasks associated with this user
    $conn->query("DELETE FROM task WHERE user_id = $id");
    
    // Then, delete the user from the database
    $sql = "DELETE FROM user WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../index.php"); // Redirect back to main page after deletion
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}

$conn->close();