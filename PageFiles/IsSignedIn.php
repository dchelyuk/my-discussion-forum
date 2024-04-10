<?php

header('Content-Type: application/json');
$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';

session_start();

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT username FROM Users WHERE username = :usern";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['usern' => $_SESSION['username']]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        // Assuming the username is stored in session
        echo json_encode(['signedIn' => true, 'username' => $_SESSION['username']]);
    } else {
        echo json_encode(['signedIn' => false]);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}