<?php

header('Content-Type: application/json');
global $host, $dbname, $username, $password;
include 'dbCredentials.php';

session_start();

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT username FROM Users WHERE username = :usern";
    $stmt = $conn->prepare($sql);
    if($_SESSION['username']) {
        $stmt->execute(['usern' => $_SESSION['username']]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else {
        $result = null;
    }
    if ($result != null) {
        // Assuming the username is stored in session
        echo json_encode(['signedIn' => true, 'username' => $_SESSION['username']]);
    } else {
        echo json_encode(['signedIn' => false]);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}