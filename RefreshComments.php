<?php
header('Content-Type: application/json');


$pdo = new PDO('mysql:host=your_host;dbname=your_db', 'username', 'password');



$post_id = 1; 
$lastCommentId = isset($_POST['lastCommentId']) ? (int)$_POST['lastCommentId'] : 0;


$stmt = $pdo->prepare(); //TODO: add sql to fetch comments from database
$stmt->execute(['lastCommentId' => $lastCommentId]);


$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);


$response = ['comments' => []];

foreach ($comments as $comment) {

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
    $stmt = $pdo->prepare('g'); // TODO: statement to get stuff
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

