<?php

header('Content-Type: application/json');
$host = 'localhost:3306';
$dbname = 'db_75934729';
$username = '75934729';
$password = '75934729';

session_start();
try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT Users.username FROM Users JOIN Admins ON Admins.userId = Users.userId WHERE Users.username = :usern";
$stmt = $conn->prepare($sql);
$stmt->execute(['usern' => $_SESSION['username']]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($result != null) {
    echo json_encode("True");
}else{ echo json_encode("False");}
}catch(PDOException $e) {echo json_encode(['success' => false, 'message' => $e->getMessage()]);}