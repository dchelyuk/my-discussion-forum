<?php
ini_set('display_errors', 0);
error_reporting(0);
// TODO figure out what data we want to display on main page under each post
header('Content-Type: application/json');

$host = 'localhost:3306';
$dbname = 'db_75934729';
$username = '75934729';
$password = '75934729';

try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$sql = "SELECT postId, headline FROM Posts ORDER BY postId DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(['posts' => $posts]);
} catch(PDOException $e) {
echo json_encode(['error' => $e->getMessage()]);
}





