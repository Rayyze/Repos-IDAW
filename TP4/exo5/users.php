<?php
require_once("init_pdo.php");

function setHeaders() {
    // https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Access-Control-Allow-Origin
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json; charset=utf-8');
}

function get_users($db) {
    if(isset($_GET['id'])) {
        $sql = "SELECT * FROM users WHERE id=:user_id"; 
        $exe = $db->prepare($sql);
    
        $exe->bindParam(':user_id', $_GET['id']);
        $exe->execute();
    } else {
        $sql = "SELECT * FROM users"; 
        $exe = $db->query($sql); 
        $res = $exe->fetchAll(PDO::FETCH_OBJ);
    }
    
    return $res;
}

function new_user($db) {
    $sql = "INSERT INTO users (login, email) VALUES (:login, :email)"; 
    $exe = $db->prepare($sql);

    $exe->bindParam(':login', $_POST['login']);
    $exe->bindParam(':email', $_POST['email']);

    if ($exe->execute()) {
        $newUserId = $db->lastInsertId();
        $res = [
            'id' => $newUserId,
            'login' => $_POST['login'],
            'email' => $_POST['email']
        ];

        http_response_code(201);
    } else {
        $res = [
            "error" => "Failed to create user."
        ];
        http_response_code(500);
    }
    return $res;
}

switch($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        $result = get_users($pdo);
        setHeaders();
        echo json_encode($result);
        exit;
        
    case 'POST':
        $result = new_user($pdo);
        echo json_encode($result);
        exit;
        
    case 'PUT':
        $result = new_user($pdo);
        http_response_code(501);
        exit(json_encode(["error" => "PUT method not implemented"]));
    
    case 'DELETE':
        $result = new_user($pdo);
        http_response_code(501);
        exit(json_encode(["error" => "DELETE method not implemented"]));
        
    default:
        // https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
        http_response_code(405);
        exit(json_encode(["error" => "Method Not Allowed"]));
}
?>
