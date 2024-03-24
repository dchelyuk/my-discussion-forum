<?php
// Database credentials
//$servername = "localhost";
$servername = "localhost:3308";
//$username = "75934729";
$username = "root";
//$password = "75934729";
$password = "304rootpw";
//$database = "db_75934729";
$database = "cosc360test";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Close connection
$conn->close();
?>