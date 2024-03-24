<?php
$host = 'localhost:3308';
//$dbname = 'db_75934729';
$dbname = 'cosc360test';
//$username = '75934729';
$username = 'root';
//$password = '75934729';
$password = '304rootpw';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user = $_POST['username'];
$pass = $_POST['password'];
$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

// Assuming your Users table has an AUTO_INCREMENT ID and a `date_created` column that defaults to the current timestamp
$sql = "INSERT INTO Users (username, accountCreateDate, password) VALUES (:username, cast(now() as datetime ), :password)";
$stmt = $conn->prepare($sql);

try {
    $stmt->execute([':username' => $user, ':password' => $hashedPassword]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
