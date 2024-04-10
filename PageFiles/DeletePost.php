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

    $postId = isset($_POST['post_id']) ? $_POST['post_id'] : null; 

    if ($postId === null) {
        echo json_encode(['success' => false, 'message' => 'Post ID is required.']);
        exit;
    }

    $sql = "DELETE FROM Posts WHERE postId = :postId";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['postId' => $postId]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Post deleted successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No post found or deletion failed.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}