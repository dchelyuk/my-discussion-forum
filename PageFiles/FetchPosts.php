<?php
header('Content-Type: application/json');

$host = 'localhost:3308';
//$dbname = 'db_75934729';
$dbname = 'cosc360test';
//$username = '75934729';
$username = 'root';
//$password = '75934729';
$password = '304rootpw';
$dsn = "";

$pdo = new PDO('mysql:host=localhost:3308;dbname=cosc360test', 'root', '304rootpw');


//
//$post_id = 8;
//$lastCommentId = isset($_POST['lastCommentId']) ? (int)$_POST['lastCommentId'] : 0;


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

