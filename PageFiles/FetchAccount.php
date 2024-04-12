<?php
header('Content-Type: application/json');
global $host, $dbname, $username, $password;
include 'dbCredentials.php';
session_start();

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_SESSION['userId'] ?? null;

if ($user_id != null) {
    $stmt = $pdo->prepare("SELECT username, accountCreateDate, image, contentType FROM Users  as u left join userImages as uI on u.userId = uI.userId WHERE u.userId = :userId;");
    $stmt->execute(['userId' => $user_id]);

    if ($stmt->rowCount() > 0) {
        // Fetch image blob data and image type
        $row = $stmt->fetch();
        $account['username'] = $row['username'];
        $account['accountCreateDate'] = $row['accountCreateDate'];
        if ($row['contentType'] != null) {
        $account['image'] = 'data:' . $row['contentType'] . ';base64,' . base64_encode($row['image']);
        } else {
            $account['image'] = null;
        }
    }
} else {
    $account['username'] = "Unregistered user";
    $account['accountCreateDate'] = "Not registered";
    $account['image'] = null;
}

$response = [
    'username' => $account['username'],
    'accountCreateDate' => $account['accountCreateDate'],
    'image' => $account['image']
];
echo json_encode($response);