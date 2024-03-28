<?php
$host = 'localhost:3306';
$dbname = 'db_75934729';
$username = '75934729';
$password = '75934729';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $post_id = 8;
    $sql = 'select * from Comments where postId = $post_id  order by commentCreateDate desc;';
    $stmt = $conn->prepare($sql);
    $stmt->execute(['postId' => $post_id]);
    echo $stmt;



?>