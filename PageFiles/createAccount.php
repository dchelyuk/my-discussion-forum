<?php
// creates account by inserting data into Users database

header('Content-Type: application/json');
$host = 'localhost:3306';
$dbname = 'db_75934729';
$username = '75934729';
$password = '75934729';

// TODO: put conn in trycatch
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = $_POST['username'];
$pass = $_POST['password'];
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO Users (username, accountCreateDate, password) VALUES (:username, cast(now() as datetime ), :password)";
$stmt = $conn->prepare($sql);
session_start();
try {
    $stmt->execute([':username' => $user, ':password' => $hashedPassword]);
    $_SESSION['username'] = $user;
    echo json_encode(['success' => true, 'redirect' => 'MainPage.html']);
    exit;
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
