<?php
// creates comment by inserting data into comments database. currently somewhat hardcoded to test java. SEE TODOS 

$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';
ini_set('display_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
//TODO: put con in try catch and echo message

try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    exit;}

session_start();
 //$user=$_SESSION['username'] ;
 $body = $_POST['commentText'];
 //echo($user);
//TODO: add sql call to get all data, save as variables, and pass to existing sql insert statement 
 //but it was easier for testing to have it there. update all data as it should be in the table. we need username to put beside comment
 // append it to end of comment using json

$sql = "INSERT INTO Comments (postId, userId, commentCreateDate, data) VALUES (8, 2,  cast(now() as datetime ), :body)";
$stmt = $conn->prepare($sql);

try {
    $stmt->execute([':body' => $body]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

