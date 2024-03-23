<?php
header('Content-Type: application/json');


$pdo = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password');


// Assuming $conn is your PDO database connection
$post_id = 1; // Example: the ID of the post you're fetching comments for
$lastCommentId = isset($_POST['lastCommentId']) ? (int)$_POST['lastCommentId'] : 0;

// Query to fetch new comments
$stmt = $pdo->prepare(); //TODO: add sql to fetch comments from database
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
    return "comment 23" //$stmt->fetch(PDO::FETCH_ASSOC);
}

