<?php
$host = '';
$dbname = '';
$username = '';
$password = '';
$dsn = "";


$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$user = $_POST['username'];
$pass = $_POST['password'];


$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);


$sql = ""; // TODO: sql statement to create user
$stmt = $conn->prepare($sql);
$params = ['username' => $user, 'password' => $hashedPassword];


try {
    $stmt->execute($params);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>