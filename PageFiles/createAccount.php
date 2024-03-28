<?php
// creates account by inserting data into Users database

header('Content-Type: application/json');
$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';
// TODO: put conn in trycatch
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = $_POST['username'];
$pass = $_POST['password'];
$picture_url = $_POST['https://static.thenounproject.com/png/1095867-200.png'];
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

$sql = "INSERT INTO Users (username, accountCreateDate, password, picture_url)
    VALUES (:username, cast(now() as datetime ), :password, :pictur_url)";
$stmt = $conn->prepare($sql);
session_start();
try {
    $stmt->execute([':username' => $user, ':password' => $hashedPassword, ':picture_url' => $picture_url]);
    $_SESSION['username'] = $user;

    echo json_encode(['success' => true, 'redirect' => 'MainPage.html']);
    exit;
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
