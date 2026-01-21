<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');


$data = json_decode(file_get_contents("php://input"), true);


$username = isset($data['username']) ? $data['username'] : (isset($_POST['username']) ? $_POST['username'] : '');

$response = [
    'taken' => false,
    'error' => ''
];

if (empty($username)) {
    $response['error'] = 'Username vuoto';
} else {

    if ($dbh->isUsernameTaken($username)) {
        $response['taken'] = true;
    }
}

echo json_encode($response);
?>