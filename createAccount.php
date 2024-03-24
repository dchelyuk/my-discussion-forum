<?php
$host = 'localhost:3308';
//$dbname = 'db_75934729';
$dbname = 'cosc360test';
//$username = '75934729';
$username = 'root';
//$password = '75934729';
$password = '304rootpw';
$dsn = "";


$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$user = $_POST['username'];
$pass = $_POST['password'];


$hashedPassword = password_hash($pass, PASSWORD_DEFAULT);


$sql = "insert into Users values (3, $user, cast(now() as datetime), null, $pass);"; // TODO: change to trigger
$stmt = $conn->prepare($sql);
$params = ['username' => $user, 'password' => $hashedPassword];


try {
    $stmt->execute($params);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>