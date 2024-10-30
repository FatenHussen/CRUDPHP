<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create a connection
$conn = new mysqli($servername, $username, $password);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the database already exists, or use "IF NOT EXISTS"
$sql = "CREATE DATABASE IF NOT EXISTS CRUDPHP_VICA";
if ($conn->query($sql) === TRUE) {
    echo "Database created or already exists.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->select_db("CRUDPHP_VICA");

// Create the "user" table
$sql_users = "CREATE TABLE IF NOT EXISTS user (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    role VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql_users) === TRUE) {
    echo "Table 'user' created successfully.<br>";
} else {
    echo "Error creating 'user' table: " . $conn->error . "<br>";
}

// Create the "task" table
$sql_tasks = "CREATE TABLE IF NOT EXISTS task (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    user_id INT(6) UNSIGNED,
    FOREIGN KEY (user_id) REFERENCES user(id)
)";
if ($conn->query($sql_tasks) === TRUE) {
    echo "Table 'task' created successfully.<br>";
} else {
    echo "Error creating 'task' table: " . $conn->error . "<br>";
}

// $conn->close();
