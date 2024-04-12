<?php
ini_set('display_errors', 0);
error_reporting(0);
// TODO figure out what data we want to display on main page under each post
header('Content-Type: application/json');

$host = 'localhost:3308';
$dbname = 'cosc360test';
$username = 'root';
$password = '304rootpw';

try {
$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT DISTINCT postTopic FROM Posts WHERE postTopic <> '' ORDER BY postTopic";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(['topics' => $topics]);
} catch(PDOException $e) {
echo json_encode(['error' => $e->getMessage()]);
}

