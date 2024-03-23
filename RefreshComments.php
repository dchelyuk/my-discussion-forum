<?php
header('Content-Type: application/json');


$pdo = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password');


$lastCommentId = isset($_POST['lastCommentId']) ? (int)$_POST['lastCommentId'] : 0;

// Query to fetch new comments
$stmt = $pdo->prepare("SELECT id, user_id, text, timestamp FROM comments WHERE id > :lastCommentId ORDER BY id ASC");
$stmt->execute(['lastCommentId' => $lastCommentId]);

// Fetching comments
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preparing data to be JSON encoded
$response = ['comments' => []];

foreach ($comments as $comment) {
    // create function getUserById that fetches user details by ID so it works
    $user = getUserById($comment['user_id']);
    $response['comments'][] = [
        'id' => $comment['id'],
        'user' => $user['username'], 
        'text' => $comment['text'],
        'timestamp' => $comment['timestamp'],
    ];
}

echo json_encode($response);

// Example function to fetch user details depending on danylos database
function getUserById($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :userId");
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}