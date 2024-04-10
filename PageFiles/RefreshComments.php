<?php


// Refreshes comments from database. postid is hardcoded until main page is completed


header('Content-Type: application/json');

$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';
try {
 
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   //TODO: make postid dynamic
    $post_id = 8;

    $sql = "select * from Comments where postId = $post_id  order by commentCreateDate desc;";

    
    $stmt = $pdo->prepare($sql);


    $stmt->execute();


    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$response = [];

foreach ($comments as $comment) {

    $response[] = [
        'id' => $comment['commentId'],
        'text' => $comment['data'],
        'timestamp' => $comment['commentCreateDate'],
    ];
}

echo json_encode($response);

// Example function to fetch user details depending on danylos database


