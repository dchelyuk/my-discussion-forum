<?php
header('Content-Type: application/json');
$host = 'localhost:3308';
$dbname = 'cosc360test';
$dbUsername = 'root';
$dbPassword = '304rootpw';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// TODO: Make postid get from mainpage when they click on the link to view the post
// it was working but now isnt so i removed it
//$post_id = isset($_GET['postId']) ? $_GET['postId'] : null;

// Fetch post data
$stmt = $pdo->prepare("SELECT * FROM Posts WHERE postId = 8");
//$stmt->execute(['postId' => $post_id]);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);


$response = [
    'postId' => $post['postId'],
    'userId' => $post['userId'],
    'postCreateDate' => $post['postCreateDate'],
    'headline' => $post['headline'],
    'data' => $post['data'],
    'picture_url' => $post['picture_url'],
];

echo json_encode($response);