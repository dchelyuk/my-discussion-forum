<?php
$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $post_id = 8;
    $sql = 'select * from Comments where postId = $post_id  order by commentCreateDate desc;';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['postId' => $post_id]);
    echo $stmt;



?>