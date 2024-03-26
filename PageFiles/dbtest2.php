<?php


$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';
echo('php works');
//$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

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
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Print or manipulate the data as needed
    print_r($data);

} catch (PDOException $e) {
    // Handle errors gracefully
    echo "Connection issue: " . $e->getMessage();
}

