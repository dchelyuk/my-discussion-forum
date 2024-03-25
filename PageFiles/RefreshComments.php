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

//$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


try {
    // Create a new PDO instance
//    $pdo = new PDO($dsn, $username, $password);
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to select data
    $post_id = 8;

    $sql = "select * from Comments where postId = $post_id  order by commentCreateDate desc;";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch data and save it in an array
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (PDOException $e) {
    // Handle errors gracefully
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
//echo var_export($response);
//echo var_export($response[0]['text']);
// Example function to fetch user details depending on danylos database


