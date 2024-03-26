<?php
// Attempts to fetch posts and populate main page. lots to do, still in prototype stage
header('Content-Type: application/json');

$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';

// TODO: put pdo conn into try catch
$pdo = new PDO('mysql:host=localhost:3308;dbname=cosc360test', 'root', '304rootpw');


$stmt = $pdo->prepare('select * from Posts order by postCreateDate desc;');
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
    $stmt = $pdo->prepare('select * from Users where userId = ' . $userId . ';'); // TODO: what data is needed?
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

