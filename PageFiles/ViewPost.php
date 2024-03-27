<?php
header('Content-Type: application/json');
$host = 'localhost:3308';
$dbname = 'cosc360test';
$dbUsername = 'root';
$dbPassword = '304rootpw';
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbUsername, $dbPassword);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// TODO: Make postid get from mainpage when they click on the link to view the post
$post_id = 8; 

// Fetch post data
$stmt = $pdo->prepare("SELECT * FROM Posts WHERE postId = :postId");
$stmt->execute(['postId' => $post_id]);
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